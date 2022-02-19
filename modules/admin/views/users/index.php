<?php

use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-sm-12 p-0">
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <?= Html::a('<i class="fa fa-user mr-2"></i>'.Yii::t('app', 'Create User'),
                    ['create'], ['class' => 'btn btn-primary btn-sm modal-main-show',
                        'title' => Yii::t('app', 'Create User'),
                        'data-toggle' => "modal", 'data-target' => "#exampleModalScrollable"
                    ]) ?>
            </div>
            <div class="table-responsive">
            <?php
            try {
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'summary' => '',
                    'tableOptions' => ['class' => 'table table-bordered table-hover'],
                    'columns' => [
                        [ 'class' => SerialColumn::class ],
                        'name',
                        'username',
                        'position',
                        'email:email',
                        'address:ntext',
                        'content:ntext',
                        [
                            'attribute' => 'status',
                            'format' => 'raw',
                            'value' => function ($model) {
                                if ($model->status == $model::STATUS_ACTIVE) {
                                    return '<span class="badge badge-primary d-block font-size-13 py-1"> ' . Yii::t('app', 'Active') . ' </span>';
                                }
                                return '<span class="badge badge-danger d-block font-size-13 py-1">' . Yii::t('app', 'Inactive') . '</span>';
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'contentOptions' => ['style' => 'min-width: 100px!important; width: 100px!important;'],
                            'template' => '{view} {update} {remove}',
                            'header' => Yii::t('app', 'Actions'),
                            'headerOptions' => ['class' => 'text-center', 'style' => 'color: #556ee6;'],
                            'buttons' => [
                                'view' => function ($url) {
                                    return Html::a('<i class="fa fa-eye"></i>', $url, [
                                        'title' => Yii::t('app', 'View'),
                                        'class' => "btn btn-xs btn-outline-success right-bar-toggle",
                                    ]);
                                },
                                'update' => function ($url) {
                                    return Html::a('<i class="fa fa-pen"></i>', $url, [
                                        'class' => "btn btn-xs btn-outline-info modal-main-show",
                                        'title' => Yii::t('app', 'Update User'),
                                        'data-toggle' => "modal", 'data-target' => "#exampleModalScrollable"
                                    ]);
                                },
                                'remove' => function ($url) {
                                    return Html::a('<i class="fa fa-trash-alt"></i>', $url, [
                                        'title' => Yii::t('app', 'Delete'),
                                        'class' => "btn btn-xs btn-outline-danger delete-ajax",
                                    ]);
                                },

                            ],
                            'visibleButtons' => [
//                                'update' => function () {
//                                    return Yii::$app->user->can('users/update');
//                                },
//                                'remove' => function () {
//                                    return Yii::$app->user->can('users/delete');
//                                },
//                                'view' => function () {
//                                    return Yii::$app->user->can('users/view');
//                                },
                            ],

                        ],
                    ],
                ]);
            } catch (Exception $e) {
                Yii::error('Error Gridview "users/index" '.$e->getMessage(), 'index');
            } ?>
            </div>
        </div>

    </div>
</div>