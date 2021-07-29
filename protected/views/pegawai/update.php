<?php
/* @var $this PegawaiController */
/* @var $model Pegawai */

$this->breadcrumbs=array(
	'Pegawai'=>array('admin'),
	'Sunting',
);
?>

<h1>Sunting Pegawai</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>