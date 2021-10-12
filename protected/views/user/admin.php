<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'User'=>array('admin'),
	'Kelola',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

?>
<h1>Indeks User</h1>

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'type'=>'striped bordered condensed',
	'columns'=>array(
		'username',
		[
            'name' => 'role_id',
            'value' => function(User $data) {
		        return $data->getNamaRole();
            },
            'filter' => [
                '1' => 'Admin',
                '2' => 'Pegawai',
            ]
        ],
        [
            'header' => 'Keterangan',
            'value' => function(User $data) {
                return $data->getKeterangan();
            },
            'filter' => [
                '1' => 'Admin',
                '2' => 'Pegawai',
            ]
        ],
		array(
			'class'=>'booster.widgets.TbButtonColumn',
		),
	),
)); ?>

<div>&nbsp;</div>

<div class="well" style="text-align:right">
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'User Admin',
		'icon'=>'plus',
		'size'=>'small',
		'context'=>'danger',
		'url'=>array('user/create','role_id' => 1)
)); ?>&nbsp;
<?php $this->widget('booster.widgets.TbButton',array(
    'buttonType'=>'link',
    'label'=>'User Pegawai',
    'icon'=>'plus',
    'size'=>'small',
    'context'=>'danger',
    'url'=>array('user/create','role_id' => 2)
)); ?>&nbsp;
</div>
