<?php
/* @var $this BarangController */
/* @var $model Barang */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'barang-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

<p class="note">Fields with <span class="required">*</span> are required.</p>
	
<div class="row">
	<div class="col-sm-9">
		
		<?php echo $form->errorSummary($model); ?>

		<div class="well">
        <?php echo $form->textFieldGroup($model,'nama',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
        
		<?php echo $form->textFieldGroup($model,'kode',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

		<?php echo $form->textFieldGroup($model,'nup',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>		

		<?php echo $form->dropDownListGroup($model,'id_barang_kondisi',array(
			'widgetOptions'=>array(
				'data' => CHtml::listData(BarangKondisi::model()->findAll(),'id','nama'),
				'htmlOptions'=>array(
					'class'=>'span5',
                    'maxlength'=>255,
                    'empty' => '- Pilih Kondisi -'
                )
            )
        )); ?>
        
        <?php echo $form->datePickerGroup($model,'tanggal_kondisi_barang',array(
			'widgetOptions'=>array(
				'options'=>array('format'=>'yyyy-mm-dd','autoclose'=>true),
				'htmlOptions'=>array('class'=>'span5')
				), 
			'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 
		)); ?>
                    
        <?php echo $form->select2Group($model,'id_lokasi_jenis',array(
            'widgetOptions'=>array(
                'data'=>LokasiJenis::getList(),
                'htmlOptions'=>array('class'=>'span5','maxlength'=>255, 'placeholder' => 'Pilih Ruangan'))
		)); ?>

		<?php echo $form->select2Group($model,'id_lokasi',array(
				'widgetOptions'=>array(
					'data'=>Lokasi::getListData(),
					'htmlOptions'=>array('class'=>'span5','maxlength'=>255, 'placeholder'=>'Pilih Lokasi'))
		)); ?>

		<?php
		if(isset($_GET['id_pegawai'])){
			echo $form->select2Group($model,'id_pegawai',array(
				'widgetOptions'=>array(
                    'data' => CHtml::listData(Pegawai::model()->findAllByAttributes(array('id'=>$_GET['id_pegawai'])),'id','nama'),
                    'htmlOptions' => array(
                        'class'=>'span5',
                        'maxlength' => 255,
                        'prompt' => '- Pilih Pegawai -',
                    ),
                )
			)); 
		}
		else
		{
			echo $form->select2Group($model,'id_pegawai',array(
				'widgetOptions'=>array(
                    'data'=>CHtml::listData(Pegawai::model()->findAll(),'id','nama'),
                    'htmlOptions' => array(
                        'class'=>'span5',
                        'maxlength'=>255,
                        'prompt' => '- Pilih Pegawai -',
                    )
                ))
            );
		}
		?>

		<?php echo $form->textFieldGroup($model,'tahun',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

		<?php echo $form->datePickerGroup($model,'tahun_perolehan',array(
			'widgetOptions'=>array(
				'options'=>array('format'=>'yyyy-mm-dd','autoclose'=>true),
				'htmlOptions'=>array('class'=>'span5')
				), 
			'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>', 
		)); ?>

        <?php echo $form->select2Group($model,'id_perolehan_asal', array(
            'widgetOptions'=>array('data'=>CHtml::listData(PerolehanAsal::model()->findAll(),'id','nama'),'htmlOptions'=>array('class'=>'span5','maxlength'=>255,'placeholder' => 'Pilih Asal Perolehan'))
        )) ?>

		<?php echo $form->textFieldGroup($model,'bukti_perolehan',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>		
		
		<?php echo $form->textFieldGroup($model,'merek',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>		

        <?php echo $form->textFieldGroup($model,'spesifikasi_processor',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)),'hint' => 'Khusus PC Unit & Notebook')); ?>

        <?php echo $form->textFieldGroup($model,'sistem_operasi',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)),'hint' => 'Khusus PC Unit & Notebook')); ?>
        
		<?php /* echo $form->textFieldGroup($model,'masa_manfaat',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); */ ?>

		<?php echo $form->textFieldGroup($model,'sk_psp',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
		
		<?php /* echo $form->textFieldGroup($model,'sk_penghapusan',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); */ ?>			
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Gambar</label>
			<div class="col-sm-9">
				<?php if($model->gambar!='') { ?>
				<?php print CHTml::image(Yii::app()->request->baseUrl.'/uploads/barang/'.$model->gambar,'',array('class'=>'img-responsive')); ?>
				<?php } ?>
				<?php echo $form->fileField($model,'gambar',array('class'=>'form-control')); ?>
				<?php echo $form->error($model,'gambar'); ?>
			</div>
		</div>
		</div><!-- .well -->
	</div>
	<!-- Sidebar Kanan -->
    <?php /*
	<div class="col-sm-5">
		<?php $this->beginWidget('booster.widgets.TbPanel',array(
		    'title' => 'ADMINISTRASI',
		   	'context' => 'danger',
		));?>
			<?php echo $form->textFieldGroup($model,'administrasi_jumlah',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

			<?php echo $form->textFieldGroup($model,'administrasi_harga_satuan',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

			<?php echo $form->textFieldGroup($model,'administrasi_harga',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

		<?php $this->endWidget(); ?>

		<?php $this->beginWidget('booster.widgets.TbPanel',array(
		    'title' => 'INVENTARISASI',
		   	'context' => 'danger',
		));?>
			<?php echo $form->textFieldGroup($model,'inventarisasi_jumlah',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

			<?php echo $form->textFieldGroup($model,'inventarisasi_harga_satuan',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

			<?php echo $form->textFieldGroup($model,'inventarisasi_harga',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

		<?php $this->endWidget(); ?>
	</div>
    */ ?>
</div><!-- row -->

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