<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\RegisterForm;
use yii\data\Pagination;
use app\models\Roles;
use app\models\Profiles;
use yii\base\Exception;

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
        $roles = Roles::find()->all();
        $data_roles = [];
        foreach($roles as $role)
        {
            $data_roles[$role->id] = $role->label;
        }

        if ($model->load(Yii::$app->request->post()) && $model->create()) {
          Yii::$app->getSession()->setFlash('success-crate', 'Пользователь успешно создан!');
          return $this->redirect(['admin/users']);
        }

        return $this->render('register-user', ['model' => $model, 'roles' => $data_roles]);
    }

    public function actionEditUser($id)
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $user_data = Users::findOne($id);
        $model = new RegisterForm();
        $roles = Roles::find()->all();
        $data_roles = [];
        foreach($roles as $role)
        {
            $data_roles[$role->id] = $role->label;
        }

        if ($model->load(Yii::$app->request->post()) && $model->create($id)) {
            Yii::$app->getSession()->setFlash('success-edit', 'Пользователь успешно редактирован!');
            return $this->redirect(['admin/users']);
        }

        $user_data = Users::findOne($id);
        $model->username = $user_data->username;
        $model->firstname = $user_data->profiles->firstname;
        $model->lastname = $user_data->profiles->lastname;
        $model->email = $user_data->profiles->email;
        $model->phone = $user_data->profiles->phone;
        $model->role__id = $user_data->role__id;

        return $this->render('edit-user', ['model' => $model, 'roles' => $data_roles]);
    }

    public function actionDeleteUser($id)
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $user = Users::findOne($id);
        $profile = $user->profiles;

        $transaction = Yii::$app->db->beginTransaction();
        try
        {
          if(!$user->delete())
          {
              throw new Exception('Ошибка удаления данных пользователя');
          }

          if(!$profiles->delete())
          {
              throw new Exception('Ошибка удаления данных пользователя');
          }
          $transaction->commit();
          Yii::$app->getSession()->setFlash('success-delete', 'Пользователь успешно удален!');
        }
        catch (Exception $e)
        {
            $transaction->rollBack();
        }
        
        return $this->redirect(['admin/users']);
    }

    public function actionUsers()
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $countUsers = Users::find()->count();

        $pages = new Pagination(['totalCount' => $countUsers, 'pageSize' => Yii::$app->params['page']]);

        $pages->pageSizeParam = false;
        $models = Users::find()->offset($pages->offset)
          ->limit($pages->limit)
          ->all();

        return $this->render('user', ['models' => $models, 'pages' => $pages]);
    }

}
