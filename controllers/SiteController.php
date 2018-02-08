<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\Users;
use app\models\forms\LessonForm;
use app\models\Lessons;
use app\models\Locations;
use yii\data\Pagination;
use app\models\Files;
use app\models\Subscribers;
use app\models\forms\ContactForm;

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

    public function actionLessonEdit($id)
    {
        if(Yii::$app->user->isGuest || Users::isStudent(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $model = new LessonForm();

        if ($model->load(Yii::$app->request->post()) && $model->create($id)) {
          Yii::$app->getSession()->setFlash('success-create', 'Урок успешно редактирован!');
          return $this->redirect(['site/lesson']);
        }

        $lesson = Lessons::findOne($id);

        if($lesson->user__id != Yii::$app->user->id)
        {
            return $this->redirect(['http-errors/403']);
        }
        $model->name = $lesson->name;
        $model->description = $lesson->description;
        $model->text = $lesson->text;

        $files = Files::find()->where(['lesson__id' => $lesson->id])->all();

        return $this->render('lesson/lesson-edit', ['model' => $model, 'files' => $files, 'lesson__id' => $id]);
    }

    public function actionLessonView($id)
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['http-errors/403']);
        }

        $model = Lessons::findOne($id);
        $files = Files::find()->where(['lesson__id' => $id])->all();

        $subscriber = Subscribers::find()->where(['lesson__id' => $id, 'user__id' => Yii::$app->user->id])->one();

        if(Yii::$app->request->post() != null)
        {
              $subscribe = new Subscribers();
              $subscribe->lesson__id = $id;
              $subscribe->user__id = Yii::$app->user->id;

              if(!$subscribe->save())
              {
                  throw new Exception('Ошибка при создании подписки!');
              }
        }

        return $this->render('lesson/lesson-view', ['model' => $model, 'files' => $files, 'subscriber' => $subscriber]);
    }

    public function actionDeleteImage()
    {
        if (Yii::$app->request->isAjax)
        {
            $data = Yii::$app->request->post();
            $id= explode(":", $data['id']);

            Files::deleteImage($id);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'answer' => $id,
            ];
        }
    }

    public function actionDeleteFile()
    {
        if (Yii::$app->request->isAjax)
        {
            $data = Yii::$app->request->post();
            $id= explode(":", $data['id']);

            Files::deleteFile($id);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return [
                'answer' => $id,
            ];
        }
    }

    public function actionLessonDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try
        {
          if(!Yii::$app->db->createCommand()->delete('locations', ['lessons__id' => $id])->execute())
          {
              throw new Exception('Ошибка удаления данных локаций');
          }

          $files = Files::find()->where(['lesson__id' => $id])->all();
          foreach($files as $file)
          {
              if(!$file->delete())
              {
                  throw new Exception('Ошибка удаления данных файлов');
              }
          }

          if(!Yii::$app->db->createCommand()->delete('lessons', ['id' => $id])->execute())
          {
              throw new Exception('Ошибка удаления данных урока');
          }

          $transaction->commit();
          Yii::$app->getSession()->setFlash('success-delete', 'Урок успешно удален!');
        }
        catch (Exception $e)
        {
            $transaction->rollBack();
        }

        return $this->redirect(['site/lesson']);
    }

    public function actionCourses()
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->redirect(['http-errors/403']);
        }
        
        return $this->render('courses/courses');
    }
}
