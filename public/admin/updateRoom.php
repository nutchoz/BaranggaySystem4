<h1>UPDATE ROOM</h1>
<form action="../redirect.php" method="POST">
	<select class="select-form" id="select-room" required>
<?php
	$database = new MySQLDatabase();

	$sql = "SELECT room_id, room_number, price, type, status, name, h.hotel_id FROM Rooms r INNER JOIN Hotel h ON r.hotel_id = h.hotel_id";
	$result = $database->query($sql);

	while($row = $result->fetch_assoc())
	{
		$jsonValue = htmlspecialchars(json_encode($row));
		echo "<option value='{$jsonValue}'>{$row['name']}, Room: {$row['room_number']}</option>";
	}
	$database->close_connection();
?>
	</select>
	<select class="select-form" id="update-room-hotel_id" name="hotel_id" required>
	<?php
		$database = new MySQLDatabase();

		$sql = "SELECT hotel_id, name FROM Hotel";
		$result = $database->query($sql);

		while($row = $result->fetch_assoc())
			echo "<option value='{$row['hotel_id']}'>{$row['name']}</option>";
		$database->close_connection();
	?>
	</select>
	<input type="hidden" id="update-room-room_id" name="room_id" required>
	<input class="input-form" type="number" id="update-room-room_number" name="room_number" placeholder="Room Number" required>
	<input class="input-form" type="number" id="update-room-price" name="price" placeholder="Price" required>
	<select class="select-form" id="update-room-type" name="typeID" required>
		<option value="Standard">Standard</option>
		<option value="Deluxe">Deluxe</option>
		<option value="Suite">Suite</option>
		<option value="Penthouse">Penthouse</option>
	</select>
	<select class="select-form" id="update-room-status" name="status" required>
		<option value="Available">Available</option>
		<option value="Booked">Booked</option>
		<option value="Out Of Service">Out Of Service</option>
	</select>
	<input type="hidden" name="type" value="upd-room">
	<button type="submit" value="submit">SUBMIT</button>
</form>

<script type="text/javascript">

const selectUser = document.getElementById('select-room');
function updateInputRoom()
{
	const selectedOption = selectUser.value;
	if (selectedOption === "")
	{
		document.getElementById('update-room-hotel_id').value = "";
		document.getElementById('update-room-room_id').value = "";
		document.getElementById('update-room-room_number').value = "";
		document.getElementById('update-room-price').value = "";
		document.getElementById('update-room-type').value = "";
		document.getElementById('update-room-status').value = "";
		return;
	}

	const userData = JSON.parse(selectedOption);
	document.getElementById('update-room-hotel_id').value = userData.hotel_id;
	document.getElementById('update-room-room_id').value = userData.room_id;
	document.getElementById('update-room-room_number').value = userData.room_number;
	document.getElementById('update-room-price').value = userData.price;
	document.getElementById('update-room-type').value = userData.type;
	document.getElementById('update-room-status').value = userData.status;
}
selectUser.addEventListener('change', updateInputRoom);
updateInputRoom();

</script>