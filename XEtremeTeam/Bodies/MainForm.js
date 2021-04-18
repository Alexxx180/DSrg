function Hide(Id, bool){
document.getElementById(Id).hidden=bool;
}
function Grid(Id, Row, Column){
	document.getElementById(Id).style.gridColumn = Column;
	document.getElementById(Id).style.gridRow = Row;
}
function Grid2(Id, RowStart, RowEnd, ColumnStart, ColumnEnd){
	document.getElementById(Id).style.gridColumnStart = ColumnStart;
	document.getElementById(Id).style.gridColumnEnd = ColumnEnd;
	document.getElementById(Id).style.gridRowStart = RowStart;
	document.getElementById(Id).style.gridRowEnd = RowEnd;
}

function ChangeType(Web){
	document.getElementById("Web").disabled=Web;
	document.getElementById("Local").disabled=!Web;
	if (Web){
		document.getElementById("Icon1").src="Imgs/CoverArts/WayIntoProgramming.jpg";
		document.getElementById("TxtHd").innerHTML="<sup>EN</sup>Way into programming<br><sup>RU</sup>Путь в программирование<br><br><form action='https://wip2020.herokuapp.com'><input type='submit' value='► Запуск' style='font-family: \"Franklin Gothic\"; font-size:100%;' disabled /> /!\\ Используется</form>";
		document.getElementById("Content").innerHTML="Свободное пользование.<br>Ограничения: игроки 50/50";
	}
	else {
		document.getElementById("Icon1").src="Imgs/CoverArts/DesertRage.jpg";
		document.getElementById("TxtHd").innerHTML="<sup>EN</sup>Desert Rage<br><sup>RU</sup>Ярость Пустыни<br><br><form action='https://github.com/Alexxx180/DSrg/archive/master.zip'><input type='submit' value='↓ Скачать' style='font-family: \"Franklin Gothic\"; font-size:100%;' /></form>";
		document.getElementById("Content").innerHTML="Свободное пользование.<br>Требования:<br>ОС: Windows 7/10<br>ПЗУ: 2 Гб<br>ОЗУ: 4 Гб";
	}
}

function Info() {
document.getElementById("TxtHd").innerHTML="Добро пожаловать.";
document.getElementById("Content").innerHTML="Данный сайт является именным.<br>Здесь вы можете приобрести наши продукты, связаться с нами.<br>Также представлен отдельный сервис для разработчиков.";
Grid2("TxtHd", 1, 2, 2, 7);
Grid2("Content", 3, 4, 2, 7);
Hide("Icon1", true);
Hide("Web", true);
Hide("Local", true);
}

function Contacts() {
	console.log(document.getElementById("TxtHd").style.gridColumnStart);
	Grid2("TxtHd", 1, 3, 5, 7);
	Grid2("Content", 4, 5, 5, 7);
	Grid2("Icon1", 2, 6, 2, 4);
	document.getElementById("TxtHd").innerHTML="Татаринцев Александр<br>Роль: основатель.";
	document.getElementById("Content").innerHTML="@mail: alexx120702@gmail.com<br>Телефон: +7(921)204-93-20<br>(VK):<a href='https://vk.com/t.alexander2002'>Татаринцев Александр</a>";
	document.getElementById("Icon1").src="Imgs/Contacts/Creator.jpg";
	Hide("Icon1", false);
	Hide("Web", true);
	Hide("Local", true);
}
function Products() {
	Grid2("TxtHd", 1, 3, 6, 7);
	Grid2("Content", 6, 7, 6, 7);
	Grid2("Icon1", 1, 7, 2, 5);
	document.getElementById("Web").disabled=true;
	document.getElementById("Local").disabled=false;
	document.getElementById("TxtHd").innerHTML="<sup>EN</sup>Way into programming<br><sup>RU</sup>Путь в программирование<br><br><form action='https://wip2020.herokuapp.com'><input type='submit' value='► Запуск' style='font-family: \"Franklin Gothic\"; font-size:100%;' disabled /> /!\\ Используется</form>";
	document.getElementById("Content").innerHTML="Свободное пользование.<br>Ограничения: игроки 50/50";
	document.getElementById("Icon1").src="Imgs/CoverArts/WayIntoProgramming.jpg";
	Hide("Icon1", false);
	Hide("Web", false);
	Hide("Local", false);
}
function DevOp(){
	Grid2("TxtHd", 1, 3, 2, 7);
	Grid2("Content", 4, 7, 2, 7);
	Hide("Web", true);
	Hide("Local", true);
	Hide("Icon1", true);
	document.getElementById("TxtHd").innerHTML="<p>Поддержка</p>";
	document.getElementById("Content").innerHTML="<a href ='javascript: void(0)'>Way into programming</a><br><a href='Admin.php'>Desert Rage</a><h2 style='text-decoration:underline;'>Как стать разработчиком?</h2>Свяжитесь с основателем для выявления условий.";
}