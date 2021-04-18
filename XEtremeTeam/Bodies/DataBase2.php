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
		<div id='Player' onclick='ChangeLocation("DataBase.php");'>Игрок</div>
		<div id='Bag' class="active">Сумка</div>
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
					<span onclick='ChangeLocation("DataBase.php");'>Игрок</span>
					<span>Сумка</span>
					<span onclick='ChangeLocation("DataBase3.php");'>Экипировка</span>
					<span onclick='ChangeLocation("DataBase4.php");'>Настройки</span>
					<span onclick='ChangeLocation("DataBase5.php");'>Параметры</span>
				</nav>
			</article>
			<section class="grid grid-10p gap">
			<article class="grid grid-13 gap">
					<span>№ сумки</span>
					<span>Логин</span>
					<span>Бинт</span>
					<span>Эфир</span>
					<span>Антидот</span>
					<span>Смесь</span>
					<span>Ц. травы</span>
					<span>Эфир2</span>
					<span>С. мешок</span>
					<span>Эликсир</span>
					<span>Материалы</span>
					<span>Изменение</span>
					<span>Удаление</span>
				</article>
			</section>
			<section class="grid grid-100p gap" id="Area">
				<form method="POST">
				<?php
					$fp = fopen('DataBase/Bag.csv','r') or die("can't open file");
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

					if(isset($_POST['Change'])) {
					        $content = "No,Login,Bandage,Ether,Antidote,Fused,Herbs,Ether2,SleepBag,Elixir,Materials";
							for ($i = 0; $i < count($arr); $i++)
							{
								if ($_POST["Change"]=="D".$i."2") {
									continue;
								}
								if ($_POST["Change"]=="U".$i."2")
									$content .= "\r\n".$_POST["p".$i."201"].",".$_POST["p".$i."202"].",".$_POST["p".$i."203"].",".$_POST["p".$i."204"].",".$_POST["p".$i."205"].",".$_POST["p".$i."206"].",".$_POST["p".$i."207"].",".$_POST["p".$i."208"].",".$_POST["p".$i."209"].",".$_POST["p".$i."210"].",".$_POST["p".$i."211"];
								else
									$content .="\r\n".$arr[$i][0].",".$arr[$i][1].",".$arr[$i][2].",".$arr[$i][3].",".$arr[$i][4].",".$arr[$i][5].",".$arr[$i][6].",".$arr[$i][7].",".$arr[$i][8].",".$arr[$i][9].",".$arr[$i][10];
							}
								if ($_POST["Change"]=="A2") {
									$content .= "\r\n".$_POST["Last1"].",".$_POST["Last2"].",".$_POST["Last3"].",".$_POST["Last4"].",".$_POST["Last5"].",".$_POST["Last6"].",".$_POST["Last7"].",".$_POST["Last8"].",".$_POST["Last9"].",".$_POST["Last10"].",".$_POST["Last11"];
								}
								file_put_contents("DataBase/Bag.csv", $content);
					    }
					$fp = fopen('DataBase/Bag.csv','r') or die("can't open file");
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
					if (count($arr)>=1)
					for ($i = 0; $i < count($arr); $i++) {
						echo "<article class=\"grid grid-13 gap\""; echo ">";
						echo "<input type='textbox' placeholder='№ сумки' name='p";  echo (int)$i; echo "201' value='"; echo (int)$arr[$i][0];    echo "'></input>";
						echo "<input type='textbox' placeholder='Логин' name='p";  	 echo (int)$i; echo "202' value='"; echo (string)$arr[$i][1]; echo "'></input>";
						echo "<input type='textbox' placeholder='Бинт' name='p";	 echo (int)$i; echo "203' value='"; echo (int)$arr[$i][2]; 	  echo "'></input>";
						echo "<input type='textbox' placeholder='Эфир' name='p";	 echo (int)$i; echo "204' value='"; echo (int)$arr[$i][3];	  echo "'></input>";
						echo "<input type='textbox' placeholder='Антидот' name='p";  echo (int)$i; echo "205' value='"; echo (int)$arr[$i][4]; 	  echo "'></input>";
						echo "<input type='textbox' placeholder='Смесь' name='p";	 echo (int)$i; echo "206' value='"; echo (int)$arr[$i][5];	  echo "'></input>";
						echo "<input type='textbox' placeholder='Ц. травы' name='p"; echo (int)$i; echo "207' value='"; echo (int)$arr[$i][6];	  echo "'></input>";
						echo "<input type='textbox' placeholder='Эфир2' name='p"; 	 echo (int)$i; echo "208' value='"; echo (int)$arr[$i][7]; 	  echo "'></input>";
						echo "<input type='textbox' placeholder='Сп. мешок' name='p";echo (int)$i; echo "209' value='"; echo (int)$arr[$i][8];	  echo "'></input>";
						echo "<input type='textbox' placeholder='Эликсир' name='p";	 echo (int)$i; echo "210' value='"; echo (int)$arr[$i][9]; 	  echo "'></input>";
						echo "<input type='textbox' placeholder='Материалы' name='p";echo (int)$i; echo "211' value='"; echo (int)$arr[$i][10];	  echo "'></input>";
						echo "<span><button type='submit' name='Change' value='U";	 echo (int)$i; echo "2'>!/_ Изменение</button></span>";
						echo "<span><button type='submit' name='Change' value='D";	 echo (int)$i; echo "2'>[Х] Удаление</button></span>";
						echo "</article>";
					}
					
				?>
				<article class="grid grid-13 gap">
					<input type='textbox' name='Last1' placeholder="№ сумки"></input>
					<input type='textbox' name='Last2' placeholder="Логин"></input>
					<input type='textbox' name='Last3' placeholder="Бинт"></input>
					<input type='textbox' name='Last4' placeholder="Эфир"></input>
					<input type='textbox' name='Last5' placeholder="Антидот"></input>
					<input type='textbox' name='Last6' placeholder="Смесь"></input>
					<input type='textbox' name='Last7' placeholder="Ц. травы"></input>
					<input type='textbox' name='Last8' placeholder="Эфир2"></input>
					<input type='textbox' name='Last9' placeholder="Сп. мешок"></input>
					<input type='textbox' name='Last10' placeholder="Эликсир"></input>
					<input type='textbox' name='Last11' placeholder="Материалы"></input>
					<span><button type='submit' name="Change" value="A2">(+) Добавление</button></span>
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