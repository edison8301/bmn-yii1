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
		<?php echo $form->select2Group($model,'kode',array(
				'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
				'widgetOptions'=>array(
					'data'=>Barang::getList(),
					'htmlOptions'=>array(
						'placeholder'=>'Ketik Kode atau Nama Barang',
					)
				)
		)); ?>
		
		<?php echo $form->textFieldGroup($model,'nup_awal',array(
				'wrapperHtmlOptions'=>array('class'=>'col-sm-2'),
				'widgetOptions'=>array(
					'htmlOptions'=>array('class'=>'span5','maxlength'=>255)
				)
		)); ?>
		
		<?php echo $form->textFieldGroup($model,'nup_akhir',array(
				'wrapperHtmlOptions'=>array('class'=>'col-sm-2'),
				'widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)
				)
		)); ?>

		<?php echo $form->select2Group($model,'nup_lainnya',array(
				'wrapperHtmlOptions' => array('class' => 'col-sm-4'),
				'widgetOptions' => array(
					'asDropDownList' => false,
					'options' => array(
						'tags' => [],
						'placeholder' => 'Ketik Nup Lainnya',
						'separator' => ',',
						'minimumInputLength'=>0,
					),
				),
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
