<?php

namespace backend\controllers;

use Yii;
use common\models\SchoolsTypes;
use backend\models\search\SchoolsTypesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SchoolsTypesController implements the CRUD actions for SchoolsTypes model.
 */
class SchoolsTypesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SchoolsTypes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SchoolsTypesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SchoolsTypes model.
     * @param integer $school_id
     * @param integer $type_id
     * @return mixed
     */
    public function actionView($school_id, $type_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($school_id, $type_id),
        ]);
    }

    /**
     * Creates a new SchoolsTypes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SchoolsTypes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'school_id' => $model->school_id, 'type_id' => $model->type_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SchoolsTypes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $school_id
     * @param integer $type_id
     * @return mixed
     */
    public function actionUpdate($school_id, $type_id)
    {
        $model = $this->findModel($school_id, $type_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'school_id' => $model->school_id, 'type_id' => $model->type_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SchoolsTypes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $school_id
     * @param integer $type_id
     * @return mixed
     */
    public function actionDelete($school_id, $type_id)
    {
        $this->findModel($school_id, $type_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SchoolsTypes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $school_id
     * @param integer $type_id
     * @return SchoolsTypes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($school_id, $type_id)
    {
        if (($model = SchoolsTypes::findOne(['school_id' => $school_id, 'type_id' => $type_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
