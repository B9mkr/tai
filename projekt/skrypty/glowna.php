<?php
$post      = new Post();
$user      = $user_main->get_user();
$tytul     = "Glowna";
$zawartosc = get_tresc($post, $ob);

function get_tresc($post, $ob)
{
    $tresc='<div class="post-feed" id="post-feed">';
    
    // ----------------------------------------------------------------
    $this_tag = '';
    if (filter_input(INPUT_GET, 'tag'))
    {
        $this_tag = filter_input(INPUT_GET, 'tag');
    } else {
        $this_tag = '';
    }
    // ----------------------------------------------------------------

    if($this_tag == '')
        $sql = 'SELECT * FROM `Post`';
    else
        $sql = 'SELECT * FROM `Post` WHERE `Post`.tag="'.$this_tag.'"';

    $dane = $ob->dane_z_bazy($sql);
    
    if($dane == NULL)
        echo "Nie poprawne zapytania </br>";
    else {
        $user = new User("", "", "");
        
        foreach($dane as $key => $da){
            // $da->;
            $post->set_z_bazy($dane, $key);
            $user->set_id_user($post->get_id_user());
            $user->set_z_bazy($ob->dane_z_bazy('SELECT * FROM `User` u where u.id_user="'.$user->get_id_user().'"'));
            // $post->set
            $tresc.=$post->get_tresc_g($user);
        }
    }
    
    return $tresc.'</div>';
}

?>
