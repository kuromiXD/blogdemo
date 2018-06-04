<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Comment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
            //'status',
            [
              'attribute'=>'status',
              'value'=>$model->status0->name,  
            ],
            //'create_time:datetime',
            [
                'attribute'=>'status',
                'value'=>date('Y-m-d H:i:s',$model->create_time),
            ],
            //'userid',
            [
                'label'=>'发表者',
                'value'=>$model->user->username,
            ],
            'email:email',
            //'url:url',
            [
                'label'=>'文章名',
                'value'=>$model->post->title,
            ],
            //'post_id',
        ],
    ]) ?>

</div>
