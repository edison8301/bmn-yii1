<?php
$this->breadcrumbs=array(
	'Barang Pemindahan Details'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List BarangPemindahanDetail','url'=>array('index')),
array('label'=>'Create BarangPemindahanDetail','url'=>array('create')),
array('label'=>'Update BarangPemindahanDetail','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BarangPemindahanDetail','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BarangPemindahanDetail','url'=>array('admin')),
);
?>

<h1>View BarangPemindahanDetail #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_barang_pemindahan',
		'id_barang',
),
)); ?>
