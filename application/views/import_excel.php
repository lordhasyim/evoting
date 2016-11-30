


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Import Data Pemilih </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | Import Data Pemilih ke Dalam Sistem (.xls, .xlsx)
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if($message) {
                                ?>
                                <div class="alert alert-warning"><?php echo $message;?></div>
                                <?php
                            }?>
                            <p align="right">
                                <?php echo anchor('voter', 'Daftar Pemilih', "class='btn btn-default'")?>
                            </p>

                            <form action="<?php echo current_url();?>" method="post" enctype="multipart/form-data" class="form-horizontal">

                                <div class="form-group">
                                    <label for="filename" class="col-sm-2 control-label">Pilih File:</label>

                                    <div class="col-sm-6">
                                        <input type="file" name="filename" class="form-control">

                                    </div>
                                </div>

                                <div class="form-group">

                                    <div class="col-sm-8">
                                        <p><?php echo form_submit('submit', "Upload Data", ['class' => 'btn btn-success  pull-right']); ?></p>
                                    </div>
                                </div>

                            </form>


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