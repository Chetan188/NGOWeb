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
		<h1><i class="bi bi-house"></i> <?php echo $menu_title; ?></h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('ngo-payments'); ?>"><?php echo $menu_title; ?></a></li>
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
								<th>NGO</th>
								<th>Donor</th>
								<th width="15%">Amount</th>
								<th width="15%">Paid On</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($payments) {
									foreach($payments as $key => $val) {
							?>
										<tr>
											<td><?php echo $key+1; ?></td>
											<td><?php echo $val['ngo']; ?></td>
											<td><?php echo $val['donor']; ?></td>
											<td>₹ <?php echo number_format($val['amount'],2); ?></td>
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
<script type="text/javascript" src="<?php echo base_url('public/admin/js/plugins/jquery.dataTables.min.js'); ?>"></script>
<!-- <script type="text/javascript" src="js/plugins/dataTables.bootstrap.min.js"></script> -->
<script type="text/javascript">
	var page_title = "<?php echo $menu_title; ?>";
	$('#sampleTable').DataTable();
</script>
<?= $this->endSection(); ?>