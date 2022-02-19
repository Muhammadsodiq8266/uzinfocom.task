<?php

/* @var $this yii\web\View */

use app\assets\ReactAsset;
use yii\helpers\Url;

ReactAsset::$reactFileName = 'leftMenu';
ReactAsset::$reactCssFileName = 'leftMenu';
ReactAsset::register($this);
?>
<div data-simplebar="init" class="h-100">
    <div id="sidebar-menu"></div>
</div>


