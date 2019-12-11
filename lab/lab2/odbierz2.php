<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">	
		<title> odbierz </title>
		<link rel="stylesheet" href="http://localhost/www/style.css" type="text/css" />
	</head>
	<body >
        <div>
            <h2>Dane odebrane z formularza:</h2>
            <?php
                print("<table>
                            <tr>
                                <th><label>Nazwisko:</label></th>
                                <td><label>");
                if (isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="")) 
                {
                    echo htmlspecialchars(trim($_REQUEST['nazwisko']));
                }
                else echo 'Nie wpisano nazwiska';
                print("</label></td>
                        </tr>
                        <tr>
                            <th><label>Wiek:</label></th>
                            <td><label>");
                
                if (isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="")) 
                {
                    echo htmlspecialchars(trim($_REQUEST['wiek']));
                }
                else echo 'Nie wpisano wieku';
                print("</label></td>
                        </tr>
                        <tr>
                            <th><label>Państwo:</label></th>
                            <td><label>");

                if (isset($_REQUEST['panstwo'])&&($_REQUEST['panstwo']!="")) 
                {
                    $panstwo = htmlspecialchars(trim($_REQUEST['panstwo']));
                    switch($panstwo)
                    {
                        case "p":	echo 'Polska'; break;
                        case "u":	echo 'Ukraina'; break;
                        case "n":	echo 'Niemiecki'; break;
                        case "i":	echo 'Inne'; break;
                        default:    echo 'Nie wpisano państwa';
                    }
                }
                print("</label></td>
                        </tr>
                        <tr>
                            <th><label>Adres e-mail:</label></th>
                            <td><label>");

                if (isset($_REQUEST['email'])&&($_REQUEST['email']!="")) 
                {
                    echo htmlspecialchars(trim($_REQUEST['email']));
                }
                else echo 'Nie wpisano emailu';
                
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
                            <th><label>Zamawiane produkty:</label></th>
                            <td>Nie zamówiono produktów</td>");
                else
                {
                    print("</label></td>
                        </tr>
                        <tr>
                            <th rowspan=".$k."><label>Zamawiane produkty:</label></th>
                            <td>");
                    $m = 0;
                    $k = 0;
                    for ($i = 0; $i < count($kurs); $i++) 
                    {
                        if(isset($_REQUEST[$kurs[$i]]))
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
                            <th><label>Sposób zapłaty:</label></th>
                            <td>");
                if (isset($_REQUEST['oplata'])&&($_REQUEST['oplata']!="")) 
                {
                    echo htmlspecialchars(trim($_REQUEST['oplata']));
                }
                else
                    print("Nie wybrano sposób opłaty");
                print("</td>
                        </tr>
                    </table>");
            ?>
            <a href="formularz.html">Powrót do formularza</a>
        </div>
	</body>
</html>