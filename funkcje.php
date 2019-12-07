<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<title> lab7 </title>
		<!-- <link rel="stylesheet" href="style.css" type="text/css" /> -->
	</head>
	<body >
	<div>
        <?php
            //Funkcje pomocnicze:
            function drukuj_form() {
        ?>
		
        <!-- <a href="formularze.html">podać wartości</a> -->
		<form action = "funkcje.php" method = "GET">
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
			<label for="visa"> <input type="radio" name="oplata" value="Visa" id="visa" /> Visa </label>
			<label for="ecard"> <input type="radio" name="oplata" value="Euro card" id="ecard" /> Master Card </label>
			<label for="prbank"> <input type="radio" name="oplata" value="Przelew bankowy" id="prbank" /> Przelew </label> <br />
			
			<!-- <input type="submit" name="wyslij" value="Wyślij" /> -->
			<input type="reset" name="reset" value="Wyczyść formularz" />
			
            <input type="submit" value="Dodaj" name="submit"/>
			<input type="submit" value="Pokaz" name="submit"/>
			<br />
		</form>

        <?php }

// include_once ("formularze.php");
drukuj_form();

include_once ("Baza.php");
//tworzymy uchwyt do bazy danych:

$bd = new Baza("localhost", "root", "", "klienci");

if (filter_input(INPUT_GET, "submit")) {
    $akcja = filter_input(INPUT_GET, "submit");
    switch ($akcja) {
        case "Dodaj" : dodajdoBD($bd); break;
        case "Pokaż" : echo $bd->select("select Nazwisko,Zamowienie from klienci", array("Nazwisko","Zamowienie")); break;
    }
}

function dodajdoBD($bd){
    $sql=create_dane();//np.: "(NULL, 'Mushka', '22', 'Polska', 'mushkab@gmail.com', 'Java,PHP', 'Master Card');"
    // echo $sql;
    $bd->insert($sql);
}

function create_dane(){
    $dane="(NULL, '";
    if (isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="")) 
    {
        $dane .= htmlspecialchars(trim($_REQUEST['nazwisko']))."', ";
    }
    else $dane .= "NULL', ";

    if (isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="")) 
    {
        $dane .= "'".htmlspecialchars(trim($_REQUEST['wiek']))."', '";
    }
    else $dane .= "'NULL', '";

    if (isset($_REQUEST['panstwo'])&&($_REQUEST['panstwo']!="")) 
    {
        $panstwo = htmlspecialchars(trim($_REQUEST['panstwo']));
        switch($panstwo)
        {
            case "p":	$dane .= "Polska', '"; break;
            case "u":	$dane .= "Ukraina', '"; break;
            case "n":	$dane .= "Niemcy', '"; break;
            case "i":	$dane .= "Inne', '"; break;
            default:    $dane .= "NULL', '";
        }
    }

    if (isset($_REQUEST['email'])&&($_REQUEST['email']!="")) 
    {
        $dane .= htmlspecialchars(trim($_REQUEST['email']))."', '";
    }
    else $dane .= "NULL', '";

    $kurs = ["PHP", "CPP", "Java"];
    for ($i = 0; $i < count($kurs); $i++) 
    {
        if(isset($_REQUEST[$kurs[$i]])){
            $dane .= $kurs[$i];
            if($i < count($kurs)-1)
                $dane.=",";
        }
        
    }
    $dane.="', '";

    if (isset($_REQUEST['oplata'])&&($_REQUEST['oplata'] != "")) 
    {
        $dane .= htmlspecialchars(trim($_REQUEST['oplata']))."');\r\n";
    }
    else $dane .= "NULL');\r\n";

    return $dane;
}

?>
</div>

</body>
</html>