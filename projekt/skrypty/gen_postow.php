<?php

$user      = $user_main->get_user();
$tytul     = "Generacja";
// $header='<a class="gener-button" href="?strona=log_in" title="log in" rel="noopener">
//         <img src="img/anon.jpg"  width="50" height="50" alt="anon"/>
//         </a>';
// $header.='<a class="gener-button" href="?strona=log_in" title="log in" rel="noopener">
//             <svg class="svg-icon" viewBox="0 0 20 20"><path d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z"></path></svg>
//         </a>';
$zawartosc = get_tresc($user);

function get_tresc($user){
    $tresc='
    <article class="post-full">
    <header class="post-full-header">
        <section class="post-full-meta">
            <time class="post-full-meta-date" datetime="'.$user->get_date().'">'.$user->get_date_format("d F Y").'</time>
        </section>
        <h1 class="post-full-title">'.$user->get_username().'</h1>
    </header>';
    $tresc.='<section class="post-full-content"><div class="post-content">';
    $tresc.='<nav>
<table>
    <tr>
        <td><button onclick="pokazPosty()">Pokaż posty</button></td>
        <td><button onclick="usunPosty()">Usuń posty</button></td>
    </tr>
    <tr>
        <td>Tytuł: </td>
        <td><input id="title" type="text"  placeholder="Tytuł"/> </td>
    </tr>
    <tr>
        <td>Zdzjęcie zadniego fonu: </td>
        <td><input name="fFon" id="fFon" type="file" accept="image/*" onchange="openFilef(event)"/> </td>
    </tr>
    <tr>
        <td>Tag:</td>
        <td><input id="tag" type="text"  placeholder="Tag"/></td>
    </tr>
    <tr>
        <td>Autor: </td>
        <td><input id="author" type="text"  placeholder="Anon"/> </td>
    </tr>
    <tr>
        <td>Zdzjęcie autora: </td>
        <td><input name="fAuthora" id="fAuthora" type="file" accept="image/*" onchange="openFilea(event)"/> </td>
    </tr>
    <tr>
        <td>Czas: </td>
        <td><input id="time" type="number" placeholder="Dla przeczytania postu"/> </td>
    </tr>
    <tr>
        <td>Opis: </td>
        <td><input id="opis" type="text"  placeholder="Opis"/> </td>
    </tr>
    <tr>
        <td>Tekst główny: </td>
        <td><input id="glowny" type="text"  placeholder="url na tekst w formacie .md"/> </td>
    </tr>
    <tr>
        <td><button onclick="dodajPost()">Dodaj</button></td>
        <td><button id="zmien" onclick="zmienPost1()">Zmień post</button></td>
    </tr>
</table>
</nav>';
    $tresc.='</div></section></article>';
    return $tresc;
}



?>
