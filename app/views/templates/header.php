<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Presensi</title>

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

			<hr class="sidebar-divider my-0">

			<?php if ($_SESSION['login'] == 'admin') : ?>
				<li class="nav-item active" id="dashboard">
					<a class="nav-link" href="<?= BASEURL ?>/Home">
						<i class="fas fa-fw fa-tachometer-alt"></i>
						<span>Dashboard</span></a>
				</li>

				<li class="nav-item" id="karyawan">
					<a class="nav-link" href="<?= BASEURL ?>/Employee">
						<i class="fas fa-users"></i>
						<span>Karyawan</span></a>
				</li>

				<!-- Nav Item - Utilities Collapse Menu -->
				<li class="nav-item" id="presensi">
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
						<i class="fas fa-fingerprint"></i>
						<span>Presensi</span>
					</a>
					<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
						<div class="bg-white py-2 collapse-inner rounded">
							<a class="collapse-item" id="attendance" href="<?= BASEURL ?>/Attendance">Presensi Hari ini</a>
							<a class="collapse-item" id="getAllAttendance" href="<?= BASEURL ?>/Attendance/getAllAttendance">Riwayat Presensi</a>
							<a class="collapse-item" id="getMonthlyAttendance" href="<?= BASEURL ?>/Attendance/getMonthlyAttendance">Presensi Bulanan</a>
						</div>
					</div>
				</li>
			<?php endif; ?>

			<?php if ($_SESSION['login'] != 'admin') : ?>
				<li class="nav-item active">
					<a class="nav-link" id="employee_with_name" href="<?= BASEURL ?>/Employee/name/<?php echo $_SESSION['employee_unique_number']; ?>">
						<i class="fas fa-fw fa-wrench"></i>
						<span>Presensi Hari ini</span>
					</a>
				</li>
			<?php endif; ?>
			<li class="nav-item" id="account">
				<a class="nav-link" href="<?= BASEURL ?>/Account">
					<i class="fas fa-lock"></i>
					<span>Ganti Password</span>
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?= BASEURL ?>/Logout">
					<i class="fas fa-sign-out-alt"></i>
					<span>Logout</span>
				</a>
			</li>
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

					</ul>

				</nav>