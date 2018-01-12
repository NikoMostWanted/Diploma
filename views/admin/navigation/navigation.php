<?php
use yii\helpers\Html;

$this->title = 'Управление навигацией';
$this->params['breadcrumbs'][] = ['label' => 'Админ панель', 'url' => 'index'];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= Html::a('Создать навигацию', ['admin/navigation-create'], ['class' => 'btn btn-success']); ?>
