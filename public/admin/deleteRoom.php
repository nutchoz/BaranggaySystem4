<h1>DELETE ROOM</h1>
<div class="hotel-list">
<?php
	$database = new MySQLDatabase();

	$sql = "SELECT room_id, room_number, name, status FROM Rooms r INNER JOIN Hotel h ON r.hotel_id = h.hotel_id";
	$result = $database->query($sql);

	while($row = $result->fetch_assoc())
	{
		echo "
		<div class='hotel-item'>
			<div>{$row['name']}, Room: {$row['room_number']} ({$row['status']})</div>
			<form action='../redirect.php' method='POST'>
				<input type='hidden' name='room_id' value='{$row['room_id']}'>
				<input type='hidden' name='type' value='del-room'>
				<button class='delete-btn'>X</button>
			</form>
		</div>";
	}
	$database->close_connection();
?>
</div>