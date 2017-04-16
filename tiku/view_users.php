<?php
session_start();
$page_title = 'view users';
include('includes/header.html');

echo '<h1>用户管理</h1>';

require_once('connect.php');

$display = 10;

if(isset($GET['p'])&& is_numeric($GET['p'])){
	$page = $_GET['p'];
} else {
	$q = "SELECT COUNT(user_id) FROM users";
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


$q = "SELECT last_name, first_name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr ,user_id FROM users ORDER BY registration_date ASC LIMIT $start,$display";

//$q = "SELECT CONCAT(last_name, ', ', first_name) AS name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM users ORDER BY registration_date ASC";		

$r = mysql_query($q);

if($r){
	echo '<table align="center" cellspacing= "3" cellpading = "3" width="75%">
	<tr><td align="left"><b>编辑</b></td>
	<td align="left"><b>删除</b></td>
	<td align="left"><b>姓氏</b></td>
	<td align="left"><b>名字</b></td>
	<td align="left"><b>注册日期</b></td></tr>';

	$bg = '#eeeeee';

	while ($row = mysql_fetch_array($r,MYSQL_ASSOC)) {
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor "'.$bg.'">
		<td align="left"><a href="edit_user.php?id='.$row['user_id'].'">编辑</a></td>
		<td align="left"><a href="delete_user.php?id='.$row['user_id'].'">删除</a></td>
		<td align="left">'.$row['last_name'].'</td>
		<td align="left">'.$row['first_name'].'</td>
		<td align="left">' .$row['dr'].'</td>
		</tr>';
	}


	echo '</table>';

	mysql_free_result($r);
	mysql_close($link);

	if($pages>1){
		echo '<br/><p>';
		$current_page = ($start/$display) + 1;

		if($current_page!=1){
			echo '<a href="view_users.php?s='.($start - $display).'&p='.$pages.'">前一页</a>';
		}

		for($i = 1;$i <= $pages;$i++){
			if($i != $current_page){
				echo '<a href="view_users.php?s='.(($display * ($i - 1))).'&p=' . $pages .'">'.$i.'</a>';
			} else {
				echo $i .' ';
			}
		}

		if($current_page != $pages){
			echo '<a href = "view_users.php?s='.($start + $display). '&p='.$pages.'">下一页</a>';
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