<?php
session_start();
include "connect_db.php";
if($_POST['name']){
	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$text = htmlspecialchars($_POST['text']);
	$insert = $connection->query("INSERT INTO zadachi(name,email,text) VALUES
	('".$name."','".$email."','".$text."')");
	if($insert){
		$out = "Задача успешно добавлена";
	}
	else echo "ошибка!";
}
?>

<style>
body{
		margin: 200px 300px;
	}
	input, p{
		font-size: 30px;
		margin: 10px;
	}
</style>
<form method="POST">
	<input type="text" name="name" placeholder="Введите имя" required><br>
    <input type="email" name="email" placeholder="Введите email" required><br>
	<input type="text" name="text" placeholder="Введите текст задачи" required><br>
	<input type="submit" name="insert" value="Добавить">
</form>
<a href="index.php">Назад</a>
<?
	echo $out;
?>









