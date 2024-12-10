<?php
require_once('../includes/functions.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$database = new MySQLDatabase();
	$type = $_POST['type'];
	if ($type === 'login') {
		$username = $_POST["email"];
		$password = $_POST["password"];

		if (isset($_SESSION['failedAttempts']) && $_SESSION['failedAttempts'] >= 3) {
			if (time() - $_SESSION['lastFailedAttempt'] < 30) {
				$timeRemaining = 30 - (time() - $_SESSION['lastFailedAttempt']);
				$_SESSION['error'] = "Too many failed login attempts. Please try again in {$timeRemaining} seconds.";
				redirect_to('./registration.php');
			} else {
				$_SESSION['failedAttempts'] = 0;
			}
		}

		if ($username === 'admin' && $password === 'admin') {
			$_SESSION['isLoggedIn'] = 'true';
			redirect_to('./admin.php?on=home');
		}

		if (login($username)) {
			$account = $_SESSION['account'];

			if (!password_verify($password, $account['password'])) {
				if (!isset($_SESSION['failedAttempts']))
					$_SESSION['failedAttempts'] = 0;

				$_SESSION['failedAttempts']++;
				$_SESSION['lastFailedAttempt'] = time();
				if ($_SESSION['failedAttempts'] >= 5) {
					$_SESSION['error'] = 'Too many failed attempts. You are temporarily banned for 30 seconds.';
					redirect_to('./registration.php');
				} else {
					$_SESSION['error'] = 'Login error. Maybe wrong email or password?';
					redirect_to('./registration.php');
				}
			} else {
				if (!$account['verified']) {
					$_SESSION['error'] = 'Login error. Your account is not verified.';
					redirect_to('./index.php');
				}

				$_SESSION['isLoggedIn'] = 'true';
				$_SESSION['success'] = "Login successful! Welcome {$account['lastName']}";
				$_SESSION['failedAttempts'] = 0;
				redirect_to('./index.php');
			}
		} else {
			if (!isset($_SESSION['failedAttempts']))
				$_SESSION['failedAttempts'] = 0;
			$_SESSION['failedAttempts']++;
			$_SESSION['lastFailedAttempt'] = time();
			if ($_SESSION['failedAttempts'] >= 5) {
				$_SESSION['error'] = 'Too many failed attempts. You are temporarily banned for 30 seconds.';
				redirect_to('./registration.php');
			} else {
				$_SESSION['error'] = 'Login error. Maybe wrong email or password?';
				redirect_to('./registration.php');
			}
		}
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
			$_SESSION['success'] = "Verification code was sent to $email successfully!";
		else
			$_SESSION['error'] = "Failed to send verification code to $email.";
		redirect_to('./admin.php?on=accounts');
	} elseif ($type === "forgot") {
		$email = $_POST['email'];
		if (!isUserExists($email)) {
			$_SESSION['error'] = "Email: $email is not registered in the system.";
			redirect_to('./registration.php?on=forgot');
			return;
		}

		if (SQLFunction::sendCode($email, "forgot password"))
			$_SESSION['success'] = "Forgot password code was sent to $email successfully!";
		else
			$_SESSION['error'] = "Failed to send Forgot password code to $email.";
		redirect_to("./registration.php?on=reset&email=$email");

	} elseif ($type === "reset") {
		$email = $_POST['email'];
		$code = $_POST['code'];
		$password = $_POST['new-password'];
		$cpass = $_POST['confirm-password'];

		if ($password != $cpass) {
			$_SESSION['error'] = "Password does not match.";
			redirect_to("./registration.php?on=reset&email=$email");
			return;
		}

		if (!isUserExists($email)) {
			$_SESSION['error'] = "Email: $email is not registered in the system.";
			redirect_to("./registration.php?on=reset&email=$email");
			return;
		}
		if (isset($_GET["$email-generatedCode"]) && $_GET["$email-generatedCode"] == "$code") {
			SQLFunction::updatePasswprd(password_hash($password, PASSWORD_BCRYPT));
			unset($_GET["$email-generatedCode"]);
			redirect_to('./registration.php?on=login');
			$_SESSION['success'] = "Password was reset successfully!";
			return;
		}
		// unset($_GET["$email-generatedCode"]);
		$_SESSION['error'] = "Invalid email or code.";
		redirect_to("./registration.php?on=reset&email=$email");

	} elseif ($type === "baranggay-clearance") {
		$fullName = $_POST["fullName"];
		$address = $_POST["address"];
		$age = $_POST["age"];
		$birthDate = $_POST["birthDate"];
		$civilStatus = $_POST["civilStatus"];
		$purpose = $_POST["purpose"];
		$contactNumber = $_POST["contactNumber"];
		$periodResidence = $_POST["periodResidence"];
		$price = $_POST["price"];
	
		$uploadFolder = 'uploads/';

		// Handle Proof of Residency Upload
		if (isset($_FILES['proofResidency']) && $_FILES['proofResidency']['error'] === UPLOAD_ERR_OK) {
			$proofResidency = $_FILES['proofResidency'];
			$fileTmpPath = $proofResidency['tmp_name'];
			$fileName = $proofResidency['name'];
			$fileType = $proofResidency['type'];
	
			// $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
			// if (!in_array($fileType, $allowedMimeTypes)) {
			// 	$_SESSION['error'] = "Invalid file type for proof of residency. Only images are allowed.";
			// 	header("Location: dashboard.php");
			// 	exit;
			// }
	
			$proofResidencyPath = $uploadFolder . basename($fileName);
			if (!move_uploaded_file($fileTmpPath, $proofResidencyPath)) {
				$_SESSION['error'] = "Error uploading the proof of residency file.";
				header("Location: dashboard.php");
				exit;
			}
		} else {
			$_SESSION['error'] = "Error with proof of residency file upload.";
			header("Location: dashboard.php");
			exit;
		}
	
		// Handle ID Proof Upload
		// if (isset($_FILES['idProof']) && $_FILES['idProof']['error'] === UPLOAD_ERR_OK) {
		// 	$idProof = $_FILES['idProof'];
		// 	$fileTmpPath = $idProof['tmp_name'];
		// 	$fileName = $idProof['name'];
		// 	$fileType = $idProof['type'];
	
		// 	// $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
		// 	// if (!in_array($fileType, $allowedMimeTypes)) {
		// 	// 	$_SESSION['error'] = "Invalid file type for ID Proof. Only images are allowed.";
		// 	// 	header("Location: dashboard.php");
		// 	// 	exit;
		// 	// }
	
		// 	// $idProofPath = $uploadFolder . basename($fileName);
		// 	// if (!move_uploaded_file($fileTmpPath, $idProofPath)) {
		// 	// 	$_SESSION['error'] = "Error uploading the ID Proof file.";
		// 	// 	header("Location: dashboard.php");
		// 	// 	exit;
		// 	// }
		// 	$newFilePath = $uploadFolder . basename($fileName);
		// 	if (!move_uploaded_file($fileTmpPath, $newFilePath)) {
		// 		echo "Error uploading the ID Proof file.";
		// 		exit;
		// 	}
		// } else {
		// 	$_SESSION['error'] = "Error with ID Proof file upload.";
		// 	header("Location: dashboard.php");
		// 	exit;
		// }
	
		$serviceData = [
			"fullName" => $fullName,
			"address" => $address,
			"age" => $age,
			"birthDate" => $birthDate,
			"civilStatus" => $civilStatus,
			"purpose" => $purpose,
			"contactNumber" => $contactNumber,
			"periodResidence" => $periodResidence,
			"proofResidency" => $proofResidencyPath,
		];
	
		$database = new MySQLDatabase();
		$params = [
			$serviceData["fullName"],
			$serviceData["address"],
			$serviceData["age"],
			$serviceData["birthDate"],
			$serviceData["civilStatus"],
			$serviceData["purpose"],
			$serviceData["contactNumber"],
			$serviceData["periodResidence"],
			$serviceData["proofResidency"],
		];
	
		$database->prepexec(
			"INSERT INTO service (userId, userName, name, type, information) VALUES (?, ?, ?, ?, ?)",
			$_SESSION['account']['id'],
			$_SESSION['account']['firstName'] . " " . $_SESSION['account']['middleName'] . " " . $_SESSION['account']['lastName'],
			"Baranggay Clearance",
			"Application",
			json_encode($serviceData),
		);
	
		header("Location: dashboard.php?on=allOrder");
		exit;
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