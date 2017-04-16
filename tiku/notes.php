<?php
session_start();
$page_title='Notes';
include('includes/header.html');
include('connect.php');

$uid=$_SESSION['user_id'];

$sql="SELECT ques_id
FROM relation
where user_id = $uid order by ques_id asc";
$query=mysql_query($sql);

echo '<h1>错题本</h1>
<form action="test.php" method="POST">';
while($r=mysql_fetch_array($query)){
	$qid = $r['ques_id'];
	$ql="SELECT * FROM timu where ques_id = $qid order by ques_id asc";
	$ry=mysql_query($ql);
	// $row=mysql_fetch_array($ry);
	while($row=mysql_fetch_array($ry,MYSQL_ASSOC)){
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
	$ql="SELECT * FROM relation where ques_id = $qid and user_id = $uid  limit 1";
	$ry=mysql_query($ql);
	 $row=mysql_fetch_array($ry,MYSQL_ASSOC);
	echo '<p>出错次数：'.$row['wrong_times'].'</p>';
	echo '<p>最后一次出错日期：'.$row['last_date'].'</p><p></p>';
	}
}

include('includes/footer.html'); 
?>