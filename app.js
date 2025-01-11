document.addEventListener('alpine:init', () => {
  Alpine.data('products', () => ({

    items: [
    	{ id: 1, name: 'Uang bulanan', img: 'spp.jpg', price: 50000 },
    	{ id: 2, name: 'Uang Ujian UTS', img: 'uts.jpg', price: 100000 },
    	{ id: 3, name: 'Uang Ujian UAS', img: 'uas.jpg', price: 150000 },
    	{ id: 4, name: 'Seragam Putih Hijau', img: 'product 1.jpg', price: 243000 },
    	{ id: 5, name: 'Seragam Merah Putih', img: 'product 2.jpg', price: 232000 },
    	{ id: 6, name: 'Pulpen', img: 'product 3.jpg', price: 3000 },
    	{ id: 7, name: 'Pensil', img: 'product 4.jpg', price: 2000 },
    	{ id: 8, name: 'Simbol Sekolah 1 Set', img: 'product 5.png', price: 24000 },
    ],
  }));

  Alpine.store('cart', {
  	items: [],
  	total: 0,
  	quantity: 0,

  	//tombol nambah item
  	add(newItem) {
  	// cek apakah ada barang yang sama di cart
  	const cartItem = this.items.find((item) => item.id === newItem.id);

  	// jika belum ada atau cart masih kosong
  	if(!cartItem){
  		this.items.push({ ...newItem, quantity: 1, total: newItem.price });
  		this.quantity++;
  		this.total += newItem.price;

  	} else{
  		//jika barang sudah ada, cek apakah barang beda atau sama dengan yang ada di cart
  		this.items = this.items.map((item) => {
  			//jika barang berbeda
  			if(item.id !== newItem.id) {
  				return item;
  			} else{
  				//jika barang sama atau sudah ada, maka tambah jumlah barang dan totalnya
  				item.quantity++;
  				item.total = item.price * item.quantity;
  				this.quantity++;
  				this.total += item.price;
  				return item;

  			}
  		});
  	}
  	},

  	//kurangin barang atau remove item
  	remove(id) {
  		const cartItem = this.items.find((item) => item.id === id);

  		//jika barang lebih dari 1
  		if(cartItem.quantity > 1) {
  			// telusuri 1 per 1
  			this.items = this.items.map((item) =>{
  				// jika bukan barang yang di klik
  				if (item.id !== id) {
  					return item;
  				} else{
  					item.quantity--;
  					item.total = item.price * item.quantity;
  					this.quantity--;
  					this.total -= item.price;
  					return item;
  				}
  			});
  		} else if (cartItem.quantity === 1) {
  		//jika barang sisa 1
  		this.items = this.items.filter((item) => item.id !== id);
  		this.quantity--;
  		this.total -= cartItem.price;
  		}
  	},

  });
});

//FORM VALIDASI CHECKOUT
const checkoutButton = document.querySelector('.checkout-button');
checkoutButton.disabled = true;

const form = document.querySelector('#checkoutForm');

form.addEventListener('keyup', function(){
	for(let i = 0; i < form.elements.length; i++) {
		if(form.elements[i].value.length !== 0) {
			checkoutButton.classList.remove('disabled');
			checkoutButton.classList.add('disabled');
		} else{
			return false;
		}
	}
	checkoutButton.disabled = false;
	checkoutButton.classList.remove('disabled');
});

//kirim data ketika tombol checkout di klik
checkoutButton.addEventListener('click', async function(e) {
	e.preventDefault();
	const formData = new FormData(form);
	const data = new URLSearchParams(formData);
	const objData = Object.fromEntries(data);

// jika menggunakan melalui wa pakai codingan bawah ini:
	//const message = formatMessage(objData);
	//window.open('http://wa.me/6289519110957?text=' + encodeURIComponent(message));

//jika pakai web langsung transaksiny maka pakai codingan di bawah ini:

	//minta transaction token menggunakan ajax / fetch
	try {
		const response = await fetch('php/placeOrder.php', {
			method: 'POST',
			body: data,
		});
		const token = await response.text();
		//console.log(token);
			window.snap.pay('token');
	} catch(err) {
		console.log(err.message);
	}

});

// format pesan whatsapp
const formatMessage = (obj) => {
	return `Data Customer :
	Nama: ${obj.name}
	Email: ${obj.email}
	No HP: ${obj.phone}
Data Pesanan :
	${JSON.parse(obj.items).map((item) => 
	`${item.name} (${item.quantity} x ${rupiah(item.total)}) \n`)}
TOTAL : ${rupiah(obj.total)}
TERIMA KASIH.`;
};

// konversi mata uang
const rupiah = (number) => {
	return new  Intl.NumberFormat('id-ID',{
	style : 'currency',
	currency: 'IDR',
	minimumFractionDigits: 0
	}).format(number);
};