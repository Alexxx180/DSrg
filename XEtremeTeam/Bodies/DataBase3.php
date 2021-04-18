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
		<div id='Equip' class="active">Экипировка</div>
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
					<span onclick='ChangeLocation("DataBase2.php");'>Сумка</span>
					<span>Экипировка</span>
					<span onclick='ChangeLocation("DataBase4.php");'>Настройки</span>
					<span onclick='ChangeLocation("DataBase5.php");'>Параметры</span>
				</nav>
			</article>
			<section class="grid grid-10p gap">
			<article class="grid grid-12 gap">
					<span>№ экип.</span>
					<span>Логин</span>
					<span>Оружие</span>
					<span>Броня</span>
					<span>Штаны</span>
					<span>Сапоги</span>
					<span>Код ор.</span>
					<span>Код бр.</span>
					<span>Код ш.</span>
					<span>Код с.</span>
					<span>Изменение</span>
					<span>Удаление</span>
				</article>
			</section>
			<section class="grid grid-100p gap" id="Area">
				<form method="POST">
				<?php
					$fp = fopen('DataBase/Equip.csv','r') or die("can't open file");
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
					        $content = "No,Login,Weapon,Armor,Pants,Boots,WPNS,ARMR,PNTS,BTS";
								for ($i = 0; $i < count($arr); $i++)
								{
									if ($_POST["Change"]=="D".$i."3") {
										continue;
								}
									if ($_POST["Change"]=="U".$i."3")
									$content .= "\r\n".$_POST["p".$i."301"].",".$_POST["p".$i."302"].",".$_POST["p".$i."303"].",".$_POST["p".$i."304"].",".$_POST["p".$i."305"].",".$_POST["p".$i."306"].",".$_POST["p".$i."307"].",".$_POST["p".$i."308"].",".$_POST["p".$i."309"].",".$_POST["p".$i."310"];
									else
										$content .="\r\n".$arr[$i][0].",".$arr[$i][1].",".$arr[$i][2].",".$arr[$i][3].",".$arr[$i][4].",".$arr[$i][5].",".$arr[$i][6].",".$arr[$i][7].",".$arr[$i][8].",".$arr[$i][9];
							}
								if ($_POST["Change"]=="A3") {
									$content .= "\r\n".$_POST["Last1"].",".$_POST["Last2"].",".$_POST["Last3"].",".$_POST["Last4"].",".$_POST["Last5"].",".$_POST["Last6"].",".$_POST["Last7"].",".$_POST["Last8"].",".$_POST["Last9"].",".$_POST["Last10"];
								}
								file_put_contents("DataBase/Equip.csv", $content);
					    }
					$fp = fopen('DataBase/Equip.csv','r') or die("can't open file");
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
							echo "<article class=\"grid grid-12 gap\""; echo ">";
							echo "<input type='textbox' placeholder='№ экип.' name='p";  echo (int)$i; echo "301' value='"; echo (int)$arr[$i][0];    echo "'></input>";
							echo "<input type='textbox' placeholder='Логин' name='p";  	 echo (int)$i; echo "302' value='"; echo (string)$arr[$i][1]; echo "'></input>";
							echo "<input type='textbox' placeholder='Оружие' name='p";	 echo (int)$i; echo "303' value='"; echo (int)$arr[$i][2]; 	  echo "'></input>";
							echo "<input type='textbox' placeholder='Броня' name='p";	 echo (int)$i; echo "304' value='"; echo (int)$arr[$i][3];	  echo "'></input>";
							echo "<input type='textbox' placeholder='Штаны' name='p";    echo (int)$i; echo "305' value='"; echo (int)$arr[$i][4]; 	  echo "'></input>";
							echo "<input type='textbox' placeholder='Сапоги' name='p";	 echo (int)$i; echo "306' value='"; echo (int)$arr[$i][5];	  echo "'></input>";
							echo "<input type='textbox' placeholder='Код ор.' name='p";  echo (int)$i; echo "307' value='"; echo (int)$arr[$i][6];	  echo "'></input>";
							echo "<input type='textbox' placeholder='Код бр.' name='p";  echo (int)$i; echo "308' value='"; echo (int)$arr[$i][7]; 	  echo "'></input>";
							echo "<input type='textbox' placeholder='Код ш.' name='p";	 echo (int)$i; echo "309' value='"; echo (int)$arr[$i][8];	  echo "'></input>";
							echo "<input type='textbox' placeholder='Код с.' name='p";	 echo (int)$i; echo "310' value='"; echo (int)$arr[$i][9]; 	  echo "'></input>";
							echo "<span><button type='submit' name='Change' value='U";	 echo (int)$i; echo "3'>!/_ Изменение</button></span>";
							echo "<span><button type='submit' name='Change' value='D";	 echo (int)$i; echo "3'>[Х] Удаление</button></span>";
							echo "</article>";
						}
					}
					
				?>
				<article class="grid grid-12 gap">
					<input type='textbox' name='Last1' placeholder="№ экип."></input>
					<input type='textbox' name='Last2' placeholder="Логин"></input>
					<input type='textbox' name='Last3' placeholder="Оружие"></input>
					<input type='textbox' name='Last4' placeholder="Броня"></input>
					<input type='textbox' name='Last5' placeholder="Штаны"></input>
					<input type='textbox' name='Last6' placeholder="Сапоги"></input>
					<input type='textbox' name='Last7' placeholder="Код ор."></input>
					<input type='textbox' name='Last8' placeholder="Код бр."></input>
					<input type='textbox' name='Last9' placeholder="Код ш."></input>
					<input type='textbox' name='Last10' placeholder="Код с."></input>
					<span><button type='submit' name="Change" value="A3">(+) Добавление</button></span>
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