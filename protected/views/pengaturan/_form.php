<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'pengaturan-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

<p class="help-block">Kolom dengan <span class="required">*</span> harus diisi.</p>

<?php echo $form->errorSummary($model); ?>

<div class="well">
	<?php echo $form->fileFieldGroup($model,'nilai',array('class'=>'span5','maxlength'=>255)); ?>

	
	<?php if(!empty($model->nilai)) print CHtml::image(Yii::app()->request->baseUrl.'/uploads/images/images'.$model->nilai,'',array('class'=>'img-responsive')); ?>

	
	<?php if(!empty($model->nilai)) { ?>
	<?php $this->widget('booster.widgets.TbButton',array(
			'buttonType'=>'link',
			'htmlOptions'=>array('class'=>'dim'),
			'context'=>'danger',
			'size'=>'small',
			'icon'=>'remove',
			'label'=>'',
			'url'=>array('post/removeThumbnail','id'=>$model->id)
	)); ?>
	<?php } ?>

	<?php print $form->error($model,'thumbnail'); ?>		
	
	<div>&nbsp;</div>

</div>

	<div class="form-actions well">
		<div class="row">
			<div class="col-sm-3">&nbsp;</div>
			<div class="col-sm-9">
			<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'htmlOptions'=>array('class'=>'dim'),
				'context'=>'primary',
				'icon'=>'ok',
				'label'=>'Simpan',
			)); ?>
			</div>
		</div>
	</div>

<?php $this->endWidget(); ?>
