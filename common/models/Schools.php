<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\Html;


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
 * @property string $created
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
            [['name', 'city', 'active', 'age'], 'required'],
            [['address', 'timetable', 'about', 'location'], 'string'],
            // [['url'], 'backend\models\validate\UrlValidate'],
            [['age'], 'integer'],
            [['active'], 'boolean'],
            [['tagsArray'], 'safe'],
            [['updated', 'created'], 'safe'],
            [['phone'], 'backend\models\validate\PhoneValidate'],
            [['name', 'url', 'city', 'www', 'email', 'general_image', 'title', 'description', 'h1'], 'string', 'max' => 255],

            // для загрузки файла
            [['file'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
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
            'url' => 'Ссылка',
            'timetable' => 'Расписание',
            'phone' => 'Телефоны',
            'active' => 'Опубликовано',
            'age' => 'Возраст',
            'city' => 'Город',
            'www' => 'Сайт',
            'email' => 'Email',
            'created' => 'Дата создания',
            'updated' => 'Дата обновления',
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

    // Обработка сайтов
    public function getParseSites() {

        $sites = explode(',', $this->www);

        $parsed = '';

        foreach ($sites as $site) {

            $site = trim($site);

            if (stristr($site, 'vk.com')) {
                $parsed .= Html::a(Html::encode('Вконтакте'), $site, ['class' => 'school_link_vk', 'rel' => 'nofollow']);
            } elseif (stristr($site, 'instagram.com')) {
                $parsed .= Html::a(Html::encode('Instagram'), $site, ['class' => 'school_link_inst', 'rel' => 'nofollow']);
            } elseif (stristr($site, 'facebook.com')) {
                $parsed .= Html::a(Html::encode('Facebook'), $site, ['class' => 'school_link_facebook', 'rel' => 'nofollow']);
            } elseif (stristr($site, 'youtube.com')) {
                $parsed .= Html::a(Html::encode('Youtube'), $site, ['class' => 'school_link_youtube', 'rel' => 'nofollow']);
            } elseif ($site != '') {
                $parsed .= '<br>' . Html::a(Html::encode('Сайт'), $site, ['class' => 'school_link_view', 'rel' => 'nofollow']);
            }
        }

        return $parsed;
    }

}
