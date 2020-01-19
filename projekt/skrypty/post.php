<?php
include_once('parsedown/Parsedown.php');

$user       = $user_main->get_user();
$post       = new Post();
$zawartosc  = '';

$sql='SELECT * FROM `Post` p where p.id_post='.$this_post;

$dane = $ob->dane_z_bazy($sql);

if($dane == NULL)
{
    $zawartosc .= "<h1>Nie poprawne zapytania</h1>";
    $tytul     = "Blęd";
} else {
    $post->set_z_bazy($dane);

    $tytul     = $post->get_title();
    
    $Parsedown = new Parsedown();

    $zawartosc .= $post->get_tresc($Parsedown);
}


?>
