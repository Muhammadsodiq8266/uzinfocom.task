<?php

use kartik\base\BootstrapInterface;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Users */
/* @var $form yii\widgets\ActiveForm */
/* @var $rules  */
/* @var $assignment app\modules\admin\models\AuthAssignment */
?>

<?php $form = ActiveForm::begin([
    'id' => $model->formName(),
    'method' => 'POST',
    'enableAjaxValidation' => true
]); ?>


<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

<?= $form->field($model, 'confirmPassword')->passwordInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

<?= $form->field($assignment, 'elements')->widget(Select2::classname(), [
    'data' => $rules,
    'size' => BootstrapInterface::SIZE_SMALL,
    'options' => [
        'placeholder' => Yii::t('app', 'Select . . .'),
        'multiple' => true
    ],
    'pluginOptions' => [
        'allowClear' => true
    ],
])->label(Yii::t('app', 'Select a rules')) ?>


<?= $form->field($model, 'status')->dropDownList([
    $model::STATUS_ACTIVE => Yii::t('app', 'Active'),
    $model::STATUS_INACTIVE => Yii::t('app', 'Inactive'),
]) ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-outline-success font-size-14 px-5 btn-sm saveButton']) ?>
</div>

<?php ActiveForm::end(); ?>
