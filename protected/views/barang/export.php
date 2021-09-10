<?php $this->renderPartial('_batch_laporan'); ?>

<h1>Laporan Barang</h1>

<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
    'id'=>'laporan-form',
    'type'=>'horizontal',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Filter Laporan Barang  </p>

    <?php echo $form->errorSummary($laporanform); ?>

    <div class="form-actions well">



        <?php echo $form->textFieldGroup($laporanform,'nama',array(
                'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
                'widgetOptions'=>array(
                    'data'=>Barang::getList(),
                    'htmlOptions'=>array(
                        'placeholder'=>'Ketik Kode atau Nama Barang',
                        'empty' => 'Semua Barang',
                    )
                )
        )); ?>

    <?php echo $form->dropDownListGroup($laporanform,'tahun',array(
            'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
            'widgetOptions'=>array(
                'data' => Chtml::ListData(Tahun::model()->findAll(),'id','tahun'),
                'htmlOptions'=>array(
                        'class'=>'form-control',
                        'placeholder'=>'Tahun',
                        'empty' => 'Semua Tahun'
                    ),
            ),      
            'prepend'=>'<i class="glyphicon glyphicon-calendar"></i>'
    )); ?>        

    <?php echo $form->dropDownListGroup($laporanform,'lokasi',array(
            'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
            'widgetOptions'=>array(
                    'data' => CHtml::listData(Lokasi::model()->findAll(),'id','nama'),
                    'htmlOptions'=>array(
                        'class'=>'form-control',
                        'placeholder'=>'Tanggal Akhir',
                        'empty' => 'Semua Lokasi'
                    ),
            ),      
            'prepend'=>'<i class="glyphicon glyphicon-map-marker"></i>'
    )); ?>  

    <?php echo $form->dropDownListGroup($laporanform,'kondisi',array(
            'wrapperHtmlOptions'=>array('class'=>'col-sm-5'),
            'widgetOptions'=>array(
                    'data' => CHtml::listData(BarangKondisi::model()->findAll(),'id','nama'),
                    'htmlOptions'=>array(
                        'class'=>'form-control',
                        'placeholder'=>'Tanggal Akhir',
                        'empty' => 'Semua Kondisi'
                    ),
            ),      
    )); ?>      

</div>    

<div class="form-actions well">
    <div class="row">
        <div class="col-sm-3">&nbsp;</div>
        <div class="col-sm-9">
            <?php $this->widget('booster.widgets.TbButton', array(
                'buttonType'=>'submit',
                'context'=>'success',
                'icon'=>'ok',
                'label'=>'Export',
            )); ?>
        </div>
    </div>
</div>

    
<?php $this->endWidget(); ?>
