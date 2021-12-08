<?php
if (!isset($_SESSION["login"])) {
	header('location: ' . BASEURL . '/login');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SB Admin 2 - Dashboard</title>

	<!-- Custom fonts for this template-->
	<link href="<?= BASEURL ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?= BASEURL ?>/css/sb-admin-2.min.css" rel="stylesheet">

	<!-- Bootstrap core JavaScript-->
	<script src="<?= BASEURL ?>/vendor/jquery/jquery.min.js"></script>
	<script src="<?= BASEURL ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
				<div class="sidebar-brand-text mx-3">Attendance App</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<?php if ($_SESSION['login'] == 'admin') : ?>
				<!-- Nav Item - Dashboard -->
				<li class="nav-item active">
					<a class="nav-link" href="<?= BASEURL ?>/Home">
						<i class="fas fa-fw fa-tachometer-alt"></i>
						<span>Dashboard</span></a>
				</li>

				<!-- Divider -->
				<!-- <hr class="sidebar-divider"> -->

				<!-- Heading -->
				<!-- <div class="sidebar-heading">
				Interface
			</div> -->

				<!-- Nav Item - Pages Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
						<i class="fas fa-fw fa-cog"></i>
						<span>Karyawan</span>
					</a>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<!-- <h6 class="collapse-header">Custom Components:</h6> -->
							<a class="collapse-item" href="<?= BASEURL ?>/employee/add_employee">Tambah Karyawan</a>
							<a class="collapse-item" href="<?= BASEURL ?>/employee">Data Karyawan</a>
						</div>
					</div>
				</li>

				<!-- Nav Item - Utilities Collapse Menu -->
				<li class="nav-item">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
						<i class="fas fa-fw fa-wrench"></i>
						<span>Presensi</span>
					</a>
					<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<!-- <h6 class="collapse-header">Custom Utilities:</h6> -->
							<a class="collapse-item" href="<?= BASEURL ?>/Attendance">Presensi Hari ini</a>
							<a class="collapse-item" href="<?= BASEURL ?>/Attendance/getAllAttendance">Riwayat Presensi</a>
							<a class="collapse-item" href="<?= BASEURL ?>/Attendance/getMonthlyAttendance">Presensi Bulanan</a>
						</div>
					</div>
				</li>
			<?php endif; ?>

			<?php if ($_SESSION['login'] != 'admin') : ?>
				<li class="nav-item active">
					<a class="nav-link" href="<?= BASEURL ?>/Employee/name/gonzales">
						<i class="fas fa-fw fa-wrench"></i>
						<span>Presensi Hari ini</span>
					</a>
				</li>
			<?php endif; ?>
			<li class="nav-item">
				<a class="nav-link" href="<?= BASEURL ?>/Account">
					<i class="fas fa-fw fa-wrench"></i>
					<span>Ganti Password</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?= BASEURL ?>/Logout">
					<i class="fas fa-fw fa-wrench"></i>
					<span>Logout</span>
				</a>
			</li>

			<!-- Divider -->
			<!-- <hr class="sidebar-divider"> -->

			<!-- Heading -->
			<!-- <div class="sidebar-heading">
				Addons
			</div> -->

			<!-- Nav Item - Pages Collapse Menu -->
			<!-- <li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
					<i class="fas fa-fw fa-folder"></i>
					<span>Pages</span>
				</a>
				<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Login Screens:</h6>
						<a class="collapse-item" href="login.html">Login</a>
						<a class="collapse-item" href="register.html">Register</a>
						<a class="collapse-item" href="forgot-password.html">Forgot Password</a>
						<div class="collapse-divider"></div>
						<h6 class="collapse-header">Other Pages:</h6>
						<a class="collapse-item" href="404.html">404 Page</a>
						<a class="collapse-item" href="blank.html">Blank Page</a>
					</div>
				</div>
			</li> -->

			<!-- Nav Item - Charts -->
			<!-- <li class="nav-item">
				<a class="nav-link" href="charts.html">
					<i class="fas fa-fw fa-chart-area"></i>
					<span>Charts</span></a>
			</li> -->

			<!-- Nav Item - Tables -->
			<!-- <li class="nav-item">
				<a class="nav-link" href="tables.html">
					<i class="fas fa-fw fa-table"></i>
					<span>Tables</span></a>
			</li> -->

			<!-- Divider -->
			<!-- <hr class="sidebar-divider d-none d-md-block"> -->



		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<!-- <div class="topbar-divider d-none d-sm-block"></div> -->

						<!-- Nav Item - User Information -->
						<!-- <li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
								<img class="img-profile rounded-circle" src="img/undraw_profile.svg">
							</a> -->
						<!-- Dropdown - User Information -->
						<!-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="#">
									<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
									Profile
								</a>
								<a class="dropdown-item" href="#">
									<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
									Settings
								</a>
								<a class="dropdown-item" href="#">
									<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
									Activity Log
								</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li> -->

					</ul>

				</nav>