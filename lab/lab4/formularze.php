<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<title> lab4 </title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body >
	<div>
        <?php
			//dołącz funkcje z pliku zewnętrznego:
			include_once ("funkcje.php");
            drukuj_form();
            if (filter_input(INPUT_GET, "submit"))
			{
				$akcja = filter_input(INPUT_GET, "submit");
                switch ($akcja) 
                {
                    case "Dodaj":dodaj();break;
                    case "Pokaz":pokaz();break;
                    // case "Java":pokaz_zamowienie($akcja);break;
					// case "PHP":pokaz_zamowienie($akcja);break;
					// case "CPP":pokaz_zamowienie($akcja);break;
					default: break;
                }
			}			
        ?>
	</div>

	</body>
</html>

<!-- dane
('Mushka', '20', 'Polska', 'mushkaborys@gmail.com', 'C,Java', 'Przelew bankowy');
('Mushka', '20', 'Polska', 'mushkaborys@gmail.com', 'Java', 'Visa');
('Karol', '21', 'Polska', 'karol@gmail.com', 'PHP,Java', 'Euro card');
('Niedziela', '22', 'Polska', 'niedziela@gmail.com', 'C', 'Przelew bankowy');
('Karol', '23', 'Wielka Brytania', 'karol23@gmail.com', 'C,Java', 'Euro card');
('Niedziela', '19', 'Niemcy', 'niedziela@gmai.com', 'C', 'Przelew bankowy');
('Mushka', '20', 'Niemcy', 'mushkaborys@gmail.com', 'Java', 'Przelew bankowy'); -->