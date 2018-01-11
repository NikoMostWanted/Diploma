<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\RegisterForm;

class AdminController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        return $this->render('index');
    }

    public function actionRegisterUser()
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->goBack();
        }

        return $this->render('register-user', ['model' => $model]);
    }

    public function actionEditUser()
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        return $this->render('edit-user');
    }

    public function actionDeleteUser()
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        return $this->render('delete-user');
    }

}
