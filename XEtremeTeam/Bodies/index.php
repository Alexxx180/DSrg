<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="Styles/Total.css" />
<script type="text/javascript" src="MainForm.js"></script>
<title>XEtreme Team</title>
<meta charset="utf-8" />
</head>
<body>

<div id="All">

<div id="TopPanel">
<div class="TpBtns" id="Tp1"><p>Татаринцев Александр</p></div>
<div class="TpBtns" id="Tp2" ><p>Главная</p></div>
<div class="TpBtns" id="Tp3" ><p>Основные сведения</p></div>
</div>

<div id="LeftPanel">
<div class="LpBtns" id="Lp1" onclick="Info();"><p>Главная</p></div>
<div class="LpBtns" id="Lp2" onclick="Products();"><p>Продукты</p></div>
<!--<div class="LpBtns" id="Lp3" ><p>Прочее</p></div>-->
</div>

<div id="MainContent">
	<h2 id="TxtHd">Добро пожаловать.</h2>
	<p id="Content">Данный сайт является именным.<br>Здесь вы можете приобрести наши продукты, связаться с нами.<br>Также представлен отдельный сервис для разработчиков.</p>
	<img id="Icon1" src="Imgs/Contacts/Creator.jpg" hidden />
	<button id="Web" onclick="ChangeType(true);" hidden disabled>Web</button>
	<button id="Local" onclick="ChangeType(false);" hidden>Локально</button>
</div>

<div id="RightPanel">
<div class="RpBtns" id="Rp1" onclick="Contacts();"><p>Контакты</p></div>
<div class="RpBtns" id="Rp2" onclick="DevOp();"><p>Разработчик</p></div>
</div>

<div id="Foot">
<p>Все права защищены<br><br>@mail: alexx120702@gmail.com<br>Телефон: +7(921)204-93-20</p>
</div>

</div>
</body>
</html>