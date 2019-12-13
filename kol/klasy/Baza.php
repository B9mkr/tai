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
        if ($result = $this->mysqli->query($sql)) {
            $ilepol = sizeof($pola);
            $ile    = $result->num_rows;
            // pętla po wyniku zapytania $results
            $tresc .= "<table border><tbody>";
            while ($row = $result->fetch_object()) {
                $tresc .= "<tr><td class='blue'>";
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc .= "<td>" . $row->$p . "</td>";
                }
                $tresc .= "</tr>";
            }
            $tresc .= "</table></tbody>";
            $result->close();
            /* zwolnij pamięć */
        }
        return $tresc;
    }
    public function answer($sql) //$sql ~= "('43', 'Mushka', '20', 'Polska', 'mushkab@gmail.com', 'Java,PHP', 'Master Card');"
    {
        if ($this->mysqli->query($sql)) {
            echo "New record created successfully";
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . $this->mysqli->error;
            return false;
        }
    }
} //koniec klasy Baza
?>