<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "my_works".
 *
 * @property int $id
 * @property int $category
 * @property string $name
 * @property string $text
 * @property string $date
 * @property resource $photo
 *
 * @property Category $category0
 */
class Works extends \yii\db\ActiveRecord
{
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
            [['text', 'photo'], 'string'],
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
            'photo' => 'Photo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }
}
