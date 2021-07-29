<?php
/* @var $this BarangKondisiController */
/* @var $model BarangKondisi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'barang-kondisi-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

<div class="well">

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->textFieldGroup($model,'nama',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
	</div>
	
</div>

<div class="well">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'danger',
			'icon'=>'ok',
			'label'=>'Add',
		)); ?>

</div>

<?php $this->endWidget(); ?>

</div><!-- form -->