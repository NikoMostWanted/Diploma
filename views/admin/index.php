<?php
  use yii\helpers\Html;
  use app\models\Navigations;
?>
<?php
  $this->title = 'Админ панель';
  $this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
  <?php foreach(Navigations::getAdminNav() as $nav): ?>
    <?= Html::a($nav->label, [$nav->url], ['class' => 'btn btn-link']); ?>
  <?php endforeach; ?>
</div>
