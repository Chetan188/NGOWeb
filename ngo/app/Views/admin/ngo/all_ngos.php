<?= $this->extend('admin/header'); ?>
<?= $this->section('main_content'); ?>
<style type="text/css">
	.bi-plus-square, .bi-pencil {
		margin-right: 0px !important;
	}
</style>
<div class="app-title">
	<div>
		<h1><i class="bi bi-house"></i> NGOs</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('all-ngos'); ?>">NGOs</a></li>
	</ul>
</div>
<div class="row">
	<?php
		if($ngos) {
			foreach($ngos as $ngo) {
	?>
				<div class="col-md-4">
					<div class="tile">
						<div class="tile-title-w-btn">
							<h3 class="title"><a href="<?php echo base_url('ngo-view/'.$ngo['id']); ?>"><?php echo $ngo['name']; ?></a></h3>
							<p>
								<!-- < ?php
									for($i = 1;$i <= 5; $i ++) {
										if(isset($pg["rate"]) && $i <= $pg["rate"])
											echo '<i class="bi bi-star-fill"></i>&nbsp;';
										else 
											echo '<i class="bi bi-star"></i>&nbsp;';	
									} 
								?> -->
							</p>
						</div>
						<div class="tile-body">
							<b><?php echo $ngo['city'].", ".$ngo["state"].", India."; ?></b><br>
							<table width="100%">
								<tbody>
									<tr>
										<td width="25%">Email</td>
										<td width="75%">: <?php echo $ngo['email']; ?></td>
									</tr>
									<tr>
										<td width="25%">Phone</td>
										<td width="75%">: <?php echo $ngo['phone']; ?></td>
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
	var page_title = "NGOs";	
</script>
<?= $this->endSection(); ?>