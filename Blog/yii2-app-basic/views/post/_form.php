<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <h5><b>Category</b></h5>
    <?= Html::dropDownList('id_tag',$selectedTag,$tags,['class'=>'form-control','style'=>"margin-bottom: 15px"]) ?>
    <?php
    if($action!='update') {
        ?>
        <?= $form->field($model2, 'image')->fileInput(['maxlength' => true]) ?>
        <?php
    }
    ?>
    <div class="form-group" style="margin-top: 20px">
        <?php if($action!='create') {?>
        <?= Html::a('Change Image', ['set-image', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?php } ?>
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
