<?= $this->extend('admin/header'); ?>
<?= $this->section('main_content'); ?>
<div class="app-title">
	<div>
		<h1><i class="bi bi-people"></i> My Profile</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('profile'); ?>">My Profile</a></li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<form method="post" action="<?php echo base_url('submit-profile'); ?>" enctype="multipart/form-data">
				<div class="tile-body">
					<div class="row">
						<div class="col-md-12">
							<div class="mb-3">
								<label class="form-label">Name</label>
								<input class="form-control" type="text" name="name" value="<?php echo $profile['name']; ?>" required />
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">Email</label>
								<input class="form-control" type="email" name="email" value="<?php echo $profile['email']; ?>" required />
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label">Phone</label>
								<input class="form-control" type="text" name="phone" value="<?php echo $profile['phone']; ?>" pattern="[1-9]{1}[0-9]{9}" title="Enter 10 digit mobile no." required />
							</div>
						</div>
					</div>
				</div>
				<div class="tile-footer">
					<button class="btn btn-primary" type="submit">Save</button>&nbsp;
					<a href="<?php echo base_url('dashboard'); ?>" class="btn btn-sm btn-info">Back</a>
				</div>
			</form>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>