<?php
$page_title='Login';
include('includes/header.html');

if(isset($errors)&&!empty($errors)){
	echo '<h1>Error!</h1>
	<p class="error">The following error(s) occured:<br/>';
	foreach ($errors as $msg) {
		echo " - $msg<br/>\n";
	}
	echo '</p><p>Please try again.</p>';
}
?>
<h1>登录</h1>
<form action="login.php" method="post">
	<p>邮箱地址：<input type="text" name="email" size="20" maxlength="60"/></p>
	<p>密码：<input type="password" name="pass" size="20" maxlength="20"></p>
	<p><input type="submit" name="submit" value="登录" /></p>
</form>

<?php include('includes/footer.html'); ?>