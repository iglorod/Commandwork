<?php
$this->title = 'Registration';
?>

<h1>Registration</h1>

<?php
use \yii\widgets\ActiveForm;
?>
<link rel="stylesheet" type="text/css" href="web/css/login.css">
<?php
$form=ActiveForm::begin(['class'=>'form-horizontal']);
?>
<div class="center-block">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-2-offset-0">
				<?= $form->field($model,'login')->textInput(['autofocus'=>true]) ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-2-offset-0">
				<?= $form->field($model,'email')->textInput() ?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 col-xl-2-offset-0">
				<?= $form->field($model,'password')->passwordInput() ?>
				<div>
					<button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
				</div>
			</div>
		</div>
	</div>
	<?php
	$form=ActiveForm::end();
	?>
