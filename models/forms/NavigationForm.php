<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\base\Exception;

class NavigationForm extends Model
{

    public $label;
    public $url;
    public $own;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['label', 'url', 'own'], 'required'],
        ];
    }

    public function create()
    {
        if ($this->validate())
        {

            return true;
        }
        return false;
    }

}
