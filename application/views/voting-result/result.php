<script src="<?php echo base_url('assets/chart/highcharts.js') ; ?>"></script>
<script src="<?php echo base_url('assets/chart/exporting.js') ; ?>"></script>


<style type="text/css">
/**/
    /*.row.no-gutter {*/
        /*margin-left: 0;*/
        /*margin-right: 0;*/
    /*}*/

    /*.row.no-gutter [class*='col-']:not(:first-child),*/
    /*.row.no-gutter [class*='col-']:not(:last-child) {*/
        /*padding-right: 0;*/
        /*padding-left: 0;*/
    /*}*/

    /*.row .thumbnail {*/
        /*border:0;*/
        /*box-shadow:0;*/
        /*border-radius:0;*/
    /*}*/

    /*.rlisting{*/
        /*background-color: #fff;overflow: hidden;*/
    /*}*/

    /*.rlisting img{*/
        /*width: 100%;*/
        /*border: none;*/
    /*}*/

    /*.nopad{*/
        /*padding:0;*/
    /*}*/
    /*.panel-body {*/
        /*padding: 0px;*/
        /*margin: 0px;*/
    /*}*/
</style>
<!-- dpm High Chart -->
<script type="text/javascript">
    $(function () {
        Highcharts.chart('hasil_dpm', {
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $data[1]['section']['title'] ?>'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total prosentase pemilih'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.2f}%'
                    }
                }
            },

            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [{
                name: 'Brands',
                colorByPoint: true,
                data:<?php echo $data[1]['graph'] ?>
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
                text: '<?php echo $data[0]['section']['title'] ?>'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
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
                name: 'Prosentase Hasil',
                colorByPoint: true,
                data: <?php echo $data[0]['graph'] ?>
            }]
        });
    });
</script>
<body>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <div id="hasil_dpm"></div>
                </div>
                <div class="col-lg-6">
                    <h2 class="text-center"><?php echo $data[1]['section']['title'] ?></h2>
                    <?php
                    if($data[1]['data']):
                        $i = 1;
                        foreach($data[1]['data'] as $item): ?>
                        <h3><?php echo $i.". ".$item['graph_name']." (".$item['voter_total'].")"."/".$item['percentage']*100 ."%" ?></h3>
                        <?php
                        $i++;
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <div id="hasil_bem"></div>
                </div>

                    <h2 class="text-center"><?php echo $data[0]['section']['title'] ?></h2>
                <?php

                $abstain_percentage = 0;
                $abstain_voter = 0;
                if($data[0]['data']):
                    $i = 1;
                    foreach($data[0]['data'] as $item):
                        if($item['candidate_id'] == NULL) {

                            $abstain_percentage = $item['percentage'];
                            $abstain_voter = $item['voter_total'];
                            continue;

                        }?>
                        <div class="col-lg-2">
                            <div class="rlisting">
                                <div class="panel panel-default">
                                    <div class="panel-heading"><h1 class="text-center"> <b> <?php echo $item['serial_number'] ?> </b> </h1></div>
                                    <div class="panel-body">
                                        <div class="col-md-12 nopad">
                                            <img src="<?php echo base_url('assets/uploads/files/'.$item['picture']) ; ?>"
                                                 class="img-responsive" height="250" width="250">
                                        </div>
                                        <div class="col-md-12 nopad">
                                            <h1 class="text-center"><?php echo $item['percentage']*100 ?>%</h1>
                                            <h1 class="text-center"><?php echo $item['voter_total'] ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach;
                ?>
                    <div class="col-lg-2">
                        <div class="rlisting">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h1 class="text-center"> <b> Abstain </b> </h1></div>
                                <div class="panel-body">
                                    <div class="col-md-12 nopad">
                                        <img src="<?php echo base_url('assets/img/abstain.jpg') ; ?>"
                                             class="img-responsive" height="250" width="250">
                                    </div>
                                    <div class="col-md-12 nopad">
                                        <h1 class="text-center"><?php echo $abstain_percentage*100 ?>%</h1>
                                        <h1 class="text-center"><?php echo $abstain_voter ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
</body>