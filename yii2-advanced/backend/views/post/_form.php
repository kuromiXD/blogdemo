<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Poststatus;
use common\models\Adminuser;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tags')->textarea(['rows' => 6]) ?>

    <?php
        /*
        $poststatus_obj=Poststatus::find()->all();
        $poststatus=ArrayHelper::map($poststatus_obj, 'id' , 'name');
        */

        /*
        $poststatus_arr=Yii::$app->db->createCommand('select id,name from poststatus')->queryAll();
        $poststatus=ArrayHelper::map($poststatus_arr, 'id' , 'name');
        */

        /*
        $poststatus=(new \yii\db\Query())
        ->select(['name','id'])
        ->from('poststatus')
        ->indexBy('id')
        ->column();
        */
        
    ?>

    <?= $form->field($model, 'status')->dropDownList(
        Poststatus::find()
        ->select(['name','id'])
        ->indexBy('id')
        ->column(),['prompt' => '请选择文章状态']
        ) ?>

    <?= $form->field($model, 'author_id')->dropDownList(
        Adminuser::find()
        ->select(['nickname','id'])
        ->indexBy('id')
        ->column(),['prompt' => '请选择作者']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('保存修改', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
