<?php
$i=1;
foreach ($_GET[tid] as $tid){
	$mysqli = new mysqli("localhost", "root", "", "murderer");
	$result = $mysqli->query("INSERT INTO murderer.order (tid, count1, uid) VALUES (".$tid.", ".$_GET['count'][$i].", ".$_GET['uid'].")", MYSQLI_USE_RESULT);
	$i++;
}
header ('Location: index.php?message=Вы заказали товар&uid='.$_GET['uid'].'&role='.$_GET['role'].'&email='.$_GET['email']);
?>