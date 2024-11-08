<?php

require_once('config.php');
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MySQLDatabase
{
	private $connection;

	public function __construct()
	{
		$this->open_connection();
	}

	public function __destruct()
	{
		$this->close_connection();
	}

	private function open_connection()
	{
		$this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		if ($this->connection->connect_error) {
			die("Database connection failed: " . $this->connection->connect_error);
		}
	}

	public function getType($param)
	{
		if (is_int($param))
			return 'i';
		elseif (is_float($param))
			return 'd';
		elseif (is_string($param))
			return 's';
		else
			return 'b';
	}
	public function getParamTypeStr(...$params)
	{
		$types = '';
		foreach ($params as $param)
			$types .= $this->getType($param);
		return $types;
	}

	public function prepare($query)
	{
		return $this->connection->prepare($query);
	}

	public function query($sql)
	{
		$result = $this->connection->query($sql);
		$this->confirm_query($result);
		return $result;
	}

	public function execute($statement, ...$params)
	{
		$statement->bind_param(
			$this->getParamTypeStr(...$params),
			...$params
		);
		$statement->execute();
		return $statement->get_result();
	}

	public function prepexec($query, ...$params)
	{
		$statement = $this->connection->prepare($query);
		return $this->execute($statement, ...$params);
	}

	public function fetch($query, ...$params)
	{
		$fetch_to_return = null;
		$statement = $this->connection->prepare($query);
		$statement->bind_param(
			$this->getParamTypeStr(...$params),
			...$params
		);
		$statement->execute();
		$statement->bind_result($fetch_to_return);
		$statement->fetch();
		$statement->close();
		return $fetch_to_return;
	}

	public function confirm_query($result)
	{
		if (!$result) {
			die("Database query failed: " . $this->connection->error);
		}
	}

	public function escape_value($value)
	{
		return $this->connection->real_escape_string($value);
	}

	public function fetch_array($result)
	{
		return $result->fetch_assoc();
	}

	public function num_rows($result)
	{
		return $result->num_rows;
	}

	public function affected_rows()
	{
		return $this->connection->affected_rows;
	}

	public function insert_id()
	{
		return $this->connection->insert_id;
	}

	public function close_connection()
	{
		if (isset($this->connection)) {
			$this->connection->close();
			unset($this->connection);
		}
	}
}

class SQLFunction
{
	public static function getAccount(...$params)
	{
		$database = new MySQLDatabase();
		$result = $database->prepexec("SELECT id FROM users WHERE code = ? LIMIT 1", ...$params);
		$row = $result->fetch_assoc();
		return $row;
	}

	public static function loginAccount(...$params)
	{
		$database = new MySQLDatabase();
		$result = $database->prepexec("SELECT * FROM users WHERE email = ?", ...$params);
		$row = $result->fetch_assoc();
		return $row;
	}

	public static function registerAccount(...$params)
	{
		$database = new MySQLDatabase();
		$database->prepexec("INSERT INTO users (firstName, middleName, lastName, email, password) VALUES
			(?, ?, ?, ?, ?)", ...$params);
	}

	public static function updateAccount(...$params)
	{
		$database = new MySQLDatabase();
		$database->prepexec("UPDATE users 
			SET firstName = ?, middleName = ?, lastName = ?, email = ?, password = ?
			WHERE id = ?", ...$params);
	}

	public static function verifyAccount($email, $code)
	{
		$database = new MySQLDatabase();
		$result = $database->prepexec("SELECT * FROM users WHERE email = ? AND code = ?", $email, $code);
		$row = $result->fetch_assoc();

		if ($row) {
			$database->prepexec("UPDATE users SET verified = TRUE WHERE email = ?", $email);
			return true;
		}
		return false;
	}

	public static function getAllAccounts()
	{
		$database = new MySQLDatabase();
		$result = $database->query("SELECT * FROM users WHERE verified = FALSE");

		$accounts = [];
		while ($row = $result->fetch_assoc()) {
			$accounts[] = $row;
		}
		return $accounts;
	}

	public static function sendCode($email)
	{
		$generateCode = rand(100000, 999999);

		$database = new MySQLDatabase();
		$database->prepexec("UPDATE users SET code = ? WHERE email = ?", $generateCode, $email);
		$mail = new PHPMailer(true);
		try {
			$mail->isSMTP();
			$mail->Host = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'jdmaster888@gmail.com';
			$mail->Password = 'mxvj qric haou eibj';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;

			$mail->setFrom('jdmaster888@gmail.com', 'Your Name or App Name');
			$mail->addAddress($email);
			$mail->Subject = 'Your Verification Code';
			$mail->Body = "Your verification code is: $generateCode";

			$mail->send();
			return true;
		} catch (Exception $e) {
			return false;
		}
	}
}

?>