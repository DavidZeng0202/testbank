<?php
$page_title='test';
session_start();
include("connect.php");
include_once("includes/header.html");


$sql="SELECT * FROM `timu` order by ques_id asc";
// $query=mysql_query($sql);
// while($row=mysql_fetch_array($query)){
// 	$answer=explode('###',$row['answer']);
// 	$arr[]=array(
// 		'question'=>$row['ques_id'].'、'.$row['question'],
// 		'answer'=>$answer
// 		);
// }
//$json=json_encode($arr);
$i=1;
$q=0;
$query=mysql_query($sql);
if($_SERVER['REQUEST_METHOD']=='POST'){
	echo '<h1>测试结果</h1>';
	while($row=mysql_fetch_array($query)){
		$answers[$i]=$_POST['answer'.$row['ques_id'].''];
		print "<p>$answers[$i]";
		if($answers[$i]==$row['correct']) {$check[$i]="true"; $q++; print "   正确   ";}
		else {
			$check[$i]="false"; echo '   错误   正确答案应为   '.$row['correct'].'';
			if(isset($_SESSION['user_id'])){

				$qid=$row['ques_id'];
				$uid=$_SESSION['user_id'];

				$ql = "SELECT ques_id FROM relation WHERE ques_id= $qid AND user_id=$uid ";
				$r=mysql_query($ql);
				if(mysql_num_rows($r)==1){
					$ql = "UPDATE relation SET wrong_times = wrong_times+1,last_date=NOW() WHERE ques_id= $qid AND user_id=$uid LIMIT 1";
					$r=mysql_query($ql);
				} else {
					$ql = "INSERT INTO relation (ques_id,user_id,wrong_times,last_date) VALUES ('$qid','$uid','1',NOW())";
					$r=mysql_query($ql);
					// echo '<p>ppp</p>';
				}
			}

		}
		print "</p>";
		$i++;
	}
	$q=$q/($i-1);
	print "<p>正确率为$q</p>";
	}
?>

			<h1>历年真题</h1>
			<?php
			$query=mysql_query($sql);

			echo '<form action="test.php" method="POST">';
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
			echo '<input type="submit" name="submit" value="提交"/>
			</form> ';
			?>

			<?php include("includes/footer.html"); ?>