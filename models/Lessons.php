<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lessons".
 *
 * @property integer $id
 * @property integer $user__id
 * @property string $name
 * @property string $description
 * @property string $text
 *
 * @property Users $user
 */
class Lessons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lessons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user__id', 'name', 'description', 'text'], 'required'],
            [['user__id'], 'integer'],
            [['text'], 'string'],
            [['name', 'description'], 'string', 'max' => 255],
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
            'name' => 'Название',
            'description' => 'Описание',
            'text' => 'Текст',
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
