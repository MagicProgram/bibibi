<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
// use yii\db\Query;
use yii\data\Pagination;
use common\models\Schools;
use common\models\SchoolsTypes;
use yii\data\ActiveDataProvider;
use common\models\Types;
use common\models\City;
/**
 * Site controller
 */
class KidsController extends Controller
{
    /**
     * @inheritdoc
     */
    

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    

    public function actionSchoolsForKids($city) {

        $dataProvider = new ActiveDataProvider([
            'query' => Schools::find()
                            ->with(['types'])
                            ->where(['city' => $city])
                            ->andWhere(['age' => [1,2]])
                            ->active()
                            ->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ]
        ]);

        $types = Types::getTypesByCityForKids($city)
                                    ->orderBy(['name' => SORT_ASC])
                                    ->all();

        $name = $city . 'kids';

        if (!$modelCity = City::findOne(['name' => $name])) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        return $this->render('schools', [
            'dataProvider' => $dataProvider,
            'city' => $city,
            'modelCity' => $modelCity,
            'types' => $types,
        ]);
    }

    public function actionTypeForKids($type, $city)
    {
        // print_r($city);die;
        $type = $this->findTypeModel($type); //->where(['city' => $city])

        $dataProvider = new ActiveDataProvider([
            'query' => Schools::find()
                            ->forTypeCity($type->id, $city)
                            ->andWhere(['age' => [1,2]])
                            ->active()
                            ->orderBy(['name' => SORT_ASC]),
            'pagination' => [
                'pageSize' => 10,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ]
        ]);

        return $this->render('type', [
            'type' => $type,
            'dataProvider' => $dataProvider,
            'city' => $city,
        ]);
    }

    protected function findTypeModel($type)
    {
        if (($model = Types::findOne(['url' => $type])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    




}
