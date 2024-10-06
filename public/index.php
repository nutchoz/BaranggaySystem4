<?php
require_once("../includes/initialize.php");

$session = new Session();

if ($session->has('isLoggedIn') && $session->get('isLoggedIn') === 'true')
{
	redirect_to('dashboard.php');
}
else
{
	redirect_to('registration.php');
}
?>