<div class="navigation">
	<div class="left">
		<img src="assets/logo.png" style="height: calc(100% - 10px); width: auto; margin-top: 5px; margin-left: 20px;
				backdrop-filter: drop-shadow(0 5px 20px black);" />
		<div class="left-title">BARANGGAY LECHERIA</div>
	</div>
	<div class="right">
		<a class="navigation-link" href="dashboard.php?on=home">HOME</a>
		<!-- <a class="navigation-link" href="dashboard.php?on=about">ABOUT</a> -->
		<a class="navigation-link" href="dashboard.php?on=service">SERVICES</a>
		<a class="navigation-link" href="dashboard.php?on=allOrder">ORDERS</a>
		<!-- <a class="navigation-link" href="dashboard.php?on=profile">PROFILE</a> -->
		<a class="navigation-link" href="registration.php">LOGOUT</a>

		<img class="profile-pic" src="">
	</div>
</div>

<script>
	function getURLParameter(name) {
		const urlParams = new URLSearchParams(window.location.search);
		return urlParams.get(name);
	}

	const activeParam = getURLParameter('on');
	const links = document.querySelectorAll('.navigation-link');

	links.forEach(link => {
		const hrefParam = new URL(link.href).searchParams.get('on');

		if (hrefParam && hrefParam === activeParam) {
			link.classList.add('active');
			link.setAttribute('aria-current', 'page');
		}
	});

	document.querySelector('.navigation-link.active')?.addEventListener('click', function (e) {
		e.preventDefault();
	});

</script>