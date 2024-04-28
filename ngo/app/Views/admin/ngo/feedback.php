<?= $this->extend('admin/header'); ?>
<?= $this->section('main_content'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-1.13.4/datatables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
	.bi-trash, .bi-pencil {
		margin-right: 0px !important;
	}
</style>
<div class="app-title">
	<div>
		<h1><i class="bi bi-house"></i> Feedbacks</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('pg-feedbacks'); ?>">Feedbacks</a></li>
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
								<th width="25%">Rate</th>
								<th width="10%">Comment</th>
								<th width="10%">Given by</th>
								<th width="15%">Created At</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($feedbacks) {
									foreach($feedbacks as $key => $val) {
							?>
										<tr>
											<td><?php echo $key+1; ?></td>
											<td>
												<?php
													for($i = 1;$i <= 5; $i ++) {
														if($i <= $val["rate"])
															echo '<i class="bi bi-star-fill"></i>&nbsp;';
														else 
															echo '<i class="bi bi-star"></i>&nbsp;';	
													} 
												?>
											</td>
											<td><?php echo $val['comment']; ?></td>
											<td><?php echo $val['commented_by']; ?></td>
											<td><?php echo date('d M, Y',strtotime($val['created_at'])); ?></td>
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
	var page_title = "Feedbacks";
	$('#sampleTable').DataTable();
</script>
<?= $this->endSection(); ?>