<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;
use app\models\forms\RegisterForm;
use yii\data\Pagination;
use app\models\Roles;
use app\models\Profiles;
use yii\base\Exception;
use app\models\forms\NavigationForm;
use app\models\Navigations;

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
          Yii::$app->getSession()->setFlash('success-create', 'Пользователь успешно создан!');
          return $this->redirect(['admin/users']);
        }

        return $this->render('user/register-user', ['model' => $model, 'roles' => $data_roles]);
    }

    public function actionEditUser($id)
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

        return $this->render('user/edit-user', ['model' => $model, 'roles' => $data_roles]);
    }

    public function actionDeleteUser($id)
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $transaction = Yii::$app->db->beginTransaction();
        try
        {
          if(!Yii::$app->db->createCommand()->delete('profiles', ['user__id' => $id])->execute())
          {
              throw new Exception('Ошибка удаления данных пользователя');
          }

          if(!Yii::$app->db->createCommand()->delete('users', ['id' => $id])->execute())
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

    public function actionNavigationDelete($id)
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        try
        {
            if(!Yii::$app->db->createCommand()->delete('navigations', ['id' => $id])->execute())
            {
                throw new Exception('Ошибка удаления данных навигации');
            }

            Yii::$app->getSession()->setFlash('success-delete', 'Навигация успешно удалена!');
        }
        catch (Exception $e)
        {
            print $e->getMessage();
        }

        return $this->redirect(['admin/navigation']);
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

        return $this->render('user/user', ['models' => $models, 'pages' => $pages]);
    }

    public function actionNavigation()
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $countNavAdmin = Navigations::find()->where(['own' => 1])->count();
        $countNavClient = Navigations::find()->where(['own' => 2])->count();

        $pagesAdmin = new Pagination(['totalCount' => $countNavAdmin, 'pageSize' => Yii::$app->params['page'], 'pageParam' => 'admin-page']);
        $pagesClient = new Pagination(['totalCount' => $countNavClient, 'pageSize' => Yii::$app->params['page'], 'pageParam' => 'client-page']);

        $pagesAdmin->pageSizeParam = false;
        $pagesClient->pageSizeParam = false;

        $modelsAdmin = Navigations::find()->where(['own' => 1])->offset($pagesAdmin->offset)
          ->limit($pagesAdmin->limit)
          ->all();

        $modelsClient = Navigations ::find()->where(['own' => 2])->offset($pagesClient->offset)
          ->limit($pagesClient->limit)
          ->all();

        return $this->render('navigation/navigation', ['modelsAdmin' => $modelsAdmin, 'modelsClient' => $modelsClient, 'pagesAdmin' => $pagesAdmin, 'pagesClient' => $pagesClient]);
    }

    public function actionNavigationCreate()
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $model = new NavigationForm();

        if ($model->load(Yii::$app->request->post()) && $model->create()) {
          Yii::$app->getSession()->setFlash('success-create', 'Навигация успешно создана!');
          return $this->redirect(['admin/navigation']);
        }

        return $this->render('navigation/navigation-create', ['model' => $model]);
    }

    public function actionNavigationEdit($id)
    {
        if(!Users::isAdmin(Yii::$app->user->id))
        {
            return $this->redirect(['http-errors/403']);
        }

        $model = new NavigationForm();

        if ($model->load(Yii::$app->request->post()) && $model->create($id)) {
            Yii::$app->getSession()->setFlash('success-edit', 'Навигация успешно редактирована!');
            return $this->redirect(['admin/navigation']);
        }

        $navigation_data = Navigations::findOne($id);
        $model->label = $navigation_data->label;
        $model->url = $navigation_data->url;
        $model->own = $navigation_data->own;

        return $this->render('navigation/navigation-edit', ['model' => $model]);
    }

}