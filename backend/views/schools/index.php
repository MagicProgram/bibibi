<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Types;
use common\models\Schools;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SchoolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Schools';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schools-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Schools', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    // return Yii::$app->params['city'][$data->city];
                    return Html::a($data->name, ['update', 'id' => $data->id]);
                },
                'format' => 'html',
            ],
            // 'url',
            // [
            //     'label' => 'Types',
            //     'attribute' => 'type_id',
            //     'filter' => Types::find()->select(['name', 'id'])->indexBy('id')->column(),
            //     'value' => function (Schools $schools) {
            //             return implode(', ', ArrayHelper::map($schools->types, 'id', 'name'));
            //         },

            // ],
            // 'address:ntext',
            // 'timetable:ntext',
            // 'phone',
            [
                'attribute' => 'active',
                'filter' => [0 => 'Нет', 1 => 'Да'],
                'format' => 'boolean',
            ],
            // 'age',
            [
                'attribute' => 'created',
                'format' => ['date', 'php:Y-m-d']
            ],
            [
                'label' => 'Город',
                'attribute' => 'city',
                'filter' => Yii::$app->params['city'],
                'value' => function ($data) {
                    return Yii::$app->params['city'][$data->city];
                }
                // 'value' => Yii::$app->params['city'][$city],
            ],
            // 'www',
            // 'email:email',
            // 'updated',
            // 'general_image',
            // 'title',
            // 'description',
            // 'h1',
            // 'about:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
