<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $tag app\models\Schools */
/* @var $dataProvider yii\data\ActiveDataProvider */

$currentCity = Yii::$app->params['city'][$city];

$this->title = 'Все виды боевых искусств в г. ' . $currentCity;


$this->params['breadcrumbs'][] = ['label' => $currentCity, 'url' => ['/' . $city]];
$this->params['breadcrumbs'][] = ['label' => 'Виды боевых искусств', 'url' => ['/' . $city . '/types']];
// $this->params['breadcrumbs'][] = $this->title;
?>
    <h1>Виды боевых искусств в г. <?php echo ' ', $currentCity ?></h1>

<ul class="types">
<?php
	foreach($model as $row): 
?>

<li class="well">
	<!-- <img class="media-object" width="64" height="64"> -->
	<?= Html::a(Html::encode($row['name']), [$city . '/types/' . $row['url']], ['class' => '']) ?></li>

<?php
	endforeach;
?>
</ul>

