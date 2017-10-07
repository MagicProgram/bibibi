<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SchoolsTypes */

$this->title = 'Create Schools Types';
$this->params['breadcrumbs'][] = ['label' => 'Schools Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="schools-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
