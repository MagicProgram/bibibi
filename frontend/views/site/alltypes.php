<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $tag app\models\Schools */
/* @var $dataProvider yii\data\ActiveDataProvider */

// echo $modelCity->text;

$currentCity = Yii::$app->params['city'][$city];

$this->title = 'Все виды боевых искусств в г. ' . $currentCity;


$this->params['breadcrumbs'][] = ['label' => $currentCity, 'url' => ['/' . $city]];
$this->params['breadcrumbs'][] = ['label' => 'Виды боевых искусств'];
// $this->params['breadcrumbs'][] = $this->title;

$pageinationTitle = '';
if (array_key_exists('page', $_GET)) {
	$pageinationTitle =  ' — Страница ' . $_GET['page'];
}

\frontend\components\Common::setDescription($modelCity->description);
\frontend\components\Common::setTitle($modelCity->title . $pageinationTitle);

?>

<h1><?php echo Yii::$app->formatter->asNtext($modelCity->h1) ?></h1>

<div class="col-md-12"><?php echo Yii::$app->formatter->asHtml($modelCity->text) ?></div>

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

