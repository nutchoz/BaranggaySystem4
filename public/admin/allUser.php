<h1>ALL USERS</h1>
<form action="ban.php" method="POST">
	<select id="select-user" class="select-form" required>
		<option value="">NONE</option>
		<?php
		$database = new MySQLDatabase();

		$sql = "SELECT * FROM Users WHERE role != 'Admin User'";
		$result = $database->query($sql);
		while($row = $result->fetch_assoc()) {
			$jsonValue = htmlspecialchars(json_encode($row));
			$username = strtoupper($row['username']);
			echo "<option value='{$jsonValue}'>{$username}</option>";
		}
		$database->close_connection();
		?>
	</select>
	<input class="input-form" type="text" id="hotel-list-username" placeholder="USERNAME" readonly>
	<input class="input-form" type="text" id="hotel-list-password" placeholder="PASSWORD" readonly>
	<input class="input-form" type="text" id="hotel-list-email" placeholder="EMAIL" readonly>
	<input class="input-form" type="text" id="hotel-list-fullname" placeholder="FULLNAME" readonly>
	<input class="input-form" type="text" id="hotel-list-role" placeholder="ROLE" readonly>
	<button type="submit" value="submit">BAN THE USER</button>
</form>
<script type="text/javascript">

const selectUser = document.getElementById('select-user');
selectUser.addEventListener('change', function() {
	const selectedOption = this.value;
	if (this.value === "")
	{
		document.getElementById('hotel-list-username').value = "";
		document.getElementById('hotel-list-password').value = "";
		document.getElementById('hotel-list-email').value = "";
		document.getElementById('hotel-list-fullname').value = "";
		document.getElementById('hotel-list-role').value = "";
		return;
	}

	const userData = JSON.parse(selectedOption);
	document.getElementById('hotel-list-username').value = userData.username;
	document.getElementById('hotel-list-password').value = userData.password;
	document.getElementById('hotel-list-email').value = userData.email;
	document.getElementById('hotel-list-fullname').value = userData.full_name;
	document.getElementById('hotel-list-role').value = userData.role;

});
</script>