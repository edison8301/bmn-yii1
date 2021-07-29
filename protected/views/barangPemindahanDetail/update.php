<?php
$this->breadcrumbs=array(
	'Barang Pemindahan Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

	$this->menu=array(
	array('label'=>'List BarangPemindahanDetail','url'=>array('index')),
	array('label'=>'Create BarangPemindahanDetail','url'=>array('create')),
	array('label'=>'View BarangPemindahanDetail','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage BarangPemindahanDetail','url'=>array('admin')),
	);
	?>

	<h1>Update BarangPemindahanDetail <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>