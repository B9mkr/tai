<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<title> Lab3 </title>
		<link rel="stylesheet" href="style.css" type="text/css" />
	</head>
	<body >
	<div>
		<!-- <a href="formularze.html">podać wartości</a> -->
		<form action = "index.php" method = "GET">
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
							<option value="u">Ukraina</option>
							<option value="n">Niemiecki</option>
							<option value="i">Inne</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><label for = "adresmail">Adres e-mail:</label></td>
					<td><input type="text" name="email"/></td>
				</tr>
			</table>

			<div id="baner"> <h4>Zamawiam tutorial z jęsyka:</h4> </div>
			<?php
				$tech = ["C", "CPP", "Java", "C#", "Html", "CSS", "XML", "PHP", "JavaScript"];
				for ($i=0; $i < 9 ; $i++) { 
					print("<label for=\"".$tech[$i]."\"> <input type=\"checkbox\" name=\"tech[]\" value=\"".$tech[$i]."\" id=\"".$tech[$i]."\" />".$tech[$i]."</label>");
				}
			?>
			<!-- <label for="php"> <input type="checkbox" name="PHP" value="PHP" id="php" /> PHP </label>
			<label for="c/c++"> <input type="checkbox" name="C" value="C" id="c/c++" /> C/C++ </label>
			<label for="java"> <input type="checkbox" name="Java" value="Java" id="java" /> Java </label> <br /> -->

			<div id="baner"> <h4> Sposób  zapłaty:</h4> </div> 
			<label for="ecard"> <input type="radio" name="oplata[]" value="ecard" id="ecard" /> eurocard </label>
			<label for="visa"> <input type="radio" name="oplata[]" value="visa" id="visa" /> visa </label>
			<label for="prbank"> <input type="radio" name="oplata[]" value="prbank" id="prbank" /> przelew bankowy </label> <br />
			
			<input type="reset" name="reset" value="Wyczyść formularz" />
			<input type="submit" name="wyslij" value="Wyślij" /><br />
		</form>
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
	</div>

	</body>
</html>

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