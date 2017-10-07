<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SchoolsTypes */

$this->title = $model->school_id;
$this->params['breadcrumbs'][] = ['label' => 'Schools Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schools-types-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'school_id' => $model->school_id, 'type_id' => $model->type_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'school_id' => $model->school_id, 'type_id' => $model->type_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'school_id',
            'type_id',
        ],
    ]) ?>

</div>
