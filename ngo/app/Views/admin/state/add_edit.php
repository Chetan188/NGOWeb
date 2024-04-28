<?= $this->extend('admin/header'); ?>
<?= $this->section('main_content'); ?>
<?php
	if($state) {
		$header_title = "Edit State";
		$header_title_url = base_url("states/".$state['id'].'/edit');
		$action = base_url("states/".$state['id']);
		$btn_title = "Save";

		$name = $state["name"];
		$country_id = $state["country_id"];
		$is_active = $state["is_active"];
	} else {
		$header_title = "New State";
		$header_title_url = base_url("states");
		$action = base_url("states");
		$btn_title = "Add";

		$name = "";
		$country_id = "";
		$is_active = 1;
	}
?>
<div class="app-title">
	<div>
		<h1><i class="bi bi-people"></i> State</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a>General</a></li>
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
					<div class="mb-3">
						<label class="form-label">Name</label>
						<input class="form-control" type="text" name="name" value="<?php echo $name; ?>" required />
					</div>
					<div class="mb-3">
						<label class="form-label">Country</label>
						<select class="form-control" name="country_id" id="country_id" required>
							<option value="">Option</option>
							<?php
								if($countries) {
									foreach($countries as $country) {
							?>
										<option value="<?php echo $country['id']; ?>" <?php echo $country['id'] == $country_id ? "selected" : ""; ?>>
											<?php echo $country['name']; ?>
										</option>
							<?php
									}
								} 
							?>
						</select>
					</div>
					<div class="mb-3">
						<label class="form-label">Status</label>
						<select class="form-control" name="is_active" id="is_active">
							<option value="1" <?php echo $is_active == 1 ? "selected" : ""; ?>>Active</option>
							<option value="0" <?php echo $is_active == 0 ? "selected" : ""; ?>>Inactive</option>
						</select>
					</div>
				</div>
				<div class="tile-footer">
					<button class="btn btn-primary" type="submit"><?php echo $btn_title; ?></button>&nbsp;
					<a href="<?php echo base_url('countries'); ?>" class="btn btn-sm btn-info">Back</a>
				</div>
			</form>
		</div>
	</div>
</div>
<?= $this->endSection(); ?>