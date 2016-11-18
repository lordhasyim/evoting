<?php
/**
 * Created by PhpStorm.
 * User: Hasyim
 * Date: 15/11/2016
 * Time: 14.27
 */
?>
<style>
    .btn span.glyphicon {
        opacity: 0;
    }

    .btn.active span.glyphicon {
        opacity: 1;
    }
</style>
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
                    <i class="fa fa-bar-chart-o fa-fw"></i> Manajemen User | Edit User
                    <h1><?php echo lang('edit_user_heading'); ?></h1>
                    <p><?php echo lang('edit_user_subheading'); ?></p>
                    <div id="infoMessage"><?php echo $message; ?></div>
                    <?php echo form_open(uri_string(), ['class' => 'form-horizontal']); ?>
                    <div class="form-group">
                        <?php echo lang('edit_user_fname_label', 'first_name', "class='col-sm-2 control-label'"); ?>
                        <div class="col-sm-10">
                            <?php //echo form_input($first_name);?>
                            <input name="first_name" value="<?php echo $first_name['value'] ?>" id="first_name"
                                   type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_lname_label', 'last_name', "class='col-sm-2 control-label'"); ?>
                        <div class="col-sm-10">
                            <?php //echo form_input($last_name);?>
                            <input name="last_name" value="<?php echo $last_name['value']; ?>" id="last_name"
                                   type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_company_label', 'company', "class='col-sm-2 control-label'"); ?>
                        <div class="col-sm-10">
                            <?php //echo form_input($company); ?>
                            <input name="company" value="<?php echo $company['value']; ?>" id="company" type="text"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_phone_label', 'phone', "class='col-sm-2 control-label'"); ?>
                        <div class="col-sm-10">
                            <?php //echo form_input($phone); ?>
                            <input name="phone" value="<?php echo $phone['value']; ?>" id="phone" type="text" ,
                                   class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_password_label', 'password', "class='col-sm-2 control-label'"); ?>
                        <div class="col-sm-10">
                            <?php //echo form_input($password); ?>
                            <input name="password" value="" id="password" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo lang('edit_user_password_confirm_label', 'password_confirm', "class='col-sm-2 control-label'"); ?>
                        <div class="col-sm-10">
                            <?php //echo form_input($password_confirm); ?>
                            <input name="password_confirm" value="" id="password_confirm" type="password"
                                   class="form-control">

                        </div>
                    </div>
                    <div class="form-group">
                        <?php if ($this->ion_auth->is_admin()): ?>
                            <h3><?php echo lang('edit_user_groups_heading'); ?></h3>
                            <?php foreach ($groups as $group): ?>
                                <label class="btn btn-primary">
                                    <?php
                                    $gID = $group['id'];
                                    $checked = null;
                                    $item = null;
                                    foreach ($currentGroups as $grp) {
                                        if ($gID == $grp->id) {
                                            $checked = ' checked="checked"';
                                            break;
                                        }
                                    }
                                    ?>
                                    <input type="checkbox" name="groups[]"
                                           value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                                    <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                </label>
                            <?php endforeach ?>
                        <?php endif ?>

                        <div class="col-sm-10 col-md-offset-10">
                            <input name="submit" value="Save User" type="submit" class="btn btn-primary">
                        </div>
                    </div>

                    <?php echo form_hidden('id', $user->id); ?>
                    <?php echo form_hidden($csrf); ?>
                    <?php //echo form_submit('submit', lang('edit_user_submit_btn')); ?>
                    <?php echo form_close(); ?>

                </div>
                <!-- /.panel-heading -->


