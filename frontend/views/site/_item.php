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
    $phoneLinks[] = Html::a(Html::encode($phonelink), 'tel:' . $model->phone);
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
    <div class="col-sm-5 school_address">
        <div class="school_overflow_cell">
            <img height="20px" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgaGVpZ2h0PSIyNCIgdmVyc2lvbj0iMS4xIiB3aWR0aD0iMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6Y2M9Imh0dHA6Ly9jcmVhdGl2ZWNvbW1vbnMub3JnL25zIyIgeG1sbnM6ZGM9Imh0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvIiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPjxnIHRyYW5zZm9ybT0idHJhbnNsYXRlKDAgLTEwMjguNCkiPjxwYXRoIGQ9Im0xMiAwYy00LjQxODMgMi4zNjg1ZS0xNSAtOCAzLjU4MTctOCA4IDAgMS40MjEgMC4zODE2IDIuNzUgMS4wMzEyIDMuOTA2IDAuMTA3OSAwLjE5MiAwLjIyMSAwLjM4MSAwLjM0MzggMC41NjNsNi42MjUgMTEuNTMxIDYuNjI1LTExLjUzMWMwLjEwMi0wLjE1MSAwLjE5LTAuMzExIDAuMjgxLTAuNDY5bDAuMDYzLTAuMDk0YzAuNjQ5LTEuMTU2IDEuMDMxLTIuNDg1IDEuMDMxLTMuOTA2IDAtNC40MTgzLTMuNTgyLTgtOC04em0wIDRjMi4yMDkgMCA0IDEuNzkwOSA0IDQgMCAyLjIwOS0xLjc5MSA0LTQgNC0yLjIwOTEgMC00LTEuNzkxLTQtNCAwLTIuMjA5MSAxLjc5MDktNCA0LTR6IiBmaWxsPSIjZTc0YzNjIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgwIDEwMjguNCkiLz48cGF0aCBkPSJtMTIgM2MtMi43NjE0IDAtNSAyLjIzODYtNSA1IDAgMi43NjEgMi4yMzg2IDUgNSA1IDIuNzYxIDAgNS0yLjIzOSA1LTUgMC0yLjc2MTQtMi4yMzktNS01LTV6bTAgMmMxLjY1NyAwIDMgMS4zNDMxIDMgM3MtMS4zNDMgMy0zIDMtMy0xLjM0MzEtMy0zIDEuMzQzLTMgMy0zeiIgZmlsbD0iI2MwMzkyYiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMCAxMDI4LjQpIi8+PC9nPjwvc3ZnPg==">
            <?php echo Yii::$app->formatter->asNtext($model->address) ?>
        </div>
    </div>
</div>
