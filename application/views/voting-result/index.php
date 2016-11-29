<!--<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>-->
<script src="<?php echo base_url('assets/chart/highcharts.js'); ?>"></script>
<script src="<?php echo base_url('assets/chart/exporting.js'); ?>"></script>
<style>
    .rwrapper {
        padding: 5px;
    }

    .rlisting {
        background-color: #fff;
        overflow: hidden;
    }

    .rlisting img {
        width: 100%;
    }

    .nopad {
        padding: 0;
    }

    .rfooter {
        background: #f1f3f5;
        border-top: 1px #ebebeb solid;
        width: 100%;
        padding: 10px 15px;
    }

    .rlisting h5, .rlisting p {
        padding: 0 15px;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Hasil Pemilihan</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | Hasil <?php echo $section->title; ?>
                </div>

                <div class="panel-body">
                    <p align="right">
                        <?php echo anchor('section', 'Kembali', "class='btn btn-default'") ?>
                    </p>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="container"
                                 style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">

                                <?php $i = 0; ?>
                                <?php foreach($data as $item):?>
                                    <?php if($item['candidate_id'] == NULL)
                                        continue; ?>
                                    <?php $i++; ?>
                                <?php endforeach; ?>

                                <?php foreach($data as $item):?>
                                    <?php if($item['candidate_id'] == NULL)
                                        continue; ?>
                                    <?php if ($i%2 ==  0) {?>
                                        <div class="col-lg-6 rwrapper">
                                    <?php }else { ?>
                                        <div class="col-lg-4 rwrapper">
                                    <?php }?>
                                        <div class="rlisting">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa |
                                                        Hasil <?php echo $section->title; ?>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="col-md-12 nopad">
                                                            <img src="<?php echo base_url('assets/uploads/files/'.$item['picture']) ; ?>"
                                                                 class="img-responsive" height="250" width="250">
                                                        </div>
                                                        <div class="col-md-12 nopad">
                                                            <h1 class="text-center text-danger"><?php echo $item['percentage']*100 ?>%</h1>
                                                            <h1 class="text-center text-danger"><?php echo $item['voter_total'] ?></h1>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

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
                    text: 'Hasil Pemilihan <?php echo $section->title ?>'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data:
                    <?php echo $graph ?>
                }]
            });
        });


    </script>

