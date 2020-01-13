<?php
    //uchwyt do bazy testowa:
    include_once "class/Baza.php";
    include_once "class/User.php";
    include_once "class/Post.php";

$post      = new Post();
$ob        = new Baza("localhost", "root", "", "projekt");
$user = new User("", "", "");
$tytul     = "glowna";
$zawartosc = get_tresc($post, $ob);//."<img src="img/anon.jpg" alt="anon"/>";

$datetime  = $user->get_date();
$dateshow  = $user->get_date_format("d F Y");

function get_tresc($post, $ob){
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
                <a class="post-card-image-link" href="?strona=post">'.create_img($post->get_post_full_image(), "png").'</a>
                <div class="post-card-content">
                    <a class="post-card-content-link" href="?strona=post">
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
                                    <a href="#" class="static-avatar">
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

function create_img($url="img/text/lovew", $k="png")
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

// object(stdClass)#7 (9) { 
//     ["id_post"]=> string(1) "1" 
//     ["id_user"]=> string(1) "1" 
//     ["title"]=> string(3) "inf" 
//     ["datetime"]=> string(10) "2020-01-10" 
//     ["tag"]=> string(11) "information" 
//     ["post_full_title"]=> string(2) "ts" 
//     ["post_full_image"]=> string(14) "img/text/lovew" 
//     ["access"]=> string(2) "66" 
//     ["content"]=> string(6) "inf.md" }

// object(stdClass)#7 (7) { 
//     ["id_user"]=> string(1) "1" 
//     ["username"]=> string(5) "borys" 
//     ["email"]=> string(21) "mushkaborys@gmail.com" 
//     ["date"]=> string(10) "2020-01-11" 
//     ["img"]=> string(12) "img/anon.jpg" 
//     ["status"]=> string(1) "1" 
//     ["passwd"]=> string(32) "c4ca4238a0b923820dcc509a6f75849b" }

?>
