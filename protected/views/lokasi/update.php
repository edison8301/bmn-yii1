<?php
/* @var $this LokasiController */
/* @var $model Lokasi */

$this->breadcrumbs=array(
	'Ruangan' => array('index'),
    $model->nama => array('view','id'=>$model->id),
	'Ubah',
);

$this->menu=array(
	array('label'=>'List Lokasi', 'url'=>array('index')),
	array('label'=>'Create Lokasi', 'url'=>array('create')),
	array('label'=>'View Lokasi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Lokasi', 'url'=>array('admin')),
);
?>

<h1>Ubah Ruangan</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>