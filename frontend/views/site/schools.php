<?php

use yii\widgets\ListView;

/* @var $this yii\web\View */

// print_r($this);

$currentCity = Yii::$app->params['city'][$city];

$this->title = 'Школы Боевых искусств в г. ' . $currentCity;
// $this->description = 'sssss';
$this->params['breadcrumbs'][] = $currentCity;
// $this->params['breadcrumbs'][] = $this->title;
// $this->params['type'] = $this->title;
?>



<h1><?= $this->title ?></h1>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'itemView' => '_item',
]); ?>




