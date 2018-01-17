<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property integer $name
 * @property integer $lesson__id
 * @property string $href
 *
 * @property Lessons $lesson
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lesson__id'], 'required'],
            [['lesson__id', 'name'], 'integer'],
            [['href'], 'string', 'max' => 255],
            [['lesson__id'], 'exist', 'skipOnError' => true, 'targetClass' => Lessons::className(), 'targetAttribute' => ['lesson__id' => 'id']],
        ];
    }

    public function afterDelete()
    {
        unlink(Yii::getAlias('@webroot').'/uploads/'.$this->href);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lesson__id' => 'Lesson  ID',
            'href' => 'Href',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lessons::className(), ['id' => 'lesson__id']);
    }

    public static function deleteImage($id)
    {
        $file = self::findOne($id);
        $href = $file->href;
        $file->delete();
    }
}
