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
            echo "Error: " . $sql . "</br>" . $this->mysqli->error;
            return false;
        }
    }
    // public function selectUser($email, $passwd)//, $tabela)
    // {
    //     $id=-1;
    //     $sql='SELECT id_user FROM `User` u WHERE u.email="'.$email.'" AND u.passwd="'.$passwd.'"';
    //     $dane=$ob->dane_z_bazy($sql);
    //     if($dane == NULL)
    //         echo "Nie poprawne zapytania </br>";
    //     else{
    //         $id = $dane->id_user;
    //         // var_dump($user);        
    //     }
    //     return $id;
    // }
    public function selectUser($email, $passwd, $tabela="User") {
        //parametry $login, $passwd , $tabela – nazwa tabeli z użytkownikami
        //wynik – id użytkownika lub -1 jeśli dane logowania nie są poprawne
        $id = -1;
        $sql = "SELECT * FROM $tabela t WHERE t.email='$email'";
        if ($result = $this->mysqli->query($sql))
        {
            $ile = $result->num_rows;
            if ($ile == 1)
            {
                $row = $result->fetch_object()) //pobierz rekord z użytkownikiem
                $md5 = $row->passwd; //pobierz zahaszowane hasło użytkownika
                //sprawdź czy pobrane hasło pasuje do tego z tabeli bazy danych:
                if ($md5 == md5($passwd))
                    $id = $row->id_user; //jeśli hasła się zgadzają - pobierz id użytkownika
            }
        }
        return $id; //id zalogowanego użytkownika(>0) lub -1
       }
} //koniec klasy Baza
?>

