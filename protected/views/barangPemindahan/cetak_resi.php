<table>
	<tr>
		<th style="text-align: left">Pemindahan Barang</th>
	</tr>
	<tr style="text-align: left">
		<th style="text-align: left">Nomor : <?= $model->nomor; ?></th>
	</tr>
</table>

<hr>

<div>&nbsp;</div>

<h2>Detail Pemindahan</h2>

<table width="100%">
	<tr>
		<th width="20%" style="text-align: left">Tanggal Pemindahan</th>
		<th width="5%">:</th>
		<td><?= Helper::tanggal($model->tanggal); ?></td>
		<td width="200px" rowspan="6" style="text-align: center">
			<?php $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
					'data' => $model->id.'-'.$model->nomor.'-'.$model->tanggal,
					'subfolderVar' => false,
					'matrixPointSize' => 4,
					'displayImage'=>true, // default to true, if set to false display a URL path
					'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
			)) ?>&nbsp;

		</td>
	</tr>
	<tr>
		<th style="text-align: left">Lokasi Asal</th>
		<th>:</th>
		<td><?= $model->getLokasiAsal(); ?></td>
	</tr>	
	<tr>
		<th style="text-align: left">Lokasi Tujuan</th>
		<th>:</th>
		<td><?= $model->getLokasiTujuan(); ?></td>
	</tr>	
	<tr>
		<th style="text-align: left">Status Pemindahan</th>
		<th>:</th>
		<td><?= $model->getPemindahanStatus(); ?></td>
	</tr>	
	<tr>
		<th style="text-align: left">Waktu Dibuat</th>
		<th>:</th>
		<td><?= Helper::getCreatedTime($model->waktu_dibuat); ?></td>
	</tr>	
	
</table>

<hr>

<h2>Daftar Barang</h2>

<table cellpadding="2" cellspacing="0" width="100%" border="1">
	<tr>
		<th width="4%" style="text-align: center">No</th>		
		<th>Kode</th>
		<th>NUP</th>
		<th>Nama Barang</th>
	</tr>
	
	<?php  $i=1; 
	foreach(BarangPemindahanDetail::model()->findAllByAttributes(array('id_barang_pemindahan'=>$model->id)) as $barang) {
		foreach(Barang::model()->findAllByAttributes(array('id'=>$barang->id_barang)) as $barang_atribut)
		{ ?>
			<tr>
			 	<td style="text-align: center"><?=$i ?></td>			 	
			 	<td style="text-align: center"><?= $barang_atribut->kode; ?></td>
			 	<td style="text-align: center"><?= $barang_atribut->nup; ?></td>
			 	<td><?= $barang->getNamaBarang(); ?></td>
			
			</tr>
	<?php $i++; } } ?>	
</table>

<div>&nbsp;</div>
<div>&nbsp;</div>

<?php $penandatangan = PenandatanganResi::model()->findByAttributes(array('id'=>1)); ?>

<table width="100%" style="" class="surat">
	<tr>
		<td style="width:50%" style="text-align:center;font-weight:bold">Penanggung Jawab Ruangan</td>
		<td style="width:50%" style="text-align:center;font-weight:bold">Petugas BMN</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
 	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>	
	<tr>
		<td style="width:50%"></td>
		<td style="width:50%" style="text-align:center;font-weight:bold"></td>
	</tr>
	<tr>
		<td style="width:50%" style="text-align:center;font-weight:bold"><?= $penandatangan->penanggung_jawab_ruangan; ?> <br>NIP. </td>
		<td style="width:50%" style="text-align:center;font-weight:bold"><?= $penandatangan->petugas_bmn; ?> <br>NIP. </td>
	</tr>
</table>

<div>&nbsp;</div>

<table width="100%">
	<tr>
		<td style="text-align:center;font-weight:bold">Menyetujui / Mengetahui <br> Kasubag umum & SDM </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<?php if($penandatangan->kasubag_umum_sdm !==null){ ?>
			<td style="text-align:center;font-weight:bold"><?= $penandatangan->kasubag_umum_sdm; ?></td>
		<?php } else { ?>
			<td style="text-align:center;font-weight:bold">M. Fahrurozi R.N. S.Psi. </td>
		<?php } ?>
	</tr>				
</table>