<?php


namespace app\components;


use Yii;
use yii\base\Widget;

class MenuActivate extends Widget
{
    /**
     * @param $module string /*
     * @param $controller string /*
     * @return string
     */
    public static function active($module, $controller){
        $moduleId = Yii::$app->controller->module->id;
        $controllerId = Yii::$app->controller->id;
        $actionId = Yii::$app->controller->action->id;
        if ($moduleId == $module && $controllerId == $controller) {
            return 'menu-item menu-item-active';
        }
        return 'menu-item';
    }

    /**
     * @param $module
     * @return string
     */
    public static function controller($module) {
        $moduleId = Yii::$app->controller->module->id;
        if ($moduleId === $module) {
            return 'menu-item-open';
        }
        return '';
    }


}