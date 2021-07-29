<h2>Pemeriksaan</h2>

<table class="table table-striped table-condensed">
<thead>
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Kondisi Barang</th>
		<th>Keterangan</th>
		<th>Waktu Dibuat</th>
		<th></th>
	</tr>
</thead>
	<?php  $i=1; foreach(BarangPemeriksaan::model()->findAllByAttributes(array('id_barang'=>$model->id)) as $data) { ?>
	 <tr>
	 	<td><?=$i ?></td>
	 	<td><?= Helper::getTanggalSingkat($data->tanggal); ?></td>
	 	<td><?= $data->getBarangKondisi() ?></td>
	 	<td><?= $data->keterangan; ?></td>
	 	<td><?= $data->waktu_dibuat; ?></td>
	 	<td><?php $this->renderPartial('_button_pemeriksaan',array('model'=>$model,'perawatan'=>$data)); ?></td>
	 </tr>
	<?php $i++; } ?>
 </table>
