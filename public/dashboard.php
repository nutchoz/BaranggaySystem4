<?php
require_once("../includes/initialize.php");

$session = new Session();
if (!$session->has('isLoggedIn') || $session->get('isLoggedIn') !== 'true') {
	redirect_to('registration.php');
}
?>
<?php createHeader("", [
	"css/main",
	"css/dashboard",
	"css/navigation",
	"css/home",
	"css/service",
	"css/about",
	"css/bottom",
	"css/modal"
]); ?>

<?php
require_once("modals/modals.php");
require_once("modals/service_modal.php");

if (isset($_SESSION['success'])) {
	echo "<script>showSuccessModal('{$_SESSION['success']}');</script>";
	unset($_SESSION['success']);
} elseif (isset($_SESSION['error'])) {
	echo "<script>showErrorModal('{$_SESSION['error']}');</script>";
	unset($_SESSION['error']);
}
?>

<body>
	<div class="main-container">
		<?php include_layout_template("layouts/navigation.php") ?>

		<?php
		$on = $_GET['on'] ?? 'home';
		switch ($on) {
			case 'service':
				include_layout_template("layouts/service.php");
				break;
			case 'about':
				include_layout_template("layouts/about.php");
				break;
			case 'profile':
				include_layout_template("layouts/profile.php");
				break;
			case 'home':
			default:
				include_layout_template("layouts/home.php");
				break;
		}
		?>
		<?php include_layout_template("layouts/bottom.php") ?>
	</div>
</body>


</html>