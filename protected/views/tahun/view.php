<?php
$this->breadcrumbs=array(
	'Tahun'=>array('admin'),
	$model->tahun,
);

$this->menu=array(
array('label'=>'List Tahun','url'=>array('index')),
array('label'=>'Create Tahun','url'=>array('create')),
array('label'=>'Update Tahun','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Tahun','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Tahun','url'=>array('admin')),
);
?>

<h1>View Tahun #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'type' => 'striped bordered condensed',
'attributes'=>array(
		'tahun',
),
)); ?>

<div>&nbsp;</div>

<div class="well">

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Update',
		'icon'=>'pencil',
		'context'=>'danger',
		'url'=>array('/barangKondisi/update','id'=>$model->id)
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah',
		'icon'=>'plus',
		'context'=>'danger',
		'url'=>array('/lokasi/create')
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Kelola',
		'icon'=>'list',
		'context'=>'danger',
		'url'=>array('/barangKondisi/admin')
)); ?>&nbsp;

</div>