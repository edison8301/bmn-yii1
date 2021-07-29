<?php
$this->breadcrumbs=array(
	'Gedungs',
);

$this->menu=array(
array('label'=>'Create Gedung','url'=>array('create')),
array('label'=>'Manage Gedung','url'=>array('admin')),
);
?>

<h1>Gedungs</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
