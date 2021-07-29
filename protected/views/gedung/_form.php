<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'gedung-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'nama',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

<div class="form-actions well">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'icon' => 'ok',
			'label'=>'Simpan',
		)); ?>
</div>

<?php $this->endWidget(); ?>
