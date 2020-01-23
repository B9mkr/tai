<?php
$user       = $user_main->get_user();

$sql='SELECT * FROM `User` u where u.id_user='.$this_user;

$dane = $ob->dane_z_bazy($sql);

if($dane == NULL)
{
    $zawartosc = "<h1>Nie poprawne zapytania</h1>";
    $tytul     = "Blęd";
}else{
    $user->set_z_bazy($dane, 0);
    $tytul     = "".$user->get_username();
    $zawartosc = get_tresc($user, $ob, $this_user);
}

function get_tresc($user, $ob, $this_user){
    $tresc='';

    $sql = 'SELECT * FROM `Session` ORDER BY `Session`.`lastUpdate` DESC LIMIT 1';
    if(($dane = $ob->dane_z_bazy($sql)) != NULL)
    {
        $sql = 'SELECT * FROM `User` WHERE `User`.id_user='.$dane[0]->id_user;
        if(($dane = $ob->dane_z_bazy($sql)) != NULL)
        {
            if($user->walid($dane, $this_user))
            {
                if (filter_input(INPUT_POST, "zmien")) 
                {
                    $user->zmien($ob);
                    header("Location: ?strona=user&user=".$this_user); 
                } else {
                    //pierwsze uruchomienie skryptu processLogin
                    $tresc .= $user->get_format_Form($user->changeForm());
                }

                if (filter_input(INPUT_POST, "usun_user")) 
                {
                    $user->usun_user($ob, $dane);
                    header("Location: ?strona=glowna"); 
                }
            }
            else{
                $tresc .= $user->get_format_Form($user->standardForm($ob));
            }
        }
    }
    else{
        $tresc .= $user->get_format_Form($user->standardForm($ob));
    }
    
    return $tresc;
}

if (filter_input(INPUT_POST, "wyloguj"))
{
    $user->logout($ob);
    header("Location: ?strona=glowna");
}

?>
