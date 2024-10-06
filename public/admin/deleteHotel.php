<h1>DELETE HOTEL</h1>
<div class="hotel-list">
<?php
	$database = new MySQLDatabase();

	$sql = "SELECT hotel_id, name FROM Hotel";
	$result = $database->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "
			<div class='hotel-item'>
				<div>{$row['name']}</div>
				<form action='../redirect.php' method='POST'>
					<input type='hidden' name='hotel_id' value='{$row['hotel_id']}'>
					<input type='hidden' name='type' value='del-hotel'>
					<button class='delete-btn'>X</button>
				</form>
			</div>";
		}
	} else {
		echo "No hotels available.";
	}
	$database->close_connection();
?>
</div>