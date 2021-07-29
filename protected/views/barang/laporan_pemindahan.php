<?php $this->renderPartial('_batch_laporan'); ?>

<h1>Laporan Pemeriksaan Barang</h1>


<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'laporan-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Filter Laporan Pemeriksaan  </p>

    <?php echo $form->errorSummary($laporanform); ?>

    <div class="form-actions well">



    <?php echo $form->datePickerGroup($laporanform,'tanggal_awal',array(
            'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
            'widgetOptions'=>array(
                    'options'=>array(
                        'showAnim'=>'fold',
                        'format'=>'yyyy-mm-dd',
                        'autoclose' =>true
                ),
                    'htmlOptions'=>array(
                        'class'=>'form-control',
                        'placeholder'=>'Tanggal Awal'
                    ),
            ),      
            'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>'
    )); ?>    

    <?php echo $form->datePickerGroup($laporanform,'tanggal_akhir',array(
            'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
            'widgetOptions'=>array(
                    'options'=>array(
                        'showAnim'=>'fold',
                        'format'=>'yyyy-mm-dd',
                        'autoclose' =>true
                ),
                    'htmlOptions'=>array(
                        'class'=>'form-control',
                        'placeholder'=>'Tanggal Akhir'
                    ),
            ),      
            'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>'
    )); ?>  

    <?php echo $form->dropDownListGroup($laporanform,'status',array(
            'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
            'widgetOptions'=>array(
                    'data' => CHtml::listData(BarangPemindahanStatus::model()->findAll(),'id','nama'),
                    'htmlOptions'=>array(
                        'class'=>'form-control',
                        'placeholder'=>'Tanggal Akhir',
                        'empty' => 'Semua Kondisi'
                    ),
            ),      
    )); ?>     

</div>    

    <div class="form-actions well" style='text-align:right'>
    <?php $this->widget('booster.widgets.TbButton',array(
        'buttonType'=>'submit',
        'context'=>'primary',
        'label'=>'Proses',
        'icon'=>'ok',
    )); ?>&nbsp;
    </div>

    
<?php $this->endWidget(); ?>