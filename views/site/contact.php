<?php

  use yii\helpers\Html;
  use yii\bootstrap\ActiveForm;
  $this->title = 'Контакти';

?>

	<main>
		<section class="container-fluid">
			<div class="container">
				<div class="row text-center header-alert">
          <div class="col-sm-12">
          	<?= Html::img('@web/img/contacts/contacts.png'); ?>
            <h2>Контактна інформація</h2>
          </div>
        </div>
        <div class="row p-3 justify-content-between">
          <div class="col-lg-offset-3 col-md-offset-2"></div>
        	<div class="col-lg-4 col-md-5 col-sm-12 ">
	        	<p><?= Html::img('@web/img/contacts/telephone.png'); ?> <span>+38(066)55-99-333</span></p>
						<p><?= Html::img('@web/img/contacts/google.png'); ?> <span>chernologov1994@gmail.com</span></p>
						<p><?= Html::img('@web/img/contacts/telegram.png'); ?> <span>http://telegram.me/SpecialOne11</span></p>
						<p><?= Html::img('@web/img/contacts/skype.png'); ?> <span> SpecialOne1133</span></p>
						<p><?= Html::img('@web/img/contacts/instagram.png'); ?> <span> chernologov_jr</span></p>
						<p><?= Html::img('@web/img/contacts/facebook.png'); ?> <span>www.facebook.com/chernologov</span></p>
						<p><?= Html::img('@web/img/contacts/vk.png'); ?> <span>vk.com/chernologov_official</span></p>
        	</div>
          <div class="col-lg-offset-1"></div>
        	<div class="col-lg-4 col-md-5 col-sm-12">
	        	<p><?= Html::img('@web/img/contacts/telephone.png'); ?> +38(099)11-16-351</p>
						<p><?= Html::img('@web/img/contacts/google.png'); ?> nikolay1995@gmail.com</p>
						<p><?= Html::img('@web/img/contacts/telegram.png'); ?> http://telegram.me/Niko77</p>
						<p><?= Html::img('@web/img/contacts/skype.png'); ?> Niko77</p>
						<p><?= Html::img('@web/img/contacts/instagram.png'); ?> nikofun</p>
						<p><?= Html::img('@web/img/contacts/facebook.png'); ?> www.facebook.com/nikofun</p>
						<p><?= Html::img('@web/img/contacts/vk.png'); ?> vk.com/benjaminfran </p>
        	</div>
        </div>
			</div>
		</section>

		<section class="container-fluid">
      <div class="container">
        <div class="row text-center header-alert">
          <div class="col-12 alert alert-light" role="alert">
            <h2>Виникли питання? Скористайтесь формою для зворотнього зв'язку!</h2>
          </div>
        </div>
      </div>
      <form class="contacts_form">
        <p><input type="text" name="name" class="feedback_input" placeholder="Name" id="Ім'я"></p>
        <p><input type="email" name="email" class="feedback_input" placeholder="Email" id="Електронна пошта"></p>
        <p><textarea name="text" class="feedback_input" id="comment" placeholder="Повідомлення"></textarea></p>
        <input type="submit" value="Надіслати повідомлення" class="button_submit">
        <div class="ease"></div>
      </form>
    </section>

	</main>
