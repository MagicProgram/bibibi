<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $tag app\models\Schools */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $type->name;

$currentCity = Yii::$app->params['city'][$city];

$this->params['breadcrumbs'][] = ['label' => 'Виды боевых искусств', 'url' => ['/' . $city . '/types']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['type'] = $type;
?>
    <h1>Школы <?= Html::encode($this->title); echo ' ', $currentCity ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => '_item',
    ]); ?>
