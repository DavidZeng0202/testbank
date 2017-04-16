<?php
session_start();
if(!isset($_SESSION['user_id']))
//if(!isset($_SESSION['agent']) OR ($_SESSION['agent'] != md5($SERVER['HTTP_USER_AGENT'])))
{
	require('includes/login_functions.inc.php');
	redirect_user();
}

$page_title = 'Logged In!';
include('includes/header.html');

echo "<h1>Logged In!</h1>
<p>你现在已经登入，{$_SESSION['first_name']}!</p>
<p><a href=\"logout.php\">退出</a></p>";

include('includes/footer.html');
?>
