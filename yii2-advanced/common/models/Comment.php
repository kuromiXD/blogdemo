<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property string $content
 * @property int $status
 * @property int $create_time
 * @property int $userid
 * @property string $email
 * @property string $url
 * @property int $post_id
 * @property int $remind 0:未提醒 1:已提醒 
 *
 * @property Post $post
 * @property Commentstatus $status0
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status', 'userid', 'email', 'post_id'], 'required'],
            [['content'], 'string'],
            [['status', 'create_time', 'userid', 'post_id', 'remind'], 'integer'],
            [['email', 'url'], 'string', 'max' => 128],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Commentstatus::className(), 'targetAttribute' => ['status' => 'id']],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '评论内容',
            'status' => '状态',
            'create_time' => '发表时间',
            'userid' => '用户ID',
            'email' => '邮箱',
            'url' => 'Url',
            'post_id' => '文章ID',
            'remind' => '是否提醒',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Commentstatus::className(), ['id' => 'status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    public function getBeginning()
    {
        $tmpStr=strip_tags($this->content);
        $tmpLen=mb_strlen($tmpStr);
        return mb_substr($tmpStr,0,20,'UTF-8').(($tmpLen>20) ? '...' : '');
    }

    public function approve(){
        $this->status=2;
        return ($this->save()?true:false);
    }

    public static function getPengdingCommentCount(){
        return Comment::find()->where(['status'=>1])->count();
    }

    public static function findRecentComments($limit=5){
        return Comment::find()->where(['status'=>2])->orderBy('create_time desc')->limit($limit)
        ->all();
    }
}
