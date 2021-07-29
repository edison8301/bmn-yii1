<h2>Perawatan</h2>

<table class="table table-striped table-condensed">
<thead>
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Keterangan</th>
		<th>Waktu Dibuat</th>
		<th>&nbsp;</th>
	</tr>
</thead>
	<?php  $i=1; foreach(BarangPerawatan::model()->findAllByAttributes(array('id_barang'=>$model->id)) as $data) { ?>
	 <tr>
	 	<td><?=$i ?></td>
	 	<td><?= Helper::getTanggalSingkat($data->tanggal); ?></td>
	 	<td><?= $data->keterangan; ?></td>
	 	<td><?= $data->waktu_dibuat; ?></td>
	 	<td><?php $this->renderPartial('_button_perawatan',array('model'=>$model,'perawatan'=>$data)); ?></td>
	 </tr>
	<?php $i++; } ?>
 </table>
