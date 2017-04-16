<?php
session_start();

if(!isset($_SESSION['user_id'])){
	require('includes/login_functions.inc.php');
	redirect_user();
} else {
	//setcookie('user_id','',time()-3600,'/','',0,0);
	//setcookie('first_name','',time()-3600,'/','',0,0);
	// setcookie('user_id');
	// setcookie('first_name');
	$_SESSION = array();
	session_destroy();
	setcookie('PHPSESSION');
}

$page_title = 'Logged Out!';
include('includes/header.html');

echo "<h1>注销</h1>
<p>你现在已注销!</p>";

include('includes/footer.html');
?>