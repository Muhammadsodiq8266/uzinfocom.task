<?php

namespace app\modules\admin\controllers;

use app\controllers\BaseController;
use app\modules\admin\models\AuthItem;
use app\modules\admin\models\AuthItemSearch;
use yii\bootstrap\ActiveForm;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Exception;
use yii\web\Response;

class PermissionController extends BaseController
{
    /**
     * @return string
     */
    public function actionIndex(){
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('permission_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return array|string|Response
     */
    public function actionCreate(){

        $model = new AuthItem();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            try {
                $model->setAttributes([
                    'type' => $model::CATEGORY_PERMISSION,
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ]);
                if ($model->save()) {
                    Yii::$app->session->set('success', Yii::t('app', 'Permission saved!'));
                } else {
                    Yii::$app->session->set('danger', Yii::t('app', 'Error saving permission!'));
                }
            } catch (Exception $e){
                Yii::info('Error Permission Saved '.$e->getMessage(),'save');
            }
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('permission_create', [
                'model' => $model,
            ]);
        }
        return $this->render('permission_create', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return array|string|Response
     */
    public function actionUpdate($id){
        $model = AuthItem::findOne(['name' => $id]);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            try {
                $model->setAttributes([
                    'type' => $model::CATEGORY_PERMISSION,
                    'created_at' => strtotime(date('Y-m-d H:i:s')),
                    'updated_at' => strtotime(date('Y-m-d H:i:s'))
                ]);
                if ($model->save()) {
                    Yii::$app->session->set('success', Yii::t('app', 'Permission edited!'));
                } else {
                    Yii::$app->session->set('danger', Yii::t('app', 'Error editing permission!'));
                }
            } catch (Exception $e){
                Yii::info('Error Permission Update '.$e->getMessage(),'update');
            }
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('permission_update', [
                'model' => $model,
            ]);
        }

        return $this->render('permission_update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return array|ActiveRecord[]
     * @throws \Throwable
     */
    public function actionRemove($id){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = AuthItem::findOne($id);
        $response['status'] = 'false';
        $response['error'] = Yii::t('app', 'Error deleting permission!');
        $response['saved'] = Yii::t('app', 'Permission deleted!');
        if (!empty($model)) {
            if ($model->delete()) {
                $response['status'] = 'true';
            } else {
                $response['status'] = 'false';
            }
        }
        return $response;
    }
}