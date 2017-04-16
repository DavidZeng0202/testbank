<?php
session_start();
$page_title = 'Change Your Password';
include('includes/header.html');

if($_SERVER['REQUEST_METHOD']=='POST'){
	require('connect.php');
	$errors = array();

	if(empty($_POST['email'])){
		$errors[] = '请输入邮箱地址。';
	} else {
		$e = trim($_POST['email']);
	}

	if(empty($_POST['pass'])){
		$errors[] = '请输入以前的密码。';
	} else {
		$p = trim($_POST['pass']);
	}

	if(!empty($_POST['pass'])){
		if($_POST['pass1']!=$_POST['pass2']){
			$errors[] = '新密码与确认密码不相同。';
		} else {
			$np = trim($_POST['pass1']);
		}
	}

	if(empty($errors)){
		$q = "SELECT user_id FROM users WHERE (email = '$e' AND pass=SHA1('$p'))";
		$r = mysql_query($q);
		$num = mysql_num_rows($r);
		if($num == 1){
			$row = mysql_fetch_array($r,MYSQL_NUM);

			$q = "UPDATE users SET pass=SHA1('$np') WHERE user_id=$row[0]";
			$r = mysql_query($q);

			if(mysql_affected_rows($link) == 1){
				echo '<h1>恭喜！</h1>
				<p>你的密码已更新。</p><p><br/></p>';
			} else {
				echo '<h1>系统错误</h1>
				<p class = "error">你的密码未能修改，对此感到抱歉。</p>';

				echo '<p>'.mysql_error($link).'<br/><br/>Query:'.$q.'</p>';
			}

			mysql_close($link);
			include ('includes/footer.html');
			exit();

		} else{
			echo '<h1>错误</h1>
			<p class="error">邮箱地址或密码有误。</p>';
		}
	} else {
		echo '<h1>错误</h1>
		<p class="error">以下错误发生:<br/>';
		foreach ($errors as $msg) {
			echo " - $msg<br/>\n";
		}
		echo '</p><p>请再次尝试。</p><p><br/></p>';
	}
	mysql_close($link);
}
?>
<h1>修改密码</h1>
<form action = "password.php" method="post">
<p>邮箱地址：<input type="text" name="email" size="20" maxlength = "60" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"/></p>
<p>当前密码：<input type="password" name="pass" size="10" maxlength = "20" value="<?php if(isset($_POST['pass'])) echo $_POST['pass']; ?>"/></p>
<p>新密码：<input type="password" name="pass1" size="10" maxlength = "20" value="<?php if(isset($_POST['pass1'])) echo $_POST['pass1']; ?>"/></p>
<p>确认密码：<input type="password" name="pass2" size="10" maxlength = "20" value="<?php if(isset($_POST['pass2'])) echo $_POST['pass2']; ?>"/></p>
<p><input type="submit" name="submit" value="修改密码" /></p>
</form>
<?php include('includes/footer.html'); ?>