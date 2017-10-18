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

<div class="schools_list_header col-sm-12 hidden-xs">
	<div class="col-sm-3 schools_list_header_name">
		Школа
	</div>
	<div class="col-sm-2 schools_list_header_types">
		Виды БИ
	</div>
	<div class="col-sm-2 schools_list_header_phone">
		Телефон
	</div>
	<div class="col-sm-4 schools_list_header_address">
		Адрес
	</div>
	<div class="col-sm-1 schools_list_header_age">
		<span title="Для детей или для взрослых и детей">Дети</span>
	</div>
</div>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n{pager}",
    'itemView' => '_item',
]); ?>




