<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Мои уроки';
$this->params['breadcrumbs'][] = $this->title;

?>

<? if(Yii::$app->session->hasFlash('success-create')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-create'); ?></div>
<? endif; ?>

<?= Html::a('Создать новый урок', ['site/lesson-create'], ['class' => 'btn btn-success']); ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Название</th>
      <th scope="col">Описание</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($model as $val): ?>
      <tr>
        <td><?= $val->name; ?></td>
        <td><?= $val->description; ?></td>
        <td>
          <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['admin/lesson-edit', 'id' => $val->id], ['class' => 'btn btn-success']); ?>
          <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['admin/lesson-delete', 'id' => $val->id], ['class' => 'btn btn-danger']); ?>
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
