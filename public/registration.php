<?php
require_once("../includes/initialize.php");
createHeader("Baranggay System", ["css/main", "css/dashboard", "css/register", "css/login", "css/customAlert"]);
?>

<body>
	<?php include_layout_template("layouts/customAlert.php") ?>

	<div class="container">
		<?php
		if (isset($_GET['on']) && $_GET['on'] === 'reg')
			include_layout_template("layouts/register.php");
		else
			include_layout_template("layouts/login.php");
		?>
	</div>

</body>
</html>

