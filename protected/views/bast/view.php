<?php
/* @var $this BastController */
/* @var $model Bast */

$this->breadcrumbs=array(
	'BAST'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Bast', 'url'=>array('index')),
	array('label'=>'Create Bast', 'url'=>array('create')),
	array('label'=>'Update Bast', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Bast', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Bast', 'url'=>array('admin')),
);
?>

<h1>Detail BAST</h1>

<?php $this->widget('booster.widgets.TbDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nomor',
		'tanggal',
		[
			'label' => 'Pihak Pertama',
            'value' => @$model->pihakPertama->nama,
		],
		[
			'label' => 'Jabatan Pihak Pertama',
            'value' => @$model->jabatan_pihak_pertama,
		],
		[
			'label' => 'Pihak Kedua',
            'value' => @$model->pihakKedua->nama,
		],
		[
			'label' => 'Jabatan Pihak Kedua',
            'value' => @$model->jabatan_pihak_kedua,
		],
		// [
		// 	'label' => 'Nama Barang',
		// 	'value' => function($data) {
		// 	    $barang = $data->getBarang();
		// 	    return @$barang->nama;
		// 	},
		// ],
		[
			'header' => 'Jenis BAST',
			'name' => 'id_jenis_bast',
            'value' => function($data) {
                return @$data->id_bast_jenis;
            },
            'headerHtmlOptions' => array('style'=>'text-align:center'),
            'htmlOptions' => array('style'=>'text-align:left'),
		],
		'nama_barang',
		'jumlah',
		'status_bast',
		'id_jenis_bast',
		'created_at',
		'updated_at',
		'deleted_at',
	),
)); ?>

<div>&nbsp;</div>

<div class="well">

    <?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Sunting',
        'icon'=>'pencil',
        'size'=>'small',
        'context'=>'danger',
        'url'=>array('/bast/update','id'=>$model->id)
    )); ?>&nbsp;
    <?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Tambah',
        'icon'=>'plus',
        'size'=>'small',
        'context'=>'danger',
        'url'=>array('/bast/create')
    )); ?>&nbsp;
    <?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Kelola',
        'icon'=>'list',
        'size'=>'small',
        'context'=>'danger',
        'url'=>array('/bast/admin')
    )); ?>&nbsp;

</div>
