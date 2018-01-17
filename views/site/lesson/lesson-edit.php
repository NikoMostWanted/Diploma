<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\Sections;

$this->title = 'Редактирование урока';
$this->params['breadcrumbs'][] = ['label' => 'Мои уроки', 'url' => 'lesson'];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/lesson/create.css');

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

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'description')->textInput() ?>

        <?= $form->field($model, 'text')->textArea(['rows' => '6']) ?>

        <?= Sections::build_tree_site_lesson(Sections::getStructure(), 0, $lesson__id); ?>

        <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
        <div class="row">
            <span id="output"></span>
        </div>


        <br/>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Редактировать', ['class' => 'btn btn-primary', 'name' => 'lesson-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <div class="row">
        <span id="save">
          <?php foreach($files as $file): ?>
              <img class="img-thumbnail" id="img-<?= $file->id ?>" src="<?= Yii::$app->request->baseUrl.'/uploads/'.$file->href ?>">
              <button class="img-<?= $file->id ?>" onclick="deleteImage(<?= $file->id; ?>)">Удалить</button>
          <?php endforeach; ?>
        </span>
    </div>

</div>

<?php
    $this->registerJsFile(Yii::$app->request->baseUrl.'/js/lesson/create.js',  ['position' => yii\web\View::POS_END]);
?>
