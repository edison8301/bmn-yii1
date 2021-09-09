<?php
/* @var $this BastController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Basts',
);

$this->menu=array(
	array('label'=>'Create Bast', 'url'=>array('create')),
	array('label'=>'Manage Bast', 'url'=>array('admin')),
);
?>

<h1>Basts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

