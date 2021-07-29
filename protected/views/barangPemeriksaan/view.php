<?php
$this->breadcrumbs=array(
	'Pemeriksaan'=>array('admin'),
	$model->getBarang(),
);

$this->menu=array(
array('label'=>'List Pemeriksaan','url'=>array('index')),
array('label'=>'Create Pemeriksaan','url'=>array('create')),
array('label'=>'Update Pemeriksaan','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Pemeriksaan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Pemeriksaan','url'=>array('admin')),
);
?>

<h1>Pemeriksaan <b><?php echo $model->getBarang(); ?></b></h1>

<div>&nbsp;</div>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'type' => 'striped bordered condensed',
'attributes'=>array(
		array(
			'name'=>'id_barang',
			'value' => $model->getBarang()),
		'tanggal',
		array(
			'name' => 'id_barang_kondisi',
			'value' => $model->getBarangKondisi()),
		'keterangan',
		'waktu_dibuat',
),
)); ?>
