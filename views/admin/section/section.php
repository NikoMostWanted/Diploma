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

<?= Sections::build_tree(Sections::getStructure(), 0); ?>
