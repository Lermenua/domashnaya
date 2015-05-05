<?php
$mysqli = new mysqli("localhost", "root", "", "murderer");
$mysqli->set_charset("utf8");
echo '
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Клиенты</h2>
<table>
	<thead>
		<tr>
			<th>ФИО</th>
			<th>E-mail</th>
			<th>Роль</th>
		</tr>
	</thead>
	<tbody>';
if ($result = $mysqli->query("SELECT * FROM user", MYSQLI_USE_RESULT)) {
	while ($res=$result->fetch_array()){
		echo '
		<tr>
			<td>'.$res['fio'].'</td>
			<td>'.$res['email'].'</td>
			<td>'.$res['role'].'</td>
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
