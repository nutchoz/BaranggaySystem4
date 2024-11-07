<?php
require_once("../includes/initialize.php");
createHeader("Baranggay System", [
	"css/main",
	"css/dashboard",
	"css/register",
	"css/login",
	"css/customAlert",
	"css/modal"
]);
unset($_SESSION['account']);
unset($_SESSION['isLoggedIn']);
?>

<?php
require_once("modals/modals.php");

if (isset($_SESSION['success'])) {
	echo "<script>showSuccessModal('{$_SESSION['success']}');</script>";
	unset($_SESSION['success']);
} elseif (isset($_SESSION['error'])) {
	echo "<script>showErrorModal('{$_SESSION['error']}');</script>";
	unset($_SESSION['error']);
}
?>

<body>
	<div class="container">
		<?php
		if (isset($_GET['on']) && $_GET['on'] === 'reg')
			include_layout_template("layouts/register.php");
		elseif (isset($_GET['on']) && $_GET['on'] === 'verify')
			include_layout_template("layouts/verify.php");
		else
			include_layout_template("layouts/login.php");
		?>
	</div>
	<a href="registration.php?on=verify" class="verify-button">
		VERIFY
	</a>
</body>



</html>