<?php  
// inisialisasi session
session_start();
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SHOPPING</title>

	<!-- fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">

<!-- feathericons -->
<script src="https://unpkg.com/feather-icons"></script>
<!-- css -->
<link rel="stylesheet" type="text/css" href="header.css">
<!-- Alpine js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<!-- app js -->
<script src="app.js" async=""></script>
<!-- midtrans -->
<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js"
      data-client-key="Mid-client-6KwLa1om_Nk2sg1s"></script>

</head>

<body>
	IKATAN PELAJAR AL-WASHLIYAH KOTA BINJAI

	<!-- navbar start -->
<nav class="navbar" x-data>
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
		<a href="#" id="shopping-cart-button">
			<i data-feather="shopping-cart"></i>
			<span class="quantity-badge" x-show="$store.cart.quantity" x-text="$store.cart.quantity"></span>
		</a>
		<a href="logout.php" id="login"> <i data-feather="log-in"></i></a>
		<a href="#" id="menu"> <i data-feather="menu"></i></a>
	</div>

	<!--SEARCH FORM START -->
	<div class="search-form">
		<input type="search" id= "search-box" placeholder="Cari disini....">
		<label for="search-box"><i data-feather="search"></i></label>
		
	</div>
	<!--- search form end -->

	<!-- SHOPPING CART START -->
	<div class="shopping-cart">

<template x-for="(item, belanja) in $store.cart.items" x-keys="belanja">
	<div class="cart-item">
			<img :src="item.img" :alt="item.name">
			<div class="item-detail">
				<h3 x-text="item.name"></h3>
				<div class="item-price">
					<span x-text="rupiah(item.price)"></span> &times;
					<button id="remove" @click="$store.cart.remove(item.id)">&minus;</button>
					<span x-text="item.quantity"></span>
					<button id="add" @click="$store.cart.add(item)">&plus;</button> &equals;
					<span x-text="rupiah(item.total)"></span>
				</div>
			</div>
	</div>
</template>
<h5 x-show="!$store.cart.items.length">Cart is Empety<br>Silahkan Pilih Barang Terlebih Dahulu yang ingin diBeli</h5>
<h4 x-show="$store.cart.items.length">Total : <span x-text="rupiah($store.cart.total)"></span></h4>

<!-- customer detail -->
		<div class="form-container" x-show="$store.cart.items.length">
			<div class="form-checkout">
			<form action="" id="checkoutForm">
				<input type="hidden" name="items" x-model="JSON.stringify($store.cart.items)">
				<input type="hidden" name="total" x-model="$store.cart.total">
				<h6>Customer Detail</h6>

				<label for="name">
					<span>Name</span>
					<input type="text" name="name" id="name">
				</label>

				<label for="email">
					<span>Email</span>
					<input type="email" name="email" id="email">
				</label>
				<label for="phone">
					<span>Phone</span>
					<input type="number" name="phone" id="phone" autocomplete="off">
				</label>

				<button class="checkout-button disabled" type="submit" id="checkout-button" value="checkout">Checkout</button>
			</form>
		</div>
		</div>
</div>

	<!-- SHOPPING CART END -->

</nav>
	<!-- navbar end -->



<!--  Section produk atribut -->

<section class="products" id="products" x-data="products">
		<h1>ATRIBUT <span> MADRASAH </span> LENGKAP</h1>
		<P>BELANJA ATRIBUT DAN PERLENGKAPAN KEBUTUHAN UNTUK PERGI KE MADRASAH SECARA ONLINE. TIDAK RIBET CUKUP BAYAR DARI RUMAH KEMUDIAN ANAK BISA LANGSUNG TES UKURAN DI MADRASAH.</P>

<!-- product 1 -->
		<div class="row">
			<template x-for="(item, belanja) in items" x-key="belanja">
			<div class="product-card">
				<div class="product-icons">

	<!-- icon keranjang -->
					<a href="#" @click.prevent="$store.cart.add(item)">
						<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round">
						<use href="img/feather-sprite.svg#shopping-cart" />
						</svg>
					</a>
	<!-- icon mata -->
					<a href="#" class="item-detail-button1">
						<svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round">
						<use href="img/feather-sprite.svg#eye" />
						</svg>
					</a>
				</div>

	<!-- gambar product -->
				<div class="product-image">
					<img :src="item.img" :alt="item.name">
				</div>

	<!-- nama product -->
				<div class="product-content">
					<h2 x-text="item.name"></h2>

	<!-- icon bintang -->
					<div class="product-star">
						<svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round">
						<use href="img/feather-sprite.svg#star" />
						</svg>

						<svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round">
						<use href="img/feather-sprite.svg#star" />
						</svg>

						<svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round">
						<use href="img/feather-sprite.svg#star" />
						</svg>

						<svg width="24" height="24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round">
						<use href="img/feather-sprite.svg#star" />
						</svg>

						<svg width="24" height="24" fill="gcolor" stroke="currentColor" stroke-width="2" stroke-linecap="round"
							stroke-linejoin="round">
						<use href="img/feather-sprite.svg#star" />
						</svg>
						
					</div>

	<!-- harga product -->
					<div class="product-price"><span x-text="rupiah(item.price)"></span></div>
				</div>
			</div>
			</template>


		</div>
	<!-- product 1 end -->



		<a href="https://forms.gle/HqTz9zYwLsFJjFFS6" class="service">CHEK OUT</a>
</section>

<!-- produk Section end -->

<!-- modal box item detail start -->
<div class="modal" id="item-detail-modal">
	<div class="modal-container">
		<a href="#" class="close-icon"><i data-feather="x-circle"></i></a>
		<div class="modal-content">
			<img src="product 1.jpg" alt="product 1">
			<div class="product-content">
				<h2>SERAGAM PUTIH HIJAU</h2>
				<p> seragam dengan kain berkualitas premium dari bahan kain katun, tidak mudah kuning dan sangat cocok untuk pemakaian 3 tahun, bahan elasatis karena terbuat dari benang woll, yang menambah ketahanan baju agar tidak mudah robek, bahan kualitas premium harga ekonomi menengah kebawah, buruan chaek out sebelum kehabisan.</p>
				<div class="product-star">
						<i data-feather="star" class="rate"></i>
						<i data-feather="star" class="rate"></i>
						<i data-feather="star" class="rate"></i>
						<i data-feather="star" class=""></i>
						<i data-feather="star" class=""></i>
					</div>
					<div class="product-price">IDR 243.000 /<span> IDR 350.000</span></div>
					<a href="#"><i data-feather="shopping-cart"></i> <span>Tambah ke Keranjang</span></a>
			</div>
		</div>
	</div>
</div>
<!-- modal box item detail end -->


 <!-- feathericons -->
<script>
      feather.replace();
</script>

<!-- My Javascript -->
<script src="header.js"></script>

</body>
</html>