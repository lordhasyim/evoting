<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Kandidat Pemilihan</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | Daftar Kandidat
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            foreach($css_files as $file): ?>
                                <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                            <?php endforeach; ?>
                            <?php foreach($js_files as $file): ?>
                                <script src="<?php echo $file; ?>"></script>
                            <?php endforeach; ?>

                            <?php echo $output; ?>
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

