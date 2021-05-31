<?php
session_start();
//退出 清空session
$_SESSION['uid'] = '';
$_SESSION['username'] = '';
echo "<script type='text/javascript'>alert('Log out!');window.location.href='index.php';</script>";
?>