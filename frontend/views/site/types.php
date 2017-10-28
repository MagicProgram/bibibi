<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $tag app\models\Schools */
/* @var $dataProvider yii\data\ActiveDataProvider */

$currentCity = Yii::$app->params['city'][$city];

$this->params['breadcrumbs'][] = ['label' => $currentCity, 'url' => ['/' . $city]];
$this->params['breadcrumbs'][] = ['label' => 'Виды боевых искусств', 'url' => ['/' . $city . '/types']];
$this->params['breadcrumbs'][] = $type->name;
$this->params['type'] = $type;

// title and description передается в лэйаут

\frontend\components\Common::setDescription($type->description, ['name' => $type->name, 'city' => Yii::$app->params['city'][$city]], 'type');
\frontend\components\Common::setTitle($type->title, ['name' => $type->name, 'city' => Yii::$app->params['city'][$city]], 'type');

?>
    <h1><?= Html::encode($type->name); echo ' ', $currentCity ?></h1>

    <div class="col-md-12"><?php echo Yii::$app->formatter->asHtml($type->excerpt) ?></div>

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
        'itemOptions' => [
	        'tag' => false,
	    ],
	    'options' => [
	        'tag' => 'div',
	        'class' => 'schools-list',
	        'id' => 'schools-list',
	    ],
    ]); ?>
