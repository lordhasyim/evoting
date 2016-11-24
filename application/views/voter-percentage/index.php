<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Prosentase Pemilih </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa |
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.panel-heading -->
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>

<script>
    $(function () {
        var chart = Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Prosentase Pemilih '
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
                data:
                <?php echo $graph ?>
            }]
        });


        function getData() {
            $.getJSON( "<?php echo base_url("voter-percentage/data"); ?>", function( data ) {
                chart.series[0].setData(data);
            });

            setTimeout(getData, 2000);
        }
        getData();
    });


</script>
