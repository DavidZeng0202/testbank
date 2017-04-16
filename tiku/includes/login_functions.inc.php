<?php
function redirect_user($page = 'index.php'){
	$url = 'http://' .$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url,'/\\');
	$url .='/' .$page;
	header("Location:$url");
	exit();
}

function check_login($link,$email= '',$pass = ''){
	$errors = array();

	if(empty($email)){
		$errors[]='请输入邮箱地址。';
	} else {
		$e = mysql_real_escape_string(trim($email));
	}

	if(empty($pass)){
		$errors[]='请输入密码。';
	} else {
		$p = mysql_real_escape_string(trim($pass));
	}

	if(empty($errors)){
		$q = "SELECT user_id,first_name,user_level FROM users WHERE email= '$e' AND pass=SHA1('$p')";
		$r = mysql_query($q);

		if(mysql_num_rows($r)==1){
			$row = mysql_fetch_array($r,MYSQL_ASSOC);
			return array(true,$row);
		}
		else{
			$errors[] = '邮箱地址或密码有误。';
		}

	}
	return array(false,$errors);
}