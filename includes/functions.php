<?php
require_once('database.php');
require_once('session.php');

function include_layout_template($template = "")
{
	require_once($template);
}

function redirect_to($location = NULL)
{
	if ($location != NULL) {
		header("Location: {$location}");
		exit;
	}
}

function register($full_name, $username, $email, $password)
{
	$database = new MySQLDatabase();
	$result = $database->prepexec(
		"INSERT INTO Users (username, password, email, full_name, role) VALUES (?, ?, ?, ?, ?)",
		$username,
		$password,
		$email,
		$full_name,
		'Customer'
	);
}

function login($username)
{
	$user = SQLFunction::loginAccount($username);


	if ($user == null)
		return false;

	$session = new Session();
	$session->set('account', $user);
	return true;
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

?>