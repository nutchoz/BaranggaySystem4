<h1>ALL RESERVATIONS</h1>
<form action="ban.php" method="POST">
	<select id="select-user" class="select-form" required>
		<option value="">NONE</option>
		<?php
		$database = new MySQLDatabase();

		$sql = "
			SELECT 
				Reservations.reservation_id AS ID, 
				Users.username AS Username, 
				Hotel.name AS HotelName, 
				Rooms.room_number AS RoomNumber, 
				Reservations.check_in AS CheckIn, 
				Reservations.check_out AS CheckOut
			FROM 
				Reservations
			JOIN Users ON Reservations.user_id = Users.user_id
			JOIN Rooms ON Reservations.room_id = Rooms.room_id
			JOIN Hotel ON Rooms.hotel_id = Hotel.hotel_id";

		$result = $database->query($sql);
		while($row = $result->fetch_assoc()) {
			$jsonValue = htmlspecialchars(json_encode($row));
			$username = strtoupper($row['username']);
			echo "<option value='{$jsonValue}'>RESERVATION {$row['ID']}</option>";
		}
		$database->close_connection();
		?>
	</select>
	<input class="input-form" type="text" id="hotel-list-username" placeholder="USERNAME" readonly>
	<input class="input-form" type="text" id="hotel-list-hotelname" placeholder="HOTEL NAME" readonly>
	<input class="input-form" type="text" id="hotel-list-roomnumber" placeholder="ROOM NUMBER" readonly>
	<input class="input-form" type="text" id="hotel-list-checkin" placeholder="CHECK IN" readonly>
	<input class="input-form" type="text" id="hotel-list-checkout" placeholder="CHECK OUT" readonly>
	<button type="submit" value="submit">UNBOOK</button>
</form>
<script type="text/javascript">

const selectUser = document.getElementById('select-user');
selectUser.addEventListener('change', function() {
	const selectedOption = this.value;
	if (this.value === "")
	{
		document.getElementById('hotel-list-username').value = "";
		document.getElementById('hotel-list-hotelname').value = "";
		document.getElementById('hotel-list-roomnumber').value = "";
		document.getElementById('hotel-list-checkin').value = "";
		document.getElementById('hotel-list-checkout').value = "";
		return;
	}

	const userData = JSON.parse(selectedOption);
	document.getElementById('hotel-list-username').value = userData.Username;
	document.getElementById('hotel-list-hotelname').value = userData.HotelName;
	document.getElementById('hotel-list-roomnumber').value = userData.RoomNumber;
	document.getElementById('hotel-list-checkin').value = userData.CheckIn;
	document.getElementById('hotel-list-checkout').value = userData.CheckOut;

});
</script>