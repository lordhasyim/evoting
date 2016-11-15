<h1><?php echo lang('index_heading');?></h1>
<p><?php echo lang('index_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<table cellpadding=0 cellspacing=10>
	<tr>
		<th>Name</th>
		<th>Description</th>
		<th><?php echo lang('index_action_th');?></th>
	</tr>
	<?php foreach ($groups as $group):?>
		<tr>
            <td><?php echo htmlspecialchars($group->name,ENT_QUOTES,'UTF-8');?></td>
            <td><?php echo htmlspecialchars($group->description,ENT_QUOTES,'UTF-8');?></td>
           	<td><?php echo anchor("groups/edit/".$group->id, 'Edit') ;?></td>
		</tr>
	<?php endforeach;?>
</table>

<p><?php echo anchor('users/create', lang('index_create_user_link'))?> | <?php echo anchor('groups/create', lang('index_create_group_link'))?></p>