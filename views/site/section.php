<?php
  use app\models\Sections;
  use yii\helpers\Html;
  use yii\widgets\LinkPager;

  $this->title = 'Разделы';
  $this->params['breadcrumbs'][] = $this->title;

?>

<?= Sections::build_tree_site_section(Sections::getStructure(), $id); ?>

<p>Уроки</p>
<?php foreach($locations as $location): ?>
  <?= Html::a($location->lessons->name, ['site/lesson-view', 'id' => $location->lessons->id]); ?>
<?php endforeach; ?>

<?php
  echo LinkPager::widget([
    'pagination' => $pages,
  ]);
?>
