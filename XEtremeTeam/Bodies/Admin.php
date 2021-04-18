<?php
		session_start();
		if ($_SERVER['REQUEST_METHOD'] == 'POST')
			if (($_POST['Login']="XEtremeAxe")&&($_POST['Pass']="I120dr49eB32c"))
			{
	    		$_SESSION['time'] = 199;
	    		header("Location: http://localhost:81/XEtreme%20Team/Bodies/DataBase.php");
			}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="Styles/AdminOnStyle.css">
	<title>Welcome, lads.</title>
</head>
<body>
<div id="all">
<!--
[EN] Send form to the server
[RU] Отправка формы на сервер.
-->
<form name="f1" id="ToPass" class="blue" method="POST">
	<p name="Entrance">Вход в систему</p>
	Логин<br>
	<input type="text" name="Login" id="Login1" /><br><br>
	Пароль<br>
	<input type="password" name="Pass" id="Password1" /><br><br>
	<input type="submit" name="Sub" value="Войти" class='Sub1' />
</form>
</div>
</body>
</html>