<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Users;

class HttpErrorsController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function action403()
    {
        return $this->render('403');
    }

}
