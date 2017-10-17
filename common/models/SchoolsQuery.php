<?php

namespace common\models;

use common\models\SchoolsTypes;

/**
 * This is the ActiveQuery class for [[Schools]].
 *
 * @see Schools
 */
class SchoolsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/


    /**
     * @inheritdoc
     * @return Schools[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    public function active()
    {
        return $this->andWhere(['active' => true]);
    }

    public function forType($id)
    {
        return $this->joinWith(['schoolsTypes'], false)->andWhere([schoolsTypes::tableName() . '.type_id' => $id]);
    }
    public function forTypeCity($id, $city)
    {
        return $this->joinWith(['schoolsTypes'], false)->where(['city' => $city])->andWhere([schoolsTypes::tableName() . '.type_id' => $id]);
    }


    /**
     * @inheritdoc
     * @return Schools|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
