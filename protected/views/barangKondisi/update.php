<?php
/* @var $this BarangKondisiController */
/* @var $model BarangKondisi */

$this->breadcrumbs=array(
	'Kondisi Barang'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'List BarangKondisi', 'url'=>array('index')),
	array('label'=>'Create BarangKondisi', 'url'=>array('create')),
	array('label'=>'View BarangKondisi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BarangKondisi', 'url'=>array('admin')),
);
?>

<h1>Sunting Kondisi Barang <?php echo $model->nama; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>