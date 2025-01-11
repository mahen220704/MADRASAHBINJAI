<?php
session_start();
include "koneksi.php";
		if(isset($_POST['login'])) {
			$username = $_POST['username'];
			$password = md5($_POST['password']);

			$query = mysqli_query ($koneksi, "select * from admin where username = '$username' and password = '$password'");
 
			if(mysqli_num_rows($query)>0){
				$data = mysqli_fetch_array($query);
				$_SESSION['login'] = $data;
				echo '<script>alert("Selamat datang, '.$data['username'].'"); location.href="home.php";</script>';
			}else{

				echo '<script>alert("username/password tidak sesuai");</script>';
			}
	

			if(mysqli_num_rows($query)>0){
				$login_id = $data['login_id'];
				$query = mysqli_query ($koneksi, "select * from admin_akses where login_id = '$login_id'");
				while ($data = mysqli_fetch_array($query)){
					$akses[] = $data['akses_id'];//pembayaran, guru, siswa
					$_SESSION['admin_akses'] = $akses;
					echo '<script>alert("kamu di izinkan masuk tampilan ini");<script>';
				}
			}else{
					echo '<script>alert("kamu tidak memiliki izin"); location.href="login.php";</script>';
				}

		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="widht=device-widht, initial-scale=1.0">
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>

	<div id="form" class="wrapper">
		<h1>MASUK</h1>
		<h2>IKATAN PELAJAR AL-WASHLIYAH</h2>
		<h3>Assalamu'alaikum..</h3>


		<form action="" method="post">
			<div class="input-box">
			<input type="text" name="username" class="input" placeholder="Isi Username anda" required>
		</div>
		<div class="input-box">
			<input type="password" name="password" class="input" placeholder="Isi Password anda" required>
		</div>
			<input type="submit" name="login" value="Masuk Ke Sistem" class="btn"/>
		</form>
	</div>

</body>
</html>