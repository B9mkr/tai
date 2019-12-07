<?php /*deklaracje funkcji*/
function drukuj_form($imie, $nazw, $tel) { ?>
<form method="post" action="http://localhost/form3.php">
Nazwisko *: <input type="text" name="nazw" value="
<?php print $nazw ?> "><br />
Imię: <input type="text" name="imie" value="<? print $imie ?>"><br />
Telefon *:</b><input type="text" name="tel" size=10 value="
<? print $tel ?>"><br />
<input type="submit" name="submit" value="Wyslij zamówienie">
<input type="reset" value="Anuluj zamówienie">
</form>
<?php } //koniec funkcji drukuj_form

// <?php
//     $tech = ["C", "CPP", "Java", "C#", "Html", "CSS", "XML", "PHP", "JavaScript"];
//     for ($i=0; $i < 9 ; $i++) { 
//         print("<label for=\"".$tech[$i]."\"> <input type=\"checkbox\" name=\"tech[]\" value=\"".$tech[$i]."\" id=\"".$tech[$i]."\" />".$tech[$i]."</label>");
//     }
// ?>


<!-- 
<?php
			echo '<h2>Dane odebrane z formularza:</h2>';
			if (isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="")) {
				$nazwisko = htmlspecialchars(trim($_REQUEST['nazwisko']));
				echo 'Nazwisko:'.$nazwisko.'<br />';
			}
			else echo 'Nie wpisano nazwiska <br />';
			
			if (isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="")) {
				$wiek = htmlspecialchars(trim($_REQUEST['wiek']));
				echo 'Wiek:'.$wiek.'<br />';
			}
			else echo 'Nie wpisano wieku <br />';

			if (isset($_REQUEST['panstwo'])&&($_REQUEST['panstwo']!="")) {
				$panstwo = htmlspecialchars(trim($_REQUEST['panstwo']));
				switch($panstwo)
				{
					case "p":	echo 'Państwo: Polska<br />'; break;
					case "u":	echo 'Państwo: Ukraina<br />'; break;
					case "n":	echo 'Państwo: Niemiecki<br />'; break;
					case "i":	echo 'Państwo: Inne<br />'; break;
					default: echo 'Nie wpisano państwa <br />';
				}
			}

			if (isset($_REQUEST['email'])&&($_REQUEST['email']!="")) {
				$email = htmlspecialchars(trim($_REQUEST['email']));
				echo 'email:'.$email.'<br />';
			}
			else echo 'Nie wpisano emailu <br />';

			print("<h4>Zamawiane produkty:</h4>");

			$zmd=0;

			if ( isset($_REQUEST['PHP'] )) { 	
				print("- PHP<br />");
				$zmd=1;
			}
			if ( isset($_REQUEST['C'] )){
				print("- C/C++<br />");
				$zmd=1;
			}
			if ( isset($_REQUEST['Java'] )) {
				print("- Java<br />");
				$zmd=1;
			}
			if($zmd==0)
				print("Brak wybranych produktów </br>");
			
			// if (isset($_REQUEST['lang']))
			// {
			// 	echo 'wybrano:</br>';

			// 	$lang = $_REQUEST("kraj");
			// 	foreach($lang as $key => $value){
			// 		echo $value;
			// 	}
			// }
		?>
 -->

<!-- <?php
	echo "<h2>Pierwszy skrypt PHP</h2>";
	
	$x=10.56;
	$n=5;
	
echo "<p>x= $x </br>n=$n</p>"
	// echo "n=" $n

?> -->
<!-- <h1>Something is wrong with the XAMPP installation :-(</h1> -->

	<!-- $nazwa='obraz1';
	print("<img src='obrazki/$nazwa.JPG' alt='$nazwa' />" ); -->


<!-- 
<?php
	function galeria($rows, $cols)
	{
		$zm=1;
		print("</br><h2>Galeria zdjęć</h2>");
		for ($i=0; $i < $rows; $i++) { 
			for ($j=0; $j < $cols; $j++) { 
				$nazwa="obraz".$zm;
				print("<img src='miniaturki/$nazwa.JPG' alt='$nazwa' />" );
				$zm++;
			}
			print("</br>");
		}
	}
	//wywołanie funkcji:
	galeria(3,3);
	galeria(4,2);
	galeria(2,4);
?>
 -->


<?php

$dane[8];
$linia="('NULL', '2', 'Polska', 'mushkaborys@gmail.com', 'NULL', 'NULL', 'Java', 'Euro card'),";



                print("<table>
                            <tr>
                                <td><label>Nazwisko:</label></td>
                                <td><label>");

                if($dane[0] == "NULL" || $dane[0] == "") 
                    echo 'Nie wpisano nazwiska';
                else
                    echo $dane[0];

                print("</label></td>
                        </tr>
                        <tr>
                            <td><label>Wiek:</label></td>
                            <td><label>");
                
                if($dane[1] == "NULL" || $dane[1] == "") 
                    echo 'Nie wpisano wieku';
                else
                    echo $dane[1];

                print("</label></td>
                        </tr>
                        <tr>
                            <td><label>Państwo:</label></td>
                            <td><label>");

                if ($dane[2]!="") 
                {
                    echo $dane[2];
                }
                print("</label></td>
                        </tr>
                        <tr>
                            <td><label>Adres e-mail:</label></td>
                            <td><label>");

                if($dane[3] == "NULL" || $dane[3] == "") 
                    echo 'Nie wpisano emailu';
                else
                    echo $dane[3];

                $kurs = ["PHP", "C", "Java"];
                $k = 0;
                for ($i = 0; $i < count($kurs); $i++) 
                    if(isset($_REQUEST[$kurs[$i]]))
                    {
                        $k++;
                    }

                if($k == 0)
                    print("</label></td>
                        </tr>
                        <tr>
                            <td><label>Zamawiane produkty:</label></td>
                            <td>Nie zamówiono produktów</td>");
                else
                {
                    print("</label></td>
                        </tr>
                        <tr>
                            <td rowspan=".$k."><label>Zamawiane produkty:</label></td>
                            <td>");
                    $m = 0;
                    $k = 0;
                    for ($i = 0; $i < count($kurs); $i++) 
                    {
                        if($dane[4+$i] != "NULL")
                        {
                            if($m == 1)
                                print("<tr><td>");
                            print("<label> - ".$kurs[$i]."</label>");
                            if($m == 1)
                                print("</tr></td>");
                            
                            $k++;
                        }
                        if($k == 1 && $m != 1)
                        {
                            $m = 1;
                            print("</td></tr>");
                        }
                    }
                }
                
                print("</td>
                        </tr>
                        <tr>
                            <td><label>Sposób zapłaty:</label></td>
                            <td>");

                if($dane[7] == "NULL" || $dane[7] == "") 
                    echo 'Nie wpisano sposobu opłaty';
                else
                    echo $dane[7];

                print("</td>
                        </tr>
                    </table>");
                    ?>


<?php
//dołącz funkcje z pliku zewnętrznego:
include_once ("funkcje.php");
drukuj_form();
if (filter_input(INPUT_GET, "submit"))
{
    $akcja = filter_input(INPUT_GET, "submit");
    switch ($akcja)
    {
        case "Dodaj":
            dodaj();
        break;
        case "Pokaż":
            pokaz();
        break;
            //...
            
    }
}
function walidacja()
{
    $args = array(
        'nazw' => ['filter' => FILTER_VALIDATE_REGEXP,
        'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
        'kraj' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'tech' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'flags' => FILTER_REQUIRE_ARRAY]
        //zdefiniuj pozostałe filtry
        // . . .
        
    );
    //przefiltruj dane z GET (lub z POST) zgodnie z ustawionymi w $args filtrami:
    $dane = filter_input_array(INPUT_GET, $args);
    //pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania:
    var_dump($dane);
    //Sprawdź czy dane w tablicy $dane nie zawierają błędów walidacji:
    $errors = "";
    foreach ($dane as $key => $val)
    {
        if ($val === false or $val === NULL)
        {
            $errors .= $key . " ";
        }
    }
    if ($errors === "")
    {
        //Dane poprawne - zapisz do pliku
        //wykorzystaj pomocniczą funkcję:
        dopliku("dane.txt", $dane);
    }
    else
    {
        echo "<br>Nie poprawnie dane: " . $errors;
    }
    //nowa postać funkcji dodaj():
    function dodaj()
    {
        echo "<h3>Dodawanie do pliku:</h3>";
        walidacja();
    }
    //nowa funkcja pomocnicza:
    function dopliku($plik, $tablicaDanych)
    {
        $dane = "";
        //zbierz wartości z tablicy danych (parametr $tablicaDanych
        //...
        $dane .= PHP_EOL; //dodaj koniec linii za pomocą stałej PHP
        //zapisz $dane do pliku:
        //
        echo "<p>Zapisano: <br /> $dane</p>";
    }
?>