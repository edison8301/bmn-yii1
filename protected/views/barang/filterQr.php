<?php

$this->breadcrumbs=array(
	'Barang'=>array('admin'),
	'Filter QR Code',
);

?>


<h1>Filter Barang</h1>

<div>&nbsp;</div>

<p>Filter Barang berdasarkan kode dan nomor NUP</p>

<?php print CHtml::beginForm(array('barang/cetakQrcodePdf'),'',array('target' => '_blank')); ?>

<div class="well">
<div class="form-group">
<?php 	$criteria = new CDbCriteria();
		$criteria->order = 'kode ASC';
		$criteria->group = 'kode'; 
?>
<div class="col-md-12">
	<?php if(isset($_GET['id'])){
		Print CHtml:: dropDownList('kode','',CHtml::listData(Barang::model()->findAllByAttributes(array('id'=>$_GET['id'])),'kode','kode'),array('class'=>'form-control', 'placeholder' => 'Kode')); 
	}
	else
	{
		Print CHtml:: dropDownList('kode','',CHtml::listData(Barang::model()->findAll($criteria),'kode','kode'),array('class'=>'form-control', 'placeholder' => 'Kode', 'empty' => '-- Kode Barang --')); 
	}
	?>

</div>
<div> &nbsp;</div>
<div class="col-md-6">
	<?php Print CHtml:: textField('nup_awal','',array('class'=>'form-control', 'placeholder' => 'NUP Awal',)); ?>
</div>
<div class="col-md-6">
	<?php Print CHtml:: textField('nup_akhir','',array('class'=>'form-control', 'placeholder' => 'NUP Akhir',)); ?>
</div>
<div> &nbsp;</div>

</div>
</div>

	<div class="form-actions well">
		<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'danger',
			'icon'=>'ok',
			'label'=>'Cetak QR Code',
		)); ?>
	</div>
<?php print CHtml::endForm(); ?>


