<?php
// include_once("Baza.php");
class Formularz {

protected $baza;
protected $nazwa_tabeli="";
protected $pola=["id","nr_reg","marka","rocznik","przebieg"];

function __construct($nazwa_tabeli, $baza)
{
    $this->nazwa_tabeli=$nazwa_tabeli;
    $this->baza=$baza;
?>
    <h3>konstruktor</h3>
    <p>
        <form action="../index.php" method="get">

            <input type="submit" name="Pokaz" value="Pokaz" />
            <input type="submit" name="Wybierz" value="Wybierz" />
            <input type="submit" name="Dodaj" value="Dodaj" />
        </form>
    </p>
<?php
}

// -----dodaj----------------------

function dodaj(){
    drukuj_form();
    $dane=create_dane();
    $sql=create_dodaj_sql($dane);
    $this->baza->insert($sql);
}

function drukuj_form(){
?>
    <h3>Dodnie nowego auta</h3>
    <p>
        <form action="../index.php" method="get">

            Nr-reg: <br/><input name="nr_reg" /><br/>
            Marka: <br/><input name="marka" /><br/>
            rocznik: <br/><input name="rocznik" /><br/>
            przebieg: <br/><input name="przebieg" /><br/>

            <input type="submit" name="Pokaz" value="Pokaz" />
            <input type="submit" name="Wybierz" value="Wybierz" />
            <input type="submit" name="Dodaj" value="Dodaj" />
        </form>
    </p>
<?php    
}

function create_dane(){
    
    foreach($this->pola as $key => $pole)
    {
        if (isset($_REQUEST[$pole])&&($_REQUEST[$pole]!="")){
            $dane[$key] = htmlspecialchars(trim($_REQUEST[$pole]));
        }
        else $dane[$key] = "";
    }

    return $dane;
}

function create_dodaj_sql($dane){
    $sql = "INSERT INTO \`".$this->nazwa_tabeli."\` (";
    foreach($this->pola as $key => $pole){
        $sql.="\`$pole\`";
        if($key<=count($this->pola)-1)
            $sql.=",";
    }
    $sql.=") VALUES ".create_line($dane);
    return $sql;
}

function create_line($dane)
{
    $linia="(NULL,";
    
    foreach($dane as $key => $dan){
        $linia.="'$dan'";
        if($key<=count($dane)-1)
            $sql.=",";
    }

    $linia .= "');";

    return $linia;
}

// -----pokaz----------------------

function pokaz(){
    $sql="select * from ".$this->nazwa_tabeli;
    // $sql="select * from ".$this->nazwa_tabeli." nazwa where nazwa.marka=".$marka;
    $tresc = $this->baza->select($sql, $this->pola);
    echo $tresc;
}

// -----wybierz--------------------

function wybierz(){
    drukuj_marka();
}

function pomoc(){
    if (isset($_REQUEST['marka'])&&($_REQUEST['marka']!="")){
        $marka = htmlspecialchars(trim($_REQUEST['marka']));
    }
    else $marka = "";
    return $marka;
}

function drukuj_marka(){
?>
    <h3>Podaj markę</h3>
    <p>
        <form action="../index.php" method="get">

            Marka: <br/><input name="marka" /><br/>

            <input type="submit" name="Podaj" value="Podaj" />
        </form>
    </p>
<?php
}

function pokaz_m(){
    $sql="select * from ".$this->nazwa_tabeli." nazwa where nazwa.marka=".pomoc();
    $tresc = $this->baza->select($sql, $this->pola);
    echo $tresc;
}
// --------------------------------

}
?>
