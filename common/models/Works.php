<?php

namespace common\models;

use yii\web\UploadedFile;
use yii\helpers\Url;
use Yii;

/**
 * This is the model class for table "my_works".
 *
 * @property int $id
 * @property int $category
 * @property string $name
 * @property string $text
 * @property string $date
 * @property resource $image
 *
 * @property Category $category0
 */
class Works extends \yii\db\ActiveRecord
{

    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'my_works';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'name'], 'required'],
            [['category'], 'integer'],
            [['text', 'image'], 'string'],
            [['file'], 'image'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Категория',
            'name' => 'Название',
            'text' => 'Описание',
            'date' => 'Дата работы',
            'file'=> 'Миниатюра',
            'image' => 'Имя картинки',
        ];
    }

    public function beforeSave ($insert)
    {
        if($file = UploadedFile::getInstance($this, 'file')) {
            $dir = Yii::getAlias('@images').'/work/';
            // if(file_exists($dir.$this->image)){
            //     unlink($dir.$this->image);
            // }                   
            // if (file_exists($dir.'50x50/'.$this->image)){
            //    unlink($dir.'50x50/'.$this->image);
            // }
            // if (file_exists($dir.'800x/'.$this->image)){
            //     unlink($dir.'800x/'.$this->image);
            // }
            $this->image = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' . $file->extension;
            $file->saveAs($dir.$this->image);
            $imag = Yii::$app->image->load($dir.$this->image);
            $imag->background('#fff, 0');
            $imag->resize('50','50', Yii\image\drivers\Image::INVERSE);
            $imag->crop('50','50');
            $imag->save($dir.'50x50/'.$this->image, 90);
            $imag = Yii::$app->image->load($dir.$this->image);
            $imag->background('#fff, 0');
            $imag->resize('800', null, Yii\image\drivers\Image::INVERSE);
            $imag->save($dir.'800x/'.$this->image, 90);
        }
        return parent::beforeSave($insert);
    }

    public function getSmallImage()
    {
        if($this->image) {
            $path = str_replace('admin.','',Url::home(true)).'uploads/images/work/50x50/'.$this->image;
        } else {
            $path = str_replace('admin.','',Url::home(true)).'uploads/images/abstract-1751248.svg';    
        }
        return $path;
    }   
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryId()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }
}
