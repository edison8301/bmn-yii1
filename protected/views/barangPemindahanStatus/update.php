<?php
$this->breadcrumbs=array(
	'Barang Pemindahan Statuses'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BarangPemindahanStatus','url'=>array('index')),
	array('label'=>'Create BarangPemindahanStatus','url'=>array('create')),
	array('label'=>'View BarangPemindahanStatus','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BarangPemindahanStatus','url'=>array('admin')),
	);
	?>

	<h1>Update BarangPemindahanStatus <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>