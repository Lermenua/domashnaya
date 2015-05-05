<?php
error_reporting(0);

$file=file('tovars.csv');

$db=mysql_connect("localhost", "root", "");
mysql_select_db("murderer", $db);

echo '
<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>';
/****************/
if (isset($_GET['message'])){
	echo '<div class="message">'.$_GET['message'].'</div>';
}
/****************/
if ($_GET['role']=='admin'){
	echo '
	<div class="panel">
		Вы вошли как '.$_GET['email'].', <a href="/logout.php">Выйти</a>, <a href="/users.php?uid='.$_GET['uid'].'&role='.$_GET['role'].'&email='.$_GET['email'].'">Просмотр пользователей</a>, <a href="/orders.php?uid='.$_GET['uid'].'&role='.$_GET['role'].'&email='.$_GET['email'].'">Просмотр заказов</a>
	</div>';
}
/****************/
if ($_GET['role']=='user'){
	echo '
	<div class="panel">
		Вы вошли как '.$_GET['email'].', <a href="/logout.php">выйти</a>
	</div>';
}
/****************/
if (!isset($_GET['role'])){
echo '
<form action="login.php" metod="GET">
	<label for="email">E-mail</label><input type="text" id="email" name="email">
	<label for="pass">Пароль</label><input type="password" id="pass" name="pass">
	<label for="fio">ФИО</label><input type="fio" id="fio" name="fio">
	<label for="role">Роль</label>
		<select id="role" name="role">
			<option value="admin">Админ</option>
			<option value="user">Юзер</option>
		</select>
	<input id="submit" type="submit" value="Авторизиция\Регистрация">
</form>';
}
/************************/
if ($_GET['role']=='admin' or $_GET['role']=='user'){

echo '
<form action="action.php" metod="GET">
	<table>
		<thead>
			<tr>
				<th>Товар</th>
				<th>Цена</th>
				<th>Количество</th>
			</tr>
		</thead>
		
		<tbody>';
			
					
		$mysqli = new mysqli("localhost", "root", "", "murderer");
		$mysqli->set_charset("utf8");
		$i=1;
		if ($result = $mysqli->query("SELECT * FROM tovar", MYSQLI_USE_RESULT)) {
			while ($res=$result->fetch_array()){
				
				echo '
					<tr>
						<td>'.$res[name].'</td>
						<td>'.$res[price].'</td>
						<td><input type="text" name="count['.$i.']" ><input type="hidden" name="tid['.$i.']" value="'.$res[tid].'"></td>
					</tr>';
				$i++;
			}
		}
echo '		
		</tbody>
	</table>	
	<label for="prim">Примечания к заказу</label><br>
	<textarea id="prim" name="prim"></textarea><br>
	<input id="submit" type="submit" value="заказать">
	<input type="hidden" id="uid" name="uid" value="'.$_GET['uid'].'">
	<input type="hidden" id="role" name="role" value="'.$_GET['role'].'">
	<input type="hidden" id="email" name="email" value="'.$_GET['email'].'">
</form>';
}
/***********************/
echo '
</body>
</html>
';

