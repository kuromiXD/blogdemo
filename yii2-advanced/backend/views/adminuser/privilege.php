<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Adminuser */

$this->title = '权限设置: '.$id;
$this->params['breadcrumbs'][] = ['label' => 'privileges', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $id, 'url' => ['view', 'id' => $id]];
$this->params['breadcrumbs'][] = '权限设置';
?>
<div class="adminuser-privilege-form">

<h1><?= Html::encode($this->title) ?></h1>

<div class="adminuser-privilege-form">

<?php $form = ActiveForm::begin(); ?>
<?= Html::checkboxList( 'newPri', $AuthAssignmentsArray , $allPrivilegesArray ) ?>


<div class="form-group">
<?= Html::submitButton('设置', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>


</div>