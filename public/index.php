<?php
require_once("../includes/initialize.php");

$session = new Session();

if ($session->has('isLoggedIn') && $session->get('isLoggedIn') === 'true') {
	redirect_to('dashboard.php?on=home');
} else {
	redirect_to('registration.php');
}
?>