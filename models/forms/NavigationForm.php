<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\base\Exception;
use app\models\Navigations;

class NavigationForm extends Model
{

    public $label;
    public $url;
    public $own;
    public $alias;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['label', 'url', 'own', 'alias'], 'required'],
        ];
    }

    public function create($id = false)
    {
        if ($this->validate())
        {
            if($id != false)
            {
              $navigation = Navigations::findOne($id);
            }
            else
            {
              $navigation = new Navigations();
            }

            $data = \Yii::$app->request->post();

            $navigation->label = $data['NavigationForm']['label'];
            $navigation->alias = $data['NavigationForm']['alias'];
            $navigation->url = $data['NavigationForm']['url'];
            $navigation->own = $data['NavigationForm']['own'];

            if(!$navigation->save())
            {
                 throw new Exception('Ошибка сохранения данных навигации');
            }
            return true;
        }
        return false;
    }

}
