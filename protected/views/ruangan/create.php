<?php
/* @var $this LokasiController */
/* @var $model Lokasi */

$this->breadcrumbs=array(
	'Ruangan' => array('admin'),
	'Tambah',
);
$this->menu=array(
	array('label'=>'List Lokasi', 'url'=>array('index')),
	array('label'=>'Manage Lokasi', 'url'=>array('admin')),
);
?>

<h1>Tambah Ruangan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>