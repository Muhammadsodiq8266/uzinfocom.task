<?php

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\AuthItem */
/* @var $permission_category app\modules\admin\models\AuthItem */

$this->title = Yii::t('app', 'Update Permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Permission'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('_permission', [
    'model' => $model,
]) ?>