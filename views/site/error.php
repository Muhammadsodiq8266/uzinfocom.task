<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">
<div class="account-pages my-1 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    <h1 class="display-2 font-weight-medium">
                        <?=substr($name, strpos($name, '#') + 1, 1) ?><i class="bx bx-buoy bx-spin text-primary display-3"></i><?=substr($name, strpos($name, '#') + 3, 1) ?>
                    </h1>
                    <h4 class="text-danger"><?= nl2br(Html::encode($message)) ?></h4>
                    <div class="mt-4 text-center">
                        <a class="btn btn-primary waves-effect waves-light" href="<?=Url::home()?>">
                            <?=Yii::t('app', 'Back to Dashboard') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 col-xl-6">
                <div class="text-center">
                    <img src="<?=Url::base()?>/web/assets-sko/images/error-img.png" alt="" class="img-fluid">
                    <h4 class="text-danger">Ooops!</h4>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
