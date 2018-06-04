<?php
namespace frontend\components;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

class RctRelyWidget extends Widget
{
    public $recentComments;

    public function init(){
        parent::init();
    }

    public function run(){
        $commentString='';
        $fontStyle=array("6"=>"danger",
        "5"=>"info",
        "4"=>"warning",
        "3"=>"primary",
        "2"=>"success",
    );

        foreach($this->recentComments as $comment){
            $commentString.='<div class="post">'.
                    '<div class="title">'.
                    '<p style="color:#777777;font-style:italic;">'.
                    nl2br($comment->content).'</p>'.
                    '<p style="font-size:8pt,color:blue">《<a href="'.
                    $comment->post->url.'">'.Html::encode($comment->post->title).'</a>》</p>'.
                    '<hr></div></div>';
        }
        return $commentString;
    }

}


?>