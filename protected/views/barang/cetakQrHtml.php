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
		padding: 6px;
		border: 2px solid black;
		width: 100%
	}

	.kode{
		width: 100%;
		height: 39px;
		font-size: 13px;
		text-align: center;
		border-top: 0px;
		padding: 6px;
		border: 2px solid black;
	}

	.qrcode{
		padding: 5px;
		border: 2px solid black;
		width: 30%;

		margin-top: 5px;

	}
	.kolom{
		

	}

</style>
<?php $i=1; foreach($models as $model) { ?>

<?php /*if($i > 10)
{
	break;
	
} */?>

<div style="float:left;width:300px;margin-right:10px;display:inline;">

		<div class="qrcode">

			<?php $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
					'data' => $model->id.'-'.$model->kode.'-'.$model->nup,
					/*'data' => $model->id.'-'.$model->kode.'-'.$model->nup.' - '.$model->getLokasi(),*/
					'subfolderVar' => false,
					'matrixPointSize' => 4,
					'displayImage'=>true, // default to true, if set to false display a URL path
					'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
			)) ?>&nbsp;
		</div>
		<div class="kolom">
			<div class="kode" >
				<?= $model->kode; ?>-<?=$model->nup; ?>
			</div>

			<div class="nama" >
				<?= $model->nama; ?>
			</div>
		</div>

</div>



<?php $i++; } ?>