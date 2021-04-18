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
		<div id='Bag' onclick='ChangeLocation("DataBase2.php");'>Сумка</div>
		<div id='Equip' onclick='ChangeLocation("DataBase3.php");'>Экипировка</div>
		<div id='Settings' class="active">Настройки</div>
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
					<span onclick='ChangeLocation("DataBase2.php");'>Сумка</span>
					<span onclick='ChangeLocation("DataBase3.php");'>Экипировка</span>
					<span>Настройки</span>
					<span onclick='ChangeLocation("DataBase5.php");'>Параметры</span>
				</nav>
			</article>
			<section class="grid grid-10p gap">
			<article class="grid grid-10 gap">
					<span>№ наст.</span>
					<span>Логин</span>
					<span>Музыка %</span>
					<span>Звуки %</span>
					<span>Шумы %</span>
					<span>С. боя %</span>
					<span>Яркость %</span>
					<span>Таймер</span>
					<span>Изменение</span>
					<span>Удаление</span>
				</article>
			</section>
			<section class="grid grid-100p gap" id="Area">
				<form method="POST">
				<?php
					$fp = fopen('DataBase/Settings.csv','r') or die("can't open file");
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
					        $content = "No,Login,Music,Sounds,Noises,FightSpeed,Bright,Timer";
								for ($i = 0; $i < count($arr); $i++)
								{
									if ($_POST["Change"]=="D".$i."4") {
										continue;
									}
									if ($_POST["Change"]=="U".$i."4")
									$content .= "\r\n".$_POST["p".$i."401"].",".$_POST["p".$i."402"].",".$_POST["p".$i."403"].",".$_POST["p".$i."404"].",".$_POST["p".$i."405"].",".$_POST["p".$i."406"].",".$_POST["p".$i."407"].",".($_POST["p".$i."408"]=="Yes"?"1":"0");
									else
										$content .="\r\n".$arr[$i][0].",".$arr[$i][1].",".$arr[$i][2].",".$arr[$i][3].",".$arr[$i][4].",".$arr[$i][5].",".$arr[$i][6].",".$arr[$i][7];
								}
								if ($_POST["Change"]=="A4") {
									$content .= "\r\n".$_POST["Last1"].",".$_POST["Last2"].",".$_POST["Last3"].",".$_POST["Last4"].",".$_POST["Last5"].",".$_POST["Last6"].",".$_POST["Last7"].",".($_POST["Last8"]=="Yes"?"1":"0");
								}
								file_put_contents("DataBase/Settings.csv", $content);
					    }
					$fp = fopen('DataBase/Settings.csv','r') or die("can't open file");
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
					if (count($arr)>=1){
						for ($i = 0; $i < count($arr); $i++) {
							echo "<article class=\"grid grid-10 gap\""; echo ">";
							echo "<input type='textbox' placeholder='№ наст.' name='p";  echo (int)$i; echo "401' value='"; echo (int)$arr[$i][0];    echo "'></input>";
							echo "<input type='textbox' placeholder='Логин' name='p";  	 echo (int)$i; echo "402' value='"; echo (string)$arr[$i][1]; echo "'></input>";
							echo "<input type='textbox' placeholder='Музыка %' name='p";	 echo (int)$i; echo "403' value='"; echo (int)$arr[$i][2]; 	  echo "'></input>";
							echo "<input type='textbox' placeholder='Звуки %' name='p";	 echo (int)$i; echo "404' value='"; echo (int)$arr[$i][3];	  echo "'></input>";
							echo "<input type='textbox' placeholder='Шумы %' name='p";    echo (int)$i; echo "405' value='"; echo (int)$arr[$i][4]; 	  echo "'></input>";
							echo "<input type='textbox' placeholder='С. боя %' name='p";	 echo (int)$i; echo "406' value='"; echo (int)$arr[$i][5];	  echo "'></input>";
							echo "<input type='textbox' placeholder='Яркость %' name='p";  echo (int)$i; echo "407' value='"; echo (int)$arr[$i][6];	  echo "'></input>";
							echo "<span><input type='checkbox' value='Yes' placeholder='Код бр.' name='p";echo (int)$i;echo "408' ";echo (((int)$arr[$i][7])>=1 ? "checked" : ""); echo "></input>Нет</span>";
							echo "<span><button type='submit' name='Change' value='U";	 echo (int)$i; echo "4'>!/_ Изменение</button></span>";
							echo "<span><button type='submit' name='Change' value='D";	 echo (int)$i; echo "4'>[Х] Удаление</button></span>";
							echo "</article>";
						}
					}
					
				?>
				<article class="grid grid-10 gap">
					<input type='textbox' name='Last1' placeholder="№ наст."></input>
					<input type='textbox' name='Last2' placeholder="Логин"></input>
					<input type='textbox' name='Last3' placeholder="Музыка %"></input>
					<input type='textbox' name='Last4' placeholder="Звуки %"></input>
					<input type='textbox' name='Last5' placeholder="Шумы %"></input>
					<input type='textbox' name='Last6' placeholder="С. боя %"></input>
					<input type='textbox' name='Last7' placeholder="Яркость %"></input>
					<span><input type='checkbox' value='Yes' name='Last8'></input>Нет</span>
					<span><button type='submit' name="Change" value="A4">(+) Добавление</button></span>
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