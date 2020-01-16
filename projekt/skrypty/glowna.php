<?php

$post      = new Post();
// $ob        = new Baza("localhost", "root", "", "projekt");
$user      = $user_main->get_user();
$tytul     = "Glowna";
$zawartosc = get_tresc($post, $ob);//."<img src="img/anon.jpg" alt="anon"/>";

// $datetime  = $user->get_date();
// $dateshow  = $user->get_date_format("d F Y");

function get_tresc($post, $ob)
{
    $tresc='<div class="post-feed" id="post-feed">';
    
    $sql='SELECT * FROM `Post`';
    $dane=$ob->dane_z_bazy($sql);
    
    $user = new User("", "", "");

    if($dane == NULL)
        echo "Nie poprawne zapytania </br>";
    else{
        // var_dump($dane);
        
        foreach($dane as $key => $da){
            // $da->;
            $post->set_z_bazy($dane, $key);
            $user->set_id_user($post->get_id_user());
            $user->set_z_bazy($ob->dane_z_bazy('SELECT * FROM `User` u where u.id_user="'.$user->get_id_user().'"'));
            // $post->set
            $tresc.='
                <article class="post-card post">
                    <a class="post-card-image-link" href="?strona=post&this_post='.$post->get_id_post().'">'.create_img($post->get_post_full_image(), "jpg").'</a>
                    <div class="post-card-content">
                        <a class="post-card-content-link" href="?strona=post&this_post='.$post->get_id_post().'">
                            <header class="post-card-header">
                                <span class="post-card-tags">'.$post->get_tag().'</span>
                                <h2 class="post-card-title">'.$post->get_title().'</h2>
                            </header>
                            <section class="post-card-excerpt">
                                <p>Ubuntu Basics</p>
                            </section>
                        </a>
                        <footer class="post-card-meta">
                            <ul class="author-list">
                                <li class="author-list-item">
                                    <div class="author-name-tooltip">'.
                                        $user->get_username()
                                    .'</div>
                                        <a href="?strona=user&user='.$user->get_id_user().'" class="static-avatar">
                                            <img class="author-profile-image" src="'.$user->get_img().'" alt="author" />
                                        </a>
                                </li>
                            </ul>
                            <span class="reading-time">10 min</span>
                        </footer>
                    </div>
                </article>';
        }
    }
    
    return $tresc.'</div>';
}

function create_img($url="img/text/lovew", $k)
{
    return "<img
        srcset=\"".$url."300.".$k." 300w,
        ".$url."600.".$k." 600w,
        ".$url."1000.".$k." 1000w,
        ".$url."2000.".$k." 2000w\"
        sizes=\"(max-width: 800px) 400px,
        (max-width: 2000px) 700px, 1400px\"
        src=\"".$url."2000.".$k."\"
        alt=\"img\"/>";
}
?>
