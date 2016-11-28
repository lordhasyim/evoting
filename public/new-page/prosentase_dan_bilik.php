<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>
        <!-- jQuery is required for this example -->
        <script src="<?php echo base_url('assets/bootstrap/jquery-1.10.2.js') ; ?>"></script>
        <!-- Bootstrap JavaScript -->
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js') ; ?>"></script>
        <script src="<?php echo base_url('assets/chart/highcharts.js') ; ?>"></script>
        <script src="<?php echo base_url('assets/chart/exporting.js') ; ?>"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css') ; ?>">
        
        <style>

        .no-gutter {
            padding = 0;
            margin = 0;
        }
    
        </style>
        <script type="text/javascript">
        $(function () {
        Highcharts.chart('container', {
        chart: {

            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },

        title: {
            text: 'Prosentase'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Calon 1',
                y: 56.33
            }, {
                name: 'Calon 2',
                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: 'Golput',
                y: 10.38
            }, {
                name: 'Tidak Hadir',
                y: 0.2
            }]
        }]
    });
});
        
        </script>
        
        
    </head>
    <body  oncontextmenu="return false;">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="row">
                    
                    <div class="col-lg-8">
                        <h2 class="text-center">Prosentase Pemilih</h2>
                        <div id="container" style="min-width: 310px; height: 600px; max-width: 900px; margin: 0 auto"></div>
                        
                    </div>
                    <div class="col-lg-4" style="margin-top: 30px;">
                        <div class="row">
                            <div class="panel panel-default text-center">
                                    <h1 class="text-danger">Bilik 1</h1>
                                    <h1>James</h1>
                                    <h1>9093454958</h1>
                            </div>
                            <div class="panel panel-default text-center">
                                    <h1 class="text-danger">Bilik 1</h1>
                                    <h1>James</h1>
                                    <h1>9093454958</h1>
                            </div>
                            <div class="panel panel-default text-center">
                                    <h1 class="text-danger">Bilik 1</h1>
                                    <h1>James</h1>
                                    <h1>9093454958</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
        
        
        
    </body>
</html>
