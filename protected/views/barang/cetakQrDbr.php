<?php
$this->breadcrumbs=array(
	'Barang'=>array('admin'),
	'Cetak QR',
);
?>
<h1>Cetak QR Code</h1>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'barang-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('target'=>'_blank')
)); ?>
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="well">
		<?php echo $form->select2Group($model,'id_lokasi',array(
				'wrapperHtmlOptions'=>array('class'=>'col-sm-6'),
				'widgetOptions'=>array(
					'data'=>Lokasi::getList(),
					'htmlOptions'=>array(
						'placeholder'=>'Ketik Kode atau Nama Lokasi Untuk Memilih Lokasi',
					)
				)
		)); ?>
		
	</div>


	<div class="form-group well">
		<div class="col-sm-3">&nbsp;</div>
		<div class="col-sm-9">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'danger',
				'icon'=>'print',
				'label'=>'Cetak QR Code',
		)); ?>		
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
