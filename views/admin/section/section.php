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

<? if(Yii::$app->session->hasFlash('success-edit')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-edit'); ?></div>
<? endif; ?>

<? if(Yii::$app->session->hasFlash('success-delete')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-delete'); ?></div>
<? endif; ?>

<? if(Yii::$app->session->hasFlash('error-delete')): ?>
    <div class="alert alert-danger"><?= Yii::$app->session->getFlash('error-delete'); ?></div>
<? endif; ?>

<?= Html::a('Создать новый раздел', ['admin/section-create'], ['class' => 'btn btn-success']); ?>
<br/><br/>

<?= Sections::build_tree_section(Sections::getStructure(), 0); ?>
