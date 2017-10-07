<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Schools;
use common\models\Types;

/* @var $this yii\web\View */
/* @var $model common\models\SchoolsTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schools-types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'school_id')->dropDownList(Schools::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <?= $form->field($model, 'type_id')->dropDownList(Types::find()->select(['name', 'id'])->indexBy('id')->column()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
