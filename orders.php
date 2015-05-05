<?php
$mysqli = new mysqli("localhost", "root", "", "murderer");
$mysqli->set_charset("utf8");
$mysqli1 = new mysqli("localhost", "root", "", "murderer");
$mysqli1->set_charset("utf8");
$mysqli2 = new mysqli("localhost", "root", "", "murderer");
$mysqli2->set_charset("utf8");
echo '
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Заказы</h2>
<table>
	<thead>
		<tr>
			<th>ФИО</th>
			<th>Товар</th>
			<th>Количество</th>
		</tr>
	</thead>
	<tbody>';

if ($result = $mysqli->query("SELECT * FROM murderer.order", MYSQLI_USE_RESULT)) {
	while ($res=$result->fetch_array()){
		if ($result_user=$mysqli1->query("SELECT * FROM user WHERE uid=".$res['uid'], MYSQLI_USE_RESULT)){
			$user=$result_user->fetch_array();
		}
		
		if ($result_tovar=$mysqli2->query("SELECT * FROM tovar WHERE tid=".$res['tid'], MYSQLI_USE_RESULT)){
			$tovar=$result_tovar->fetch_array();
		}
		echo '
		<tr>
			<td>'.$user['fio'].'</td>
			<td>'.$tovar['name'].'</td>
			<td>'.$res['count1'].'</td>
		</tr>
		';
	}	
}

echo '
</tbody>
</table>
<a href="/?uid='.$_GET['uid'].'&role='.$_GET['role'].'&email='.$_GET['email'].'">Назад</a>
</body>
</html>';
?>
