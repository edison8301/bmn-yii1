<?php
$this->breadcrumbs=array(
	'Pemeriksaan'=>array('admin'),
	'Tambah',
);
?>

<h1>Buat Data Pemeriksaan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>