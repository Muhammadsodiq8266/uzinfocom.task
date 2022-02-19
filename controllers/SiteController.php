<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use app\models\LoginForm;

class SiteController extends BaseController
{

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        $this->layout = 'login-main';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * @param $language
     * @return Response
     */
    public function actionLanguage($language){
        Yii::$app->session->set('language', $language);
        Yii::$app->language = $language;
        if (empty(Yii::$app->request->referrer)){
            return $this->redirect(['index']);
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }
    }
}
