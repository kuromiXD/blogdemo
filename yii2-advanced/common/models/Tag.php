<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 * @property int $frequency
 */
class Tag extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    public static function stringtoarray($tags)
    {
        //return explode(',',$tags);
        return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
    }

    public static function arraytostring($tags) 
    {
        return implode(',',$tags);
    }
    
    public static function addTags($tags)
    {
        if(empty($tags)) return;
        foreach ($tags as $name) {
            $find_tag_count=Tag::find()->where(['name'=>$name])->count();
            if(!$find_tag_count){
                $new_tag = new Tag;
                $new_tag->name=$name;
                $new_tag->frequency=1;
                $new_tag->save();
            } else {
                $find_tag=Tag::find()->where(['name'=>$name])->one();
                $find_tag->frequency+=1;
                $find_tag->save();
            }
        }
    }

    public static function deleteTags($tags)
    {
        if(empty($tags)) return;
        foreach ($tags as $name) {
            
            $find_tag_count=Tag::find()->where(['name'=>$name])->count();
            if($find_tag_count){
                $find_tag=Tag::find()->where(['name'=>$name])->one();
                if($find_tag->frequency<=1){
                    $find_tag->delete();
                } else {
                    $find_tag->frequency-=1;
                    $find_tag->save();
                }
            }
        }
    }

    public static function updateFrequency($oldtags,$newtags)
    {
        if(!empty($oldtags) || !empty($newtags)){
            $oldtagsarray=self::stringtoarray($oldtags);
            $newtagsarray=self::stringtoarray($newtags);
            self::addTags(array_diff($newtagsarray,$oldtagsarray));
            self::deleteTags(array_diff($oldtagsarray,$newtagsarray));
        }
        
    }

    public static function findTagsWeight($limit=20){
        $tag_size_level=5;

        $models=Tag::find()->orderBy('frequency desc')->limit($limit)->all();
        $total=Tag::find()->limit($limit)->count();

        $stepper=ceil($total/$tag_size_level);

        $tags=array();
        $counter=1;

        if($total>0)
        {
            foreach($models as $model)
            {
                $weight=ceil($counter/$stepper)+1;
                $tags[$model->name]=$weight;
                $counter++;
            }
            ksort($tags);
        }
        
        return $tags;
    }

    
}
