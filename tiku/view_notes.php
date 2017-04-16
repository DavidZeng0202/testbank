<?php
session_start();
$page_title = 'view notes';
include('includes/header.html');

echo '<h1>错题管理</h1>';

require_once('connect.php');

$q = "SELECT *  FROM relation ORDER BY r_id ASC ";

$r = mysql_query($q);

if($r){
	echo '<table align="center" cellspacing= "3" cellpading = "3" width="75%">
	<tr><td align="left"><b>出错试题编号</b></td>
	<td align="left"><b>出错用户编号</b></td>
	<td align="left"><b>出错次数</b></td>
	<td align="left"><b>最后一次出错日期</b></td>
	</tr>';

	$bg = '#eeeeee';

	while ($row = mysql_fetch_array($r,MYSQL_ASSOC)) {
		$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor "'.$bg.'">
		<td align="left">'.$row['ques_id'].'</td>
		<td align="left">'.$row['user_id'].'</td>
		<td align="left">' .$row['wrong_times'].'</td>
		<td align="left">' .$row['last_date'].'</td>
		</tr>';
	}


	echo '</table>';
}

	mysql_free_result($r);
	mysql_close($link);

include('includes/footer.html');
?>