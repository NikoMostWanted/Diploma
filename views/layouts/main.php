<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Users;
use app\models\Navigations;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerCssFile("@web/css/style.css"); ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <a href="/" class="navbar-brand">
      <?= Html::img('@web/img/logo.png'); ?>
    </a>


      <ul class="navbar-nav mr-auto">
        <?php foreach(Navigations::getClientNav() as $nav): ?>
          <?php if($nav->alias == 'AdminPanel'): ?>
            <?php if(Users::isAdmin(Yii::$app->user->id)): ?>
              <li class="nav-item">
                <?= Html::a($nav->label, [$nav->url], ['class' => 'nav-link']) ?>
              </li>
            <?php endif; ?>
            <?php elseif($nav->alias == 'Lessons'): ?>
            <?php if(!Yii::$app->user->isGuest && (Users::isAdmin(Yii::$app->user->id) || Users::isTeacher(Yii::$app->user->id))): ?>
              <li class="nav-item">
                <?= Html::a($nav->label, [$nav->url], ['class' => 'nav-link']) ?>
              </li>
            <?php endif; ?>
          <?php elseif($nav->alias != 'Authorization'): ?>
            <li class="nav-item">
              <?= Html::a($nav->label, [$nav->url], ['class' => 'nav-link']) ?>
            </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>

      <ul class="form-inline my-2 my-lg-0">
        <?php foreach(Navigations::getClientNav() as $nav): ?>
          <?php if($nav->alias == 'Authorization'): ?>
            <?php if(Yii::$app->user->isGuest): ?>
              <span class="badge">Ви зайшли як гість</span>
              <?= Html::a($nav->label, [$nav->url], ['class' => 'btn btn-outline-secondary']) ?>
            <? else: ?>
              <?= Html::beginForm(['/site/logout'], 'post'); ?>
              <input type="submit" class="btn btn-outline-secondary" value="Вийти(<?= Yii::$app->user->identity->username; ?>)">
              <?= Html::endForm(); ?>
            <? endif; ?>
          <? endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </nav>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer bg-dark">
  <div class="container">
    <div class="d-flex p-3 justify-content-between" >
      <div class="col-3">
        <h3>Дистанційне навчання - крок до успіху!</h3>
        <p>Розвиток ІКТ (інформаційно-комунікаційних технологій) сприяв появі такої форми здобуття нових знань як дистанційне навчання! Спробуйте і ви переконаєтесь наскільки це зручно та ефективно!</p>
      </div>
      <div class="col-3">
        <h3>Контакти</h3>
        <address>
          <strong>Petro Mohyla Black Sea State University, Inc.</strong><br/>
          <span>10,68-Desantnykiv Str.</span>
          <span>Mykolayiv, 54003</span>
        </address>
      </div>
      <div class="col-3">
        <h3>Навігація</h3>
        <nav class="nav flex-column">
          <?php foreach(Navigations::getClientNav() as $nav): ?>
            <?php if($nav->alias == 'AdminPanel'): ?>
              <?php if(Users::isAdmin(Yii::$app->user->id)): ?>
                <?= Html::a($nav->label, [$nav->url], ['class' => 'nav-link']) ?>
              <?php endif; ?>
              <?php elseif($nav->alias == 'Lessons'): ?>
              <?php if(!Yii::$app->user->isGuest && (Users::isAdmin(Yii::$app->user->id) || Users::isTeacher(Yii::$app->user->id))): ?>
                <?= Html::a($nav->label, [$nav->url], ['class' => 'nav-link']) ?>
              <?php endif; ?>
            <?php elseif($nav->alias != 'Authorization'): ?>
              <?= Html::a($nav->label, [$nav->url], ['class' => 'nav-link']) ?>
            <?php endif; ?>
          <?php endforeach; ?>
        </nav>
      </div>
    </div>
    <div class="container">
      <div class="row justify-content-center social">
        <div class="col-12 social-icon">
          <a href="#"><?= Html::img('@web/img/social/em.png'); ?></a>
          <a href="#"><?= Html::img('@web/img/social/face.png'); ?></a>
          <a href="#"><?= Html::img('@web/img/social/goo.png'); ?></a>
          <a href="#"><?= Html::img('@web/img/social/inst.png'); ?></a>
          <a href="#"><?= Html::img('@web/img/social/pint.png'); ?></a>
        </div>
      </div>
    </div>
  </div>
</footer>
<div class="copyright bg-dark">
  <div class="container">
    <?= Html::img('@web/img/logo.png', ['class' => 'footer-logo']); ?>
    <div>© 2017-2018 NeyNiko</div>
  </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
