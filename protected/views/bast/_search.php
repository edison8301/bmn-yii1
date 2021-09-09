<?php
/* @var $this BastController */
/* @var $model Bast */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nomor'); ?>
		<?php echo $form->textField($model,'nomor',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tanggal'); ?>
		<?php echo $form->textField($model,'tanggal'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pegawai_pihak_pertama'); ?>
		<?php echo $form->textField($model,'id_pegawai_pihak_pertama'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pegawai_pihak_kedua'); ?>
		<?php echo $form->textField($model,'id_pegawai_pihak_kedua'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_barang'); ?>
		<?php echo $form->textField($model,'id_barang'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'jumlah'); ?>
		<?php echo $form->textField($model,'jumlah'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status_bast'); ?>
		<?php echo $form->textField($model,'status_bast'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_jenis_bast'); ?>
		<?php echo $form->textField($model,'id_jenis_bast'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created_at'); ?>
		<?php echo $form->textField($model,'created_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated_at'); ?>
		<?php echo $form->textField($model,'updated_at'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deleted_at'); ?>
		<?php echo $form->textField($model,'deleted_at'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->