<?php
session_start();
$page_title = 'Delete Question';
include ('includes/header.html');
echo '<h1>删除试题</h1>';

if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { 
	$id = $_GET['id'];
} else if ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { 
	$id = $_POST['id'];
} else { 
	echo '<p class="error">操作未成功。</p>';
	include ('includes/footer.html'); 
	exit();
}

require ('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['sure'] == 'Yes') { 

		$q = "DELETE FROM timu WHERE ques_id=$id LIMIT 1";		
		$r = mysql_query ($q);
		if (mysql_affected_rows($link) == 1) {
			$q = "DELETE  FROM relation WHERE ques_id=$id ";
			$r = mysql_query ($q);
			echo '<p>试题已删除。</p>';	
		} else {
			echo '<p class="error">由于系统原因，该试题无法被删除。</p>'; 
			echo '<p>' . mysql_error($link) . '<br />Query: ' . $q . '</p>'; 
		}
	
	} else {
		echo '<p>该试题未被删除。</p>';	
	}

} else {
	$q = "SELECT CONCAT(ques_id, ', ', question) FROM timu WHERE ques_id=$id";
	$r = mysql_query ($q);

	if (mysql_num_rows($r) == 1) {

		$row = mysql_fetch_array ($r, MYSQLI_NUM);
		
		echo "<h3>题号：$row[0]</h3>
		你确定要删除这道试题吗？";
		
		echo '<form action="delete_question.php" method="post">
	<input type="radio" name="sure" value="Yes" /> 是
	<input type="radio" name="sure" value="No" checked="checked" /> 否
	<input type="submit" name="submit" value="确定" />
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';
	
	} else { 
		echo '<p class="error">页面出错。</p>';
	}

} 

mysql_close($link);
		
include ('includes/footer.html');
?>