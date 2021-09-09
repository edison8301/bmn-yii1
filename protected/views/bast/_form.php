<?php
/* @var $this BastController */
/* @var $model Bast */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'bast-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nomor'); ?>
		<?php echo $form->textField($model,'nomor',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nomor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tanggal'); ?>
		<?php echo $form->textField($model,'tanggal'); ?>
		<?php echo $form->error($model,'tanggal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pegawai_pihak_pertama'); ?>
		<?php echo $form->textField($model,'id_pegawai_pihak_pertama'); ?>
		<?php echo $form->error($model,'id_pegawai_pihak_pertama'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_pegawai_pihak_kedua'); ?>
		<?php echo $form->textField($model,'id_pegawai_pihak_kedua'); ?>
		<?php echo $form->error($model,'id_pegawai_pihak_kedua'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_barang'); ?>
		<?php echo $form->textField($model,'id_barang'); ?>
		<?php echo $form->error($model,'id_barang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'jumlah'); ?>
		<?php echo $form->textField($model,'jumlah'); ?>
		<?php echo $form->error($model,'jumlah'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status_bast'); ?>
		<?php echo $form->textField($model,'status_bast'); ?>
		<?php echo $form->error($model,'status_bast'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id_jenis_bast'); ?>
		<?php echo $form->textField($model,'id_jenis_bast'); ?>
		<?php echo $form->error($model,'id_jenis_bast'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
		<?php echo $form->error($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
		<?php echo $form->error($model,'updated_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'deleted_at'); ?>
		<?php echo $form->textField($model,'deleted_at'); ?>
		<?php echo $form->error($model,'deleted_at'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->