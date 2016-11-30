
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Groups Pengguna Sistem</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | Tambah Group Pengguna Sistem
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
                                <?php echo anchor('groups', 'Kembali', "class='btn btn-default'")?>
                            </p>

                            <?php echo form_open(current_url(), ['class' => 'form-horizontal']); ?>
                            <div class="form-group">
                                <?php echo lang('create_group_name_label', 'group_name', "class='col-sm-2 control-label'"); ?>

                                <div class="col-sm-6">
                                    <?php //echo form_input($group_name, ['class' => 'form-control']);?>
                                    <input name="group_name" value="<?php echo  $group_name['value'] ?>" id="group_name"
                                           type="text" class="form-control">

                                </div>
                            </div>
                            <div class="form-group">
                                <?php echo lang('create_group_desc_label', 'description', "class='col-sm-2 control-label'"); ?>

                                <div class="col-sm-6">
                                    <input name="description" value="<?php echo $description['value'] ?>" id="description"
                                           type="text" class="form-control">

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-8">
                                    <p><?php echo form_submit('submit', lang('edit_group_submit_btn'), ['class' => 'btn btn-success pull-right']); ?></p>
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