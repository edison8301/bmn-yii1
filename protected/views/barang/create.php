<?php
/* @var $this BarangController */
/* @var $model Barang */

$this->breadcrumbs=array(
	'Barang'=>array('admin'),
	'Tambah data',
);

$this->menu=array(
	array('label'=>'List Barang', 'url'=>array('index')),
	array('label'=>'Manage Barang', 'url'=>array('admin')),
);
?>

<h1>Input Barang</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>