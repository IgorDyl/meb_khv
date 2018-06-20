<?php

namespace common\models;

use yii\web\UploadedFile;
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
            [['category'], 'unique'],
            [['category'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'name' => 'Name',
            'text' => 'Text',
            'date' => 'Date',
            'image' => 'Картинка',
            'file'=> 'картинка'
        ];
    }

    public function beforeSave ($insert)
    {
        if($file = UploadedFile::getInstance($this, 'file')) {
            $dir = Yii::getAlias('@images').'/work/';
            // if(file_exists($dir.$this->image)){
            //    // unlink($dir.$this->image);
            // }
            // if (file_exists($dir.'50x50/'.$this->image)){
            //   //  unlink($dir.'50x50/'.$this->image);
            // }
            // if (file_exists($dir.'800x/'.$this->image)){
            //    // unlink($dir.'800x/'.$this->image);
            // }
            $this->image = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' . $file->extension;
            $file->saveAs($dir.$this->image);
            $imag = Yii::$app->image->load($dir.$this->image);
            $imag->backgraund('#fff, 0');
            $imag->resize('50','50', Yii\image\drivers\Image::INVERSE);
            $imag->crop('50','50');
            $imag->save($dir.'50x50/'.$this->image, 90);
            // $imag = Yii::$app->image->load($dir.$this->image);
            // $imag->backgraund('#fff, 0');
            // $imag->resize('800', null, Yii\image\drivers\Image::INVERSE);
            // $imag->save($dir.'800x/'.$this->image, 90);
        }
        return parent::beforeSave($insert);
    }    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasMeny(Category::className(), ['id' => 'category']);
    }
}
