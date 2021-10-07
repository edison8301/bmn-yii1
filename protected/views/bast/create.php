<?php
/* @var $this BastController */
/* @var $model Bast */

$this->breadcrumbs=array(
	'BAST'=>array('index'),
	'Tambah',
);

$this->menu=array(
	array('label'=>'List Bast', 'url'=>array('index')),
	array('label'=>'Manage Bast', 'url'=>array('admin')),
);
?>

<h1>Tambah BAST</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>