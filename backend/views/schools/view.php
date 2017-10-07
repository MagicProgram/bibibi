<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Schools */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
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
            'timetable:ntext',
            'phone',
            'active',
            'age',
            'city',
            'www',
            'email:email',
            'updated',
            'general_image',
            'title',
            'description',
            'h1',
            'about:ntext',

            
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
