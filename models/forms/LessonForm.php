<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\Lessons;
use yii\base\Exception;
use yii\web\UploadedFile;
use app\models\Files;
use app\models\Locations;

class LessonForm extends Model
{

    public $description;
    public $name;
    public $text;
    public $imageFiles;
    public $docsFiles;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['description', 'name', 'text'], 'required'],
            [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
            [['docsFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx', 'maxFiles' => 4],
        ];
    }

    public function create($id = false)
    {
        $this->imageFiles = UploadedFile::getInstances($this, 'imageFiles');
        $this->docsFiles = UploadedFile::getInstances($this, 'docsFiles');
        if ($this->validate())
        {
            $model = new Lessons();
            if($id != false)
            {
              $model = Lessons::findOne($id);
            }
            $data = \Yii::$app->request->post();

            $model->user__id = Yii::$app->user->id;
            $model->name = $data['LessonForm']['name'];
            $model->description = $data['LessonForm']['description'];
            $model->text = $data['LessonForm']['text'];

            if(!$model->save())
            {
                 throw new Exception('Ошибка сохранения данных урока');
            }

            if(isset($data['location']))
            {
                $for_delete = Locations::find()->where(['lessons__id' => $model->id])->all();
                if($for_delete != null)
                {
                    if(!Locations::deleteAll(['lessons__id' => $model->id]))
                    {
                        throw new Exception('Ошибка удаления данных локаций');
                    }
                }

                foreach($data['location'] as $loc)
                {
                    $location = new Locations();
                    $location->lessons__id = $model->id;
                    $location->section__id = $loc;

                    if(!$location->save())
                    {
                         throw new Exception('Ошибка сохранения данных локаций');
                    }
                }
            }

            $file = Files::find()->orderBy(['name' => SORT_DESC])->one();
            $name_file = 0; // ID file
            if($file != NULL)
            {
                $name_file = $file->name;
            }

            foreach ($this->imageFiles as $file)
            {
                $name_file++;
                $file->saveAs('uploads/' . $name_file . '.' . $file->extension);

                $new_file = new Files();
                $new_file->name = $name_file;
                $new_file->lesson__id = $model->id;
                $new_file->href = $name_file . '.' . $file->extension;
                if(!$new_file->save())
                {
                    throw new Exception('Ошибка сохранения данных файла');
                }
            }
            foreach($this->docsFiles as $file)
            {
                $name_file++;
                $file->saveAs('uploads/' . $name_file . '.' . $file->extension);

                $new_file = new Files();
                $new_file->name = $name_file;
                $new_file->lesson__id = $model->id;
                $new_file->href = $name_file . '.' . $file->extension;
                if(!$new_file->save())
                {
                    throw new Exception('Ошибка сохранения данных файла');
                }
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Название',
            'description' => 'Описание',
            'text' => 'Текст',
            'imageFiles' => 'Картинки',
            'docsFiles' => 'MS Office документы'
        ];
    }

}
