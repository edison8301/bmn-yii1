<?php
$this->breadcrumbs=array(
	'Subunits'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List Subunit','url'=>array('index')),
array('label'=>'Create Subunit','url'=>array('create')),
array('label'=>'Update Subunit','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Subunit','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Subunit','url'=>array('admin')),
);
?>

<h1>View Subunit #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'id_unit',
		'nama',
),
)); ?>

<div class="well" style="text-align: right">
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Kembali',
		'icon'=>'back',
		'context'=>'danger',
		'url'=>array('subunit/admin')
)); ?>&nbsp;
