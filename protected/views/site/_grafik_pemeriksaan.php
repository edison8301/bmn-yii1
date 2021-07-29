<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/vendors/fusioncharts/js/FusionCharts.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/vendors/fusioncharts/js/themes/FusionCharts.theme.fint.js"); ?>

<script>

FusionCharts.ready(function(){
      var revenueChart = new FusionCharts({
        "type": "column3d",
        "renderAt": "pemeriksaan-per-bulan",
        "width": "100%",
        "height": "300",
        "dataFormat": "json",
        "dataSource": {
          "chart": {
              "caption" : "Pemeriksaan",
              "xAxisName": "Bulan",
              "yAxisName": "Jumlah Pemeriksaan",
              "theme": "fint"
           },
          "data":        
              [ <?php print BarangPemeriksaan:: getChartPerBulan(); ?> ]
             
           
        }
    });

    revenueChart.render();
})
		
</script> 
<div id="pemeriksaan-per-bulan"> FusionChart XT will load here! </div>
