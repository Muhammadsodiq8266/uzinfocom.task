<?php

namespace app\modules\admin\controllers;

use app\controllers\BaseController;
use app\modules\admin\models\AuthAssignment;
use app\modules\admin\models\AuthItem;
use Yii;
use app\modules\admin\models\Users;
use app\modules\admin\models\UsersSearch;
use yii\base\BaseObject;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends BaseController
{
    public function actionValidate()
    {
        $model = new Users();
        $request = Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        return true;
    }

    /**
     * Lists all Users models.
     * @return string
     */
    public function actionIndex()
    {

        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param $id
     * @return Response|string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id)
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return array|Response|string
     */
    public function actionCreate()
    {
        $model = new Users();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return \yii\bootstrap\ActiveForm::validate($model);
        }

        $assignment = new AuthAssignment();
        $rules = ArrayHelper::map(AuthItem::find()->all(), 'name', 'name');

        if ($model->load(Yii::$app->request->post())) {
            $model->password = md5($model->confirmPassword);
            $model->confirmPassword = $model->password;
            try {
                $transaction = Yii::$app->db->beginTransaction();
                $saved = false;
                $rules = Yii::$app->request->post('AuthAssignment');
                $rules = $rules['elements'];
                if ($model->save()) {
                    $saved = true;
                    if (!empty($rules)) {
                        foreach ($rules as $rule) {
                            $assign = new AuthAssignment();
                            $assign->setAttributes([
                                'item_name' => $rule,
                                'user_id' => (string)$model->id,
                                'created_at' => date('dmY'),
                                'elements' => true
                            ]);
                            if ($assign->save()) {
                                $saved = true;
                            } else {
                                $saved = false;
                                break;
                            }
                        }
                    }
                }
                if ($saved) {
                    $transaction->commit();
                    Yii::$app->session->set('success', Yii::t('app', 'User saved!'));
                } else {
                    $transaction->rollBack();
                    Yii::$app->session->set('danger', Yii::t('app', 'Error saving user!'));
                }

            } catch (Exception $e) {
                Yii::info('Error Rules Saved ' . $e->getMessage(), 'save');
            }
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
                'assignment' => $assignment,
                'rules' => $rules,
            ]);
        }
        return $this->render('create', [
            'model' => $model,
            'assignment' => $assignment,
            'rules' => $rules,
        ]);
    }

    /**
     * @param $id
     * @return array|string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return ActiveForm::validate($model);
        }

        $assignment = new AuthAssignment();
        $rules = ArrayHelper::map(AuthItem::find()->all(), 'name', 'name');
        $assignment->elements = ArrayHelper::map(AuthAssignment::find()->where(['user_id' => (string)$model->id])->all(), 'item_name', 'item_name');

        if ($model->load(Yii::$app->request->post())) {
            $model->password = md5($model->confirmPassword);
            $model->confirmPassword = $model->password;

            try {
                $transaction = Yii::$app->db->beginTransaction();
                $saved = false;
                if ($model->save()) {
                    $saved = true;
                    $rules = Yii::$app->request->post('AuthAssignment');
                    $rules = $rules['elements'];
                    AuthAssignment::deleteAll(['user_id' => (string)$model->id]);
                    if (!empty($rules)) {
                        foreach ($rules as $rule) {
                            $assign = new AuthAssignment();
                            $assign->setAttributes([
                                'elements' => true,
                                'item_name' => $rule,
                                'user_id' => (string)$model->id,
                                'created_at' => date('dmY')
                            ]);
                            if ($assign->save()) {
                                $saved = true;
                            } else {
                                $saved = false;
                                break;
                            }
                        }
                    }
                }
                if ($saved) {
                    $transaction->commit();
                    Yii::$app->session->set('success', Yii::t('app', 'User edited!'));
                } else {
                    $transaction->rollBack();
                    Yii::$app->session->set('danger', Yii::t('app', 'User editing error!'));
                }

            } catch (Exception $e) {
                Yii::info('Error Rules Update ' . $e->getMessage(), 'update');
            }
            return $this->redirect(['index']);
        }

        $model->password = '';
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
                'assignment' => $assignment,
                'rules' => $rules,
            ]);
        }
        return $this->render('update', [
            'model' => $model,
            'assignment' => $assignment,
            'rules' => $rules,
        ]);
    }

    /**
     * @param $id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionRemove($id)
    {
        $model = $this->findModel($id);
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response['status'] = 'false';
        $response['error'] = Yii::t('app', 'Error deleting user!');
        $response['saved'] = Yii::t('app', 'User Deleted!');
        if (!empty($model)) {
            $model->setAttributes([
                'status' => $model::STATUS_DELETE,
                'confirmPassword' => $model->password
            ]);
            if ($model->save()) {
                $response['status'] = 'true';
            }
        }
        return $response;
    }

    /**
     * @param $id
     * @return Users
     * @throws NotFoundHttpException
     */
    protected function findModel($id) {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
