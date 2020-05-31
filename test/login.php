<?
session_start();
include "connect_db.php";
$admin = $connection->query("SELECT * FROM admin");
if(isset($_POST['login'])){
	foreach($admin as $data)
	{
		if($data['login'] == $_POST['login'] && $data['password'] == $_POST['password'])
		{
			$_SESSION['login'] = $_POST['login'];
			$_SESSION['password'] = $_POST['password'];
			header("Location: admin.php");
		}
	}
			echo "Неправильный логин или пароль";	
}	

?>
<style>

	input{
		margin:10px;
		font-size:30px;
	}

</style>
<form method="POST">
	<input type="text" name="login" placeholder="Логин"><br>
	<input type="password" name="password" placeholder="Пароль"><br>
	<input type="submit">
</form>