<?= $this->extend('admin/header'); ?>
<?= $this->section('main_content'); ?>
<div class="app-title">
	<div>
		<h1><i class="bi bi-speedometer"></i> Dashboard</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">Dashboard</a></li>
	</ul>
</div>
<div class="row">
	<div class="col-md-6 col-lg-4">
		<div class="widget-small primary coloured-icon"><i class="icon bi bi-house fs-1"></i>
			<div class="info">
				<h4>Total NGO<small>s</small></h4>
				<p><b><?php echo $total_ngos; ?></b></p>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-4">
		<div class="widget-small primary coloured-icon"><i class="icon bi bi-house fs-1"></i>
			<div class="info">
				<h4>Today Payments</h4>
				<p><b>₹ <?php echo $today_payments; ?></b></p>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-4">
		<div class="widget-small primary coloured-icon"><i class="icon bi bi-house fs-1"></i>
			<div class="info">
				<h4>Total Payments</h4>
				<p><b>₹ <?php echo $total_payments; ?></b></p>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var page_title = "Dashboard";
</script>
<?= $this->endSection(); ?>