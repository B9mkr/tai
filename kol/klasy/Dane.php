<?php
class Dane
{
    // $pola=["id","Nazwisko","PESEL","Stan konta","Posiadanie karty"];
    private $nazwa_tabeli;
    private $pola_t;//Techniczne
    private $pola_d;//Dekoracyjne
    private $baza;
    private $poszuk;
    
    function __construct($baza, $nazwa_tabeli, $polat, $polad, $poszuk=0)
    {
        $this->nazwa_tabeli=$nazwa_tabeli;
        $this->baza=$baza;
        $this->pola_t=$polat;
        $this->pola_d=$polad;
        $this->poszuk=$poszuk;
    } //koniec funkcji konstruktora
    // function __destruct(){}

// -----GET------------------------
    function get_nazwa_tabeli(){
        return $this->nazwa_tabeli;
    }
    function get_baza(){
        return $this->baza;
    }
    function get_poszuk(){
        return $this->poszuk;
    }
    function get_pola_t(){
        return $this->pola_t;
    }
    function get_pola_d(){
        return $this->pola_d;
    }
    
// -----SET------------------------
    function set_nazwa_tabeli($nazwa_tabeli){
        $this->nazwa_tabeli=$nazwa_tabeli;
    }
    function set_baza($baza){
        $this->baza=$baza;
    }
    function set_poszuk($poszuk){
        $this->poszuk=$poszuk;
    }
    function set_pola_t($pola){
        $this->pola_t=$pola;
    }
    function set_pola_d($pola){
        $this->pola_d=$pola;
    }
// --------------------------------

    function get_pole_t($i=0){
        if(($i > count($this->pola_t)) || ($i < 0))
            $i = 0;
        return $this->pola_t[$i];
    }
    function get_pole_d($i=0){
        if(($i > count($this->pola_d)) || ($i < 0))
            $i = 0;
        
        return $this->pola_d[$i];
    }

} //koniec klasy Dane
?>