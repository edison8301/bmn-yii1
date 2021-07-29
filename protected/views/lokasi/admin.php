<?php
/* @var $this LokasiController */
/* @var $model Lokasi */

$this->breadcrumbs=array(
	'Lokasi'=>array('admin'),
	'Kelola',
);

?>

<h1>Kelola Lokasi</h1>


<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'lokasi-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'kode',
		'nama',
		 array(
			 	'name' => 'id_gedung',
			 	'value' => '$data->getGedung()',
			 	'headerHtmlOptions' => array('width' =>'30%'),
			 	'filter' => CHtml::listData(Gedung::model()->findAll(array('order' => 'nama ASC')),'id', 'nama'),
			 	'htmlOptions'=>array('style'=>'text-align:left')
			 	),
		 array(
			 	'name' => 'id_pegawai',
			 	'value' => '$data->getPegawai()',
			 	'headerHtmlOptions' => array('width' =>'30%'),
			 	'filter' => CHtml::listData(Pegawai::model()->findAll(array('order' => 'nama ASC')),'id', 'nama'),
			 	'htmlOptions'=>array('style'=>'text-align:left')
			 	),
		 array(
			 	'name' => 'id',
			 	'header'=>'DBR',
			 	'type'=>'raw',
			 	'value' => 'CHtml::link("<i class=\"glyphicon glyphicon-download-alt\"></i>",array("lokasi/dbr","id"=>$data->id))',
			 	'headerHtmlOptions' => array('width' =>'5%'),
			 	'filter' => '',
			 	'htmlOptions'=>array('style'=>'text-align:center'),
			 	'headerHtmlOptions'=>array('style'=>'text-align:center')
			 	),
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array(
				'style' => 'width: 80px;text-align:center')
			),
		 array(
			 	'name' => 'id',
			 	'header'=>'Jumlah Barang',
			 	'type'=>'raw',
			 	'value' => '$data->getCountLokasi()',
			 	'headerHtmlOptions' => array('width' =>'5%'),
			 	'filter' => '',
			 	'htmlOptions'=>array('style'=>'text-align:center'),
			 	'headerHtmlOptions'=>array('style'=>'text-align:center')
		),
	),
)); ?>


<div>&nbsp;</div>

<div class="well" style="text-align:right">
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Cetak QR per DBR',
		'icon'=>'qrcode',
		'size'=>'small',
		'context'=>'success',
		'url'=>array('barang/cetakQrcodeDbr')
)); ?> &nbsp;
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Tambah',
		'icon'=>'plus',
		'size'=>'small',
		'context'=>'danger',
		'url'=>array('lokasi/create')
)); ?>
</div>