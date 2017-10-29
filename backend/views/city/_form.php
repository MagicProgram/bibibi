<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\City */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'h1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
                                                                'options' => ['rows' => 2],
                                                                'preset' => 'basic',
                                                                'clientOptions' => ['format_tags' => 'p;h1;h2;h3;h4;h5;h6;pre;address;div',]
                                                            ]) ?>

    <?= $form->field($model, 'fulltext')->widget(CKEditor::className(), [
                                                                'options' => ['rows' => 4],
                                                                'preset' => 'full',
                                                                'clientOptions' => ['format_tags' => 'p;h1;h2;h3;h4;h5;h6;pre;address;div']
                                                            ]) ?>

    <?= $form->field($model, 'general_image')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
