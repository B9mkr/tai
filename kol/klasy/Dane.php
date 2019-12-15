<?php
class Dane
{
    private $nazwa_tabeli;
    private $pola_t;//Techniczne
    private $pola_d;//Dekoracyjne
    private $type;
    private $baza;
    private $poszuk;
    private $action;
    private $method;
    private $args;
    
    function __construct($baza, $nazwa_tabeli, $polat, $polad, $type, $poszuk=0, $args, $method="GET")
    {
        $this->nazwa_tabeli=$nazwa_tabeli;
        $this->baza=$baza;
        
        $this->pola_t=$polat;
        $this->pola_d=$polad;
        $this->type=$type;

        $this->poszuk=$poszuk;
        $this->method=$method;
        $this->args=$args;
        $this->action = $this->create_url();//"/www/tai/kol/index.php";
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
    function get_action(){
        return $this->action;
    }
    function get_method(){
        return $this->method;
    }
    function get_args(){
        return $this->args;
    }
    function get_type(){
        return $this->type;
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
    function set_action($action){
        $this->action=$action;
    }
    function set_method($method){
        $this->method=$method;
    }
    function set_args($args){
        $this->args=$args;
    }
    function set_type($type){
        $this->typ=$type;
    }
// --------------------------------

    function get_pole_t($i = 0){
        if(($i > count($this->pola_t)) || ($i < 0))
            $i = 0;
        return $this->pola_t[$i];
    }
    function get_pole_d($i=0){
        if(($i > count($this->pola_d)) || ($i < 0))
            $i = 0;
        
        return $this->pola_d[$i];
    }
    function get_typ($i=0){
        if(($i > count($this->type)) || ($i < 0))
            $i = 0;
        
        return $this->type[$i];
    }

    private function create_url()
    {
        // echo getcwd()."</br>";
        $url = str_split(getcwd()."/");
        
        $k=0;
        $s=0;
        $k=0;
        $m=0;

        foreach ($url as $key => $lin){
            if($lin=="/"){
                if($k==0){
                    $k=1;
                    continue;
                }
                $array[$s++]=$this->fun($slowo, $m);
                $m=0;
                continue;
            }
            
            $slowo[$m]=$lin;
            $m++;
        }

        // foreach($array as $key => $ar){
        //     echo $key." ".$ar."</br>";
        // }

        $zm=0;
        $wyn="/";
        foreach($array as $key => $ar){
            if($ar=="htdocs"){
                $zm=1;

            }
            elseif($zm==1)
                $wyn.=$ar."/";
        }
        // echo $wyn."index.php";

        return $wyn;//"/www/tai/kol/index.php";
    }
    private function fun($slowo, $m)
    {
        for($i=0; $i<$m; $i++){
            $wynik[$i] = $slowo[$i];
        }
        return implode($wynik);
    }
} //koniec klasy Dane
?>