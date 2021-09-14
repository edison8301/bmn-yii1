<?php
/* @var $this LokasiController */
/* @var $model Lokasi */

$this->breadcrumbs=array(
	'Lokasi'=>array('admin'),
	'Kelola',
);

?>

<h1>Kelola Ruangan</h1>


<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'lokasi-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'No',
            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
            'headerHtmlOptions' => array('style' =>'text-align:center'),
            'htmlOptions' => array('style'=>'text-align:center; width: 50px'),
        ),
        'nama',
		 [
            'name' => 'kode',
            'headerHtmlOptions' => array('style' =>'text-align:center'),
            'htmlOptions' => array('style'=>'text-align:center; width: 100px'),
        ],
        [
            'name' => 'id_lokasi',
            'value' => function($data) {
                return @$data->lokasi->nama;
            },
            'headerHtmlOptions' => array('width' =>'30%'),
            'htmlOptions'=>array('style'=>'text-align:left')
        ],
        [
            'name' => 'id_pegawai',
            'value' => function(Ruangan $data) {
                return @$data->pegawai->nama;
            },
            'headerHtmlOptions' => array('width' =>'200px','style'=>'text-align:center'),
            'htmlOptions'=>array('style'=>'text-align:left')
        ],
        array(
            'name' => 'id',
            'header'=>'Jumlah<br/>Barang',
            'type'=>'raw',
            'value' => function(Ruangan $data) {
                return $data->getCountBarang();
            },
            'headerHtmlOptions' => array('width' =>'5%'),
            'filter' => '',
            'htmlOptions'=>array('style'=>'text-align:center'),
            'headerHtmlOptions'=>array('style'=>'text-align:center')
        ),
		 array(
            'name' => 'id',
            'header'=>'DBR',
            'type'=>'raw',
            'value' => function(Ruangan $data) {
                return CHtml::link("<i class=\"glyphicon glyphicon-download-alt\"></i>",[
                    "/ruangan/exportExcelDbr",
                    "id"=>$data->id
                ]);
            },
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

	),
)); ?>


<div>&nbsp;</div>

<div class="well" style="text-align:right">
    <?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Tambah',
        'icon'=>'plus',
        'size'=>'small',
        'context'=>'danger',
        'url'=>array('/ruangan/create')
    )); ?>
    <?php $this->widget('booster.widgets.TbButton',array(
            'buttonType'=>'link',
            'label'=>'Cetak QR per DBR',
            'icon'=>'qrcode',
            'size'=>'small',
            'context'=>'success',
            'url'=>array('barang/cetakQrcodeDbr')
    )); ?> &nbsp;
</div>