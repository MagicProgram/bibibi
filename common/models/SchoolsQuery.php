<?php

namespace common\models;

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

    /**
     * @inheritdoc
     * @return Schools|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
