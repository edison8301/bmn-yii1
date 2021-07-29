<style type="text/css">

	td{
		padding: 5px;
		font-size: 12px;
	}
	div {
		display:inline !important;
		float:left !important;

	}

</style>
<?php $i=1; foreach($models as $model) { ?>

<div style="float:left;width:300px;margin-right:10px;display:inline;">
<table width="290px" border="1" cellspacing="0" cellpadding="0" style="font-weight:bold;float:left;margin-bottom:10px;display:inline">
	<tr>
		<td rowspan="2" width="100px" style="text-align:center;">
			<?php $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
					'data' => $model->id.'-'.$model->kode.'-'.$model->nup.'<br> Nup: '.$model->nup.'<br> Kode: '.$model->kode.'<br> Nama Barang: '.$model->nama,
					'subfolderVar' => false,
					'matrixPointSize' => 4,
					'displayImage'=>true, // default to true, if set to false display a URL path
					'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
			)) ?>&nbsp;
		</td>
		<td><?= $model->kode; ?>-<?=$model->nup; ?></td>
	</tr>
	<tr>
		<td><?= $model->nama; ?></td>
	</tr>
</table>
</div>

<?php } ?>