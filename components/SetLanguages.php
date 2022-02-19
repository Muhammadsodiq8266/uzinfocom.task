<?php
namespace app\components;

use yii\base\Behavior;
use yii\web\Application;
use Yii;

class SetLanguages extends Behavior {
    /**
     * @return string[]
     */
    public function events(){
        return [ Application::EVENT_BEFORE_REQUEST => 'set' ];
    }


    public function set() {
        if (Yii::$app->session->has('language')) {
            Yii::$app->language=Yii::$app->session->get('language');
        }
    }
}
