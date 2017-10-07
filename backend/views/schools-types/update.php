<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SchoolsTypes */

$this->title = 'Update Schools Types: ' . $model->school_id;
$this->params['breadcrumbs'][] = ['label' => 'Schools Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->school_id, 'url' => ['view', 'school_id' => $model->school_id, 'type_id' => $model->type_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="schools-types-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
