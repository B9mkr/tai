<?php
$user       = $user_main->get_user();
$post       = new Post();
$zawartosc  = '';
$tytul      = 'Zmień post';

$sql='SELECT * FROM `Post` WHERE `Post`.id_post='.$this_post.' limit 1';
if(($dane2=$ob->dane_z_bazy($sql)) != NULL)
{
    $post->set_z_bazy($dane2, 0);

    if (filter_input(INPUT_POST, "zmien_post"))
    {
        $postId = $post->walidacja_danych_z($ob, $user); //sprawdź parametry
        if ($postId > 0)
        {
            header("Location: ?strona=post&this_post=".$postId); 
        } else {
            $zawartosc .= "<p>Błędna nazwa użytkownika lub hasło</p>";
            $zawartosc .= $post->getZForm(); //Pokaż formularz
        }
    } else {
        //pierwsze uruchomienie skryptu
        $zawartosc .= $post->getZForm();
    }
}
else {
    $zawartosc = "<h1>Nie poprawne id posta!</h1>";
    $tytul     = "Blęd";
}



// $sql='SELECT * FROM `User` u where u.id_user='.$this_user;

// $sql='SELECT * FROM `Post` WHERE `Post`.id_post='.$this_post.' limit 1';
// if(($dane2=$ob->dane_z_bazy($sql)) != NULL)
// {
//     $post->set_z_bazy($dane2, 0);
//     $tytul     = "Edycja postu";
//     $zawartosc = get_tresc($post, $ob, $user);
//     // if($this_user == $dane2[0]->id_user)
//     // {
        
//     // }
// }
// else
// {
//     $zawartosc = "<h1>Nie poprawne id posta!</h1>";
//     $tytul     = "Blęd";
// }

// function get_tresc($post, $ob, $user)
// {
//     $tresc='
//     <article class="post-full">
//     <header class="post-full-header">
//         <section class="post-full-meta">
//             <time class="post-full-meta-date" datetime="'.$post->get_datetime().'">'.$post->get_date_format("d F Y").'</time>
//         </section>
//         <h1 class="post-full-title">'.$post->get_title().'</h1>
//     </header>';
//     // <figure class="post-full-image">';
//     // $tresc.=create_img($post->get_post_full_image(), "png");
//     // $tresc.='</figure>
//     $tresc.='<section class="post-full-content"><div class="post-content">';
//     $tresc .= get_tresc_in($post, $ob, $user);
//     $tresc.='</div></section></article>';
//     return $tresc;
// }

// function get_tresc_in($post, $ob, $user)
// {
//     $tresc='';

    

//     return $tresc;
// }

?>
