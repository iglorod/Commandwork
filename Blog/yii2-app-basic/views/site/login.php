<?php
$this->title = 'Login';
?>
<link rel="stylesheet" type="text/css" href="web/css/login.css">

<h1>The page of Login</h1>

<?php
use yii\widgets\ActiveForm;
?>

<?php
$form=ActiveForm::begin();
?>
<div class="center-block">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-2-offset-0">
				<?=
				$form->field($model,'email')->textInput(['autofocus'=>true]);
				?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-2-offset-0">
				<?=
				$form->field($model,'password')->passwordInput(['class'=>'form-control']);
				?>
				<div>
					<button type="submit" class="btn btn-primary btn-lg">Sign in</button>
					<span class="help-block">Click here if you still doesn't register.</span>
					<span class="help-block">.</span>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
$form=ActiveForm::end();
?>


