<?php
/* @var $this BastController */
/* @var $data Bast */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomor')); ?>:</b>
	<?php echo CHtml::encode($data->nomor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pegawai_pihak_pertama')); ?>:</b>
	<?php echo CHtml::encode($data->id_pegawai_pihak_pertama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pegawai_pihak_kedua')); ?>:</b>
	<?php echo CHtml::encode($data->id_pegawai_pihak_kedua); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_barang')); ?>:</b>
	<?php echo CHtml::encode($data->id_barang); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('jumlah')); ?>:</b>
	<?php echo CHtml::encode($data->jumlah); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status_bast')); ?>:</b>
	<?php echo CHtml::encode($data->status_bast); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_jenis_bast')); ?>:</b>
	<?php echo CHtml::encode($data->id_jenis_bast); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('deleted_at')); ?>:</b>
	<?php echo CHtml::encode($data->deleted_at); ?>
	<br />

	*/ ?>

</div>