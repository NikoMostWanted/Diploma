<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Редактирование раздела';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => 'index'];
$this->params['breadcrumbs'][] = ['label' => 'Управление разделами', 'url' => 'section'];
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

        <?= $form->field($model, 'alias')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'name')->textInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'name' => 'section-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>