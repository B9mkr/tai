<?php
$post      = new Post();
$user      = $user_main->get_user();
$tytul     = "Glowna";
$zawartosc = get_tresc($post, $ob, $user);

function get_tresc($post, $ob, $this_user)
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
        $sql = 'SELECT * FROM `Post` ORDER BY `Post`.`datetime` DESC';
    else
        $sql = 'SELECT * FROM `Post` WHERE `Post`.tag="'.$this_tag.'" ORDER BY `Post`.`datetime` DESC';

    $dane = $ob->dane_z_bazy($sql);
    
    if($dane == NULL)
        $tresc.="Nie poprawne zapytania </br>";
    else {
        $user = new User("", "", "");
        
        foreach($dane as $key => $da)
        {
            if(walid($da, $post, $this_user))
            {
                $post->set_z_bazy($dane, $key);
                $user->set_id_user($post->get_id_user());
                $user->set_z_bazy($ob->dane_z_bazy('SELECT * FROM `User` u where u.id_user="'.$user->get_id_user().'"'));
                // $post->set
                $tresc.=$post->get_tresc_g($user);
            }
        }
    }
    
    return $tresc.'</div>';
}

function walid($dana, $post, $this_user) // dana zbiór objektów z bazy Post
{
    // var_dump($dana); 
    // echo $dana->access;
    $wyn = false;
    switch($this_user->get_status())
    {
        case 0: $wyn = true; break; // admin
        case 1:
        
            // echo ''.$post->get_access_for(0, $dana->access).' '.$post->get_access_for(1, $dana->access);
            if (''.$this_user->get_id_user() == ''.$dana->id_user)
            {
                switch ($post->get_access_for(0, $dana->access)) {
                    case 6:
                    case 4: $wyn = true; break;

                    default://1
                        $wyn = false;
                        break;
                }
            }
            else 
            {
                switch ($post->get_access_for(1, $dana->access)) {
                    case 6:
                    case 4: $wyn = true; break;

                    default://1
                        $wyn = false;
                        break;
                }
            }
            break;
        default: 
            switch ($post->get_access_for(1, $dana->access)) {
                case 6:
                case 4: $wyn = true; break;

                default://1
                    $wyn = false;
                    break;
            }
            break;
    }
    // echo '</br>';
    return $wyn;
}


?>
