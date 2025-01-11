//Toggle class active
const navbarNav = document.querySelector(".navbar-nav");
//ketika menu di klik
document.querySelector("#menu").onclick = () => {
	navbarNav.classList.toggle("active");
};

//Klik di luar sidebar untuk menghilangkan nav
const menu = document.querySelector("#menu");

documen.addEventListener("click", function(e) {
	if (!menu.contains(e.target) && !navbarNav.contains(e.target)) {
	   navbarNav.classList.remove("active");
	}
});

