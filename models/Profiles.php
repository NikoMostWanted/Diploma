<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profiles".
 *
 * @property integer $id
 * @property integer $user__id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $phone
 *
 * @property Users $user
 */
class Profiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user__id', 'firstname', 'lastname', 'email', 'phone'], 'required'],
            [['user__id'], 'integer'],
            [['firstname', 'lastname', 'email', 'phone'], 'string', 'max' => 255],
            ['email', 'email'],
            [['user__id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user__id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user__id' => 'User  ID',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'email' => 'Email',
            'phone' => 'Телефон',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user__id']);
    }
}
