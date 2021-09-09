<?php
/* @var $this BastController */
/* @var $model Bast */

$this->breadcrumbs=array(
	'Basts'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bast', 'url'=>array('index')),
	array('label'=>'Create Bast', 'url'=>array('create')),
	array('label'=>'Update Bast', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bast', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bast', 'url'=>array('admin')),
);
?>

<h1>View Bast #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nomor',
		'tanggal',
		'id_pegawai_pihak_pertama',
		'id_pegawai_pihak_kedua',
		'id_barang',
		'jumlah',
		'status_bast',
		'id_jenis_bast',
		'created_at',
		'updated_at',
		'deleted_at',
	),
)); ?>
