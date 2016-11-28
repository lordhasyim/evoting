<!DOCTYPE html>
<html>
    <head>
        <title>chart</title>
        <!-- jQuery is required for this example -->
        <script src="<?php echo base_url('assets/bootstrap/jquery-1.10.2.js') ; ?>"></script>
        <!-- Bootstrap JavaScript -->
        <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.js') ; ?>"></script>
        <script src="<?php echo base_url('assets/chart/highcharts.js') ; ?>"></script>
        <script src="<?php echo base_url('assets/chart/exporting.js') ; ?>"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css') ; ?>">
    </head>
    <style type="text/css">

    .row.no-gutter {
        margin-left: 0;
        margin-right: 0;
    }

    .row.no-gutter [class*='col-']:not(:first-child),
    .row.no-gutter [class*='col-']:not(:last-child) {
        padding-right: 0;
        padding-left: 0;
    }

    .row .thumbnail {
    border:0;
    box-shadow:0;
    border-radius:0;
    }
    
    .rlisting{
        background-color: #fff;overflow: hidden;
    }
    
    .rlisting img{
        width: 100%;
        border: none;
    }
    
    .nopad{        
        padding:0;
    }
    .panel-body {
        padding: 0px;
        margin: 0px;
    }
    </style>
    <!-- dpm High Chart -->
    <script type="text/javascript">
        $(function () {
        Highcharts.chart('hasil_dpm', {
        chart: {
            type: 'column',

        },

        title: {
        text: 'Hasil Pemilihan DKM '
        },
        subtitle: {
        text: 'FTP Brawijaya'
        },
        xAxis: {
        
        crosshair: true
        },
        yAxis: {
        min: 0,
        title: {
        text: 'Hitungan per 25 suara'
        }
        },
        tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
        '<td style="padding:0; margin=0"><b>{point.y:.1f} mm</b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
    },
    plotOptions: {
    column: {
    pointPadding: 0.2,
    borderWidth: 0,
    }
    },
    series: [
    {
    name: 'Calon 1',
    data: [49.9]
    },
    {
    name: 'Calon 2',
    data: [83.6]
    },
    {
    name: 'Calon 3',
    data: [48.9]
    },
    {
    name: 'Calon 4',
    data: [48.9]
    },
    {
    name: 'Calon 5',
    data: [48.9]
    },
    {
    name: 'Calon 6',
    data: [48.9]
    },
    {
    name: 'Golput',
    data: [48.9]
    },
    {
    name: 'Tidak Hadir',
    data: [42.4]
    }]
    });
    });
    </script>
    <!-- Bem High Chart -->
    <script type="text/javascript">
    $(function () {
    Highcharts.chart('hasil_bem', {
    chart: {
    plotBackgroundColor: null,
    plotBorderWidth: null,
    plotShadow: false,
    type: 'pie'
    },
    title: {
    text: 'Hasil Rekapitulasi Pemilihan BEM FTP 2016'
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
    name: 'golput',
    y: 10.38
    }, {
    name: 'Tidak Hadir',
    y: 0.2
    }]
    }]
    });
    });
    </script>
    <body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-lg-12">
                <div class="col-lg-9">
                    <div id="hasil_dpm"></div>
                </div>
                <div class="col-lg-3">
                    <h2 class="text-center">urutan dpm</h2>
                    <h3>calon 1</h3>
                    <h3>calon 2</h3>
                    <h3>calon 3</h3>
                    <h3>calon 4</h3>
                    <h3>calon 5</h3>
                    <h3>calon 6</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            <div class="row no-gutter">
                    <div class="col-lg-3">
                        <div class="rlisting">
                                <div class="panel panel-default">
                                    
                                    <div class="panel-body">
                                        <div class="col-md-12 nopad">
                                            <img src="bem1.jpg" class="img-responsive" height="250px" width="250px">
                                        </div>
                                        <div class="col-md-12 nopad">
                                            <h3 class="text-center">4</h3>
                                            <h3 class="text-center"> 40%</h3>    
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="hasil_bem" style="min-width: 310px; height: 350px; max-width: 600px; margin: 0 auto"></div>
                    </div>
                    <div class="col-lg-3">
                        <div class="rlisting">
                                <div class="panel panel-default">
                                    
                                    <div class="panel-body">
                                        <div class="col-md-12 nopad">
                                            <img src="bem2.jpg" class="img-responsive" height="250px" width="250px">
                                        </div>
                                        <div class="col-md-12 nopad">
                                            <h3 class="text-center">4</h3>
                                            <h3 class="text-center"> 40%</h3>
                                            
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
        </div>
    </div>
            

</body>
</html>
