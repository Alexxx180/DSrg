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
		<div id='Settings' onclick='ChangeLocation("DataBase4.php");'>Настройки</div>
		<div id='Stats' class="active">Параметры</div>
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
					<span onclick='ChangeLocation("DataBase4.php");'>Настройки</span>
					<span>Параметры</span>
				</nav>
			</article>
			<section class="grid grid-10p gap">
			<article class="grid grid-9 gap">
					<span>Уровень</span>
					<span>Макс. ОЗ</span>
					<span>Макс. ОД</span>
					<span>Атака</span>
					<span>Защита</span>
					<span>Скорость</span>
					<span>Специальное</span>
					<span>Изменение</span>
					<span>Удаление</span>
				</article>
			</section>
			<section class="grid grid-100p gap" id="Area">
				<form method="POST">
				<?php
					$fp = fopen('DataBase/Stats.csv','r') or die("can't open file");
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
					        $content = "Level,MaxHp,MaxAp,Attack,Defence,Speed,Special";
								for ($i = 0; $i < count($arr); $i++)
								{
									if ($_POST["Change"]=="D".$i."5") {
										continue;
									}
									if ($_POST["Change"]=="U".$i."5")
									$content .= "\r\n".$_POST["p".$i."501"].",".$_POST["p".$i."502"].",".$_POST["p".$i."503"].",".$_POST["p".$i."504"].",".$_POST["p".$i."505"].",".$_POST["p".$i."506"].",".$_POST["p".$i."507"];
									else
										$content .="\r\n".$arr[$i][0].",".$arr[$i][1].",".$arr[$i][2].",".$arr[$i][3].",".$arr[$i][4].",".$arr[$i][5].",".$arr[$i][6];
								}
								if ($_POST["Change"]=="A5") {
									$content .= "\r\n".$_POST["Last1"].",".$_POST["Last2"].",".$_POST["Last3"].",".$_POST["Last4"].",".$_POST["Last5"].",".$_POST["Last6"].",".$_POST["Last7"];
								}
								file_put_contents("DataBase/Stats.csv", $content);
					    }
					$fp = fopen('DataBase/Stats.csv','r') or die("can't open file");
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
							echo "<article class=\"grid grid-9 gap\""; echo ">";
							echo "<input type='textbox' placeholder='Уровень' name='p";  echo (int)$i; echo "501' value='"; echo (int)$arr[$i][0];    echo "'></input>";
							echo "<input type='textbox' placeholder='Макс. ОЗ' name='p";  	 echo (int)$i; echo "502' value='"; echo (string)$arr[$i][1]; echo "'></input>";
							echo "<input type='textbox' placeholder='Макс. ОД' name='p";	 echo (int)$i; echo "503' value='"; echo (int)$arr[$i][2]; 	  echo "'></input>";
							echo "<input type='textbox' placeholder='Атака' name='p";	 echo (int)$i; echo "504' value='"; echo (int)$arr[$i][3];	  echo "'></input>";
							echo "<input type='textbox' placeholder='Защита' name='p";    echo (int)$i; echo "505' value='"; echo (int)$arr[$i][4]; 	  echo "'></input>";
							echo "<input type='textbox' placeholder='Скорость' name='p";	 echo (int)$i; echo "506' value='"; echo (int)$arr[$i][5];	  echo "'></input>";
							echo "<input type='textbox' placeholder='Специальное' name='p";  echo (int)$i; echo "507' value='"; echo (int)$arr[$i][6];	  echo "'></input>";
							echo "<span><button type='submit' name='Change' value='U";	 echo (int)$i; echo "5'>!/_ Изменение</button></span>";
							echo "<span><button type='submit' name='Change' value='D";	 echo (int)$i; echo "5'>[Х] Удаление</button></span>";
							echo "</article>";
						}
					}
					
				?>
				<article class="grid grid-9 gap">
					<input type='textbox' name='Last1' placeholder="Уровень"></input>
					<input type='textbox' name='Last2' placeholder="Макс. ОЗ"></input>
					<input type='textbox' name='Last3' placeholder="Макс. ОД"></input>
					<input type='textbox' name='Last4' placeholder="Атака"></input>
					<input type='textbox' name='Last5' placeholder="Защита"></input>
					<input type='textbox' name='Last6' placeholder="Скорость"></input>
					<input type='textbox' name='Last7' placeholder="Специальное"></input>
					<span><button type='submit' name="Change" value="A5">(+) Добавление</button></span>
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