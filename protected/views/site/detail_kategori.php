<?php if($_GET['id'] == 301) $kelompok = "Alat Berat"; ?>
<?php if($_GET['id'] == 302) $kelompok = "Alat Angkutan"; ?>
<?php if($_GET['id'] == 303) $kelompok = "Alat Bengkel & Alat Ukur"; ?>
<?php if($_GET['id'] == 305) $kelompok = "Alat Kantor & Rumah Tangga"; ?>
<?php if($_GET['id'] == 306) $kelompok = "Alat Studio, Komunikasi & Pemancar"; ?>
<?php if($_GET['id'] == 307) $kelompok = "Alat Kedokteran & Kesehatan"; ?>
<?php if($_GET['id'] == 310) $kelompok = "Komputer"; ?>
<?php if($_GET['id'] == 315) $kelompok = "Alat Keselamatan Kerja"; ?>
<?php if($_GET['id'] == 317) $kelompok = "Alat Produksi"; ?>
<?php if($_GET['id'] == 319) $kelompok = "Peralatan Olahraga"; ?>
<?php if($_GET['id'] == 401) $kelompok = "Bangunan Gedung"; ?>
<?php if($_GET['id'] == 404) $kelompok = "Tugu Titik Kontrol"; ?>
<?php if($_GET['id'] == 502) $kelompok = "Bangunan Air"; ?>
<?php if($_GET['id'] == 503) $kelompok = "Alat Instalasi"; ?>
<?php if($_GET['id'] == 601) $kelompok = "Bahan Perpustakaan"; ?>

<h1>Kelompok <?= $kelompok ?></h1>

<?php
  $this->widget('booster.widgets.TbGridView',array(
	'id'=>'pegawai-grid',
	'type'=>'striped bordered hover condensed',
	'dataProvider'=>Barang::model()->detailJenis($id),
	'filter'=>Barang::model(),
	'columns'=>array(
		array(
			'header'=>'No',
			'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
			'htmlOptions'=>array(
				'style'=>'text-align:left',
			),
		),
		array(
	      	'name'=>'nama',
	      	'value'=>'$data->nama',
		),
		array(
			'name'=>'nup',
			'header'=>'NUP',
			'value'=>'$data->nup',
		),	
		array(
			'name'=>'kode',
			'header'=>'Kode',
			'value'=>'$data->kode',
		),
        array(
            'name'=>'tahun_perolehan',
            'value'=>'$data->getTahunPerolehan()'
        ),
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array(
				'style' => 'width: 60px;text-align:center')
		),				
	),
)); ?>