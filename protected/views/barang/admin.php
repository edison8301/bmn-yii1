	<?php
/* @var $this BarangController */
/* @var $model Barang */

$this->breadcrumbs=array(
	'Barang'=>array('admin'),
	'Kelola Barang',
);


?>

<h1>Kelola Barang</h1>

<div class="row">
	<div class="col-sm-12">
		<?php print CHtml::beginForm(array('admin'),'GET',['class'=>'form-inline']); ?>

    	<?php print CHtml::dropDownList('paging',$paging,[10=>10,20=>20,30=>30,50=>50,100=>100],['class'=>'form-control','style'=>'margin-bottom:3px','empty'=>'- Pilih Banyak Data -']); ?>

    	<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'submit',
		'label'=>'Tampilkan',
		'htmlOptions' => ['class' => 'btn-flat','style'=>'margin-bottom:3px'],
		'context'=>'primary',
		'icon'=>'search'
    	)); ?>

    <?php print CHtml::endForm(); ?>
	</div>
</div>


<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'barang-grid',
	'pager' => array(
		'class' => 'CLinkPager', 
		'header' => '',
		'htmlOptions'=>[
			'class'=>'pagination',
		]),
	'dataProvider'=>$model->search($paging),
	'type'=>'striped bordered condensed',
	'filter'=>$model,
    'enablePagination' => true,
    /*'rowCssClassExpression' => '"' . $this->getCssClass($model) . '"',*/
	'columns'=>array(
        array(
            'header' => 'No',
            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
            'htmlOptions' => array('style'=>'text-align:center; width: 50px'),
        ),
		array(
			'name'=>'nama',
			'headerHtmlOptions' => array('style'=>'text-align:center'),
			'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
		),
        array(
            'value' => '$data->kode',
            'name' => 'kode',
            'headerHtmlOptions' => array('width'=>'10%','style'=>'text-align:center'),
            'htmlOptions' => array('style'=>'text-align:center;'),
            'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
        ),
		array(
			 'name' => 'nup',
			 'headerHtmlOptions' => array('width' =>'5%','style'=>'text-align:center'),
			 'htmlOptions'=>array('style'=>'text-align:center'),
			 'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
		),
        array(
            'name' => 'merek',
            'headerHtmlOptions' => array('style'=>'text-align:center; width: 200px'),
            'htmlOptions' => ['style'=>'text-align:left'],
            'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
        ),
		array(
			'name' => 'tanggal_perolehan',
			'value' => function($data) {
			    return Helper::getTanggalSingkat($data->tanggal_perolehan);
			},
			'headerHtmlOptions' => array('width' =>'120px','style'=>'text-align:center'),
			'htmlOptions' => array('style'=>'text-align:center'),
			'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
		),
        [
            'header' => 'Nilai Perolehan',
            'name' => 'harga',
            'value' => function($data) {
                return number_format($data->nilai_perolehan,0,',','.');
            },
            'headerHtmlOptions' => ['width' =>'150px','style'=>'text-align:center'],
            'htmlOptions' => ['style'=>'text-align:right'],
            'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
        ],
		/*
		array(
		 	'header' => 'Lokasi',
		 	'name' => 'id_lokasi',
		 	'value' => '$data->getLokasi()',
		 	'headerHtmlOptions' => array('width' =>'15%','style'=>'text-align:center'),
		 	'htmlOptions'=>array('style'=>'text-align:center'),
		 	'filter' => CHtml::listData(Lokasi::model()->findAll(array('order'=>'nama ASC')),'id','nama'),
		 	'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
		),
		array(
		 	'header' => 'Kondisi',
		 	'name' => 'id_barang_kondisi',
		 	'value' => '$data->getBarangKondisi()',
		 	'headerHtmlOptions' => array('width' =>'10%','style'=>'text-align:center'),
		 	'htmlOptions'=>array('style'=>'text-align:center'),
		 	'filter' => CHtml::listData(BarangKondisi::model()->findAll(array('order'=>'nama ASC')),'id','nama'),
		 	'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
		),
		array(
			 'name' => 'perawatan_terakhir',
			 'value'=>'Helper::getTanggalSingkat($data->perawatan_terakhir)',
			 'headerHtmlOptions' => array('width' =>'10%','style'=>'text-align:center'),
			 'htmlOptions'=>array('style'=>'text-align:center'),
			 'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
		),
		array(
			 'name' => 'pemeriksaan_terakhir',
			 'value'=>'Helper::getTanggalSingkat($data->pemeriksaan_terakhir)',
			 'headerHtmlOptions' => array('width' =>'10%','style'=>'text-align:center'),
			 'htmlOptions'=>array('style'=>'text-align:center'),
			 'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
		),
		*/
		array(
			'type'=>'raw',
			'value'=>'CHtml::link("<i class=\"glyphicon glyphicon-qrcode\"></i>",array("barang/cetakQr","id"=>"$data->id"),array("target" => "_blank","data-toggle"=>"tooltip","title"=>"Cetak QR"))',
			'htmlOptions'=>array('style'=>'text-align:center; width: 50px'),
			'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
		),		
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'cssClassExpression' => '$data->getCssClass($data->id_barang_kondisi)',
			'htmlOptions' => array(
				'style' => 'width: 60px;text-align:center')
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
		'url'=>array('barang/create')
)); ?>&nbsp;
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Ekspor ke Excel',
		'icon'=>'download',
		'context'=>'success',
		'size'=>'small',
		'url'=>array('barang/exportExcel')
)); ?>&nbsp;
<?php $this->widget('booster.widgets.TbButton',array(
		'buttonType'=>'link',
		'label'=>'Laporan Perawatan',
		'icon'=>'file',
		'context'=>'success',
		'size'=>'small',
		'url'=>array('barang/reportPerawatan')
)); ?>&nbsp;


</div>
