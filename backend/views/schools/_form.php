<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Types;
use common\models\Schools;

/* @var $this yii\web\View */
/* @var $model common\models\Schools */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schools-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">



        <div class="col-lg-5">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-2">
            <?= $form->field($model, 'age')->dropDownList(['0' => 'Взрослые', '1' => 'Дети', '2' => 'Взрослые и дети']); ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'city')->dropDownList(Schools::find()->select(['city'])->indexBy('city')->groupBy('city')->column(), ['prompt' => '']) ?>
        </div>

        <div class="col-lg-2">
            <?= $form->field($model, 'active')->dropDownList([0 => 'Нет', 1 => 'Да'], ['options' => ['1' => ['Selected'=>true]]]) ?>
        </div>

        <div class="col-lg-5">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-lg-12">
            <?= $form->field($model, 'tagsArray')->checkboxList(Types::find()->select(['name', 'id'])->indexBy('id')->column()) ?>
        </div>

        <div class="col-lg-6">
            <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'timetable')->textarea(['rows' => 6]) ?>
        </div>

        <div class="col-lg-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'www')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'updated')->input('date') ?>
        </div>

        <div class="col-lg-12">

            <?= $form->field($model, 'general_image')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

        </div>

    </div>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
