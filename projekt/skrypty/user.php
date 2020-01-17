<?php
$user       = $user_main->get_user();
$post       = new Post();

$sql='SELECT * FROM `User` u where u.id_user='.$this_user;

// $sql='SELECT * FROM `User` WHERE `User`.`id_user`=(SELECT id_user FROM `Session` ORDER BY `Session`.`lastUpdate` DESC LIMIT 1)';

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

function get_tresc($user, $ob, $this_user)
{
    $tresc='
    <article class="post-full">
    <header class="post-full-header">
        <section class="post-full-meta">
            <time class="post-full-meta-date" datetime="'.$user->get_date().'">'.$user->get_date_format("d F Y").'</time>
        </section>
        <h1 class="post-full-title">'.$user->get_username().'</h1>
    </header>';
    // <figure class="post-full-image">';
    // $tresc.=create_img($post->get_post_full_image(), "png");
    // $tresc.='</figure>
    $tresc.='<section class="post-full-content"><div class="post-content">';
        
    $tresc .= get_tresc_in($user, $ob, $this_user);
    
    $tresc.='</div></section></article>';
        
    return $tresc;
}

function get_tresc_in($user, $ob, $this_user){
    $tresc=
    '<form method="post" action="">
    <table>
        <tr>
        <td><label>User id:</label></td>
            <td><label>'.$user->get_id_user().'</label></td>
        </tr>    
        <tr>
            <td><label>Adres e-mail:</label></td>
            <td><label>'.$user->get_email().'</label></td>
        </tr>
        <tr>
            <td><label>User name:</label></td>
            <td><label>'.$user->get_username().'</label></td>
        </tr>
        <tr>
            <td><label>Zdjęcie:</label></td>
            <td><img src="'.$user->get_img().'" alt="author"/></td>
        </tr>
        <tr>
            <td colspan=2>';

    $sql = 'SELECT * FROM `Session` ORDER BY `Session`.`lastUpdate` DESC LIMIT 1';
    if(($dane = $ob->dane_z_bazy($sql)) != NULL)
    {
        if($this_user == $dane[0]->id_user)
        {
            $tresc .= '<input type="submit" value="Wyłoguj" name="wyloguj"/>';
        }
    }
    
    return $tresc.'</td></tr></table></form>';
}

if (filter_input(INPUT_POST, "wyloguj"))
{
    $User_M->logout($ob);
    header("Location: ?strona=glowna");
    exit;
}
// $dane=$ob->dane_z_bazy('SELECT * FROM `User` u WHERE u.email="'.$user->get_email().'" AND u.passwd="'.$user->get_passwd().'"');
// if($dane == NULL)
//     echo "Nie poprawne zapytania </br>";
// else{    $user->set_z_bazy($dane);}

?>
