<?php
$user       = $user_main->get_user();
$post       = new Post();
$zawartosc  = '';
$tytul      = 'Zmień post';

$sql='SELECT * FROM `Post` WHERE `Post`.id_post='.$this_post.' limit 1';
if(($dane2=$ob->dane_z_bazy($sql)) != NULL)
{
    $post->set_z_bazy($dane2, 0);

    if (filter_input(INPUT_POST, "usun_post")) 
    {
        $post->usun_post($ob);
        header("Location: ?strona=glowna"); 
    }
    
    if (filter_input(INPUT_POST, "zmien_post"))
    {
        $postId = $post->walidacja_danych_z($ob, $user); //sprawdź parametry
        if ($postId > 0)
        {
            header("Location: ?strona=post&this_post=".$postId); 
        } else {
            $zawartosc .= "<p>Błędna nazwa użytkownika lub hasło</p>";
            $zawartosc .= $post->get_format_Form($post->get_change_Form()); //Pokaż formularz
        }
    } else {
        //pierwsze uruchomienie skryptu
        $zawartosc .= $post->get_format_Form($post->get_change_Form());
    }
}
else {
    $zawartosc = "<h1>Nie poprawne id posta!</h1>";
    $tytul     = "Blęd";
}


?>
