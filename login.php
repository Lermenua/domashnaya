<?php
$email=$_GET['email'];
$pass=$_GET['pass'];
$fio=$_GET['fio'];
$role=$_GET['role'];

$mysqli = new mysqli("localhost", "root", "", "murderer");

if ($result = $mysqli->query("SELECT * FROM user WHERE email='".$email."' AND pass='".$pass."'", MYSQLI_USE_RESULT)) {
	$res=$result->fetch_array();
	//print_r($res);db();
	if (isset($res['uid'])){
		//$res=$result->fetch_array();
		header ('Location: index.php?message=Вы успешно авторизированы&uid='.$res['uid'].'&role='.$role.'&email='.$email);
		exit;
		
	}
	else{
		$mysqli->query("INSERT INTO user (email,pass,fio,role) VALUES ('".$email."', '".$pass."', '".$fio."', '".$role."')", MYSQLI_USE_RESULT);
		$result1 = $mysqli->query("SELECT * FROM user WHERE email='".$email."' AND pass='".$pass."'", MYSQLI_USE_RESULT);
		$res=$result1->fetch_array();
		$result1->close();
		header ('Location: index.php?message=Вы успешно зарегистрированы&uid='.$res['uid'].'&role='.$res['role'].'&email='.$res['email']);
		exit;
	}
	
}
?>