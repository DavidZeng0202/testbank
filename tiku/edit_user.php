<?php
session_start();
$page_title = 'Edit User';
include ('includes/header.html');
echo '<h1>编辑用户信息</h1>';

if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
	$id = $_GET['id'];
} else if ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
	$id = $_POST['id'];
} else { 
	echo '<p class="error">页面出错。</p>';
	include ('includes/footer.html'); 
	exit();
}

require ('connect.php'); 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();

	if (empty($_POST['first_name'])) {
		$errors[] = '请输入名字。';
	} else {
		$fn = trim($_POST['first_name']);
	}

	if (empty($_POST['last_name'])) {
		$errors[] = '请输入姓氏。';
	} else {
		$ln = trim($_POST['last_name']);
	}

	if (empty($_POST['email'])) {
		$errors[] = '请输入邮箱地址。';
	} else {
		$e = trim($_POST['email']);
	}

	if (empty($errors)) { 

		$q = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id";
		$r = mysql_query($q);

		if (mysql_num_rows($r) == 0) {
			$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e' WHERE user_id=$id LIMIT 1";
			$r = mysql_query ($q);

			if (mysql_affected_rows($link) == 1) {
				echo '<p>用户信息已更新。</p>';
			} else { 
				echo '<p class="error">由于系统原因，用户信息无法被编辑。</p>'; 
				echo '<p>' . mysql_error($link) . '<br />Query: ' . $q . '</p>'; 
			}

		} else { 
			echo '<p class="error">邮箱地址已经被注册。</p>';
		}
	} else { 

		echo '<p class="error">发生了以下错误：<br />';
		foreach ($errors as $msg) { 
			echo " - $msg<br />\n";
		}
		echo '</p><p>请稍后再次尝试。</p>';
	
	}

}

$q = "SELECT first_name, last_name, email FROM users WHERE user_id=$id";		
$r = mysql_query ($q);

if (mysql_num_rows($r) == 1) { 

	$row = mysql_fetch_array ($r, MYSQLI_NUM);
	
	echo '<form action="edit_user.php" method="post">
<p>名字：<input type="text" name="first_name" size="15" maxlength="15" value="' . $row[0] . '" /></p>
<p>姓氏：<input type="text" name="last_name" size="15" maxlength="30" value="' . $row[1] . '" /></p>
<p>电子邮箱：<input type="text" name="email" size="20" maxlength="60" value="' . $row[2] . '"  /> </p>
<p><input type="submit" name="submit" value="确认" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';

}
include('includes/footer.html');
?>
