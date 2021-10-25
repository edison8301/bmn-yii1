<?php
$this->breadcrumbs=array(
	'Units'=>array('index'),
	'Manage',
);
?>

<h1>Kelola Unit</h1>


<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'unit-grid',
		'type'=>'striped bordered condensed',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'nama',
			array(
				'class'=>'booster.widgets.TbButtonColumn',
			),
		),
)); ?>

<div class="well" style="text-align: right">
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah',
		'icon'=>'plus',
		'context'=>'danger',
		'url'=>array('unit/create')
)); ?>&nbsp;
