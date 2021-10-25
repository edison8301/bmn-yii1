<?php
$this->breadcrumbs=array(
	'Kondisi Barang'=>array('admin'),
	'Kelola',
);
?>

<h1>Kelola Kondisi Barang</h1>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView', array(
	'id'=>'barang-kondisi-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nama',
		array(
			'class'=>'booster.widgets.TbButtonColumn',
			'htmlOptions' => array(
				'style' => 'width: 80px;')
		),
	),
)); ?>

<div>&nbsp;</div>