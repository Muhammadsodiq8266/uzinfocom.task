<?php

use app\models\BaseModel;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>

<div class="col-sm-12">
    <div class="table-responsive mb-5">
    <?= DetailView::widget([
        'model' => $model,
        'options' => [
            'style' =>[
                'border-radius' => '1px',
            ],
            'class' =>'table table-bordered'
        ],
        'attributes' => [
            'name',
            'username',
            'email:email',
            'address',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return BaseModel::getStatus($model->status);
                }
            ],
        ],
    ]) ?>
    </div>
    <?=$model::getCreatedUpdated($model->created_at, $model->created_by, $model->updated_at, $model->updated_by) ?>
</div>
