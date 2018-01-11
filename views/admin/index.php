<?php
  use yii\helpers\Html;
?>

<div class="site-index">
  <?= Html::a('Регистрация пользователей', ['admin/register-user'], ['class' => 'btn btn-link']); ?>
  <?= Html::a('Редактирование пользователей', ['admin/edit-user'], ['class' => 'btn btn-link']); ?>
  <?= Html::a('Удаление пользователей', ['admin/delete-user'], ['class' => 'btn btn-link']); ?>
</div>
