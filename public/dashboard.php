<?php
require_once("../includes/initialize.php");

$session = new Session();
if (!$session->has('isLoggedIn') || $session->get('isLoggedIn') !== 'true')
{
	redirect_to('registration.php');
}
?>
<?php createHeader("", ["css/main", "css/dashboard", "css/customAlert", "css/navigation"]); ?>

<body>
	<?php include_layout_template("layouts/customAlert.php") ?>
	<div class="container">
		<?php include_layout_template("layouts/navigation.php") ?>

	</div>
</body>
</html>
