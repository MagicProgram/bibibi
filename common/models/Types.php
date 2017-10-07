<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%types}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $description
 * @property string $h1
 * @property string $text
 * @property string $general_image
 *
 * @property SchoolsTypes[] $schoolsTypes
 * @property Schools[] $schools
 */
class Types extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%types}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['text', 'general_image'], 'string'],
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
            'url' => 'Ссылка (латиница)',
            'title' => 'Title',
            'description' => 'Description',
            'h1' => 'H1',
            'text' => 'Text',
            'general_image' => 'General Image',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchoolsTypes()
    {
        return $this->hasMany(SchoolsTypes::className(), ['type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchools()
    {
        return $this->hasMany(Schools::className(), ['id' => 'school_id'])->viaTable('{{%schools_types}}', ['type_id' => 'id']);
    }
}
