<?php
$this->breadcrumbs=array(
	'Pengaturans'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Tambah Pengaturan','url'=>array('create'),'icon'=>'plus'),
	array('label'=>'Sunting Pengaturan','url'=>array('update','id'=>$model->id),'icon'=>'pencil'),
	array('label'=>'Hapus Pengaturan','icon'=>'trash','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Kelola Pengaturan','url'=>array('admin'),'icon'=>'th-list'),
);
?>

<h1>Lihat Pengaturan</h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
		'data'=>$model,
		'type'=>'striped bordered',
		'attributes'=>array(
		'id',
		'nama',
		'nilai',
),
)); ?>
