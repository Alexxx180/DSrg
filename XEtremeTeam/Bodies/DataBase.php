<?php
		session_start();
		if (isset($_SESSION['time'])) { if ($_SESSION['time']==0) header("Location: http://localhost:81/XEtreme%20Team/Bodies/Admin.php"); } 
		else
			header("Location: http://localhost:81/XEtreme%20Team/Bodies/Admin.php");

		if (!isset($_SESSION['CREATED'])) {
    		$_SESSION['CREATED'] = time();
		} else if (time() - $_SESSION['CREATED'] > 1800) {
    	// session started more than 30 minutes ago
    		session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    		$_SESSION['CREATED'] = time();  // update creation time
    		$_SESSION['time']=0;
			//session_destroy();
		    header("Location: http://localhost:81/XEtreme%20Team/Bodies/Admin.php");
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Desert Rage</title>
	<link rel="stylesheet" href="Styles/DataBase.css" />
	<script type="text/javascript" src="Scripts/DataBase.js"></script>
</head>
<body class="grid grid-3 gap-50">
<section class="TblSection">
	<div id='BtnTbl'>Таблицы</div>
	<div id='Tables'>
		<div id='Player' class="active">Игрок</div>
		<div id='Bag' onclick='ChangeLocation("DataBase2.php");'>Сумка</div>
		<div id='Equip' onclick='ChangeLocation("DataBase3.php");'>Экипировка</div>
		<div id='Settings' onclick='ChangeLocation("DataBase4.php");'>Настройки</div>
		<div id='Stats' onclick='ChangeLocation("DataBase5.php");'>Параметры</div>
</section>
	</div>
	<section class="grid main">
		<!--<article class="right">
			<span onclick="Mode(true);">Таблицы</span>
			<span onclick="Mode(false);">Форма</span>
		</article>-->
		<section class="grid" id="switcher-table">
			<article>
				<nav class="flex">
					<span>Игрок</span>
					<span onclick='ChangeLocation("DataBase2.php");'>Сумка</span>
					<span onclick='ChangeLocation("DataBase3.php");'>Экипировка</span>
					<span onclick='ChangeLocation("DataBase4.php");'>Настройки</span>
					<span onclick='ChangeLocation("DataBase5.php");'>Параметры</span>
				</nav>
			</article>
			<section class="grid grid-10p gap">
			<article class="grid grid-11 gap">
					<span>Логин</span>
					<span>Уровень</span>
					<span>Локация</span>
					<span>ОЗ</span>
					<span>ОД</span>
					<span>Опыт</span>
					<span>Задача</span>
					<span>Бестиарий</span>
					<span>Сеанс</span>
					<span>Изменение</span>
					<span>Удаление</span>
				</article>
			</section>
			<section class="grid grid-100p gap" id="Area">
				<form method="POST">
				<?php
					$fp = fopen('DataBase/Player.csv','r') or die("can't open file");
					$arr=[];
					$c=0;
					while($csv_line = fgetcsv($fp,1024)) {
						if ($c>0) {
						    for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
						        $arr[$c-1][$i]=$csv_line[$i];
						    }
					    }
					    $c++;
					}
					fclose($fp) or die("can't close file");

					if(isset($_POST['Change'])) {
					        $content = "Login,Level,Location,Hp,Ap,Exp,Task,Learned,Timer";
							for ($i = 0; $i < count($arr); $i++)
							{
								if ($_POST["Change"]=="D".$i."1") {
									continue;
								}
								if ($_POST["Change"]=="U".$i."1")
									$content .= "\r\n".$_POST["p".$i."101"].",".$_POST["p".$i."102"].",".$_POST["p".$i."103"].",".$_POST["p".$i."104"].",".$_POST["p".$i."105"].",".$_POST["p".$i."106"].",".($_POST["p".$i."107"]=="Yes"?"1":"0").",".$_POST["p".$i."108"].",".($_POST["p".$i."109"]=="Yes"?"1":"0");
								else
									$content .="\r\n".$arr[$i][0].",".$arr[$i][1].",".$arr[$i][2].",".$arr[$i][3].",".$arr[$i][4].",".$arr[$i][5].",".$arr[$i][6].",".$arr[$i][7].",".$arr[$i][8].",".$arr[$i][9].",".$arr[$i][10];
							}
								if ($_POST["Change"]=="A1") {
									$content .= "\r\n".$_POST["Last1"].",".$_POST["Last2"].",".$_POST["Last3"].",".$_POST["Last4"].",".$_POST["Last5"].",".$_POST["Last6"].",".($_POST["p".$i."Last7"]=="Yes"?"1":"0").",".$_POST["Last8"].",".($_POST["p".$i."Last9"]=="Yes"?"1":"0");
								}
								file_put_contents("DataBase/Player.csv", $content);
					    }
					$fp = fopen('DataBase/Player.csv','r') or die("can't open file");
					$arr=[];
					$c=0;
					//print "<article>\n";
					while($csv_line = fgetcsv($fp,1024)) {
						if ($c>0) {
						    for ($i = 0, $j = count($csv_line); $i < $j; $i++) {
						        $arr[$c-1][$i]=$csv_line[$i];
						    }
					    }
					    $c++;
					}
					fclose($fp) or die("can't close file");
					//echo $content;
					//echo count($arr);
					//echo (string)$arr[$i][0];
					if (count($arr)>=1)
					for ($i = 0; $i < count($arr); $i++) {
						echo "<article class=\"grid grid-11 gap\""; echo ">";
						echo "<input type='textbox' placeholder='Логин' name='p"; echo (int)$i; echo "101' value='"; echo (string)$arr[$i][0]; echo "'></input>";
						echo "<input type='textbox' placeholder='Уровень' name='p"; echo (int)$i; echo "102' value='"; echo (int)$arr[$i][1]; echo "'></input>";
						echo "<input type='textbox' placeholder='Локация' name='p"; echo (int)$i; echo "103' value='"; echo (int)$arr[$i][2]; echo "'></input>";
						echo "<input type='textbox' placeholder='ОЗ' name='p"; echo (int)$i; echo "104' value='"; echo (int)$arr[$i][3]; echo "'></input>";
						echo "<input type='textbox' placeholder='ОД' name='p"; echo (int)$i; echo "105' value='"; echo (int)$arr[$i][4]; echo "'></input>";
						echo "<input type='textbox' placeholder='Опыт' name='p"; echo (int)$i; echo "106' value='"; echo (int)$arr[$i][5]; echo "'></input>";
						echo "<span><input type='checkbox' value='Yes' name='p"; echo (int)$i; echo "107' "; echo (((int)$arr[$i][6]>=1) ? "checked" : ""); echo "></input>Да</span>";
						echo "<input type='textbox' placeholder='Бестиарий' name='p"; echo (int)$i; echo "108' value='"; echo (int)$arr[$i][7]; echo "'></input>";
						echo "<span><input type='checkbox' value='Yes' name='p"; echo (int)$i; echo "109' "; echo (((int)$arr[$i][8]>=1) ? "checked" : ""); echo ">Да</input></span>";
						echo "<span><button type='submit' name='Change' value='U"; echo (int)$i; echo "1'>!/_ Изменение</button></span>";
						echo "<span><button type='submit' name='Change' value='D"; echo (int)$i; echo "1'>[Х] Удаление</button></span>";
						echo "</article>";
					}
					
				?>
				<article class="grid grid-11 gap">
					<input type='textbox' name='Last1' placeholder="Логин"></input>
					<input type='textbox' name='Last2' placeholder="Уровень"></input>
					<input type='textbox' name='Last3' placeholder="Локация"></input>
					<input type='textbox' name='Last4' placeholder="ОЗ"></input>
					<input type='textbox' name='Last5' placeholder="ОД"></input>
					<input type='textbox' name='Last6' placeholder="Опыт"></input>
					<span><input type='checkbox' name='Last7'>Да</input></span>
					<input type='textbox' name='Last8' placeholder="Бестиарий"></input>
					<span><input type='checkbox' name='Last9'>Да</input></span>
					<span><button type='submit' name="Change" value="A1">(+) Добавление</button></span>
					<span>Новый...</span>
				</article>
				</form>
				</section>
		</section>		
		<section id="switcher-form" hidden>
			<article>
				<nav class="flex">
				</nav>
			</article>

		</section>
	</section>
</body>
</html>