<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $tag app\models\Schools */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $type->name;

$currentCity = Yii::$app->params['city'][$city];

$this->params['breadcrumbs'][] = ['label' => $currentCity, 'url' => ['/' . $city]];
$this->params['breadcrumbs'][] = ['label' => 'По видам', 'url' => ['/' . $city . '/types']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['type'] = $type;

// title and description передается в лэйаут
\frontend\components\Common::setDescription($type->description, ['name' => $type->name, 'city' => Yii::$app->params['city'][$city]], 'type');
\frontend\components\Common::setTitle($type->title, ['name' => $type->name, 'city' => Yii::$app->params['city'][$city]], 'type');

?>
    <h1>Школы <?= Html::encode($this->title); echo ' ', $currentCity ?></h1>

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
		<div class="col-sm-5 schools_list_header_address">
			Адрес
		</div>
	</div>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'itemView' => '_item',
    ]); ?>
