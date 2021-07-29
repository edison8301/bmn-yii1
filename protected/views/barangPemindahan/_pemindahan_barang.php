<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'surat-keluar-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>
<div class="row">
	<div class="col-md-10">
		<?php echo $form->select2Group($model,'barang',array(
				'wrapperHtmlOptions' => array('class' => 'col-sm-12	'),
				'widgetOptions' => array(
					'asDropDownList' => false,
					'options' => array(
						'tags' => Barang::model()->getListAutoBarangPemindahan($id_lokasi_asal),
						'placeholder' => 'Ketik Kode Barang',
						'separator' => ';',
					),
				),
		)); ?>

		<?php echo $form->hiddenField($model,'id_barang_pemindahan',array('value'=>$view->id)); ?>
	</div>
	<div class="col-md-2">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'danger',
				'icon'=>'ok',
				'label'=>'Save',
		)); ?>
	</div>
</div>


<?php $this->endWidget(); ?>