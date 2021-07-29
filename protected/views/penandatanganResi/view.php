<?php
$this->breadcrumbs=array(
	'Penandatangan Resis'=>array('index'),
	$model->id,
);

$this->menu=array(
array('label'=>'List PenandatanganResi','url'=>array('index')),
array('label'=>'Create PenandatanganResi','url'=>array('create')),
array('label'=>'Update PenandatanganResi','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete PenandatanganResi','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage PenandatanganResi','url'=>array('admin')),
);
?>

<h1>View PenandatanganResi #<?php echo $model->id; ?></h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'penanggung_jawab_ruangan',
		'petugas_bmn',
		'kasubag_umum_sdm',
),
)); ?>
