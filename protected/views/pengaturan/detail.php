<?php
$this->breadcrumbs=array(
	'Konfigurasi'

);
?>

<h1>Konfigurasi</h1>

<div>&nbsp;</div>

<table class="table table-hover table-condensed table-bordered table-striped">
	<?php $i=1; foreach(Pengaturan::model()->findAll() as $data) { ?>		
	<tr>
		<th style="text-align: left;width:250px"><?= $data->nama; ?></th>
		<td><?php $this->widget('booster.widgets.TbEditableField',array(
        		'type' => 'text',
        		'model' => $data,
        		'attribute' => 'nilai',
        		'url' => Yii::app()->controller->createUrl('pengaturan/editableUpdate'),
    	)); ?></td>
	</tr>
	<?php $i++; } ?>
</table>

<div>&nbsp;</div>

