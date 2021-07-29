<?php
/* @var $this BarangController */
/* @var $data Barang */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kode')); ?>:</b>
	<?php echo CHtml::encode($data->kode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nama')); ?>:</b>
	<?php echo CHtml::encode($data->nama); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tahun_perolehan')); ?>:</b>
	<?php echo CHtml::encode($data->tahun_perolehan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('asal_perolehan')); ?>:</b>
	<?php echo CHtml::encode($data->asal_perolehan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('masa_manfaat')); ?>:</b>
	<?php echo CHtml::encode($data->masa_manfaat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_barang_kondisi')); ?>:</b>
	<?php echo CHtml::encode($data->id_barang_kondisi); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('sk_psp')); ?>:</b>
	<?php echo CHtml::encode($data->sk_psp); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sk_penghapusan')); ?>:</b>
	<?php echo CHtml::encode($data->sk_penghapusan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lokasi')); ?>:</b>
	<?php echo CHtml::encode($data->id_lokasi); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_pegawai')); ?>:</b>
	<?php echo CHtml::encode($data->id_pegawai); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gambar')); ?>:</b>
	<?php echo CHtml::encode($data->gambar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('waktu_diubah')); ?>:</b>
	<?php echo CHtml::encode($data->waktu_diubah); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('waktu_dibuat')); ?>:</b>
	<?php echo CHtml::encode($data->waktu_dibuat); ?>
	<br />

	*/ ?>

</div>