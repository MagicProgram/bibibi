<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;


/**
 * This is the model class for table "{{%schools}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $timetable
 * @property string $phone
 * @property integer $active
 * @property integer $age
 * @property string $city
 * @property string $www
 * @property string $email
 * @property string $updated
 * @property string $general_image
 * @property string $title
 * @property string $description
 * @property string $h1
 * @property string $about
 *
 * @property SchoolsTypes[] $schoolsTypes
 * @property Types[] $types
 */
class Schools extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;

    public $del_img;


    public static function tableName()
    {
        return '{{%schools}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'city', 'city', 'active', 'age', 'url'], 'required'],
            [['address', 'timetable', 'about'], 'string'],
            // [['url'], 'backend\models\validate\UrlValidate'],
            [['active', 'age'], 'integer'],
            [['tagsArray'], 'safe'],
            [['updated'], 'safe'],
            [['phone'], 'backend\models\validate\PhoneValidate'],
            [['name', 'city', 'www', 'email', 'general_image', 'title', 'description', 'h1'], 'string', 'max' => 255],

            // для загрузки файла
            [['file'], 'file', 'extensions' => 'png, jpg'],
            [['del_img'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название школы',
            'address' => 'Адрес',
            'url' => 'Ссылка (латиница)',
            'timetable' => 'Расписание',
            'phone' => 'Телефоны',
            'active' => 'Опубликовано',
            'age' => 'Возраст',
            'city' => 'Город',
            'www' => 'Сайт',
            'email' => 'Email',
            'updated' => 'Обновлено',
            'general_image' => 'Картинка',
            'title' => 'SEO Title',
            'description' => 'SEO Description',
            'h1' => 'Заголовок H1',
            'about' => 'Описание',
            'tagsArray' => 'Типы БИ',
            'del_img' => 'Удалить картинку',
            'file' => 'Главная картинка',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchoolsTypes()
    {
        return $this->hasMany(SchoolsTypes::className(), ['school_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasMany(Types::className(), ['id' => 'type_id'])->viaTable('{{%schools_types}}', ['school_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SchoolsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SchoolsQuery(get_called_class());
    }

    private $_tagsArray;

    public function getTagsArray()
    {
        if ($this->_tagsArray === null) {
            $this->_tagsArray = $this->getTypes()->select('id')->column();
        }
        return $this->_tagsArray;
    }

    public function setTagsArray($value)
    {
        $this->_tagsArray = (array)$value;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateTags();
        parent::afterSave($insert, $changedAttributes);

    }

    private function updateTags()
    {
        $currentTagIds = $this->getTypes()->select('id')->column();
        $newTagIds = $this->getTagsArray();

        foreach (array_filter(array_diff($newTagIds, $currentTagIds)) as $tagId) {
            /** @var Tag $tag */
            if ($tag = Types::findOne($tagId)) {
                $this->link('types', $tag);
            }
        }

        foreach (array_filter(array_diff($currentTagIds, $newTagIds)) as $tagId) {
            /** @var Tag $tag */
            if ($tag = Types::findOne($tagId)) {
                $this->unlink('types', $tag, true);
            }
        }
    }

}
