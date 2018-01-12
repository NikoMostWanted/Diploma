<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Редактирование пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => 'index'];
$this->params['breadcrumbs'][] = ['label' => 'Управление пользователями', 'url' => 'users'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>


        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'firstname')->textInput() ?>
        <?= $form->field($model, 'lastname')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'phone')->textInput() ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'role__id')->dropDownList($roles); ?>


        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>
