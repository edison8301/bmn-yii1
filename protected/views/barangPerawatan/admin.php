<?php
$this->breadcrumbs=array(
	'Perawatan'=>array('admin'),
	'Kelola',
);
?>

<h1>Kelola Perawatan</h1>

<?php $this->widget('booster.widgets.TbGridView',array(
		'id'=>'perawatan-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'type' => 'striped bordered condensed',
		'columns'=>array(
			array(
				'header'=>'Kode',
				'name' => 'id_barang',
				'value' => '$data->getRelation("barang","kode")',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
				'name' => 'id_barang',
				'value' => '$data->getRelation("barang","nama")',
				'headerHtmlOptions'=>array('style'=>'text-align:left'),
			),
			array(
				'header'=>'NUP',
				'name' => 'id_barang',
				'value' => '$data->getRelation("barang","nup")',
				'headerHtmlOptions'=>array('style'=>'width:8%;text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
				'name' => 'tanggal',
				'value' => 'Helper::getTanggalSingkat($data->tanggal)',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
				'name'=>'keterangan',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
				'class'=>'booster.widgets.TbButtonColumn',
			),
		),
)); ?>

<div>&nbsp;</div>

<div class="form-actions well" style="text-align:right">

	<?php $this->widget('booster.widgets.TbButton', array(
			'label'=>'Tambah',		
			'context'=>'danger',
			'icon' => 'plus',
			'size'=>'small',

			'htmlOptions'=>array(
				'onClick'=>'$("#dialog").dialog("open"); return false;',
				'value'=>'add',
				'style'=>'margin-bottom:3px',
			),
	)); ?>
</div>

<div>&nbsp;</div>


<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'dialog',
    'options'=>array(
        'title'=>'Daftar Barang',
        'autoOpen'=>false,
		'minWidth'=>700,
		'modal'=>true,
    ),
));
	
    $this->widget('booster.widgets.TbGridView',array(
		'id'=>'pegawai-grid',
		'type'=>'striped hover condensed',
		'dataProvider'=>Barang::model()->dialog(),
		'filter'=>Barang::model(),
		'columns'=>array(
			array(
				'header'=>'No',
				'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize+$row+1',
				'htmlOptions'=>array(
					'style'=>'text-align:left',
				),
			),
			array(
				'name'=>'kode',
				'header'=>'Kode',
				'value'=>'$data->kode',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),
			array(
		      	'name'=>'nama',
		      	'value'=>'$data->nama',
			),
			array(
				'name'=>'nup',
				'header'=>'NUP',
				'value'=>'$data->nup',
				'headerHtmlOptions'=>array('style'=>'text-align:center'),
				'htmlOptions'=>array('style'=>'text-align:center'),
			),					
			array(
				'header'=>'Pilih',
				'type'=>'raw',
				'value' => 'CHtml::link("(+)",array("barangPerawatan/create","id"=>$data->id))',
					'htmlOptions'=>array(
						'style'=>'text-align:center',
						'width'=>'30px',
						'class'=>'btn btn-xs'
					),
        	),
		),
	));
$this->endWidget('zii.widgets.jui.CJuiDialog'); //=== end CJuiDialog for mark insurer

?>