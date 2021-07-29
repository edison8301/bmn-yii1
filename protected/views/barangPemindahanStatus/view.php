<?php
$this->breadcrumbs=array(
	'Barang Pemindahan Statuses'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List BarangPemindahanStatus','url'=>array('index')),
array('label'=>'Create BarangPemindahanStatus','url'=>array('create')),
array('label'=>'Update BarangPemindahanStatus','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete BarangPemindahanStatus','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage BarangPemindahanStatus','url'=>array('admin')),
);
?>

<h1>View BarangPemindahanStatus #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'nama',
),
)); ?>
