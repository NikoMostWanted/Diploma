<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "navigations".
 *
 * @property integer $id
 * @property integer $alias
 * @property string $label
 * @property string $url
 * @property integer $own
 */
class Navigations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'navigations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['own'], 'integer'],
            [['label', 'url', 'alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'url' => 'Url',
            'own' => 'Own',
            'alias' => 'Alias',
        ];
    }

    public static function getClientNav()
    {
        $navs = self::find()->where(['own' => 2])->all();
        return $navs;
    }

    public static function getAdminNav()
    {
        $navs = self::find()->where(['own' => 1])->all();
        return $navs;
    }
}
