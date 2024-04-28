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
		<h1><i class="bi bi-house"></i> PGs Bookings</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('pg-bookings'); ?>">PGs Bookings</a></li>
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
								<th width="20%">PG Name</th>
								<th width="15%">PG Amount</th>
								<th width="15%">Status</th>
								<th width="15%">Payment Status</th>
								<th width="15%">Created At</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($bookings) {
									foreach($bookings as $key => $val) {
							?>
										<tr>
											<td><?php echo $key+1; ?></td>
											<td><?php echo $val['pg_name']; ?></td>
											<td>₹ <?php echo number_format($val['pg_amount'],2); ?></td>
											<td>
												<?php
													switch($val["status"]) {
														case 0:
														echo '<span>PENDING</span>';
														break;

														case 1:
														echo '<span>APPROVED</span>';
														break;

														case 2:
														echo '<span>REJECTED</span>';
														break;
													} 
												?>
											</td>
											<td>
												<?php
													switch($val["payment_status"]) {
														case 0:
														echo '<span>PENDING</span>';
														break;

														case 1:
														echo '<span>DONE</span>';
														break;
													} 
												?>
											</td>
											<td><?php echo date('d M, Y',strtotime($val['created_at'])); ?></td>
											<td>
												<?php
													if($val['status'] == 1 && $val["payment_status"] == 0) {
												?>
														<a class="btn btn-success btn-sm" href="javascript:make_payment(<?php echo $val['id']; ?>,'<?php echo number_format($val['pg_amount'],2); ?>','<?php echo $val['qrcode']; ?>');">Make Payment</a>
												<?php
													} 
												?>
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
<div class="modal" tabindex="-1" role="dialog" id="make-payment-modal">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
    		<form class="form-control" method="post" action="<?php echo base_url('make-payment'); ?>" enctype="multipart/form-data">
    			<input type="hidden" name="booking_id" id="booking_id" />
	      		<div class="modal-header">
	        		<h5 class="modal-title">Make Payment</h5>
	      		</div>
	      		<div class="modal-body">
	        		<div class="row">
	        			<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Amount</label>
								<input class="form-control" type="text" id="pg_amount" required disabled />
							</div>
						</div>
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Qrcode</label><br>
								<center><img src="" id="qrcode" class="img img-responsive img-thumbnail" style="width: 175px;height: 175px;" /></center>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Screenshot*</label>
								<input class="form-control" type="file" name="screenshot" required />
							</div>
						</div>
					</div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="submit" class="btn btn-primary">Apply</button>
	        		<a href="javascript:window.location.reload();" class="btn btn-secondary">Close</a>
	      		</div>
	      	</form>
    	</div>
  	</div>
</div>
<script type="text/javascript" src="<?php echo base_url('public/admin/js/plugins/jquery.dataTables.min.js'); ?>"></script>
<!-- <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script> -->
<script type="text/javascript">
	var page_title = "PG Bookings";
	$('#sampleTable').DataTable();
	function make_payment(booking_id,amount,qrcode)
	{
		$("#booking_id").val(booking_id);
		$("#pg_amount").val("₹ "+amount);
		$("#qrcode").attr("src",qrcode);
		$("#make-payment-modal").modal('show');	
	}
</script>
<?= $this->endSection(); ?>