<?= $this->extend('admin/header'); ?>
<?= $this->section('main_content'); ?>
<style type="text/css">
	.bi-plus-square, .bi-pencil {
		margin-right: 0px !important;
	}
</style>
<div class="app-title">
	<div>
		<h1><i class="bi bi-house"></i> PGs</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('pg-list'); ?>">PGs</a></li>
	</ul>
</div>
<div class="row">
	<?php
		if($pgs) {
			foreach($pgs as $pg) {
	?>
				<div class="col-md-6">
					<div class="tile">
						<div class="tile-title-w-btn">
							<h3 class="title"><a href="<?php echo base_url('pg-view/'.$pg['id']); ?>"><?php echo $pg['name']; ?></a></h3>
							<p>
								<?php
									for($i = 1;$i <= 5; $i ++) {
										if(isset($pg["rate"]) && $i <= $pg["rate"])
											echo '<i class="bi bi-star-fill"></i>&nbsp;';
										else 
											echo '<i class="bi bi-star"></i>&nbsp;';	
									} 
								?>
							</p>
						</div>
						<div class="tile-body">
							<b><?php echo $pg['city'].", ".$pg["state"].", ".$pg["country"]; ?></b><br>
							<table width="100%">
								<tbody>
									<tr>
										<td width="30%">Contact Person Email</td>
										<td>: <?php echo $pg['email']; ?></td>
									</tr>
									<tr>
										<td width="30%">Contact Person Phone</td>
										<td>: <?php echo $pg['phone']; ?></td>
									</tr>
									<tr>
										<td width="30%">Monthly Rent</td>
										<td>: ₹ <?php echo number_format($pg['rent'],2); ?></td>
									</tr>
									<tr>
										<td>Total Capacity</td>
										<td>: <?php echo $pg['capacity']; ?> Persons</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- <div class="clearfix"></div> -->
	<?php
			}
		} 
	?>
</div>
<script type="text/javascript">
	var page_title = "PGs";	
</script>
<?= $this->endSection(); ?>