<?= $this->extend('admin/header'); ?>
<?= $this->section('main_content'); ?>
<?php
	if($user) {
		$header_title = "Edit User";
		$header_title_url = base_url("users/".$user['id'].'/edit');
		$action = base_url("users/".$user['id']);
		$btn_title = "Save";

		$name = $user["name"];
		$phone = $user["phone"];
		$email = $user["email"];
		$is_approved = $user["is_approved"];
	} else {
		$header_title = "New Customer";
		$header_title_url = base_url("customers");
		$action = base_url("customers");
		$btn_title = "Add";

		$name = "";
		$phone = "";
		$email = "";
		$country_id = 0;
		$state_id = 0;
		$city_id = 0;
		$address = "";
		$role = "";
		$password = "123456";
		$old_avatar = "";
		$is_approved = 1;
	}
?>
<div class="app-title">
	<div>
		<h1><i class="bi bi-people"></i> Users</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo $header_title_url; ?>"><?php echo $header_title; ?></a></li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
				<?php
					if($name != "") {
						echo '<input type="hidden" name="_method" value="put" />';
					} 
				?>
				<div class="tile-body">
					<div class="row">
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Name*</label>
								<input class="form-control" type="text" name="name" value="<?php echo $name; ?>" required autofocus />
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Phone*</label>
								<input class="form-control" type="number" name="phone" value="<?php echo $phone; ?>" required />
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Email*</label>
								<input class="form-control" type="text" name="email" value="<?php echo $email; ?>" />
							</div>
						</div>
					</div>
				</div>
				<div class="tile-footer">
					<button class="btn btn-primary" type="submit"><?php echo $btn_title; ?></button>&nbsp;
					<a href="<?php echo base_url('users'); ?>" class="btn btn-sm btn-info">Back</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var page_title = "Users";
</script>
<?= $this->endSection(); ?>