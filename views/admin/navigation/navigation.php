<?php
use yii\helpers\Html;

$this->title = 'Управление навигацией';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>

<? if(Yii::$app->session->hasFlash('success-create')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success-create'); ?></div>
<? endif; ?>

<?= Html::a('Создать навигацию', ['admin/navigation-create'], ['class' => 'btn btn-success']); ?>
