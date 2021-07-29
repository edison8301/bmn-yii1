<?php
$this->breadcrumbs=array(
	'Perawatan'=>array('admin'),
	$model->getBarang(),
);

$this->menu=array(
array('label'=>'List Perawatan','url'=>array('index')),
array('label'=>'Create Perawatan','url'=>array('create')),
array('label'=>'Update Perawatan','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Perawatan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Perawatan','url'=>array('admin')),
);
?>

<h1>Perawatan <b><?php echo $model->getBarang(); ?></b></h1>

<div>&nbsp;</div>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'type' => 'striped bordered condensed',
'attributes'=>array(
		array(
			'name' => 'id_barang',
			'label' => 'Barang',
			'value' => $model->getBarang()),
		'tanggal',
		'keterangan',
		'waktu_dibuat',
),
)); ?>
