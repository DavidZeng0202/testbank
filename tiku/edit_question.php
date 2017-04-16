<?php
session_start();
$page_title = 'Edit Question';
include ('includes/header.html');
echo '<h1>编辑试题信息</h1>';

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

	if (empty($_POST['question'])) {
		$errors[] = '请输入题目。';
	} else {
		$ques = trim($_POST['question']);
	}

	if (empty($_POST['answer'])) {
		$errors[] = '请输入选项。';
	} else {
		$an = trim($_POST['answer']);
	}

	if (empty($_POST['correct'])) {
		$errors[] = '请输入正确答案。';
	} else {
		$c = trim($_POST['correct']);
	}

	if (empty($errors)) { 

		$q = "SELECT ques_id FROM timu WHERE question='$ques' AND ques_id != $id";
		$r = mysql_query($q);

		if (mysql_num_rows($r) == 0) {
			$q = "UPDATE timu SET question='$ques', answer='$an', correct='$c' WHERE ques_id=$id LIMIT 1";
			$r = mysql_query ($q);

			if (mysql_affected_rows($link) == 1) {
				echo '<p>试题信息已更新。</p>';
			} else { 
				echo '<p class="error">由于系统原因，试题信息无法被编辑。</p>'; 
				echo '<p>' . mysql_error($link) . '<br />Query: ' . $q . '</p>'; 
			}

		} else { 
			echo '<p class="error">试题已经被录入。</p>';
		}
	} else { 

		echo '<p class="error">发生了以下错误：<br />';
		foreach ($errors as $msg) { 
			echo " - $msg<br />\n";
		}
		echo '</p><p>请稍后再次尝试。</p>';
	
	}

}

$q = "SELECT question, answer, correct FROM timu WHERE ques_id=$id";		
$r = mysql_query ($q);

if (mysql_num_rows($r) == 1) { 

	$row = mysql_fetch_array ($r, MYSQLI_NUM);
	
	echo '<form action="edit_question.php" method="post">
<p>题目：<input type="text" name="question" size="150" maxlength="150" value="' . $row[0] . '" /></p>
<p>选项：<input type="text" name="answer" size="100" maxlength="100" value="' . $row[1] . '" /></p>
<p>正确答案：<input type="text" name="correct" size="10" maxlength="10" value="' . $row[2] . '"  /> </p>
<p><input type="submit" name="submit" value="确认" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';

}
include('includes/footer.html');
?>
