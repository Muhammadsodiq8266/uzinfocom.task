<?php

use app\modules\admin\models\AuthItem;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Permission');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-sm-12 p-0">
    <div class="card">
        <div class="card-body">
            <div class="mb-2">
                <?= Html::a('<i class="fa fa-plus mr-2"></i>' .
                    Yii::t('app', 'Create Permission'), ['create'],
                    ['class' => 'btn btn-primary btn-sm modal-main-show',
                        'title' => Yii::t('app', 'Create Permission'),
                        'data-toggle' => "modal", 'data-target' => "#exampleModalScrollable"]); ?>
            </div>
            <div class="table-responsive">
                <?php try {
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'summary' => false,
                        'tableOptions' => ['class' => 'table table-bordered'],
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                'attribute' => 'name',
                                'label' => Yii::t('app', 'Permission'),
                            ],
                            'description:ntext',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {remove}',
                                'header' => Yii::t('app', 'Actions'),
                                'headerOptions' => ['class' => 'text-center', 'style' => 'color: #556ee6;'],
                                'contentOptions' => ['style' => 'min-width: 75px!important; width: 75px!important;'],
                                'buttons' => [
                                    'update' => function ($url) {
                                        return Html::a('<span class="fa fa-pen fa-sm fa-1x"></span>', $url, [
                                            'title' => Yii::t('app', 'Update'),
                                            'class' => "btn btn-xs btn-outline-info modal-main-show",
                                            'data-toggle' => "modal", 'data-target' => "#exampleModalScrollable"
                                        ]);
                                    },
                                    'remove' => function ($url) {
                                        return Html::a('<span class="fa fa-trash-alt fa-sm fa-1x"></span>', $url, [
                                            'title' => Yii::t('app', 'Delete'),
                                            'class' => "btn btn-xs btn-outline-danger delete-ajax",
                                            'data-id' => Yii::$app->language
                                        ]);
                                    },

                                ],
                            ],
                        ]
                    ]);
                } catch (Exception $e) {
                    Yii::error('Error Gridview "permission/index" ' . $e->getMessage(), 'index');
                } ?>
            </div>
        </div>
    </div>
</div>