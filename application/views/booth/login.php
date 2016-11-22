
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Login Sebagai Bilik</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | <?php echo $item->title ?>
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
                                <?php echo anchor('booth', 'Kembali', "class='btn btn-default'")?>
                            </p>

                            <?php echo form_open(current_url(), ['class' => 'form-horizontal']); ?>
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">Password:</label>
                                <div class="col-sm-4">
                                    <?php //echo form_input($last_name); ?>
                                    <input name="password" id="password" type="password" class='form-control'>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-6">
                                    <p><?php echo form_submit('submit', 'Login', ['class' => 'btn btn-success pull-right']); ?></p>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
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