<?php
$this->breadcrumbs=array(
	'Users'=>array('admin'),
	$model->username,
);

$this->menu=array(
array('label'=>'List User','url'=>array('index')),
array('label'=>'Create User','url'=>array('create')),
array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
array('label'=>'Manage User','url'=>array('admin')),
);
?>

<h1>Detail Pegawai</h1>

<?php $this->widget('booster.widgets.TbDetailView',array(
        'data'=>$model,
        'type' => 'striped bordered condensed',
        'attributes'=>array(
            'username',
            'password',
            [
                'label' => 'Role',
                'value' => $model->getNamaRole(),
            ],
            [
                'label' => 'Pegawai',
                'value' => @$model->pegawai->nama,
            ]
        ),
)); ?>

<div>&nbsp;</div>

<div class="well">
    <?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Ubah',
        'icon'=>'pencil',
        'context'=>'danger',
        'url'=>array('update','id'=>$model->id)
    )); ?>&nbsp;
    <?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Indeks',
        'icon'=>'list',
        'context'=>'danger',
        'url'=>array('/user/admin')
    )); ?>&nbsp;
</div>