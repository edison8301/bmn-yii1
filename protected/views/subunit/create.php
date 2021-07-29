<?php
$this->breadcrumbs=array(
	'Subunits'=>array('index'),
	'Create',
);

$this->menu=array(
array('label'=>'List Subunit','url'=>array('index')),
array('label'=>'Manage Subunit','url'=>array('admin')),
);
?>

<h1>Create Subunit</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>