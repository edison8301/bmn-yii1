<?php 
use chillerlan\QRCode\QRCode;
?>
<style type="text/css">

	td{
		padding: 5px;
		font-size: 12px;
	}
	div {

		float:left !important;
	}

	.nama{
		float: left;	
		border-bottom: 2px;
		height: 39px;
		font-size: 13px;
		text-align: center;
		padding: 4px;
		border: 2px solid black;
		width: 100%
	}

	.kode{
		width: 100%;
		height: 39px;
		font-size: 13px;
		text-align: center;
		border-top: 0px;
		padding: 4px;
		border: 2px solid black;
	}

	.qrcode{
		padding: 0px;
		border: 2px solid black;
		width: 30%;
		margin-top: 5px;
	}
</style>

<?php foreach($models as $model) { ?>
<div style="float:left;width:300px;margin-right:10px;display:inline;">
	<div class="qrcode">
		<img src="<?= $qrcode->render('Gedung A Lantai 1') ?>" alt="QR Code" width="200px">
	</div>
	<div class="kolom">
		<div class="kode" >
			<?= $model->id_lokasi; ?>
		</div>
		<div class="nama" >
			Gedung A Lantai 1
		</div>
	</div>
</div>
<?php } ?>
