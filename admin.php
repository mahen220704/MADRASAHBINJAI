<?php
 include "header.php";
 if (!in_array("admin", $_SESSION['admin_akses'])) {
		echo '<script>alert("kamu tidak sopan, belum ada izin");</script>';
		header('location:login.php');
	include "footer.php";
	exit();
 }
 ?>
 <!-- Hero Section start -->
<section class="hero" id="home">
	<main class="content">
		<h1>SELAMAT DATANG ADMIND <br><span>SEMANGAT </span>KERJANYA.</br>Malas auto <span>PECAT </span>.</h1>
		<P>Ga usah galau galau, tugasmu hanya membahagiakan bukan menikmati.</P>
		<a href="https://forms.gle/HqTz9zYwLsFJjFFS6" class="service">MULAI KERJA</a>
	</main>
</section>
<!-- Hero Section end -->

 <?php
 include "footer.php";
 ?>