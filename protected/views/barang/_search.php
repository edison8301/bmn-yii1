<?php
/* @var $this BarangController */
/* @var $model Barang */
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
		<?php echo $form->label($model,'kode'); ?>
		<?php echo $form->textField($model,'kode',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nama'); ?>
		<?php echo $form->textField($model,'nama',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tahun_perolehan'); ?>
		<?php echo $form->textField($model,'tahun_perolehan',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'asal_perolehan'); ?>
		<?php echo $form->textField($model,'asal_perolehan',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'masa_manfaat'); ?>
		<?php echo $form->textField($model,'masa_manfaat',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_barang_kondisi'); ?>
		<?php echo $form->textField($model,'id_barang_kondisi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sk_psp'); ?>
		<?php echo $form->textField($model,'sk_psp',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sk_penghapusan'); ?>
		<?php echo $form->textField($model,'sk_penghapusan',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_lokasi'); ?>
		<?php echo $form->textField($model,'id_lokasi'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_pegawai'); ?>
		<?php echo $form->textField($model,'id_pegawai'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gambar'); ?>
		<?php echo $form->textField($model,'gambar',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'waktu_diubah'); ?>
		<?php echo $form->textField($model,'waktu_diubah'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'waktu_dibuat'); ?>
		<?php echo $form->textField($model,'waktu_dibuat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->