<?php
/* @var $this BarangKondisiController */
/* @var $model BarangKondisi */

$this->breadcrumbs=array(
	'Kondisi Barang'=>array('admin'),
	'Tambah data',
);

$this->menu=array(
	array('label'=>'List BarangKondisi', 'url'=>array('index')),
	array('label'=>'Manage BarangKondisi', 'url'=>array('admin')),
);
?>

<h1>Kondisi Barang</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>