<?php
  use yii\helpers\Html;
?>
<?php
  $this->title = 'Админ панель';
  $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
  <?= Html::a('Управление пользователями', ['admin/users'], ['class' => 'btn btn-link']); ?>
  <?= Html::a('Управление навигацией', ['admin/navigation'], ['class' => 'btn btn-link']); ?>
</div>
