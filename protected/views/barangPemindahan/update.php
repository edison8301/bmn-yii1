<?php
$this->breadcrumbs=array(
	'Pemindahan Barang'=>array('admin'),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BarangPemindahan','url'=>array('index')),
	array('label'=>'Create BarangPemindahan','url'=>array('create')),
	array('label'=>'View BarangPemindahan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BarangPemindahan','url'=>array('admin')),
	);
	?>

	<h1>Update BarangPemindahan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>