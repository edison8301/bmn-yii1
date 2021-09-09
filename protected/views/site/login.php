<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php /* $this->beginWidget('booster.widgets.TbPanel',array(
   'title' => 'Aplikasi BMN LAN',
	'context'=>'primary',
 	'padContent' => false,
     'htmlOptions' => array(
     		'class' => 'bootstrap-widget-table',
     		'style'=>'margin-bottom:0px;height:290px;'
     	)
));?>


<div id="site-login" style="margin:0px;">

	<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'htmlOptions'=>array('class'=>'well'),
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
			
		<?php echo $form->textFieldGroup($model,'username',array(
				'prepend'=>'<i class="glyphicon glyphicon-user"></i>'
		)); ?>

		<?php echo $form->passwordFieldGroup($model,'password',array(
				'prepend'=>'<i class="glyphicon glyphicon-lock"></i>'
		)); ?>
		
		
		<hr>

		<div class="buttons">
			<?php $this->widget('booster.widgets.TbButton', array(
					'buttonType'=>'submit',
					'context'=>'primary',
					'label'=>'Login',
					'icon'=>'lock white',
					'htmlOptions'=>array('style'=>'width:100%')
			)); ?>
		</div>


	<?php $this->endWidget(); ?>



</div>

<?php $this->endWidget(); */ ?>

<div class="row" style="margin-top: 2em">
	<div class="col-sm-6 col-6 align-items-center">
		<img src="images/logo-lan.png" alt="logo-lan" width="200" class="float-left">
	</div>
	<div class="col-sm-6 col-6 align-items-center">
		<img src="images/logo-simpatik.png" alt="logo-simpatik" width="300" class="float-right">
	</div>
</div>
<div class="row" style="margin-top: 6.5em;">
	<div class="col-sm-5 ml-auto">
		
		<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'htmlOptions'=>array('class'=>'well','style'=>'background-color:#f8f9facc'),
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

		<p class="text-center">Silahkan login terlebih dahulu</p>
						
		<?php echo $form->textFieldGroup($model,'username',array(
				'prepend'=>'<i class="glyphicon glyphicon-user"></i>'
		)); ?>

		<?php echo $form->passwordFieldGroup($model,'password',array(
				'prepend'=>'<i class="glyphicon glyphicon-lock"></i>'
		)); ?>

		<div class="buttons">
			<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'primary',
				'label'=>'LOGIN',
			)); ?>
		</div>

		<?php $this->endWidget(); ?>
	</div>
</div>
<div class="row" style="margin-top: 1em;">
	<div class="col-sm-12 text-banner">
		<h1 class="p-2">
		<span style="font-style: italic">Selamat Datang di ...</span> <br>
		Sistem Inventarisasi dan Manajemen Penggunaan Aset Tetap Internal Kantor - Lembaga Administrasi Negara
		</h1>
	</div>
</div>