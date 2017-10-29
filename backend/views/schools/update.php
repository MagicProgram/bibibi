<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Schools */

$this->title = '' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Schools', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="schools-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if (Yii::$app->session->hasFlash('bratok')): ?>
	<div class="alert alert-success">
   		<?= Yii::$app->session->getFlash('bratok'); ?>
	</div>
	<?php  endif; ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
