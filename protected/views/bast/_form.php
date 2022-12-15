<?php
/* @var $this BastController */
/* @var $model Bast */
/* @var $form CActiveForm */

?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'bast-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>

<div class="row">
	<div class="col-sm-9">
		<?php echo $form->errorSummary($model); ?>

		<div class="well">

			<?php echo $form->select2Group($model,'id_bast_jenis', array(
                'widgetOptions'=>array('data'=>array(
                		'1'=>'Penggunaan','2'=>'Pengembalian','3' => 'Hibah','4' =>'Transfer Asset'
                	),'htmlOptions'=>array('class'=>'span5','maxlength'=>255,'placeholder' => 'Pilih Jenis Bast'))
            )) ?>

			<?php echo $form->textFieldGroup($model,'nomor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
			
			<?php echo $form->datePickerGroup($model,'tanggal',array(
				'widgetOptions'=>array(
					'options'=>array('format'=>'yyyy-mm-dd','autoclose'=>true),
					'htmlOptions'=>array('class'=>'span5')
					), 
				'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 
			)); ?>

            <?php echo $form->select2Group($model,'id_pegawai_pihak_pertama', array(
                'widgetOptions'=>array('data'=>CHtml::listData(Pegawai::model()->findAll(),'id','nama'),'htmlOptions'=>array('class'=>'span5','maxlength'=>255,'placeholder' => 'Pilih Pegawai'))
            )) ?>

            <?php echo $form->textFieldGroup($model,'jabatan_pihak_pertama',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255,'label' => 'jabatan Pertama')))); ?>

            <?php echo $form->select2Group($model,'id_pegawai_pihak_kedua', array(
                'widgetOptions'=>array('data'=>CHtml::listData(Pegawai::model()->findAll(),'id','nama'),'htmlOptions'=>array('class'=>'span5','maxlength'=>255,'placeholder' => 'Pilih Pegawai'))
            )) ?>

            <?php echo $form->textFieldGroup($model,'jabatan_pihak_kedua',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255,)))); ?>


           <?php echo $form->select2Group($model,'id_barang',array(
					'wrapperHtmlOptions' => array('class' => 'col-sm-12	'),
					'widgetOptions' => array(
						'asDropDownList' => false,
	      				 'options' => array(
	                       'minimumInputLength'=>'2',
	                       'placeholder'=> 'Pilih Barang',
	                       'separator' => ';',
	                       'allowClear' => TRUE,
	                       'ajax'       => array(
                               'url'       => Yii::app()->controller->createUrl('barang/selectBarang'),
                               'dataType'  => 'json',
                               'data'      => 'js:function(term, page) { return {q: term }; }',
                               'results'   => 'js:function(data) { return {results: data}; }',
	                               ),
	                       'tags' => 'js:function(data) { return {results: data}; }',
	                        ),
					),
			)); ?>


            <?php echo $form->textFieldGroup($model,'kode_barang',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

            <?php echo $form->textFieldGroup($model,'nup_barang',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

             <?php echo $form->textFieldGroup($model,'jumlah_unit',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255,)))); ?>


            <div class="form-group">
				<label class="col-sm-3 control-label">Berkas BAST</label>
				<div class="col-sm-9">
					<?php echo $form->fileField($model,'berkas_bast',array('class'=>'form-control')); ?>
					<?php echo $form->error($model,'berkas_bast'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="well">
			<?php $this->widget('booster.widgets.TbButton', array(
				'buttonType'=>'submit',
				'context'=>'danger',
				'icon'=>'ok',
				'label'=>$model->isNewRecord ? 'Simpan' : 'Update',
			)); ?>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>


</div><!-- form -->