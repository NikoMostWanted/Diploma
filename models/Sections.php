<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sections".
 *
 * @property integer $id
 * @property string $alias
 * @property string $name
 * @property integer $sid
 */
class Sections extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid'], 'integer'],
            [['alias', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'alias' => 'Alias',
            'name' => 'Name',
            'sid' => 'Sid',
        ];
    }

    public static function getStructure()
    {
        $id = array(null);
        $data = array();
        $i = 1;
        while(!empty($id))
        {
            $sections = self::find()->where(['sid' => $id[0]])->all();
            $id = [];
            foreach($sections as $section)
            {
                $id[] = $section->id;
                $data[$section->id] = array('id' => $section->id, 'name' => $section->name, 'alias' => $section->alias, 'deep' => $i);
            }
            $i++;

        }

        return $data;
    }
}
