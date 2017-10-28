<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$typeLinks = [];
foreach ($model->types as $type) {
    $typeLinks[] = Html::a(Html::encode($type->name), [$model->city . '/types/' . $type->url]);
}
$phonesArray = explode(',', $model->phone);
$phoneLinks = [];
foreach ($phonesArray as $phonelink) {
    $phonelink = trim($phonelink);
    $phoneLinks[] = Html::a(Html::encode($phonelink), 'tel:' . $phonelink);
}
// print('<pre>');
// print_r($model);die;
?>
<div class="col-sm-12 school">
    <div class="col-sm-3 school_name">
        <div class="school_overflow_cell_name">
            <?= Html::a(Html::encode($model->name), ['/'. $model->city . '/' . $model->id . '-' .$model->url]) ?>
        </div>
    </div>
    <div class="col-sm-2 school_types">
        <div class="school_overflow_cell">
             <?php if ($typeLinks): ?><?= implode(', ', $typeLinks) ?><?php endif; ?>
        </div>
    </div>
    <div class="col-sm-2 school_phone">
        <div class="school_overflow_cell">
            <?php // echo Yii::$app->formatter->asNtext($model->phone) ?>
            <?= implode(' ', $phoneLinks) ?>
        </div>
    </div>
    <div class="col-sm-4 school_address">
        <div class="school_overflow_cell">
             <?php echo Yii::$app->formatter->asNtext($model->address) ?>
        </div>
    </div>
    <div class="col-sm-1 school_age">
        <?php if ($model->age == 1 || $model->age == 2): ?>
            <span class="for_children" title="Для детей или для взрослых и детей">👶</span>
        <?php endif; ?>
    </div>
</div>
