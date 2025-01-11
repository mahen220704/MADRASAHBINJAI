<?php
 include "header.php";
 if (!in_array("guru", $_SESSION['admin_akses'])) {
		echo '<script>alert("kamu tidak sopan, belum ada izin");</script>';
		header('location:login.php');
	include "footer.php";
	exit();
 }
 ?>
 <!-- Hero Section start -->
<section class="products" id="home">
	<main class="content">
		<h1>SELAMAT DATANG <br><span> GURU HEBAT</span>.</br></h1>
		<P>Lakukan pengecekan data pembayaran siswa agar gajimu bisa keluar bulan ini....</P>
		<a href="https://forms.gle/HqTz9zYwLsFJjFFS6" class="service">CEK SEKARANG</a>
	</main>
</section>
<!-- Hero Section end -->

 <?php
 include "footer.php";
 ?>