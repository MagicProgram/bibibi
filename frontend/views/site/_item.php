<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$tagLinks = [];
foreach ($model->types as $type) {
    $tagLinks[] = Html::a(Html::encode($type->name), [$model->city . '/types/' . $type->url]);
}
// print('<pre>');
// print_r($model);die;
?>

<div class="panel panel-default">
    <div class="panel-heading"> 
        <?= Html::a(Html::encode($model->name), ['/'. $model->city . '/' . $model->id . '-' .$model->url]) ?>
    </div>
    <div class="panel-body">
        <?php if ($tagLinks): ?>
            <p>Виды: <?= implode(', ', $tagLinks) ?></p>
        <?php endif; ?>
        <p><b>Телефоны: </b><?php echo Yii::$app->formatter->asNtext($model->phone) ?></p>
        <p><b>Адрес: </b><?php echo Yii::$app->formatter->asNtext($model->address) ?></p>
        <p><b>Город: </b><?php echo Yii::$app->formatter->asNtext($model->city) ?></p>
    </div>
</div>
