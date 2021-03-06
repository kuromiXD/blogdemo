<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = '更改管理员信息:'.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Adminusers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="adminuser-update">

<h1><?= Html::encode($this->title) ?></h1>

<div class="adminuser-update">

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'profile')->textarea(['rows' => 6]) ?>


<div class="form-group">
<?= Html::submitButton('更改', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>


</div>
