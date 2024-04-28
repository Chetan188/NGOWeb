<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/main.css'); ?>">
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
		<title><?php echo APP_NAME; ?></title>
		<style>
			.cover {
				background: #f0394d !important;
			}
			.btn-primary {
				background-color: #f0394d !important;
				border-color: #f0394d !important;
			}
			input:focus {
				border-color: #f0394d !important;
			}
		</style>
	</head>
	<body>
		<section class="material-half-bg">
			<div class="cover"></div>
		</section>
		<section class="login-content">
			<div class="logo">
				<h1><?php echo APP_NAME; ?></h1>
			</div>
			<div class="login-box">
				<form class="login-form" action="<?php echo base_url('submitSignIn'); ?>" method="post">
					<input type="hidden" name="role" value="<?php echo $role; ?>" />
					<div class="row">
						<div class="col-md-12">
							<div class="tile">
								<h4><a href="<?php echo base_url('ngo-sign-in'); ?>">NGO</a></h4>
							</div>
						</div>
						<div class="col-md-12">
							<div class="tile">
								<h4><a href="<?php echo base_url('donor-sign-in'); ?>">DONOR</a></h4>
							</div>
						</div>
					</div>
					<!-- <h3 class="login-head">< ?php echo $page_title; ?></h3> -->
					<!-- <div class="mb-3">
						<label class="form-label">EMAIL</label>
						<input class="form-control" type="email" name="email" autofocus />
					</div>
					<div class="mb-3">
						<label class="form-label">PASSWORD</label>
						<input class="form-control" type="password" name="password" />
					</div> -->
					<!-- <div class="mb-3">
						<div class="utility">
							
						</div>
					</div>
					<div class="mb-3 btn-container d-grid">
						<button class="btn btn-primary btn-block">
							<i class="bi bi-box-arrow-in-right me-2 fs-5"></i>SIGN IN
						</button>
					</div> -->
					<?php
						if($role != 1) { 
					?>
							<center>
								<p>Don't have an account? 
									<a href="<?php echo base_url('sign-up/'.$role); ?>">Make Now!</a>
								</p>
							</center>
					<?php 
						}
						$session = session();
						if($session->getFlashData('error'))
							echo '<span style="color: #FF0000;"><center>'.$session->getFlashData('error').'</center></span>';
					?>
				</form>
			</div>
		</section>
		<script src="<?php echo base_url('public/admin/js/jquery-3.7.0.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/admin/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/admin/js/main.js'); ?>"></script>
		<script type="text/javascript">
		</script>
	</body>
</html>