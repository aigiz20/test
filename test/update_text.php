<html>
<body>
<?php
$idzadachi= $_GET['id'];
include('connect_db.php');
$select_zadachi=$connection->query("SELECT * FROM zadachi WHERE id = ".$idzadachi);
$zadachi=$select_zadachi->fetch(PDO::FETCH_BOTH);    
if (isset($_POST['ok'])) {
 
$text=$_POST['text'];
$status=$_POST['status'];
$connection->query("UPDATE zadachi SET text = '$text', status = '$status' WHERE id = '$idzadachi'");

echo'<meta http-equiv="refresh" content="0; url=admin.php">';
}
else{
	
?>

<form method="post">
<table>
<tr> 
     <td align="right">Текст:</td>
<td><input type="text" name="text" size="70" value="<?php  echo $zadachi['text']?>"/> </td
</tr>

<tr> 
     <td align="right">Статус:</td>
<td><input type="text" name="status" size="70" value="<?php  echo $zadachi['status']?>"/> </td
</tr>
<tr> 
     <td align="right"></td>
<td><input type="submit" name="ok" size="70" value="Редактировать"/></td>
</tr> 
</table>
</form>
<?if(isset($text)){
 $upd = '<td>'.'<a href="index.php?id='.$zadachi['id'].'">Отредактировано администратором</a></td>'.
			"<tr>";?>
<?}?>
<?}?>
</body>
</html>