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
