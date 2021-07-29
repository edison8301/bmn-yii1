<?php
$this->breadcrumbs=array(
	'Penandatangan Resis',
);

$this->menu=array(
array('label'=>'Create PenandatanganResi','url'=>array('create')),
array('label'=>'Manage PenandatanganResi','url'=>array('admin')),
);
?>

<h1>Penandatangan Resis</h1>

<?php $this->widget('booster.widgets.TbListView',array(
'dataProvider'=>$dataProvider,
'itemView'=>'_view',
)); ?>
