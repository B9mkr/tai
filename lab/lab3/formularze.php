<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<title> lab3 </title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body >
	<div>
        <?php
            //Funkcje pomocnicze:
            function drukuj_form() {
        ?>
		
        <!-- <a href="formularze.html">podać wartości</a> -->
		<form action = "formularze.php" method = "GET">
			<table>
				<tr>
					<td><label for = "nazwisk">Nazwisko:</label></td>
					<td><input type="text" name="nazwisko"/></td>
				</tr>
				<tr>
					<td><label for = "wie">Wiek:</label></td>
					<td><input type="text" name="wiek"/></td>
				</tr>
				<tr>
					<td><label for = "Panstw">Państwo:</label></td>
					<td>
						<select name="panstwo">
							<option value="p">Polska</option>
							<option value="n">Niemcy</option>
                            <option value="w">Wielka Brytania</option>
                            <option value="c">Czechy</option>
                            <option value="m">Moldawia</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><label for = "adresmail">Adres e-mail:</label></td>
					<td><input type="text" name="email"/></td>
				</tr>
			</table>

			<div id="baner"> <h4>Zamawiam tutorial z jęsyka:</h4> </div>
			
			<label for="php"> <input type="checkbox" name="PHP" value="PHP" id="php" /> PHP </label>
			<label for="c/c++"> <input type="checkbox" name="C" value="C" id="c/c++" /> C/C++ </label>
			<label for="java"> <input type="checkbox" name="Java" value="Java" id="java" /> Java </label> <br />

			<div id="baner"> <h4> Sposób  zapłaty:</h4> </div> 
			<label for="ecard"> <input type="radio" name="oplata" value="Euro card" id="ecard" /> eurocard </label>
			<label for="visa"> <input type="radio" name="oplata" value="Visa" id="visa" /> visa </label>
			<label for="prbank"> <input type="radio" name="oplata" value="Przelew bankowy" id="prbank" /> przelew bankowy </label> <br />
			
			<!-- <input type="submit" name="wyslij" value="Wyślij" /> -->
			<input type="reset" name="reset" value="Wyczyść formularz" />
			
            <input type="submit" value="Dodaj" name="submit"/>
			<input type="submit" value="Pokaz" name="submit"/>

			<input type="submit" value="Java" name="submit"/>
			<input type="submit" value="PHP" name="submit"/>
			<input type="submit" value="CPP" name="submit"/>
			<br />
		</form>

        <?php }
            function dodaj() {
                $linia = "";

				$nazwa_pliku = "dane.txt";
				
				$dane = create_dane();
				$linia = create_line($dane);
				echo ($nazwa_pliku.' '.$linia);

				$wp = fopen($nazwa_pliku, "r");
				if (!$wp){ 
					echo "<p>nie udało się odtworzyć</p></body></html>";
					exit;
				}

				$linia = fread($wp, filesize($nazwa_pliku))."\r\n".$linia;

				fclose($wp);
				$wp = fopen($nazwa_pliku, "w");
				if (!$wp){ 
					echo "<p>nie udało się odtworzyć</p></body></html>";
					exit;
				}
				
				fputs($wp, $linia);
				
				fclose($wp);
            }

            function pokaz() 
            {
				$nazwa_pliku = "dane.txt";

				$plik = fopen($nazwa_pliku,'r');
				if (!$plik){ 
					echo "<p>nie udało się odtworzyć</p></body></html>";
					exit;
				}

				$linia="";
				print("<ol>");
				while(!feof($plik))
				{
					print("<li>");
					$linia = fgets($plik);
					pokazm($linia);
					print("</li>");
					// $zawartosc .= $linia;
				}
				print("</ol>");
				fclose($plik);
            }
            function pokaz_zamowienie($lang) 
            {
                // odczytaj dane z pliku i wyświetl tylko te wiersze,
                //w których zamówiono $lang (np. $lang="Java"
            }
            //Skrypt:
            drukuj_form();
            if (isset($_REQUEST["submit"])) 
            {
                $akcja = $_REQUEST["submit"];
                switch ($akcja) 
                {
                    case "Dodaj":dodaj();break;
                    case "Pokaz":pokaz();break;
                    case "Java":pokaz_zamowienie($akcja);break;
					case "PHP":pokaz_zamowienie($akcja);break;
					case "CPP":pokaz_zamowienie($akcja);break;
					default: break;
                }
			}

			function pokazm($liniao){
				
				$linia=str_split($liniao);
				$slowo;
				$k=0;
				$m=0;
				$s=0;
				$dane;
				
				while($k < count($linia)){//6
					if($linia[$k]!="," && $linia[$k]!="(" && $linia[$k]!=")"){
						if($linia[$k]=="'"){
							echo " ";
							$k++;
							$m=0;
							while($linia[$k]!="'"){
								echo $linia[$k++];
								// $slowo[$m++]=$linia[$k++];
							}
							// $dane[$s++]=implode($slowo);
							// echo "</br>|".$dane[$s-1]."|</br>";
							
							$m=0;
						}
								
						// $k+=2;
						
						
						// $slowo[$m++] = $linia[$k];		
					}
					$k++;
				}
				// echo "</br>";
				// $k=0;
				// while($k<count($linia)){
				// 	echo $linia[$k];
				// 	$k++;
				// }
				// echo "</br>";
			}

			function create_dane(){
				if (isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="")) 
                {
                    $dane[0] = htmlspecialchars(trim($_REQUEST['nazwisko']));
                }
                else $dane[0] = "NULL";
            
                if (isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="")) 
                {
                    $dane[1] = htmlspecialchars(trim($_REQUEST['wiek']));
                }
                else $dane[1] = "NULL";
            
                if (isset($_REQUEST['panstwo'])&&($_REQUEST['panstwo']!="")) 
                {
                    $panstwo = htmlspecialchars(trim($_REQUEST['panstwo']));
                    switch($panstwo)
                    {
                        case "p":	$dane[2] = "Polska"; break;
                        case "n":	$dane[2] = "Niemcy"; break;
						case "w":	$dane[2] = "Wielka Brytania"; break;
						case "c":	$dane[2] = "Czechy"; break;
						case "m":	$dane[2] = "Moldawia"; break;
                        default:    $dane[2] = "NULL";
                    }
                }
            
                if (isset($_REQUEST['email'])&&($_REQUEST['email']!="")) 
                {
                    $dane[3] = htmlspecialchars(trim($_REQUEST['email']));
                }
                else $dane[3] = "NULL";
            
				$kurs = ["PHP", "C", "Java"];
				$dane[4]='';
                for ($i = 0; $i < count($kurs); $i++) 
                { 
                    if(isset($_REQUEST[$kurs[$i]])){
						$dane[4] .= $kurs[$i];
						if($i < count($kurs)-1)
                			$dane[4].=",";
					}
				}

				if (isset($_REQUEST['oplata'])&&($_REQUEST['oplata'] != "")) 
                {
                    $dane[5] = htmlspecialchars(trim($_REQUEST['oplata']));
				}
				else $dane[5] = "NULL";

				return $dane;
			}

			function create_line($dane)
			{
                $linia="(";
                for($i=0; $i<count($dane); $i++){
                    $linia .= "'".$dane[$i];
                    if($i<count($dane)-1)
                        $linia .= "', ";
                }
                $linia .= "');";

				return $linia;
            }
        ?>
	</div>

	</body>
</html>
