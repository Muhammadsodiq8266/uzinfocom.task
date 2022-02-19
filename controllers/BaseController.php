<?php

namespace app\controllers;

use app\models\BaseModel;
use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * summary
 */
class BaseController extends Controller

{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param Action $action
     * @return bool
     * @throws ForbiddenHttpException
     * @throws BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (Yii::$app->authManager->getPermission(Yii::$app->controller->id . "/" . Yii::$app->controller->action->id)) {
            if (!Yii::$app->user->can(Yii::$app->controller->id . "/" . Yii::$app->controller->action->id)) {
                throw new ForbiddenHttpException(Yii::t('app', 'Permission not available!'));
            }
        }

        return parent::beforeAction($action);
    }

    /**
     * @param $model
     * @return array
     */
    public function deleteAll($model){
        $response['status'] = 'false';
        $response['data'] = Yii::t('app', 'Deleted Error!');
        $model->status = BaseModel::STATUS_DELETE;
        if ($model->save()) {
            $response['status'] = 'true';
            $response['data'] = Yii::t('app', 'Data Deleted!');
        }
        return $response;
    }

    /**
     * @return string
     */
    public function actionReturnFalse()
    {
        return '';
    }
}

