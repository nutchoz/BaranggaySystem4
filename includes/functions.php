<?php
require_once('database.php');
require_once('session.php');

function include_layout_template($template = "")
{
	require_once($template);
}

function redirect_to($location = NULL)
{
	if ($location != NULL)
	{
		header("Location: {$location}");
		exit;
	}
}

function register($full_name, $username, $email, $password)
{
	$database = new MySQLDatabase();
	$result = $database->prepexec("INSERT INTO Users (username, password, email, full_name, role) VALUES (?, ?, ?, ?, ?)",
		$username, $password, $email, $full_name, 'Customer'
	);
}

function login($username, $password)
{
	$session = new Session();
	$session->set('isLoggedIn', 'true');
	return true;
	
	// $database = new MySQLDatabase();
	// $result = $database->prepexec("SELECT user_id, email, password FROM Users WHERE (username = ? OR email = ?)", $username, $username);

	// if ($row = $result->fetch_assoc())
	// {
	// 	if (password_verify($password, $row['password']))
	// 	{
	// 		$session = new Session();
	// 		$session->set('isLoggedIn', 'true');
	// 		$session->set('user_id', $row['user_id']);
	// 		return true;
	// 	}
	// }
	// return false;
}

function createHeader($title, $hrefs)
{
	$safeTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
	echo "
	<!DOCTYPE html>
	<html>
	<head translate='no'>
		<title>$safeTitle</title>";

	foreach ($hrefs as $href) {
		$safeHref = htmlspecialchars($href, ENT_QUOTES, 'UTF-8');
		echo "<link rel='stylesheet' type='text/css' href='$safeHref.css'>";
	}
	echo "</head>";
}

function createAnalytics($img, $title, $analytics)
{
	echo "
	<div class='analytics'>
		<img class='img' src='$img' />
		<div class='text'>$title</div>
		<div class='t-analytics'>$analytics</div>
	</div>";
}

function createFront($title, $desc)
{
	echo "<div class='bg-image'>
		<div class='linear-bg'>
			<div class='title'>$title</div>
			<div class='para'>$desc</div>
		</div>
	</div>";
}

function getAllRoomPrice($hotelID)
{
	$database = new MySQLDatabase();

	$sql = "SELECT room_id, room_number, price FROM Rooms r WHERE hotel_id = $hotelID AND status = 'Available'";
	$result = $database->query($sql);

	$optionString = "";
	if ($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			$jsonValue = htmlspecialchars(json_encode($row));
			$optionString .= "<option value=\'$jsonValue\'>ROOM {$row['room_number']}</option>";
		}
	}
	$database->close_connection();
	return $optionString;
}

function createHotel($image, $hotelName, $hotelDescription, $location, $hotelID)
{
	$maxLength = 80;

	if (strlen($hotelDescription) > $maxLength)
		$shortDesc = substr($hotelDescription, 0, $maxLength) . '...';
	else
		$shortDesc = $hotelDescription;

	$optionString = getAllRoomPrice($hotelID);

	echo "<div class='hotel' onclick=\"openBooking('$image', '$hotelName', '$hotelDescription', '$location', '$optionString');\">
		<div class='image' style='
			background: url({$image}) center/100% 100%;
		'></div>
		<div class='table'>
			<div class='title-price'>
				<div class='title'>{$hotelName}</div>
			</div>
			<div class='desc'>{$shortDesc}</div>
		</div>
	</div>";
}

function createHotelBooked($image, $hotelName, $hotelPrice, $hotelDescription, $roomNumber, $reserveID, $roomID)
{
	$maxLength = 80;

	if (strlen($hotelDescription) > $maxLength)
		$shortDesc = substr($hotelDescription, 0, $maxLength) . '...';
	else $shortDesc = $hotelDescription;

	echo "<div class='hotel' onclick=\"document.querySelector('.book-container').style.display = 'inline-block'\">
		<div class='image' style='
			background: url({$image}) center/100% 100%;
		'>
		<div class='room-booked'>R-$roomNumber</div>

		<form action='./redirect.php' method='POST'>
			<input type='hidden' name='type' value='unbook-room'>
			<input type='hidden' name='reserve_id' value='$reserveID'>
			<input type='hidden' name='room_id' value='$roomID'>
			<button><b>UNBOOKED</b></button>
		</form>
		<form action='./redirect.php' method='POST'>
			<input type='hidden' name='type' value='unbook-room-finish'>
			<input type='hidden' name='reserve_id' value='$reserveID'>
			<input type='hidden' name='room_id' value='$roomID'>
			<button style='margin-top: 30px'><b>FINISHED</b></button>
		</form>
		</div>
		<div class='table'>
			<div class='title-price'>
				<div class='title'>{$hotelName}</div>
				<div class='price'>PHP {$hotelPrice}.00</div>
			</div>
			<div class='desc'>{$shortDesc}</div>

		</div>
	</div>";
}

?>