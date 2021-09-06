<?php
/* @var $this LokasiController */
/* @var $model Lokasi */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'lokasi-form',
	'type'=>'horizontal',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="well">

        <?php echo $form->textFieldGroup($model,'nama', [
            'wrapperHtmlOptions' => array('class'=>'col-sm-4'),
            'widgetOptions' => array(
                'htmlOptions'=>array('class'=>'span5','maxlength'=>255)
            )
        ]); ?>

        <?php echo $form->textFieldGroup($model,'kode', [
            'wrapperHtmlOptions' => array('class'=>'col-sm-4'),
            'widgetOptions' => array(
                'htmlOptions'=>array('class'=>'span5','maxlength'=>255)
            )
        ]); ?>

        <?php echo $form->select2Group($model,'id_lokasi',array(
            'wrapperHtmlOptions'=>array('class'=>'col-sm-4'),
            'widgetOptions'=>array(
                'data'=>CHtml::listData(Gedung::model()->findAll(),'id','nama'),
                'htmlOptions'=>array('empty'=>'-- Pilih Gedung --')
            )
        )); ?>
    </div>
</div>

	<div class="form-action well" style="text-align: right">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'danger',
			'icon'=>'ok',
			'label'=>'Simpan',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->