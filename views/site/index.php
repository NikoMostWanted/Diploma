<?php

/* @var $this yii\web\View */
use app\models\Sections;
use app\models\Subscribers;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>

<div class="site-index">
    <?php if(Yii::$app->user->isGuest): ?>
      <div class="jumbotron">
          <h1>Congratulations!</h1>

          <p class="lead">Вы не авторизованы!</p>

      </div>
  <?php else: ?>
      <?= Sections::build_tree_site_section(Sections::getStructure(), 0); ?>
      <p>Ваши подписки:</p>
      <?php foreach(Subscribers::getByUser(Yii::$app->user->id) as $subs): ?>
          <?=  Html::a($subs->lesson->name.'('.$subs->user->username.')', ['site/lesson-view', 'id' => $subs->lesson->id]); ?>
      <?php endforeach; ?>
  <?php endif; ?>

</div>
