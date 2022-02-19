<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "assets-sko/css/bootstrap.min.css",
        "assets-sko/css/icons.min.css",
        "assets-sko/css/app.min.css",
        "assets-sko/libs/sweetalert2/sweetalert2.min.css",

        "css/default.css",
        "css/widgets.css",
    ];
    public $js = [
        "assets-sko/libs/bootstrap/js/bootstrap.bundle.min.js",
        "assets-sko/libs/metismenu/metisMenu.min.js", // left menu
        "assets-sko/libs/simplebar/simplebar.min.js",
        "assets-sko/libs/node-waves/waves.min.js",

        "assets-sko/js/app.js",
        "assets-sko/libs/sweetalert2/sweetalert2.min.js",

        "js/yii.activeForm.js",
        "js/yii.gridView.js",
        "js/default.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
