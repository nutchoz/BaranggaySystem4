<h1>UPDATE HOTEL</h1>
<form action="../redirect.php" method="POST">
	<select class="select-form" id="select-hotel" required>
<?php
	$database = new MySQLDatabase();

	$sql = "SELECT hotel_id, img_url, name, location, description FROM Hotel";
	$result = $database->query($sql);

	while($row = $result->fetch_assoc())
	{
		$jsonValue = htmlspecialchars(json_encode($row));
		echo "<option value='{$jsonValue}'>{$row['name']}</option>";
	}
	$database->close_connection();
?>
	</select>
	<input type="hidden" id="update-hotel-hotel_id" name="hotel_id" required>
	<input class="input-form" type="text" id="update-hotel-img_url" name="img_url" placeholder="Image URL" required>
	<input class="input-form" type="text" id="update-hotel-name" name="name" placeholder="Name" required>
	<input class="input-form" type="text" id="update-hotel-location" name="location" placeholder="Location" required>
	<textarea class="input-form" id="update-hotel-description" name="description" placeholder="Description..." ></textarea>
	<input type="hidden" name="type" value="upd-hotel">
	<button type="submit" value="submit">SUBMIT</button>
</form>

<script type="text/javascript">

const selectUser = document.getElementById('select-hotel');
function updateInput()
{
	const selectedOption = selectUser.value;
	if (selectedOption === "")
	{
		document.getElementById('update-hotel-hotel_id').value = "";
		document.getElementById('update-hotel-img_url').value = "";
		document.getElementById('update-hotel-name').value = "";
		document.getElementById('update-hotel-location').value = "";
		document.getElementById('update-hotel-description').value = "";
		return;
	}

	const userData = JSON.parse(selectedOption);
	document.getElementById('update-hotel-hotel_id').value = userData.hotel_id;
	document.getElementById('update-hotel-img_url').value = userData.img_url;
	document.getElementById('update-hotel-name').value = userData.name;
	document.getElementById('update-hotel-location').value = userData.location;
	document.getElementById('update-hotel-description').value = userData.description;
}
selectUser.addEventListener('change', updateInput);
updateInput();

</script>