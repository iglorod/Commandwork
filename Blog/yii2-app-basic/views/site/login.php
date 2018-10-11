<?php
$this->title = 'Login';
?>

<h1>Login here...</h1>

<?php
use yii\widgets\ActiveForm;
?>

<?php
    $form=ActiveForm::begin();
?>

<?=
    $form->field($model,'email')->textInput(['autofocus'=>true]);
?>

<?=
    $form->field($model,'password')->passwordInput();
?>

<div>
    <button type="submit" class="btn btn-primary">Sign in</button>
</div>

<?php
    $form=ActiveForm::end();
?>


