<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/admin/css/main.css'); ?>">
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
		<title><?php echo APP_NAME; ?></title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300&display=swap" rel="stylesheet">
        <style>
            .app-menu span, h1, h4, h5, .app-breadcrumb li, a {
                font-family: 'Readex Pro', sans-serif !important;
            }
            .app-header__logo, .app-header, .widget-small.primary.coloured-icon .icon {
				background-color: #f0394d !important;
			}
			.app-menu__item.active {
				border-left-color: #f0394d;
			}
			.app-menu__item:hover {
				border-left-color: #f0394d;
			}
			.btn-primary {
				background-color: #f0394d !important;
				border-color: #f0394d !important;
			}
			#newbtn {
				float: right;
			}
			.text-green {
				font-weight: bold;
				background-color: #007500;
				padding: 5px;
				border-radius: 5px;
				color: #FFFFFF;
			}
			.text-red {
				font-weight: bold;
				background-color: #FF0000;
				padding: 5px;
				border-radius: 5px;
				color: #FFFFFF;
			}
			.font-red {
				color: #FF0000;
			}
			.bi-plus, .bi-trash, .bi-pencil, .bi-image, .bi-eye, .bi-check {
				margin-right: 0px !important;
			}
        </style>
        <script src="<?php echo base_url('public/admin/js/jquery-3.7.0.min.js'); ?>"></script>
	</head>
	<?php 
		$session = session();
		$userdata = $session->get('userdata');
	?>
	<body class="app sidebar-mini">
		<header class="app-header">
			<a class="app-header__logo" href="index.html"><?php echo APP_NAME; ?></a>
			<a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
			<ul class="app-nav">
				<li class="dropdown">
					<a class="app-nav__item" href="#" data-bs-toggle="dropdown" aria-label="Open Profile Menu">
						<i class="bi bi-person fs-4"></i>
					</a>
					<ul class="dropdown-menu settings-menu dropdown-menu-right">
						<li>
							<a class="dropdown-item" href="<?php echo base_url('profile'); ?>">
								<i class="bi bi-people me-2 fs-5"></i> My Profile
							</a>
						</li>
						<li>
							<a class="dropdown-item" href="<?php echo base_url('delete-account'); ?>" onclick="return delete_account()">
								<i class="bi bi-trash me-2 fs-5"></i> Delete Account
							</a>
						</li>
						<li>
							<a class="dropdown-item" href="<?php echo base_url('logout'); ?>">
								<i class="bi bi-gear me-2 fs-5"></i> Logout
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</header>
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar">
			<div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="User Image">
				<div>
					<p class="app-sidebar__user-name"><?php echo $userdata['name']; ?></p>
					<p class="app-sidebar__user-designation"><?php echo $userdata['phone']; ?></p>
				</div>
			</div>
			<ul class="app-menu" id="app-menu">
				<li>
					<a class="app-menu__item" href="<?php echo base_url('dashboard'); ?>">
						<i class="app-menu__icon bi bi-speedometer"></i>
						<span class="app-menu__label">Dashboard</span>
					</a>
				</li>
				<?php
					if($userdata['role'] == 1) {
				?>
						<li>
							<a class="app-menu__item" href="<?php echo base_url('all-ngos'); ?>">
								<i class="app-menu__icon bi bi-people"></i>
								<span class="app-menu__label">NGO<small>s</small></span>
							</a>
						</li>
				<?php
					} else if($userdata['role'] == 2) {
				?>
						<li>
							<a class="app-menu__item" href="<?php echo base_url('ngos'); ?>">
								<i class="app-menu__icon bi bi-house"></i>
								<span class="app-menu__label">NGOs</span>
							</a>
						</li>
						<li>
							<a class="app-menu__item" href="<?php echo base_url('ngo-payments'); ?>">
								<i class="app-menu__icon bi bi-house"></i>
								<span class="app-menu__label">Payments</span>
							</a>
						</li>
				<?php
					} else if($userdata['role'] == 3) {
				?>
						<li class="treeview">
							<a class="app-menu__item" href="#" data-toggle="treeview">
								<i class="app-menu__icon bi bi-laptop"></i>
								<span class="app-menu__label">NGOs</span>
								<i class="treeview-indicator bi bi-chevron-right"></i>
							</a>
							<ul class="treeview-menu">
								<li>
									<a class="treeview-item" href="<?php echo base_url('pending-ngos'); ?>">
										<i class="icon bi bi-circle-fill"></i> Pending NGOs
									</a>
								</li>
								<li>
									<a class="treeview-item" href="<?php echo base_url('ngos'); ?>">
										<i class="icon bi bi-circle-fill"></i> All NGOs
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a class="app-menu__item" href="<?php echo base_url('users'); ?>">
								<i class="app-menu__icon bi bi-people"></i>
								<span class="app-menu__label">Users</span>
							</a>
						</li>
						<li>
							<a class="app-menu__item" href="<?php echo base_url('transactions'); ?>">
								<i class="app-menu__icon bi bi-house"></i>
								<span class="app-menu__label">Transactions</span>
							</a>
						</li>
				<?php
					} else {
				?>
						<li>
							<a class="app-menu__item" href="<?php echo base_url('pg-list'); ?>">
								<i class="app-menu__icon bi bi-house"></i>
								<span class="app-menu__label">PGs</span>
							</a>
						</li>
						<li>
							<a class="app-menu__item" href="<?php echo base_url('mess-list'); ?>">
								<i class="app-menu__icon bi bi-house"></i>
								<span class="app-menu__label">Messes</span>
							</a>
						</li>
						<li>
							<a class="app-menu__item" href="<?php echo base_url('pg-bookings'); ?>">
								<i class="app-menu__icon bi bi-house"></i>
								<span class="app-menu__label">PG Bookings</span>
							</a>
						</li>
						<li>
							<a class="app-menu__item" href="<?php echo base_url('mess-bookings'); ?>">
								<i class="app-menu__icon bi bi-house"></i>
								<span class="app-menu__label">Mess Bookings</span>
							</a>
						</li>
				<?php
					}
				?>
			</ul>
		</aside>
		<main class="app-content">
			<?= $this->renderSection('main_content'); ?>
		</main>
		<script src="<?php echo base_url('public/admin/js/bootstrap.min.js'); ?>"></script>
		<script src="<?php echo base_url('public/admin/js/main.js'); ?>"></script>
		<script type="text/javascript">
			// var page_title = "";
			$(document).ready(function(){
				$("#app-menu li").each(function(){
					if($.trim($(this).find("span").text()) == page_title) {
						$(this).find("a").addClass("active");
					}
				});
			});
			function delete_account()
			{
				if(confirm("Are you sure to delete this account?")){
					return true;
				} else {
					return false;
				}
			}
			function remove_row(ajax_url,no)
			{
				if(confirm("Are you sure to remove this row?")) {
					$.ajax({
			            url: ajax_url,
			            type: "post",
			            data:{
			                "_method": "delete"
			            },
			            dataType: "json",
			            success:function(response){
			                if(response.status == 200) {
			                	$("#row-"+no).remove();
			                }
			            }
			        });
				}
			}
		</script>
	</body>
</html>