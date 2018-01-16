<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\ContactForm;
use app\models\Users;
use app\models\forms\LessonForm;
use app\models\Lessons;
use app\models\Locations;
use yii\data\Pagination;

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
                'only' => ['logout'],
                'rules' => [
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
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSection($id)
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['http-errors/403']);
        }

        $countLocations = Locations::find()->where(['section__id' => $id])->count();
        $pages = new Pagination(['totalCount' => $countLocations, 'pageSize' => Yii::$app->params['page']]);
        $pages->pageSizeParam = false;

        $locations = Locations::find()->where(['section__id' => $id])->offset($pages->offset)
          ->limit($pages->limit)
          ->all();

        return $this->render('section', ['id' => $id, 'locations' => $locations, 'pages' => $pages]);
    }

    public function actionLesson()
    {
        if(Yii::$app->user->isGuest || Users::isStudent(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $countLessons = Lessons::find()->where(['user__id' => Yii::$app->user->id])->count();

        $pages = new Pagination(['totalCount' => $countLessons, 'pageSize' => Yii::$app->params['page']]);

        $pages->pageSizeParam = false;
        $model = Lessons::find()->where(['user__id' => Yii::$app->user->id])->offset($pages->offset)
          ->limit($pages->limit)
          ->all();

        return $this->render('lesson/lesson', ['model' => $model, 'pages' => $pages]);
    }

    public function actionLessonCreate()
    {
        if(Yii::$app->user->isGuest || Users::isStudent(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $model = new LessonForm();

        if ($model->load(Yii::$app->request->post()) && $model->create()) {
          Yii::$app->getSession()->setFlash('success-create', 'Урок успешно создан!');
          return $this->redirect(['site/lesson']);
        }

        return $this->render('lesson/lesson-create', ['model' => $model]);
    }

    public function actionLessonView($id)
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['http-errors/403']);
        }

        return $this->render('lesson/lesson-view');
    }
}
