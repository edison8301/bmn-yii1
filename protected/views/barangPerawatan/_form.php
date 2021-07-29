<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'perawatan-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>false,
)); ?>
	

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

 	<div class="well">

	<?php echo $form->errorSummary($model); ?>

		<?php if(isset($_GET['id']))
		{
			

		} else { ?>

			<?php echo $form->select2Group($model,'id_barang',array(
				'wrapperHtmlOptions'=>array('class'=>'col-sm-6'),
				'widgetOptions'=>array(
					'data' => $model->listData(),
					'options' =>array(
						'minimumInputLength' =>2),
					
					'htmlOptions'=>array('class'=>'span5')))); ?>		
			<?php } ?>		

		<?php echo $form->datePickerGroup($model,'tanggal',array(
			'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
			'widgetOptions'=>array(
				'options'=>array(
					'format' => 'yyyy-mm-dd',
					'autoclose' => true),
				'htmlOptions'=>array('class'=>'span5')),
			 'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>',
			 'append'=>'Pilih Tanggal')); ?>

		<?php echo $form->textAreaGroup($model,'keterangan', array(
			'wrapperHtmlOptions'=>array('class'=>'col-sm-6'),
			'widgetOptions'=>array(
				'htmlOptions'=>array('rows'=>6, 'cols'=>50, 'class'=>'span8')))); ?>

	</div>


	<div class="well" style="text-align: right">
		<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'danger',
		
				'icon' =>'ok',
				'label'=>'Simpan'
			)); ?>
	</div>

	<?php $this->endWidget(); ?>
