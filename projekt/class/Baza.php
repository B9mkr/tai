<?php
class Baza
{
    private $mysqli; //uchwyt do BD
    function __construct($serwer, $user, $pass, $baza)
    {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);
        /* sprawdz połączenie */
        if ($this->mysqli->connect_errno) {
            printf("Nie udało sie połączenie z serwerem: %s\n", $mysqli->connect_error);
            exit();
        }
        /* zmien kodowanie na utf8 */
        if ($this->mysqli->set_charset("utf8")) { // udało sie zmienić kodowanie
        }
    } //koniec funkcji konstruktora
    function __destruct()
    {
        $this->mysqli->close();
    }
    function select($sql, $pola)
    //$pola zawiera tablicę z nazwami pol w bazie
    {
        $tresc = "";
        if ($result = $this->mysqli->query($sql)) 
        {
            $ilepol = sizeof($pola);
            $ile    = $result->num_rows;
            // pętla po wyniku zapytania $results
            $tresc .= "<table><tbody>";
            while ($row = $result->fetch_object())
            {
                $tresc .= "<tr><td class='blue'>";
                for ($i = 0; $i < $ilepol; $i++)
                {
                    $p = $pola[$i];
                    $tresc .= "<td>" . $row->$p . "</td>";
                }
                $tresc .= "</td></tr>";
            }
            $tresc .= "</tbody></table>";
            $result->close();
            /* zwolnij pamięć */
        }
        return $tresc;
    }
    function dane_z_bazy($sql)
    {
        $i=0;
        $dane=NULL;
        if ($result = $this->mysqli->query($sql)) 
        {
            while($obj = $result->fetch_object())
            {
                $dane[$i] = $obj;
                $i++;
            }
            $result->close();
        }
        else return NULL;
        if($dane == NULL)
            return NULL;
        return $dane;
    }
    public function answer($sql)
    {
        if ($this->mysqli->query($sql)) {
            // echo "Successfully answer";
            return true;
        } else {
            // echo "Error: " . $sql . "</br>" . $this->mysqli->error;
            return false;
        }
    }

    public function selectUser($email, $passwd)//$passwd = md5($string);
    {
        $id = -1;
        $sql = "SELECT * FROM User t WHERE t.email='$email' limit 1";
        if ($result = $this->mysqli->query($sql))
        {
            $ile = $result->num_rows;
            if ($ile == 1)
            {
                $row = $result->fetch_object(); //pobierz rekord z użytkownikiem
                $md5 = ''.$row->passwd; //pobierz zahaszowane hasło użytkownika
                //sprawdź czy pobrane hasło pasuje do tego z tabeli bazy danych:
                if ($md5 == ''.$passwd)
                    $id = $row->id_user; //jeśli hasła się zgadzają - pobierz id użytkownika
            }
        }
        return $id; //id zalogowanego użytkownika(>0) lub -1
    }

    public function selectPost($content)
    {
        $id = -1;
        $sql = "SELECT * FROM `Post` WHERE `Post`.content='$content';";
        if ($result = $this->mysqli->query($sql))
        {
            $row = $result->fetch_object();
            $id = $row->id_post;
        }
        return $id; //id zalogowanego użytkownika(>0) lub -1
    }
} //koniec klasy Baza
?>

