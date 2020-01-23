<?php

$user      = $user_main->get_user();
$tytul     = "Generacja";

$post = new Post();

$zawartosc = '';

if (filter_input(INPUT_POST, "dodaj_post"))
{
    $postId = $post->walidacja_danych($ob, $user); //sprawdź parametry
    if ($postId > 0)
    {
        header("Location: ?strona=post&this_post=".$postId); 
    } else {
        $zawartosc.="<p>Błędna walidacja</p>";
        $zawartosc .= $post->get_format_Form($post->get_create_Form()); //Pokaż formularz
    }
} else {
    //pierwsze uruchomienie skryptu
    $zawartosc .= $post->get_format_Form($post->get_create_Form());
}
?>
