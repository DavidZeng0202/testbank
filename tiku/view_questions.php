<?php
session_start();
$page_title = 'view questions';
include('includes/header.html');

echo '<h1>试题管理</h1>';

require_once('connect.php');

$display = 10;

if(isset($GET['p'])&& is_numeric($GET['p'])){
	$page = $_GET['p'];
} else {
	$q = "SELECT COUNT(ques_id) FROM timu";
	$r = mysql_query($q);
	$row = mysql_fetch_array($r,MYSQL_NUM);
	$records = $row[0];

	if ($records>$display){
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
}

if (isset($_GET['s']) && is_numeric($_GET['s'])){
	$start = $_GET['s'];
} else {
	$start = 0;
}


$q = "SELECT question,answer,correct,ques_id FROM `timu` order by ques_id asc LIMIT $start,$display";
	

$r = mysql_query($q);

if($r){
	echo '<table align="center" cellspacing= "3" cellpading = "3" width="100%">';
	// <tr><td align="left"><b>编辑</b></td>
	// <td align="left"><b>删除</b></td>
	// <td align="left"><b>题目</b></td>
	// <td align="left"><b>选项</b></td>
	// <td align="left"><b>正确答案</b></td></tr>
	// ';

	$bg = '#eeeeee';

	while ($row = mysql_fetch_array($r,MYSQL_ASSOC)) {
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');

		$answer=explode('###',$row['answer']);

		echo '<tr bgcolor "'.$bg.'">

		<tr><td align="left">'.$row['ques_id'].'.'.$row['question'].'</td></tr>
		<tr></tr>
		<tr><td align="left">'.$answer[0].'  '.$answer[1].'  '.$answer[2].'  '.$answer[3].'</td></tr>
		<tr><td align="left">' .$row['correct'].'</td></tr>
		<tr><td align="left"><a href="edit_question.php?id='.$row['ques_id'].'">编辑</a></td></tr>
		<td align="left"><a href="delete_question.php?id='.$row['ques_id'].'">删除</a></td>
		</tr>
		<tr></tr>';
	}


	echo '</table>';

	mysql_free_result($r);
	mysql_close($link);

	if($pages>1){
		echo '<br/><p>';
		$current_page = ($start/$display) + 1;

		if($current_page!=1){
			echo '<a href="view_questions.php?s='.($start - $display).'&p='.$pages.'">前一页</a>';
		}

		for($i = 1;$i <= $pages;$i++){
			if($i != $current_page){
				echo '<a href="view_questions.php?s='.(($display * ($i - 1))).'&p=' . $pages .'">'.$i.'</a>';
			} else {
				echo $i .' ';
			}
		}

		if($current_page != $pages){
			echo '<a href = "view_questions.php?s='.($start + $display). '&p='.$pages.'">下一页</a>';
		}

		echo '</p>';
	}
} 
else {
	echo '<p class ="error">该页无法显示。</p>';
	echo '<p>'. mysql_error($link).'<br/><br/>Query:'.$q.'</p>';
}

// mysql_close($link);

include('includes/footer.html');
?>