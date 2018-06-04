<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Commentstatus;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '评论管理';
$this->params['breadcrumbs'][] = '评论管理';
?>
<div class="comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建评论', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'content:ntext',
            [
                'attribute'=>'content',
                'value'=>'beginning',
               
            ],
            //status',
            [
                'attribute'=>'status',
                'value'=>'status0.name',
                'filter'=>Commentstatus::getDropdownlist(),
                'contentOptions'=>function($model)
                                    {
                                        return ($model->status==1)?['class'=>'bg-danger']:[];
                                    }
                ,
            ],
            //'create_time:datetime',
            [
                'attribute'=>'create_time',
                'format'=>['date','php:Y-m-d H:i:s'],
            ],
            //'userid',
            [
                'attribute'=>'user.username',
                'value'=>'user.username',
                'label'=>'发表者',
                'contentOptions'=>['width'=>'110px'],
            ],
            [
                'attribute'=>'post.title',
                'value'=>'post.title',
                'label'=>'文章名',
            ],
            //'email:email',
            //'url:url',
            //'post_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}{approve}',
                'buttons' => [
                    'approve' =>function($url,$model,$key)
                                    {
                                        $options=[
                                            'title'=>Yii::t('yii','审核'),
                                            'aria-label'=>Yii::t('yii','审核'),
                                            'data-confirm'=>Yii::t('yii','你确定要审核这条评论吗？'),
                                            'data-method'=>'post',
                                            'data-pjax'=>'0',
                                        ];
                                        return Html::a('<span class="glyphicon glyphicon-check"></span>',$url,$options);
                                    },
                                ],
            ],
        ],
    ]); ?>
</div>
