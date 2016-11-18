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
            <h3 class="page-header"><?php echo "selamat datang " . $this->logged_in_name; ?></h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Manajemen User | Create User
                <h1><?php echo lang('create_user_heading'); ?></h1>
                <p><?php echo lang('create_user_subheading'); ?></p>
                <div id="infoMessage"><?php echo $message; ?></div>
                <?php //echo form_open("users/create"); ?>
                
                <?php echo form_open('users/create', ['class' => 'form-horizontal']); ?>
                <div class="form-group">
                    <?php echo lang('create_user_fname_label', 'first_name', "class='col-sm-2 control-label'"); ?>
                    <div class="col-sm-10">
                        <?php //echo form_input($first_name); ?>
                        <input name="first_name" value="<?php echo $first_name['value'] ;?>" id="first_name" type="text" class='form-control'>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo lang('create_user_lname_label', 'last_name', "class='col-sm-2 control-label'"); ?>                    <div class="col-sm-10">
                        <?php //echo form_input($last_name); ?>
                        <input name="last_name" value="<?php echo $last_name['value'] ;?>" id="last_name" type="text" class='form-control'>
                    </div>
                </div>
                <?php
                if($identity_column!=='email') {
                    echo '<p>';
                    echo lang('create_user_identity_label', 'identity');
                    echo '<br />';
                    echo form_error('identity');
                    echo form_input($identity);
                    echo '</p>';
                }
                ?>
                <div class="form-group">
                    <?php echo lang('create_user_company_label', 'company', "class='col-sm-2 control-label'");?>
                    <div class="col-sm-10">
                        <?php // echo form_input($company);?>
                        <input name="company" value="<?php echo $company['value'] ;?>" id="company" type="text" class="form-control">

                    </div>
                </div>
                <div class="form-group">
                    <?php echo lang('create_user_email_label', 'email', "class='col-sm-2 control-label'");?>
                    <div class="col-sm-10">
                        <?php //echo form_input($email);?>
                        <input name="email" value="<?php echo $email['value'] ;?>" id="email" type="text" class="form-control">

                    </div>
                </div>
                <div class="form-group">
                    <?php echo lang('create_user_phone_label', 'phone', "class='col-sm-2 control-label'");?>
                    <div class="col-sm-10">
                        <?php //echo form_input($phone);?>
                        <input name="phone" value="<?php echo $phone['value'] ;?>" id="phone" type="text" class="form-control">

                    </div>
                </div>
                <div class="form-group">
                    <?php echo lang('create_user_password_label', 'password', "class='col-sm-2 control-label'");?>
                    <div class="col-sm-10">
                        <?php //echo form_input($password);?>
                        <input name="password" value="<?php echo $password['value'] ;?>" id="password" type="password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <?php echo lang('create_user_password_confirm_label', 'password_confirm', "class='col-sm-2 control-label'");?>
                    <div class="col-sm-10">
                        <?php // echo form_input($password_confirm);?>
                        <input name="password_confirm" value="<?php echo $password_confirm['value'] ;?>" id="password_confirm" type="password", class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-10">
                        <?php //echo form_submit('submit', lang('create_user_submit_btn'));?>
                        <input name="submit" value="Create User" type="submit" class="btn btn-primary">
                    </div>
                </div>

                <?php echo form_close();?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="morris-area-chart"></div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bar-chart-o fa-fw"></i> Hasil Perolehan
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            Actions
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li><a href="#">Action</a>
                            </li>
                            <li><a href="#">Another action</a>
                            </li>
                            <li><a href="#">Something else here</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">Separated link</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                    </div>
                    <!-- /.col-lg-4 (nested) -->
                    <div class="col-lg-8">
                        <div id="morris-bar-chart"></div>
                    </div>
                    <!-- /.col-lg-8 (nested) -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-clock-o fa-fw"></i> Timeline
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body"></div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-8 -->
    <div class="col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-bell fa-fw"></i> Pemilih di ruang tunggu
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
            </div>
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Donut Chart Example
                </div>
                <div class="panel-body">
                    <div id="morris-donut-chart"></div>
                    <a href="#" class="btn btn-default btn-block">View Details</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <div class="chat-panel panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-comments fa-fw"></i>
                    Chat
                    <div class="btn-group pull-right">
                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-chevron-down"></i>
                        </button>
                        <ul class="dropdown-menu slidedown">
                            <li>
                                <a href="#">
                                    <i class="fa fa-refresh fa-fw"></i> Refresh
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-check-circle fa-fw"></i> Available
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-times fa-fw"></i> Busy
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-clock-o fa-fw"></i> Away
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-sign-out fa-fw"></i> Sign Out
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                </div>
                <!-- /.panel-body -->
