<?php

use app\components\CustomMultipleInput;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="col-xxl-12 order-2 order-xxl-1">
    <div class="card card-custom card-stretch gutter-b">
        <div class="card-body pt-4 pb-1 pl-4 pr-4">
            <?php $form = ActiveForm::begin([
                'enableAjaxValidation' => true,
            ]); ?>
            <div class="row">

                <div class="col-sm-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-sm-12 mb-4">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-sm font-size-13 px-4 ml-1 saveButton']) ?>
                </div>

            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
