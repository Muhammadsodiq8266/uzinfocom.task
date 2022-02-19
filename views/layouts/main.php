<?php

/* @var $this yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body data-sidebar="dark">
<?php $this->beginBody() ?>


<!-- Modal Begin-->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-main">
                <h5 class="modal-title modal-title-main mt-0" id="exampleModalScrollableTitle">
                    <i class="fa fa-spin fa-spinner text-danger fa-spin1_2rem"></i>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="mdi mdi-close noti-icon"></i>
                </button>
            </div>
            <div class="modal-body modal-body-main">

            </div>
        </div>
    </div>
</div>
<!-- Modal End -->


<!-- Begin page -->
<div id="layout-wrapper">
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="<?=Url::home()?>" class="logo logo-light" style="color: white; font-size: 20px; font-style: italic;">
                        UzInfoCom
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>


            <div class="d-flex">
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img id="header-lang-img" src="<?=Url::base() ?>/web/assets-sko/images/flags/<?=Yii::$app->language.'.jpg';?>"
                             alt="<?=Yii::$app->language ?>" height="18">
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <?php foreach (Yii::$app->params['language'] as $key => $value): ?>
                            <a href="<?=Url::to(['/site/language', 'language' => $key])?>" class="dropdown-item notify-item language" data-lang="<?=$key ?>">
                                <img src="<?=Url::base() ?>/web/assets-sko/images/flags/<?=$key ?>.jpg" alt="<?=$key ?>" class="mr-1" height="12">
                                <span class="align-middle"><?=$value ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="bx bx-fullscreen"></i>
                    </button>
                </div>



                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="<?=Url::base() ?>/web/assets-sko/images/users/avatar-1.jpg" alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ml-1" key="t-henry"><?=Yii::$app->user->identity->username ?></span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="<?=Url::to(['/site/logout'])?>">
                            <i class="bx bx-power-off font-size-16 align-middle mr-1"></i>
                            <?= Yii::t('app', 'Sign Out') ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <?=$this->render('left') ?>

    </div>
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="card">
                            <div class="card-body">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h5 class="mb-0 font-size-18 title-breadcrumb">
                                <i class="fa fa-spin fa-spinner text-primary fa-spin1_2rem"></i>
                            </h5>
                            <div class="page-title-right">
                                <?= Breadcrumbs::widget([
                                    'options' => [
                                        'class' => 'breadcrumb m-0',
                                    ],
                                    'tag' => 'ol',
                                    'activeItemTemplate' => "<li class='breadcrumb-item active'>{link}</li>\n",
                                    'itemTemplate' => "<li class='breadcrumb-item link-breadcrumb'>{link}</li>",
                                    'links' => $this->params['breadcrumbs'] ?? [],
                                ]) ?>
                            </div>
                        </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">

                     <?= $content ?>

                </div>
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-right d-none d-sm-block">
                           WWW
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="<?=Url::to(['/base/return-false'])?>" class="right-bar-toggle float-right">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0 right-title">
                <i class="fa fa-spin fa-spinner text-primary fa-spin1_3rem"></i>
            </h5>
        </div>
        <hr class="mt-0"/>
        <div id="right-bar-body" class="ml-1 mr-1 mb-5">

        </div>
    </div>
</div>


<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
