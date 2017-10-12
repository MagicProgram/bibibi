<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
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
class SiteController extends Controller
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */


    public function actionSchools($city) {

        $dataProvider = new ActiveDataProvider([
            'query' => Schools::find()->active()->with(['types'])->where(['city' => $city])->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 3,
                'forcePageParam' => false,
                'pageSizeParam' => false,
            ]
        ]);

        return $this->render('schools', [
            'dataProvider' => $dataProvider,
            'city' => $city,
        ]);
    }



    public function actionView($id, $city)
    {
        $model = $this->findProductModel($id);

        return $this->render('view', [
            'model' => $model,
            'city' => $city,
        ]);
    }

    protected function findProductModel($id)
    {
        if (($model = Schools::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionIndex()
    {
        // $this->layout = "bootstrap";

        // print_r(\frontend\components\Common::getCity()) ; die; 

        $dataProvider = new ActiveDataProvider([
            'query' => Schools::find()->active()->with(['types'])->orderBy(['id' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            // 'city' => $city,
        ]);

        
    }
    
    public function actionTypes($type, $city)
    {
        // print_r($city);die;
        $type = $this->findTypeModel($type); //->where(['city' => $city])

        $dataProvider = new ActiveDataProvider([
            'query' => Schools::find()->active()->forTypeCity($type->id, $city)->orderBy(['id' => SORT_DESC]),
        ]);


        return $this->render('types', [
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


    public function actionAllTypes($city)
    {

        $model = Types::getTypesByCity($city)->all();
        

        $name = $city . 'types';

        $modelCity = City::findOne(['name' => $name]);

        return $this->render('alltypes', [
            'model' => $model,
            'city' => $city,
            'modelCity' => $modelCity,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
