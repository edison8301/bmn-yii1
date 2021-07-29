<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'tahun-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<div class="well">

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'tahun',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

</div>

<div class="well">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'danger',
			'icon' => 'ok',
			'label'=>'Add',
		)); ?>
</div>

<?php $this->endWidget(); ?>
