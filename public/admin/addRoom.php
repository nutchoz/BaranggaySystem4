<h1>ADD ROOM</h1>
<form action="../redirect.php" method="POST">
	<input class="input-form" type="number" name="room_number" placeholder="Room Number" required>
	<input class="input-form" type="number" name="price" placeholder="Price" required>
	<select class="select-form" name="typeID" required>
		<option value="Standard">Standard</option>
		<option value="Deluxe">Deluxe</option>
		<option value="Suite">Suite</option>
		<option value="Penthouse">Penthouse</option>
	</select>
	<select class="select-form" name="status" required>
		<option value="Available">Available</option>
		<option value="Booked">Booked</option>
		<option value="Out Of Service">Out Of Service</option>
	</select>

	<select class="select-form" name="hotel_id" required>
<?php
	$database = new MySQLDatabase();

	$sql = "SELECT hotel_id, name FROM Hotel";
	$result = $database->query($sql);

	while($row = $result->fetch_assoc()) {
		echo "<option value='{$row['hotel_id']}'>{$row['name']}</option>";
	}
	$database->close_connection();
?>
	</select>
	<input type="hidden" name="type" value="add-room">
	<button type="submit" value="submit">SUBMIT</button>
</form>