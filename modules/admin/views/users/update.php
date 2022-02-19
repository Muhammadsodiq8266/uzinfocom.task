<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Users */
/* @var $assignment app\modules\admin\models\AuthAssignment */
/* @var $rules app\modules\admin\models\AuthItem */

$this->title = Yii::t('app', 'Update User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update User');
?>
<div class="col-sm-12">
    <?= $this->render('_form', [
        'model' => $model,
        'assignment' => $assignment,
        'rules' => $rules,
    ]) ?>
</div>
