<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $title
 * @property string $description
 * @property string $h1
 * @property string $text
 * @property string $fulltext
 * @property string $general_image
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['text', 'fulltext', 'general_image'], 'string'],
            [['name', 'url', 'title', 'description', 'h1'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'title' => 'Title',
            'description' => 'Description',
            'h1' => 'H1',
            'text' => 'Text',
            'fulltext' => 'Fulltext',
            'general_image' => 'General Image',
        ];
    }


    
  

}