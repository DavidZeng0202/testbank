
	<?php
	$page_title='测试结果';
	include("includes/header.html");
	include_once("connect.php");
	$sql="SELECT * FROM `timu` order by id asc";
	$query=mysql_query($sql);

	$i=1;
	$q=0;
	while($row=mysql_fetch_array($query)){
		$answers[$i]=$_POST['answer'.$row['id'].''];
		print "<p>$answers[$i]";
		if($answers[$i]==$row['correct']) {$check[$i]="true"; $q++; print "   正确   ";}
		else {$check[$i]="false"; echo '   错误   正确答案应为   '.$row['correct'].'';}
		print "</p>";
		$i++;
	}
	$q=$q/($i-1);
	print "<p>正确率为$q</p>";
	?>
	<?php 
	include("includes/footer.html");
	 ?>
