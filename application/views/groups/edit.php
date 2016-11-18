<?php
/**
 * Created by PhpStorm.
 * User: Hasyim
 * Date: 15/11/2016
 * Time: 14.27
 */
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Manajemen User | Groups
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-8">
                        <h1><?php echo lang('edit_group_heading'); ?></h1>
                        <p><?php echo lang('edit_group_subheading'); ?></p>
                        <div id="infoMessage"><?php echo $message; ?></div>
                        <?php echo form_open(current_url(), ['class' => 'form-horizontal']); ?>
                        <div class="form-group">
                            <?php echo lang('edit_group_name_label', 'group_name', "class='col-sm-4 control-label'"); ?>

                            <div class="col-sm-8">
                                <?php //echo form_input($group_name);?>
                                <input name="group_name" value="<?php echo $group_name['value'] ?>" id="group_name"
                                       readonly="readonly" type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo lang('edit_group_desc_label', 'description', "class='col-sm-4 control-label'"); ?>
                            <div class="col-sm-8">
                                <?php //echo form_input($group_description); ?>
                                <input name="group_description" value="<?php echo $group_description['value'] ?>"
                                       id="group_description" type="text" class="form-control">
                            </div>
                        </div>
                        <p><?php echo form_submit('submit', lang('edit_group_submit_btn'), ['class' => 'btn btn-primary pull-right']); ?></p>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.col-lg-4 (nested) -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-8 -->