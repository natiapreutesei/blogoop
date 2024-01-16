<?php

//include: error in the page, php generates the error
// but the page will keep working

//require:same as include with the change that php generates a fatal error
// and stops the page from working

//include_once: same as include but only once making sure that you don't load the same file multiple times bause
// it sets it in the cache
//require_once
include("includes/header.php");
include("includes/sidebar.php");
include("includes/content-top.php");
?>


<div class="container-fluid">
	<div class="row">
		<h1 class="text-center">All Users</h1>
		<hr class="pb-3">
        <?php
        $users = User::find_all_users();

        ?>
		<div class="table-responsive">
			<table class="table table-dark mb-0">
				<thead>
				<tr>
					<th>ID</th>
					<th>USERNAME</th>
					<th>PASSWORD</th>
					<th>FIRST NAME</th>
					<th>LAST NAME</th>
					<th>EMAIL</th>
					<th>DELETE</th>
				</tr>
				</thead>
				<tbody>
                <?php foreach($users as $user):?>
					<tr>
						<td class="text-bold-500"><?php echo $user->id; ?></td>
						<td class="d-flex align-content-center">
							<div class="avatar me-3">
								<img src="../admin/assets/compiled/jpg/2.jpg" alt="avtar img holder">
							</div>
                            <?php echo $user->username; ?>
						</td>
						<td class="text-bold-500"><?php echo $user->password; ?></td>
						<td><?php echo $user->first_name; ?></td>
						<td><?php echo $user->last_name; ?></td>
						<td><a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail badge-circle font-medium-1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></a>
						</td>
						<td><a href="#"><i class="bi bi-trash3-fill"></i></td>
					</tr>
                <?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php
	$allUsers = User::find_all_users();
	$user = new User();
	$user->username  = "test";
	$user->password  = "test";
	$user->first_name  = "test";
	$user->last_name  = "test";
	$user->create();
?>
<?php
include("includes/footer.php");
?>

