<?php
	include 'inc/mysql.php';
	$query = query("select * from user where username='{$_POST['username']}' && password='{$_POST['password']}'");
	$rows=mysqli_fetch_array($query,MYSQLI_ASSOC);
	if (!$rows){
 		echo "<script type='text/javascript'>alert('Your user name or code are error, try again！');history.back();</script>";
 	}else{
		$_SESSION['uid'] = $rows['id'];
		$_SESSION['username'] = $rows['username'];
		echo "<script type='text/javascript'>alert('Successful！');window.location.href='managerm.php';ck();</script>";
	}
?> 