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
    <a href="index.html" class="navbar-brand">
      <?= Html::img('@web/img/logo.png'); ?>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a href="index.html" class="nav-link">Головна</a>
        </li>
        <li class="nav-item">
          <a href="courses.html" class="nav-link">Курси</a>
        </li>
        <li class="nav-item">
          <a href="contacts.html" class="nav-link">Контакти</a>
        </li>
        <li class="nav-item">
          <a href="about.html" class="nav-link">Про нас</a>
        </li>
      </ul>
      <ul class="form-inline my-2 my-lg-0">
        <span class="badge">Ви зайшли як гість</span>
        <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">
        Авторизуватися
        </button>
      </ul>
    </div>
  </nav>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    foreach(Navigations::getClientNav() as $nav):

      if($nav->alias == 'AdminPanel'):
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                Users::isAdmin(Yii::$app->user->id) ? (
                  ['label' => $nav->label, 'url' => [$nav->url]]
                ) : ('')
            ]
        ]);
      elseif($nav->alias == 'Authorization'):
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                Yii::$app->user->isGuest ? (
                    ['label' => $nav->label, 'url' => [$nav->url]]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
      elseif($nav->alias == 'Lessons'):
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                (!Yii::$app->user->isGuest && (Users::isAdmin(Yii::$app->user->id) || Users::isTeacher(Yii::$app->user->id)))  ? (
                    ['label' => $nav->label, 'url' => [$nav->url]]
                ) : ('')
            ],
        ]);
      else:
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                  ['label' => $nav->label, 'url' => [$nav->url]]
            ]
        ]);
      endif;
    endforeach;
    NavBar::end();
    ?>

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
          <a href="index.html" class="nav-link active">Головна</a>
          <a href="courses.html" class="nav-link">Курси</a>
          <a href="contacts.html" class="nav-link">Контакти</a>
          <a href="about.html" class="nav-link">Про нас</a>
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
