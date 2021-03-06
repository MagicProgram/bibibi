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



\frontend\components\Common::setDescription($modelCity->description);
\frontend\components\Common::setTitle($modelCity->title);

?>



<h1><?php echo Yii::$app->formatter->asNtext($modelCity->h1) ?></h1>

<div class="col-md-12"><?php echo Yii::$app->formatter->asHtml($modelCity->text) ?></div>	

<?=$this->render("//common/listhead") ?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'itemView' => '_item',
    'itemOptions' => [
        'tag' => false,
    ],
    'options' => [
        'tag' => 'div',
        'class' => 'schools-list',
        'id' => 'schools-list',
    ],
]); ?>




