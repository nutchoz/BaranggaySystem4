<?php
require_once("../includes/initialize.php");
createHeader("Baranggay System", [
	"css/main",
	// "css/dashboard",
	// "css/register",
	// "css/login",
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

<style>
	.verify-button {
		position: fixed;
		bottom: 20px;
		right: 20px;
		width: 100px;
		height: 100px;
		background-color: #28a745;
		color: white;
		text-align: center;
		line-height: 100px;
		border-radius: 50%;
		font-size: 18px;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
		transition: background-color 0.3s ease;
		text-decoration: none;
	}

	.verify-button:hover {
		background-color: #218838;
	}
</style>

<body>
	<div class="container">
		<?php
		if (isset($_GET['on']) && $_GET['on'] === 'reg')
			include_layout_template("layouts/register.php");
		elseif (isset($_GET['on']) && $_GET['on'] === 'verify')
			include_layout_template("layouts/verify.php");
		elseif (isset($_GET['on']) && $_GET['on'] === 'reset')
			include_layout_template("layouts/reset.php");
		elseif (isset($_GET['on']) && $_GET['on'] === 'forgot')
			include_layout_template("layouts/forgot_password.php");
		else
			include_layout_template("layouts/login.php");
		?>
	</div>
	<a href="registration.php?on=verify" class="verify-button">
		VERIFY
	</a>
</body>



</html>