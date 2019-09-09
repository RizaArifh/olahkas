<?php
include "conn.php";

$username = $_POST['username'];
$password = $_POST['password'];

$data = mysqli_query($con,"select * from user where username='$username' and password='$password'");
$cek = mysqli_num_rows($data);
if($cek > 0){
    session_start();
	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";
	header("location:../admin/index.php");
}else{
	header("location:../index.php");
}
?>