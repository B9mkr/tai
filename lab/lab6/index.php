<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0">	 -->
		<title> lab 6 </title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body >
        <div>
        <h3>lab 6</h3>
            <?php
                include "klasy/User.php";
                $user2 = new RegistrationForm();
                // $user1 = new User('kp', 'kubus Puchatek', 'kubus@stumilowylas.pl', 'nielubietygryska');
                // $user1->show();
            ?>
            <?php
                include_once('klasy/User.php');
                include_once('klasy/RegistrationForm.php');
                $rf = new RegistrationForm(); //wyświetla formularz rejestracji
                if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
                    $user = $rf->checkUser(); //sprawdza poprawność danych
                if ($user === NULL)
                    echo "<p>Niepoprawne dane rejestracji.</p>";
                else{
                    echo "<p>Poprawne dane rejestracji:</p>";
                    $user->show();
                }
                }
            ?>
        </div>
    </body>
</html>
