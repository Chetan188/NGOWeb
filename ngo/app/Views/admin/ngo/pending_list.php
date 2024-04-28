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
		<h1><i class="bi bi-house"></i> Pending NGOs</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('pending-ngos'); ?>">Pending NGOs</a></li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<div class="table-responsive">
					<table class="table table-hover table-bordered" id="sampleTable">
						<thead>
							<tr>
								<th width="5%">No.</th>
								<th width="20%">NGO Name</th>
								<th width="15%">NGO Phone</th>
								<th width="20%">NGO Email</th>
								<th width="30%">NGO Location</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($ngos) {
									foreach($ngos as $key => $val) {
							?>
										<tr>
											<td><?php echo $key+1; ?></td>
											<td><a href="<?php echo base_url('ngo-view/'.$val['id']); ?>"><?php echo $val['name']; ?></a></td>
											<td><?php echo $val['phone']; ?></td>
											<td><?php echo $val['email']; ?></td>
											<td>
												<?php
													$state_name = "";
													$city_name = "";
													if($states) {
														foreach($states as $state) {
															if($state["id"] == $val["state"]) {
																$state_name = $state["name"];
															}
														}
													}
													if($cities) {
														foreach($cities as $city) {
															if($city["id"] == $val["city"]) {
																$city_name = $city["name"];
															}
														}
													} 
													echo $city_name.", ".$state_name;
												?>
											</td>
											<td>
												<a class="btn btn-success btn-sm" href="<?php echo base_url('approve-ngo/'.$val['id']); ?>">
													<i class="bi bi-check"></i>
												</a>
												<a class="btn btn-danger btn-sm" href="<?php echo base_url('reject-ngo/'.$val['id']); ?>">
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
	var page_title = "PGs";
	$('#sampleTable').DataTable();
</script>
<?= $this->endSection(); ?>