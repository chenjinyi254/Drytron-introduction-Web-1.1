<?php
session_start();
error_reporting(0);
function query($sql){
	$conn = mysqli_connect('127.0.0.1','root','','database') or die('Fail');
    mysqli_query($conn,'SET NAMES UTF8') or die('Number set error');
	return mysqli_query($conn,$sql);
}
