<?php
/* @var $this KategoriController */
/* @var $model Kategori */

$this->breadcrumbs=array(
	'Barang Kategoris'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List BarangKategori', 'url'=>array('index')),
	array('label'=>'Create BarangKategori', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#barang-kategori-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Kategori Barang</h1>


<div style="margin-bottom: 20px">
    <?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'link',
        'label'=>'Tambah',
        'icon'=>'plus',
        'size'=>'small',
        'context'=>'success',
        'url'=>array('/barangKategori/create')
    )); ?>&nbsp;
</div>


<?php $this->widget('booster.widgets.TbGridView', array(
    'id'=>'barang-kategori-grid',
    'pager' => array(
        'class' => 'CLinkPager',
        'header' => '',
        'htmlOptions'=>[
            'class'=>'pagination',
        ]
    ),
    'dataProvider'=>$model->search($paging),
    'type'=>'striped bordered condensed',
    'filter'=>$model,
    'enablePagination' => true,
    'columns'=>array(
        'nama',
        'kode',
        array(
            'class' => 'booster.widgets.TbButtonColumn',
        ),
    ),
)); ?>
