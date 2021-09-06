<?php
/* @var $this BarangKategoriController */
/* @var $model BarangKategori */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
        'id'=>'barang-kategori-form',
        'enableAjaxValidation'=>false,
        'type'=>'horizontal',
        'htmlOptions'=>array('enctype'=>'multipart/form-data')
    )); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row well">
        <div class="col-sm-9">
            <?php echo $form->textFieldGroup($model,'nama',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

            <?php echo $form->textFieldGroup($model,'kode',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
        </div>
    </div>

    <div class="row well">
        <div class="col-sm-12">
            <?php $this->widget('booster.widgets.TbButton', array(
                'buttonType'=>'submit',
                'context'=>'danger',
                'icon'=>'ok',
                'label'=>$model->isNewRecord ? 'Simpan' : 'Update',
            )); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->