название <?= $model->name; ?><br/>
описание <?= $model->description; ?><br/>
текст <?= $model->text; ?><br/>
пользователь <?= $model->user->username; ?><br/>
картинки
<?php foreach($files as $file): ?>
    <img src="<?= Yii::$app->request->baseUrl.'/uploads/'.$file->href; ?>">
<?php endforeach; ?>
