<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ReactAsset extends AssetBundle
{
    public static string $reactFileName = 'index';
    public static string $reactCssFileName = '';
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public function init()
    {
        parent::init();
        $reactFileName = self::$reactFileName;
        $reactCssFileName = self::$reactCssFileName;
        $this->js[] = "reactjs/dist/app/{$reactFileName}.bundle.js";
        if($reactCssFileName) {
            $this->css[] = "reactjs/dist/css/{$reactCssFileName}.css";
        }
    }
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
