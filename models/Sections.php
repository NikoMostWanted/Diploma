<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

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
        $sections = self::find()->all();
        $cats = array();
        foreach($sections as $section)
        {
            $cats[$section->sid][$section->id] = $section;
        }

        return $cats;
    }

    public static function build_tree($cats, $sid)
    {
        if(is_array($cats) && isset($cats[$sid]))
        {
            $tree = '<ul>';

            foreach($cats[$sid] as $cat)
            {
                $tree .= '<li>'.$cat['name'].' '.$cat['alias'];
                $tree .= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['admin/section-edit', 'id' => $cat['id']], ['class' => 'btn btn-success']);
                $tree .= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['admin/section-delete', 'id' => $cat['id']], ['class' => 'btn btn-danger']);
                $tree .= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['admin/section-create', 'id' => $cat['id']], ['class' => 'btn btn-success']);
                $tree .= self::build_tree($cats,$cat['id']);
                $tree .= '</li>';
            }

            $tree .= '</ul>';
        }
        else return null;
        return $tree;
    }
}
