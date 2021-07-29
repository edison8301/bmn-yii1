<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/vendors/fusioncharts/js/fusioncharts.js"); ?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/vendors/fusioncharts/js/themes/fusioncharts.theme.fint.js"); ?>

<script>

FusionCharts.ready(function(){
      var revenueChart = new FusionCharts({
        "type": "column3d",
        "renderAt": "perawatan-per-bulan",
        "width": "100%",
        "height": "300",
        "dataFormat": "json",
        "dataSource": {
          "chart": {
              "caption" : "Perawatan",
              "xAxisName": "Bulan",
              "yAxisName": "Jumlah Perawatan",
              "theme": "fint"
           },
          "data":        
              [ <?php print BarangPerawatan:: getChartPerBulan(); ?> ]
             
           
        }
    });

    revenueChart.render();
})
		
</script>
<div id="perawatan-per-bulan"> FusionChart XT will load here! </div>