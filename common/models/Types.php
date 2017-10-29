<?php

namespace common\models;

use Yii;
use yii\db\Expression;

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
            [['text', 'general_image', 'excerpt'], 'string'],
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
            'h1' => 'Заголовок H1',
            'excerpt' => 'Выдержка',
            'text' => 'Полный текст',
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

    public function getTypesByCity($city = 'moscow')
    {
        return Types::find()
        ->select(['{{%types}}.*', 'types_count' => new Expression('COUNT({{%types}}.id)')])
        ->joinWith(['schools'], false)
        ->where(['city' => $city])
        ->groupBy('{{%types}}.id');
    }
    public function getTypesByCityForKids($city = 'moscow')
    {
        return Types::find()
        ->select(['{{%types}}.*', 'types_count' => new Expression('COUNT({{%types}}.id)')])
        ->joinWith(['schools'], false)
        ->where(['city' => $city])
        ->andWhere(['age' => [1,2]])
        ->groupBy('{{%types}}.id');
    }
}
