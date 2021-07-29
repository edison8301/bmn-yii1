<?php
$this->breadcrumbs=array(
	'Pengaturans'=>array('admin'),
	'Kelola',
);



Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
$('.search-form').toggle();
return false;
});
$('.search-form form').submit(function(){
$.fn.yiiGridView.update('pengaturan-grid', {
data: $(this).serialize()
});
return false;
});
");
?>

<h1>Pengaturan</h1>

<div style="overflow:auto">
<?php $this->widget('bootstrap.widgets.TbGridView',array(
		'id'=>'pengaturan-grid',
		'type'=>'striped bordered',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
		'id',
		'nama',
		'nilai',
			array(
				'class'=>'bootstrap.widgets.TbButtonColumn',
				'template'=>'{update}{delete}'
			),
		),
)); ?>

</div>
