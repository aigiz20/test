<?php
session_start();
include "connect_db.php";
if(!$_SESSION['login'] || !$_SESSION['password'])
{
	header("Location: login.php");
	die();
}

if(isset($_GET['page'])){
	$page = $_GET['page'];
} else $page=1;
$kol=3;
$art = ($kol*$page)-$kol;

if(empty($_GET['sort_value'])){
	 $spisok = $connection->query("SELECT * FROM zadachi LIMIT $art,$kol");
}
else{
	$name = $_GET['sort_value'];
	$spisok = $connection->query("SELECT * FROM zadachi ORDER BY '".$name."' LIMIT $art,$kol");
}

if($_POST['unlogin'])
{
	session_destroy();
	header("Location: login.php");
}

?>

<table border="0" width=65% bgcolor="Cornsilk" cellspacing="2" align="center">
<caption><h2>Список задач</caption>
<tr align="center">
	<th width=6%>Имя</th>
	<th>Почта</th>
	<th width="85%">Задача</th>
	<th width="5%">Статус</th>
	<th width="4%">Редактировать</th>
</tr>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="GET">
    <label for="sortValue">Сортировать по: </label>
    <select name="sort_value" id="sortValue">
        <option value="id" selected>Выберите</option>
        <option value="name">По названию(по возрастанию)</option>
        <option value="name DESC">По названию(по убыванию)</option>
    </select>
    <input type="submit" value="Применить">
		<?echo "<br>"?>

</form>

<style>
   a{  
		text-decoration: none; /* Отменяем подчеркивание у ссылки */
	}
</style>

<form method="POST">
	<input type="submit" value="Выйти из админки" name="unlogin">
</form>
	
<?
$res = $connection->query("SELECT COUNT(*) FROM zadachi");
$row = $res->fetch(PDO::FETCH_NUM);
$total = $row[0];
$str_pag = ceil($total/$kol);

for($i=1; $i <= $str_pag; $i++)
{
	echo "<a href=admin.php?page=".$i.">Страница ".$i." </a>";
	
	foreach ($spisok as $data)
	{
		echo
			"<tr><td>".$data['name']."</td>".
			"<td>".$data['email']."</td>".
			"<td>".$data['text']."</td>".
			"<td>".$data['status']."</td>".
'<td>'.'<a href="update_text.php?id='.$data['id'].'">Редактировать</a></td>'.
			"<tr>";
	}	
}







