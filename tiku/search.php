<?php
session_start();
$page_title='Search';
include('includes/header.html');
include('connect.php');

if(isset($errors)&&!empty($errors)){
	echo '<h1>Error!</h1>
	<p class="error">以下错误发生：<br/>';
	foreach ($errors as $msg) {
		echo " - $msg<br/>\n";
	}
	echo '</p><p>请稍后尝试。</p>';
}


if($_SERVER['REQUEST_METHOD']=='POST'){
	echo '<h1>查询结果</h1>';
	$k= $_POST['keywords'];
$sql="SELECT * FROM `timu` where question like '%$k%' order by ques_id asc";
$query=mysql_query($sql);

	while($row=mysql_fetch_array($query)){
		$answer=explode('###',$row['answer']);
				echo '<tr>
				<td align="left">' . $row['ques_id'].'、'.$row['question'] . '</td>
				<p>
				<input type="radio" value="A" name="answer'.$row['ques_id'].'" >'.$answer[0].'<p>
				<input type="radio" value="B" name="answer'.$row['ques_id'].'" >'.$answer[1].'<p>
				<input type="radio" value="C" name="answer'.$row['ques_id'].'" >'.$answer[2].'<p>
				<input type="radio" value="D" name="answer'.$row['ques_id'].'" >'.$answer[3].'<p>
				</p>
				</tr>
				<br>';
	}
	// echo '<input type="submit" name="submit" value="提交"/>
	// </form> ';
} else {
	echo '<h1>查询试题</h1>';
	echo '
	<form action="search.php" method="post">
	<p>关键字：<input type="text" name="keywords" size="20" maxlength="60"/></p>
	<p><input type="submit" name="submit" value="查询" /></p>
	</form>';
}


 include('includes/footer.html'); 
 ?>