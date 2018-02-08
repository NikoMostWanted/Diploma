<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\Sections;
use yii\base\Exception;

class SectionForm extends Model
{

    public $alias;
    public $name;
    public $description;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['alias', 'name', 'description'], 'required'],
        ];
    }

    public function create($id = false)
    {
        if ($this->validate())
        {
            $model = new Sections();
            $data = \Yii::$app->request->post();
            $model->alias = $data['SectionForm']['alias'];
            $model->name = $data['SectionForm']['name'];
            $model->description = $data['SectionForm']['description'];
            if($id == false)
            {
                $model->sid = 0;
            }
            else
            {
                $model->sid = $id;
            }

            if(!$model->save())
            {
                  throw new Exception('Ошибка сохранения данных раздела');
            }
            return true;
        }
        return false;
    }

    public function edit($id)
    {
        if ($this->validate())
        {
            $model = Sections::findOne($id);
            $data = \Yii::$app->request->post();
            $model->alias = $data['SectionForm']['alias'];
            $model->name = $data['SectionForm']['name'];
            $model->description = $data['SectionForm']['description'];

            if(!$model->save())
            {
                  throw new Exception('Ошибка редактирования данных раздела');
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'alias' => 'Псевдоним',
            'name' => 'Название',
            'description' => 'Описание'
        ];
    }

}
