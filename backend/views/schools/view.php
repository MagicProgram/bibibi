<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Schools */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Школы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schools-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'url',
            [
                'label' => 'Типы',
                'value' => implode(', ', ArrayHelper::map($model->types, 'id', 'name')),
            ],
            'address:ntext',
            'timetable:Html',
            'phone',
            [
                'attribute' => 'active',
                // 'filter' => [0 => 'Нет', 1 => 'Да'],
                'format' => 'boolean',
            ],
            [
                'attribute' => 'age',
                'filter' => [0 => 'Взрослые', 1 => 'Дети', 2 => 'Взрослые и дети'],
                // 'format' => 'text',
                // 'value' => $model->age,
            ],
            [
                'attribute' => 'city',
                'value' => Yii::$app->params['city'][$model->city],
            ],
            [
                'label' => 'Caйты',
                'attribute' => 'parseSites',
                'format' => 'html',
            ],
            'email:email',
            'created:datetime',
            'updated:datetime',
            // 'general_image',
            [
                'attribute' => 'general_image',
                'value' => Html::img(Yii::getAlias('http://sbi.loc' . $model->general_image), ['class' => 'school_general_image']),
                'format' => 'html',
            ],
            'title',
            'description',
            'h1',
            'about:Html',

            
        ],
    ]) ?>


    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider(['query' => $model->getSchoolsTypes()]),
        'columns' => [

            'school_id',
            'type_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'schools-types'
            ],
        ],
    ]); ?>

</div>
