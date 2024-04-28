<?= $this->extend('admin/header'); ?>
<?= $this->section('main_content'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
<style type="text/css">
	.bi-trash, .bi-pencil {
		margin-right: 0px !important;
	}
</style>
<div class="app-title">
	<div>
		<h1><i class="bi bi-people"></i> State</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a>General</a></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('states'); ?>">State</a></li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<a class="btn btn-sm btn-warning text-white" id="newbtn" href="<?php echo base_url('states/new'); ?>"><i class="bi bi-plus" style="margin-right: 0px;"></i></a><br><br>
				<div class="table-responsive">
					<table class="table table-hover table-bordered" id="sampleTable">
						<thead>
							<tr>
								<th width="5%">No.</th>
								<th width="65%">Name</th>
								<th width="15%">Status</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($states) {
									foreach($states as $key => $val) {
							?>
										<tr>
											<td><?php echo $key+1; ?></td>
											<td><?php echo $val['name']; ?></td>
											<td>
												<?php
													if($val['is_active'] == 1) {
														echo "<span class='text-green'>Active</span>";
													} else {
														echo "<span class='text-red'>Inactive</span>";
													}
												?>
											</td>
											<td>
												<a class="btn btn-danger btn-sm" href="<?php echo base_url('states/'.$val['id']); ?>/edit">
													<i class="bi bi-pencil"></i>
												</a>&nbsp;
												<a class="btn btn-danger btn-sm" href="<?php echo base_url('states/'.$val['id']); ?>" onclick="return confirm('Are you sure to remove this row?')">
													<i class="bi bi-trash"></i>
												</a>
											</td>
										</tr>
							<?php
									}
								} 
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo base_url('public/admin/js/plugins/jquery.dataTables.min.js'); ?>"></script>
<!-- <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script> -->
<script type="text/javascript">
	var page_title = "State";
	$('#sampleTable').DataTable();
</script>
<?= $this->endSection(); ?>