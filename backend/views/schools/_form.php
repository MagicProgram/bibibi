<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Types;
use common\models\Schools;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Schools */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="schools-form">

    <?php $form = ActiveForm::begin(['id' => 'schools-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">



        <div class="col-md-5">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'age')->dropDownList(['0' => 'Взрослые', '1' => 'Дети', '2' => 'Взрослые и дети']); ?>
        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'city')->dropDownList(Schools::find()->select(['city'])->indexBy('city')->groupBy('city')->column(), ['prompt' => '']) ?>
        </div>

        <div class="col-md-2">
            <?= $form->field($model, 'active')->dropDownList([0 => 'Нет', 1 => 'Да'], ['options' => ['1' => ['Selected'=>true]]]) ?>
        </div>

        <div class="col-md-5">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'address')->textInput(['rows' => 6]) ?>
        </div>

        <div class="col-md-7">
            <?= $form->field($model, 'tagsArray')->checkboxList(Types::find()->select(['name', 'id'])->indexBy('id')->column()) ?>
        </div>

        <div class="col-md-12 row">

            <div class="col-md-6">
                <?= $form->field($model, 'about')->widget(CKEditor::className(), [
                                                            'options' => ['rows' => 6],
                                                            'preset' => 'full',
                                                            'clientOptions' => ['format_tags' => 'p;h1;h2;h3;h4;h5;h6;pre;address;div']
                                                        ]) ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'timetable')->widget(CKEditor::className(), [
                                                            'options' => ['rows' => 6],
                                                            'preset' => 'full',
                                                            'clientOptions' => ['format_tags' => 'p;h1;h2;h3;h4;h5;h6;pre;address;div']
                                                        ]) ?>
            </div>
        </div>

        <div class="col-md-3">
            <?php
                if(isset($model->general_image) && file_exists(Yii::getAlias('@frontend/web' . $model->general_image)))
                { 
                    echo Html::img(Yii::getAlias('http://sbi.loc' . $model->general_image), ['class' => 'school_general_image']);
                    echo $form->field($model, 'del_img')->checkBox(['class'=>'span-1']);
                }
            ?>


        </div>

        <div class="col-md-3">
            <?= $form->field($model, 'file')->fileInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'www')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'updated')->textInput() ?>
            
        </div>



        <div class="col-md-12">
            
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

        </div>

    </div>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
