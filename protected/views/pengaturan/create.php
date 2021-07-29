<?php
$this->breadcrumbs=array(
	'Pengaturans'=>array('index'),
	'Tambah',
);


?>

<h1>Tambah Pengaturan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>