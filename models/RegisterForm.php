<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\Exception;

/**
 * RegisterForm is the model behind the register form.
 *
 * @property Users|null $user This property is read-only.
 *
 */
class RegisterForm extends Model
{

    public $username;
    public $password;
    public $firstname;
    public $lastname;
    public $email;
    public $phone;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'firstname', 'lastname', 'email', 'phone'], 'required'],
        ];
    }

    /**
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        if ($this->validate())
        {
            $user = new Users();
            $profile = new Profiles();

            $data = \Yii::$app->request->post();

            $user->username = $data['RegisterForm']['username'];
            $user->password = $data['RegisterForm']['password'];
            $profile->firstname = $data['RegisterForm']['firstname'];
            $profile->lastname = $data['RegisterForm']['lastname'];
            $profile->email = $data['RegisterForm']['email'];
            $profile->phone = $data['RegisterForm']['phone'];

            $transaction = Yii::$app->db->beginTransaction();
            try
            {
              if(!$user->save())
              {
                   throw new Exception('Ошибка сохранения данных пользователя');
              }

              $profile->user__id = $user->id;

              if(!$profile->save())
              {
                  throw new Exception('Ошибка сохранения данных пользователя');
              }
              Yii::$app->session->setFlash('success-register', 'Пользователь успешно зарегестрирован');
              $transaction->commit();
              return true;
            }
            catch (Throwable $e)
            {
                $transaction->rollBack();
            }
        }
        return false;
    }

}
