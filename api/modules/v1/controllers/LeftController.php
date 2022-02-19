<?php

namespace app\api\modules\v1\controllers;

use yii\web\Response;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use app\api\modules\v1\components\CorsCustom;
use app\api\modules\v1\models\BaseModel as BM;

/**
 * Country Controller API
 */
class LeftController extends ActiveController
{
    public $modelClass = 'app\models\LeftMenu';

    public $enableCsrfValidation = false;

    /**
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['index']);
        unset($actions['view']);
        return $actions;
    }

    /**
     * @return array[]
     */
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => CorsCustom::className()
            ],
            [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actionIndex(): array
    {
        $response['menu'] = BM::getTreeMenu();
        $response['status'] = true;
        return $response;
    }

}
