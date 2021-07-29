<div class="well">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'barang-pemindahan-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>

	<?php /* echo $form->textFieldGroup($model,'nomor',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-6'),
		'widgetOptions'=>array(
			'htmlOptions'=>array(
				'class'=>'span5',
				'maxlength'=>255,
				))
			)); */?>

	<?php echo $form->datePickerGroup($model,'tanggal',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-6'),
		'widgetOptions'=>array(
			'options'=>array('format'=>'yyyy-mm-dd','autoclose' => true),'htmlOptions'=>array(
				'class'=>'span5')),
			 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>',
			 'append'=>'Input Tanggal Pemindahan.'
			 )); ?>

	<?php echo $form->select2Group($model,'id_lokasi_asal',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-6'),
		'widgetOptions'=>array(
			'data' => CHtml::ListData(Lokasi::model()->findAll(),'id','nama'),
			'htmlOptions'=>array(
				'class'=>'span5'
			)))); ?>

	<?php echo $form->select2Group($model,'id_lokasi_tujuan',array(
		'wrapperHtmlOptions'=>array('class'=>'col-sm-6'),
		'widgetOptions'=>array(
			'data' => CHtml::ListData(Lokasi::model()->findAll(),'id','nama'),
			'htmlOptions'=>array(
				'class'=>'span5'
			)))); ?>

	<?php echo $form->hiddenField($model,'id_barang_pemindahan_status',array('value'=>2)); ?>

</div>	

<div class="well" style="text-align: right">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'danger',
			
			'icon' => 'ok',
			'label'=>'Simpan',
		)); ?>
</div>

<?php $this->endWidget(); ?>
