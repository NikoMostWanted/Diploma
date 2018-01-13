<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Управление навигацией';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>

<? if(Yii::$app->session->hasFlash('success-create')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-create'); ?></div>
<? endif; ?>

<? if(Yii::$app->session->hasFlash('success-edit')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-edit'); ?></div>
<? endif; ?>

<? if(Yii::$app->session->hasFlash('success-delete')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-delete'); ?></div>
<? endif; ?>

<?= Html::a('Создать навигацию', ['admin/navigation-create'], ['class' => 'btn btn-success']); ?>

<p class="text-center">Админ</p>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Псевдоним</th>
      <th scope="col">Название</th>
      <th scope="col">URL</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($modelsAdmin as $model): ?>
      <tr>
        <td><?= $model->alias; ?></td>
        <td><?= $model->label; ?></td>
        <td><?= $model->url; ?></td>
        <td>
          <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['admin/navigation-edit', 'id' => $model->id], ['class' => 'btn btn-success']); ?>
          <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['admin/navigation-delete', 'id' => $model->id], ['class' => 'btn btn-danger']); ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
  echo LinkPager::widget([
    'pagination' => $pagesAdmin,
  ]);
?>

<p class="text-center">Клиент</p>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Псевдоним</th>
      <th scope="col">Название</th>
      <th scope="col">URL</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($modelsClient as $model): ?>
      <tr>
        <td><?= $model->alias; ?></td>
        <td><?= $model->label; ?></td>
        <td><?= $model->url; ?></td>
        <td>
          <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['admin/navigation-edit', 'id' => $model->id], ['class' => 'btn btn-success']); ?>
          <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['admin/navigation-delete', 'id' => $model->id], ['class' => 'btn btn-danger']); ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
  echo LinkPager::widget([
    'pagination' => $pagesClient,
  ]);
?>
