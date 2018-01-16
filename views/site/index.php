<?php

/* @var $this yii\web\View */
use app\models\Sections;
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
  <?php endif; ?>

</div>
