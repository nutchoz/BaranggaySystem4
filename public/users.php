<?php
require_once("../includes/initialize.php");

$session = new Session();
if (!$session->has('isLoggedIn') || $session->get('isLoggedIn') !== 'true')
{
	redirect_to('registration.php');
}
?>
<?php createHeader("Hotel Reservation System", ["css/homepage", "css/user", "css/customAlert", "css/feedback"]); ?>

<body>
	<?php include_layout_template("layouts/customAlert.php") ?>
	<?php
	if (isset($_GET['finish']))
	{
		if ($_GET['finish'] === 'true')
			include_layout_template("layouts/feedback.php");
	}
	?>
	<div class="container">
		<?php include_layout_template("layouts/userRoom.php") ?>
	</div>
	
</body>
</html>
