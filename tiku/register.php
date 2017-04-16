<?php
session_start();
$page_title="Register";
include('includes/header.html');

if($_SERVER['REQUEST_METHOD']=='POST'){
//	require('connect.php');

	$errors=array();

	if(empty($_POST['first_name'])){
		$errors[]='Please enter your first name.';
	} else {
		$fn = trim($_POST['first_name']);
		//$fn = mysqli_real_escape_string($link, trim($_POST['first_name']));
	}

	if(empty($_POST['last_name'])){
		$errors[]='Please enter your last name.';
	} else {
		$ln = trim($_POST['last_name']);
	}

	if(empty($_POST['email'])){
		$errors[]='Please enter your email address.';
	} else {
		$e = trim($_POST['email']);
	}

	if(!empty($_POST['pass1'])){
		if($_POST['pass1']!=$_POST['pass2']){
			$errors[]='Your password did not match the confirmed password.';
		} else {
			$p=trim($_POST['pass1']);
		}
	} else {
		$errors[]='Please enter your password.';
	}

	if(empty($errors)){
		require('connect.php');
		$q="INSERT INTO users (first_name,last_name,email,pass,registration_date) VALUES ('$fn','$ln','$e',SHA1($p),NOW())";
		$r=mysql_query($q);
		if($r){
			echo '<h1>Thank you!</h1>
			<p> You are now registered.</p><p><br/></p>';
		} else {
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error.</p>';
			echo '<p>'.mysql_error($link).'<br/><br/>Query:'.$q.'</p>';
		}
		mysql_close($link);
		include('includes/footer.html');
		exit();
	} else {
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br/>';
		foreach ($errors as $msg ) {
			echo " - $msg<br/>\n";
		}
		echo '</p><p>Please try again.</p><p><br/></p>';
	}
	mysql_close($link);
}
?>

<h1>注册</h1>
<form action="register.php" method="post">
	<p>名字：<input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name'];?>" /></p>
	<p>姓氏：<input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name'];?>" /></p>
	<p>邮箱地址：<input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>" /></p>
	<p>密码：<input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1'];?>" /></p>
	<p>确认密码：<input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2'];?>" /></p>
	<p><input type="submit" name="submit" value="注册"/></p>
</form>
<?php include("includes/footer.html"); ?>