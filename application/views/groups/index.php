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
						<h1><?php echo lang('index_heading');?></h1>
						<p><?php echo lang('index_subheading');?></p>
						<div id="infoMessage"><?php echo $message;?></div>
						<table class="table">
							<tr>
								<th>Name</th>
								<th>Description</th>
								<th><?php echo lang('index_action_th');?></th>
							</tr>
							<?php foreach ($groups as $group):?>
								<tr>
									<td><?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');?></td>
									<td><?php echo htmlspecialchars($group->description,ENT_QUOTES,'UTF-8');?></td>
									<td><?php echo anchor("groups/edit/".$group->id, 'Edit', "class='btn btn-primary'") ;?></td>
								</tr>
							<?php endforeach;?>
						</table>
						<p><?php echo anchor('users/create', lang('index_create_user_link'), "class='btn btn-primary'")?> | <?php echo anchor('groups/create', lang('index_create_group_link'), "class='btn btn-primary'")?></p>
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

