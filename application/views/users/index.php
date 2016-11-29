<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"> Pengguna Sistem</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-lg-12">
			<!-- /.panel -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-bar-chart-o fa-fw"></i> SiMiLa | Daftar Pengguna Sistem
				</div>

				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<?php if($message) {
								?>
								<div class="alert alert-warning"><?php echo $message;?></div>
								<?php
							}?>

							<p align="right"><?php echo anchor('users/create', 'Tambah Pengguna Baru', "class='btn btn-success'")?></p>

							<table cellpadding=0 cellspacing=10 class="table">
								<thead>
									<tr>
										<th>Username</th>
										<th><?php echo lang('index_fname_th');?></th>
										<th><?php echo lang('index_lname_th');?></th>
										<th><?php echo lang('index_groups_th');?></th>
										<th><?php echo lang('index_status_th');?></th>
										<th><?php echo lang('index_action_th');?></th>
									</tr>
								</thead>
								<tbody>
								<?php foreach ($users as $user):?>
									<?php $groups = []; ?>
									<tr>
										<td><?php echo htmlspecialchars($user->username,ENT_QUOTES,'UTF-8');?></td>
										<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
										<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
										<td>

											<?php echo htmlspecialchars($user->groups{0}->name,ENT_QUOTES,'UTF-8'); ?>
<!--											--><?php //foreach ($user->groups as $group):?>
<!--												--><?php //$groups[] = $group->name;  ?>
<!--												--><?php //if($this->config->item('admin_group', 'ion_auth') == $group->name) :?>
<!--													--><?php //echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8'); ?>
<!--												--><?php //else: ?>
<!--													<button class="btn btn-default"> --><?php //echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8') ?>
<!--													</button>-->
<!--												--><?php //endif; ?>
<!--											--><?php //endforeach?>
										</td>
										<td>

											<?php if(!in_array($this->config->item('admin_group', 'ion_auth'),$groups)) :?>
												<?php echo ($user->active) ? anchor("users/deactivate/".$user->id, lang('index_active_link'),
													"class='btn btn-link'") : anchor("users/activate/". $user->id, lang('index_inactive_link'));?>
											<?php endif; ?>

										</td>
										<td><?php echo anchor("users/edit/".$user->id, 'Edit', "class='btn btn-warning'") ;?></td>
									</tr>
								<?php endforeach;?>

								</tbody>

							</table>
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