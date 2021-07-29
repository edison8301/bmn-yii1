<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nomor')); ?>:</b>
	<?php echo CHtml::encode($data->nomor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tanggal')); ?>:</b>
	<?php echo CHtml::encode($data->tanggal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lokasi_asal')); ?>:</b>
	<?php echo CHtml::encode($data->id_lokasi_asal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lokasi_tujuan')); ?>:</b>
	<?php echo CHtml::encode($data->id_lokasi_tujuan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_barang_pemindahan_status')); ?>:</b>
	<?php echo CHtml::encode($data->id_barang_pemindahan_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('waktu_disetujui')); ?>:</b>
	<?php echo CHtml::encode($data->waktu_disetujui); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('waktu_dibuat')); ?>:</b>
	<?php echo CHtml::encode($data->waktu_dibuat); ?>
	<br />

	*/ ?>

</div>