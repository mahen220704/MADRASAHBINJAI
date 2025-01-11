<?php  
// inisialisasi session
session_start();
include "koneksi.php";

//mengecek apakah ada session login yang aktif, jika tidak arahkan ke login.php
if (!isset($_SESSION['login'])) {
	header('location:login.php');//arahkan ke login.php
}
if(!isset($_SESSION['admin_akses'])) {
	header('location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MADRASAH KITA</title>

	<!-- fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">

<!-- feathericons -->
<script src="https://unpkg.com/feather-icons"></script>

<link rel="stylesheet" type="text/css" href="header.css">
</head>

<body>
	IKATAN PELAJAR AL-WASHLIYAH KOTA BINJAI

	<!-- navbar start -->
<nav class="navbar">
	<div class="navbar-logo">MADRASAH<span> HEBAT</span>
		<p><span>BERMAR</span>TABAT.</p></div>

<div class="navbar-nav">
		

<!-- navbar admin -->
		<?php if(in_array("admin", $_SESSION['admin_akses'])){ ?>
		<a href="admin.php">ADMIN</a>
		
	<?php } ?>
	
	<a href="home.php">HOME</a>
		<a href="siswa.php">SISWA</a>
		<a href="pembayaran.php">PEMBAYARAN</a>


<!-- navbar guru -->
	<?php if(in_array("guru", $_SESSION['admin_akses'])){ ?>
		<a href="guru.php">GURU</a>
		
	<?php } ?>

<!-- navbar siswa -->
	<?php if(in_array("siswa", $_SESSION['admin_akses'])){ ?>
		
	<?php } ?>
	<a href="belanja.php">BELANJA</a>

	</div>

	<div class="navbar-extra">
		<a href="#" id="search-button"> <i data-feather="search"></i></a>
		<a href="belanja.php" id="shopping-cart"> <i data-feather="shopping-cart"></i></a>
		<a href="logout.php" id="login"> <i data-feather="log-in"></i></a>
		<a href="#" id="menu"> <i data-feather="menu"></i></a>
	</div>

	<!--SEARCH FORM START -->
	<div class="search-form">
		<input type="search" id= "search-box" placeholder="Cari disini....">
		<label for="search-box"><i data-feather="search"></i></label>
		
	</div>
</nav>
	<!-- navbar end -->


<!-- feathericons -->
<script>
      feather.replace();
</script>

<!-- My Javascript -->
<script src="header.js"></script>

