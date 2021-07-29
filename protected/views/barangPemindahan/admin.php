<?php
$this->breadcrumbs=array(
	'Pemindahan Barang'=>array('admin'),
	'Kelola',
);
?>

<h1>Daftar Pemindahan Barang</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
'id'=>'barang-pemindahan-grid',
'type' => 'striped bordered condensed',
'dataProvider'=>$model->search(),
'filter'=>$model,
'columns'=>array(
		'nomor',
		array(
			'name' => 'tanggal',
			'value' => 'Helper::tanggal($data->tanggal)'),
		array(
			'name'=>'id_lokasi_asal',
			'value' => '$data->getLokasiAsal()'),
		array(
			'name'=>'id_lokasi_tujuan',
			'value' => '$data->getLokasiTujuan()'),
		array(
			'name'=>'id_barang_pemindahan_status',
			'value' => '$data->getPemindahanStatus()'),
		/*
		'waktu_disetujui',
		'waktu_dibuat',
		*/
array(
'class'=>'booster.widgets.TbButtonColumn',
),
),
)); ?>

<div>&nbsp;</div>

<div class="well" style="text-align:right">
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Ajukan Pemindahan Barang',
		'icon'=>'plus',
		'size'=>'small',
		'context'=>'danger',
		'url'=>array('create')
)); ?>&nbsp;

</div>

