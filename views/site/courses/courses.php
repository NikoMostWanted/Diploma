<?php
  use yii\helpers\Html;
  use app\models\Sections;
?>

<section class="container-fluid">
      <div class="container">
        <div class="row text-center header-alert">
          <div class="col-sm-12">
            <?= Html::img('@web/img/courses/1.png'); ?>
            <h2>Перелік наявних курсів</h2>
          </div>
        </div>

        <div class="row category_list">

          <?php foreach(Sections::get_zero_sections() as $section): ?>
            <div class="col-xs-12 col-sm-6 col-lg-4 category">
              <figure>
                <p>
                  <?= Html::img('@web/img/category/php.jpeg', ['class' => 'scaled']); ?>
                </p>
                <figcaption>
                  <h3><?= $section->name; ?></h3>
                  <p><?= $section->description; ?></p>
                </figcaption>
                <p class="text-center"><?= Html::a('Перейти до курсу', ['site/section', 'id' => $section->id], ['class' => 'btn btn-outline-secondary']); ?></p>
              </figure>
            </div>
          <?php endforeach; ?>

        </div>
      </div>
    </section>
