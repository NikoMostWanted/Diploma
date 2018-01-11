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
    public $role__id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password', 'firstname', 'lastname', 'email', 'phone', 'role__id'], 'required'],
        ];
    }

    public function create($id = false)
    {
        if ($this->validate())
        {
            if($id != false)
            {
              $user = Users::findOne($id);
              $profile = Profiles::findOne(['user__id' => $id]);
            }
            else
            {
              $user = new Users();
              $profile = new Profiles();
            }

            $data = \Yii::$app->request->post();

            $user->username = $data['RegisterForm']['username'];
            $user->password = md5($data['RegisterForm']['password']);
            $user->role__id = $data['RegisterForm']['role__id'];
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
              $transaction->commit();
              return true;
            }
            catch (Exception $e)
            {
                $transaction->rollBack();
            }
        }
        return false;
    }

}
