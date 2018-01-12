<?php
  use yii\helpers\Html;
  use yii\widgets\LinkPager;

  $this->title = 'Управление пользователями';
  $this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => 'index'];
  $this->params['breadcrumbs'][] = $this->title;
?>
<? if(Yii::$app->session->hasFlash('success-edit')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-edit'); ?></div>
<? endif; ?>

<? if(Yii::$app->session->hasFlash('success-create')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-create'); ?></div>
<? endif; ?>

<? if(Yii::$app->session->hasFlash('success-delete')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-delete'); ?></div>
<? endif; ?>

<?= Html::a('Создать нового пользователя', ['admin/register-user'], ['class' => 'btn btn-success']); ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Логин</th>
      <th scope="col">Имя</th>
      <th scope="col">Фамилия</th>
      <th scope="col">Почта</th>
      <th scope="col">Телефон</th>
      <th scope="col">Роль</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($models as $model): ?>
      <tr>
        <th scope="row"><?= $model->id; ?></th>
        <td><?= $model->username; ?></td>
        <td><?= $model->profiles->firstname; ?></td>
        <td><?= $model->profiles->lastname; ?></td>
        <td><?= $model->profiles->email; ?></td>
        <td><?= $model->profiles->phone; ?></td>
        <td><?= $model->role->label; ?></td>
        <td>
          <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['admin/edit-user', 'id' => $model->id], ['class' => 'btn btn-success']); ?>
          <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['admin/delete-user', 'id' => $model->id], ['class' => 'btn btn-danger']); ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
  echo LinkPager::widget([
    'pagination' => $pages,
  ]);
?>
