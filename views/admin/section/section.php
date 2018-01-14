<?php
  use yii\helpers\Html;
  use app\models\Sections;

  $this->title = 'Управление разделами';
  $this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => 'index'];
  $this->params['breadcrumbs'][] = $this->title;
?>

<? if(Yii::$app->session->hasFlash('success-create')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-create'); ?></div>
<? endif; ?>

<?= Html::a('Создать новый раздел', ['admin/section-create'], ['class' => 'btn btn-success']); ?>
<br/><br/>

<?php foreach (Sections::getStructure() as $section): ?>
    <?= $section['alias']; ?>
    <?= $section['name']; ?>
    <?= $section['deep']; ?>
    <?= Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['admin/section-edit', 'id' => $section['id']], ['class' => 'btn btn-success']); ?>
    <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['admin/section-delete', 'id' => $section['id']], ['class' => 'btn btn-danger']); ?>
    <?= Html::a('<span class="glyphicon glyphicon-plus"></span>', ['admin/section-create', 'id' => $section['id']], ['class' => 'btn btn-success']); ?>
    <br/>
<?php endforeach; ?>
