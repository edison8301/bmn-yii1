<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('penanggung_jawab_ruangan')); ?>:</b>
	<?php echo CHtml::encode($data->penanggung_jawab_ruangan); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('petugas_bmn')); ?>:</b>
	<?php echo CHtml::encode($data->petugas_bmn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('kasubag_umum_sdm')); ?>:</b>
	<?php echo CHtml::encode($data->kasubag_umum_sdm); ?>
	<br />


</div>