<?php
$this->breadcrumbs=array(
	'Gedung'=>array('admin'),
	$model->nama,
);

$this->menu=array(
array('label'=>'List Gedung','url'=>array('index')),
array('label'=>'Create Gedung','url'=>array('create')),
array('label'=>'Update Gedung','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete Gedung','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage Gedung','url'=>array('admin')),
);
?>

<h1><b><?php echo $model->nama; ?></b></h1>

<div>&nbsp;</div>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'type' => 'striped bordered condensed',
'attributes'=>array(
		'nama',
),
)); ?>

<div>&nbsp;</div>

<div class="well">
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Sunting',
		'icon'=>'pencil',
		'context'=>'danger',
		'url'=>array('update','id'=>$model->id)
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah',
		'icon'=>'plus',
		'context'=>'danger',
		'url'=>array('create')
)); ?>&nbsp;

<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'kelola',
		'icon'=>'list',
		'context'=>'danger',
		'url'=>array('admin')
)); ?>&nbsp;	

</div>
