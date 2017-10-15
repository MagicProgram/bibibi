<?php

namespace backend\controllers;

use Yii;
use common\models\Schools;
use backend\models\search\SchoolsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\imagine\Image;
use Imagine\Gd;
use Imagine\Image\Box;
use Imagine\Image\BoxInterface;


/**
 * SchoolsController implements the CRUD actions for Schools model.
 */
class SchoolsController extends Controller
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
     * Lists all Schools models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SchoolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Schools model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Schools model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Schools();

         if ($model->load(Yii::$app->request->post())) {
            $model->updated = date('Y-m-d h:m:s');
            $file = UploadedFile::getInstance($model, 'file');
            if ($file && $file->tempName) {
                $model->file = $file;
                if ($model->validate(['file'])) {
                    
                    $model->save(false);

                    $school_id = $model->id;
                    
                    $dir = Yii::getAlias('@frontend/web/images/schools/'.$school_id . '/');
                    Yii::$app->controller->createDirectory($dir);
                    $fileName = $model->url . '_' . $school_id . '.' . $model->file->extension;
                    $model->file->saveAs($dir . $fileName);
                    $model->file = $fileName; // без этого ошибка
                    $model->general_image = '/images/schools/' . $school_id . '/' . $fileName;
                        // Для ресайза фотки до 800x800px по большей стороне надо обращаться 
                        // к функции Box() или widen, так как в обертках доступны только 5 простых 
                        // функций: crop, frame, getImagine, setImagine, text, thumbnail, watermark
                    $photo = Image::getImagine()->open($dir . $fileName);
                    $photo->thumbnail(new Box(800, 800))->save($dir . $fileName, ['quality' => 90]);
                        //$imagineObj = new Imagine();
                        //$imageObj = $imagineObj->open(\Yii::$app->basePath . $dir . $fileName);
                        //$imageObj->resize($imageObj->getSize()->widen(400))->save(\Yii::$app->basePath . $dir . $fileName);
                    
                    // Yii::$app->controller->createDirectory(Yii::getAlias('/frontend/web/images/schools/'.$school_id.'/thumbs')); 
                    // Image::thumbnail($dir . $fileName, 150, 70)
                    // ->save(Yii::getAlias($dir .'thumbs/'. $fileName), ['quality' => 80]);
                }
            } 
            if ($model->save()) {
                return $this->redirect(['update', 'id' => $model->id]);
            }               
            
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
        
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $current_image = $model->general_image;

        if ($model->load(Yii::$app->request->post())) {
            $model->updated = date('Y-m-d h:m:s');
            
            $file = UploadedFile::getInstance($model, 'file');
            if ($file && $file->tempName) {
                $model->file = $file;
                if ($model->validate(['file'])) {
                                        
                    $school_id = $model->id;
                    
                    
                    $dir = Yii::getAlias('@frontend/web/images/schools/'.$school_id . '/');
                    Yii::$app->controller->createDirectory($dir);
                    $fileName = $model->url . '_' . $school_id . '.' . $model->file->extension;
                    $model->file->saveAs($dir . $fileName);
                    $model->file = $fileName; // без этого ошибка
                    $model->general_image = '/images/schools/' . $school_id . '/' . $fileName;
                        // Для ресайза фотки до 800x800px по большей стороне надо обращаться к функции Box() или widen, так как в обертках доступны только 5 простых функций: crop, frame, getImagine, setImagine, text, thumbnail, watermark
                    // $photo = Image::getImagine()->open($dir . $fileName);
                    // $photo->thumbnail(new Box(800, 800))->save($dir . $fileName, ['quality' => 90]);
                        //$imagineObj = new Imagine();
                        //$imageObj = $imagineObj->open(\Yii::$app->basePath . $dir . $fileName);
                        //$imageObj->resize($imageObj->getSize()->widen(400))->save(\Yii::$app->basePath . $dir . $fileName);
                    
                }
            } 

            //Если отмечен чекбокс «удалить файл»            
            if($model->del_img)
            {
                if(file_exists(Yii::getAlias('@frontend/web' . $current_image)))
                {

                    //удаляем файл
                    unlink(Yii::getAlias('@frontend/web' . $current_image));
                    $model->general_image = '';
                }
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    // public function actionCreate()
    // {
    //     $model = new Schools();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('create', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Updates an existing Schools model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     } else {
    //         return $this->render('update', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    /**
     * Deletes an existing Schools model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Schools model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schools the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Schools::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    // создание пути для картинки
    public function createDirectory($path) {   
        //$filename = "/folder/{$dirname}/";  
        if (file_exists($path)) {  
            //echo "The directory {$path} exists";  
        } else {  
            mkdir($path, 0775, true);  
            //echo "The directory {$path} was successfully created.";  
        }
    }
}
