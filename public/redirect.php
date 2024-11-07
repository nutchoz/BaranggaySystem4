<?php
require_once('../includes/functions.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$database = new MySQLDatabase();
	$type = $_POST['type'];
	if ($type === 'login') {
		$username = $_POST["email"];
		$password = $_POST["password"];

		if ($username === 'admin' && $password === 'admin') {
			$_SESSION['isLoggedIn'] = 'true';
			redirect_to('./admin.php?on=home');
		}

		if (login($username)) {
			$account = $_SESSION['account'];

			if (!password_verify($password, $account['password'])) {
				$_SESSION['error'] = 'Login error. Maybe wrong email or password?';
				redirect_to('./registration.php');
			}

			if (!$account['verified']) {
				$_SESSION['error'] = 'Login error. Your account is not verified.';
				redirect_to('./index.php');
			}
			$_SESSION['isLoggedIn'] = 'true';
			$_SESSION['success'] = "Login successful! Welcome {$account['lastName']}";
			redirect_to('./index.php');
		}

		$_SESSION['error'] = 'Login error. Maybe wrong email or password?';
		redirect_to('./registration.php');

	} elseif ($type === 'register') {
		$firstName = $_POST['first_name'];
		$middleName = $_POST['middle_name'];
		$lastName = $_POST['last_name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		SQLFunction::registerAccount($firstName, $middleName, $lastName, $email, password_hash($password, PASSWORD_BCRYPT));
		$_SESSION['success'] = 'Registration successful! Please wait for admin to verify your account.';
		redirect_to('./registration.php');

	} elseif ($type === 'verify') {
		$email = $_POST['email'];
		$code = $_POST['code'];

		if (SQLFunction::verifyAccount($email, $code)) {
			$_SESSION['success'] = 'Account verified successfully! You can now log in.';
			redirect_to('./registration.php');
		} else {
			$_SESSION['error'] = 'Invalid email or verification code. Please try again.';
			redirect_to('./registration.php?on=verify');
		}

	} elseif ($type === "send-code") {
		$email = $_POST['email'];
		if (SQLFunction::sendCode($email))
			$_SESSION['success'] = "Verification code to $email sent successfully!";
		else
			$_SESSION['error'] = "Failed to send verification code to $email.";
		redirect_to('./admin.php?on=accounts');
	}

	// elseif ($type === 'register')
	// {
	// 	$full_name = $_POST["full_name"];
	// 	$username  = $_POST["username"];
	// 	$email     = $_POST["email"];
	// 	$password  = $_POST["password"];
	// 	$cpassword = $_POST["cpassword"];

	// 	if ($password !== $cpassword)
	// 		redirect_to("./registration.php?on=reg&full_name=$full_name&username=$username&email=$email&error=true");

	// 	$pass = password_hash($password, PASSWORD_DEFAULT);
	// 	register($full_name, $username, $email, $pass);
	// 	if (login($username, $password))
	// 		redirect_to('./index.php');

	// 	redirect_to('./registration.php?on=reg');
	// }
	// elseif ($type === 'add-hotel')
	// {
	// 	SQLFunction::addHotel(
	// 		$_POST['img_url'],
	// 		$_POST['name'],
	// 		$_POST['location'],
	// 		$_POST['description']
	// 	);
	// 	redirect_to('./admin/admin.php?type=ahotel');
	// }
	// elseif ($type === 'add-room')
	// {
	// 	SQLFunction::addRoom(
	// 		$_POST['room_number'],
	// 		$_POST['typeID'],
	// 		$_POST['price'],
	// 		$_POST['status'],
	// 		$_POST['hotel_id']
	// 	);
	// 	redirect_to('./admin/admin.php?type=aroom');
	// }
	// elseif ($type === 'del-hotel')
	// {
	// 	SQLFunction::removeHotel($_POST['hotel_id']);
	// 	redirect_to('./admin/admin.php?type=dhotel');
	// }
	// elseif ($type === 'del-room')
	// {
	// 	SQLFunction::removeRoom($_POST['room_id']);
	// 	redirect_to('./admin/admin.php?type=droom');
	// }
	// elseif ($type === 'upd-hotel')
	// {
	// 	SQLFunction::updHotel(
	// 		$_POST['img_url'],
	// 		$_POST['name'],
	// 		$_POST['location'],
	// 		$_POST['description'],
	// 		$_POST['hotel_id']
	// 	);
	// 	redirect_to('./admin/admin.php?type=uhotel');
	// }
	// elseif ($type === 'upd-room')
	// {
	// 	SQLFunction::updRoom(
	// 		$_POST['room_number'],
	// 		$_POST['typeID'],
	// 		$_POST['price'],
	// 		$_POST['status'],
	// 		$_POST['hotel_id'],
	// 		$_POST['room_id']
	// 	);
	// 	redirect_to('./admin/admin.php?type=uroom');
	// }
	// elseif ($type === 'book-room')
	// {
	// 	$session = new Session();
	// 	$user_id = $session->get('user_id');
	// 	SQLFunction::bookRoom(
	// 		$user_id,
	// 		$_POST['room_id'],
	// 		$_POST['check_in'],
	// 		$_POST['check_out']
	// 	);
	// 	redirect_to('./dashboard.php?success-book=true');
	// }
	// elseif ($type === 'unbook-room')
	// {
	// 	SQLFunction::unBookRoom($_POST['reserve_id'], $_POST['room_id']);
	// 	redirect_to('./users.php');
	// }
	// elseif ($type === 'unbook-room-finish')
	// {
	// 	SQLFunction::unBookRoom($_POST['reserve_id'], $_POST['room_id']);
	// 	redirect_to('./users.php?finish=true');
	// }
}

unset($_SESSION['account']);
unset($_SESSION['isLoggedIn']);
redirect_to('./index.php');
?>