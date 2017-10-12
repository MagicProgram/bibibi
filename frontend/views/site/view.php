<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::$app->params['city'][$model->city], 'url' => ['/' . $city]];

\frontend\components\Common::setDescription($model->description, ['name' => $model->name, 'city' => Yii::$app->params['city'][$model->city]], 'view');
\frontend\components\Common::setTitle($model->title, ['name' => $model->name, 'city' => Yii::$app->params['city'][$model->city]], 'view');


$crumbs = [];
// $parent = $model->category;
// $crumbs[] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
// while ($parent = $parent->parent) {
    // $crumbs[] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
// }
$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], array_reverse($crumbs));

$this->params['breadcrumbs'][] = $this->title;
// $this->params['category'] = $model->category;
?>
<div class="catalog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-3">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    // 'id',
                    // [
                    //     'attribute' => 'category_id',
                    //     'value' => ArrayHelper::getValue($model, 'category.name'),
                    // ],
                    // 'name',
                    'phone',
                    // 'price',
                    [
                        'label' => 'Типы',
                        'value' => implode(', ', ArrayHelper::map($model->types, 'id', 'name')),
                    ],
                ],
            ]) ?>
        </div>

    </div>

    <?php if ($model->about != '') { ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <h2>О школе</h2>

            <?= Yii::$app->formatter->asNtext($model->about) ?>
        </div>
    </div>

    <?php } ?>

</div>
