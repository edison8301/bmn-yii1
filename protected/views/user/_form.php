<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>


<div class="well">

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

	<?php echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

	<?php echo $form->textFieldGroup($model,'role_id',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

</div>

<div>&nbsp;</div>

<div class="well">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'danger',
			'icon' => 'ok',
			'label'=>'Add'
		)); ?>
</div>

<?php $this->endWidget(); ?>
