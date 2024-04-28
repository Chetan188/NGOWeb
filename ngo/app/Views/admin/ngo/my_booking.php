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
		<h1><i class="bi bi-house"></i> Bookings</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('my-pg-bookings'); ?>">Bookings</a></li>
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
								<th width="25%">Requested By</th>
								<th width="10%">Amount</th>
								<th width="10%">Status</th>
								<th width="15%">Payment Status</th>
								<th width="15%">Created At</th>
								<th width="20%">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($bookings) {
									foreach($bookings as $key => $val) {
							?>
										<tr>
											<td><?php echo $key+1; ?></td>
											<td><?php echo $val['requested_by']; ?></td>
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
												<a class="btn btn-sm btn-info" href="javascript:;" onclick="watch_docs(<?php echo $val['id']; ?>)"><i class="bi bi-eye"></i></a>
												<?php
													if($val['status'] == 0 && $val["payment_status"] == 0) {
												?>
														<a class="btn btn-success btn-sm" href="<?php echo base_url('approve-pg-request/'.$val['id']); ?>">Approve</a>
														<a class="btn btn-danger btn-sm" href="<?php echo base_url('reject-pg-request/'.$val['id']); ?>">Reject</a>
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
<div class="modal" tabindex="-1" role="dialog" id="watch-docs-modal">
  	<div class="modal-dialog modal-lg" role="document">
    	<div class="modal-content">
    		<form class="form-control" method="post" action="<?php echo base_url('make-payment'); ?>" enctype="multipart/form-data">
	      		<div class="modal-header">
	        		<h5 class="modal-title">Documents</h5>
	      		</div>
	      		<div class="modal-body">
	        		
	      		</div>
	      		<div class="modal-footer">
	        		<a href="javascript:window.location.reload();" class="btn btn-secondary">Close</a>
	      		</div>
	      	</form>
    	</div>
  	</div>
</div>
<script type="text/javascript" src="<?php echo base_url('public/admin/js/plugins/jquery.dataTables.min.js'); ?>"></script>
<!-- <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script> -->
<script type="text/javascript">
	var page_title = "Bookings";
	$('#sampleTable').DataTable();
	function watch_docs(booking_id)
	{
		$.ajax({
			url: "<?php echo base_url('watch-pg-docs'); ?>",
			type: "post",
			data:{
				booking_id: booking_id
			},
			dataType: "json",
			success:function(response){
				var content = "";
				content += '<div class="row">';
				if(response.photos.length > 0) {
					for(var i = 0; i < response.photos.length; i ++) {
						content += '<div class="col-lg-4">';
						content += '<center>';
						content += '<img src="'+response.photos[i].avatar+'" style="width: 175px;height: 175px;" class="img img-thumbnail img-responsive" /><br><br>';
						content += '<center>';
						content += '</div>';
					}
				}
				content += '</div>';
				$("#watch-docs-modal .modal-body").html(content);
				$("#watch-docs-modal").modal('show');
			}
		});
	}
</script>
<?= $this->endSection(); ?>