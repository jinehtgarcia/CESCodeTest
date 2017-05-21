<h2 class="page-header"><?php echo $title; ?></h2>

<div class="text-right">
	<a class="btn btn-default" href="<?php echo site_url('user/create'); ?>">Add User<i class="fa fa-plus fa-fw"></i></a>
</div>
<br/>
<table class="table table-responsive">
	<thead>
		<tr class="success">
			<th>Name</th>
			<th>Email</th>
			<th>Birth Date</th>
			<th>Favorite Color</th>
			<th>Actions</th>
		</tr>			
	</thead>	
	<tbody>
		<?php foreach ($users as $user_item): ?>
			<tr>
				<td><?php echo $user_item['name']; ?></td>
				<td><?php echo $user_item['email']; ?></td>
				<td><?php echo $user_item['birthdate']; ?></td>
				<td><span style="width: 40px; background-color: <?php echo $user_item['favorite_color']; ?>">&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
				<td>
					<a href="<?php echo site_url('user/'.$user_item['id']); ?>"><i class="fa fa-pencil-square-o fa-fw"></i></a>
					<a href="<?php echo site_url('user/delete/'.$user_item['id']); ?>"><i class="fa fa-times fa-fw"></i></a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>



