<?php
/* @var $this BarangKategoriController */
/* @var $model BarangKategori */

$this->breadcrumbs=array(
	'Barang Kategoris'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BarangKategori', 'url'=>array('index')),
	array('label'=>'Create BarangKategori', 'url'=>array('create')),
	array('label'=>'View BarangKategori', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage BarangKategori', 'url'=>array('admin')),
);
?>

<h1>Ubah Kategori Barang</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>