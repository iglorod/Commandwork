<?php
$this->title = 'Registration';
?>

<h1>Registration</h1>

<?php
use \yii\widgets\ActiveForm;
?>

<?php
    $form=ActiveForm::begin(['class'=>'form-horizontal']);
?>

<?= $form->field($model,'login')->textInput(['autofocus'=>true]) ?>

<?= $form->field($model,'email')->textInput() ?>

<?= $form->field($model,'password')->passwordInput() ?>


<div>
    <button type="submit" class="btn btn-primary">Sign up</button>
</div>

<?php
    $form=ActiveForm::end();
?>
