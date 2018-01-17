<?php
  use yii\bootstrap\ActiveForm;
  use yii\helpers\Html;
?>

название <?= $model->name; ?><br/>
описание <?= $model->description; ?><br/>
текст <?= $model->text; ?><br/>
пользователь <?= $model->user->username; ?><br/>
картинки
<?php foreach($files as $file): ?>
    <?php if(strripos($file->href, 'jpg') == true || strripos($file->href, 'png') == true): ?>
      <img src="<?= Yii::$app->request->baseUrl.'/uploads/'.$file->href; ?>">
    <?php endif; ?>
    <?php if(strripos($file->href, 'doc') == true || strripos($file->href, 'docx') == true): ?>
      <a href="<?= Yii::$app->request->baseUrl.'/uploads/'.$file->href ?>" download><?= $file->href; ?></a>
    <?php endif; ?>
<?php endforeach; ?>

<?php if($subscriber == null) : ?>
  <?php $form = ActiveForm::begin([
      'id' => 'login-form',
      'layout' => 'horizontal',
      'fieldConfig' => [
          'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
          'labelOptions' => ['class' => 'col-lg-1 control-label'],
      ],
  ]); ?>
  <div class="form-group">
      <div class="col-lg-offset-1 col-lg-11">
          <?= Html::submitButton('Подписаться', ['class' => 'btn btn-primary', 'name' => 'subscribe-button']) ?>
      </div>
  </div>
  <?php ActiveForm::end(); ?>
<? else: ?>
<p>Вы подписаны</p>
<?php endif; ?>
