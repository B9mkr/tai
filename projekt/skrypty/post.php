<?php
include_once('parsedown/Parsedown.php');

$user       = $user_main->get_user();
$post       = new Post();
$zawartosc  = '';

$sql='SELECT * FROM `Post` p where p.id_post='.$this_post;

$dane = $ob->dane_z_bazy($sql);

if($dane == NULL)
{
    $zawartosc = "<h1>Nie poprawne zapytania</h1>";
    $tytul     = "Blęd";
}else{
    $post->set_z_bazy($dane);
    // var_dump($dane);
}

if($zawartosc != '<h1>Nie poprawne zapytania</h1>')
{
    $tytul     = $post->get_title();
    $zawartosc = get_tresc($post);//."<img src=\"img/anon.jpg\" alt=\"anon\"/>";
}
function get_tresc($post)
{
    $tresc='
    <article class="post-full post tag-it">
    <header class="post-full-header">
        <section class="post-full-meta">
            <time class="post-full-meta-date" datetime="'.$post->get_datetime().'">'.$post->get_date_format("d F Y").'</time>
            <span class="date-divider">/</span> <a href="?strona=glowna&tag='.$post->get_tag().'">'.$post->get_tag().'</a>
        </section>
        <h1 class="post-full-title">'.$post->get_title().'</h1>
    </header>
    <figure class="post-full-image">';
    $tresc.=create_img($post->get_post_full_image(), "jpg");
    $tresc.='</figure>
    <section class="post-full-content">
        <div class="post-content">';
        
    $tresc .= file_get_tresc("".$post->get_content());
    
    $tresc.='</div></section></article>';
        
    return $tresc;
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

// $dane=$ob->dane_z_bazy('SELECT * FROM `User` u WHERE u.email="'.$user->get_email().'" AND u.passwd="'.$user->get_passwd().'"');
// if($dane == NULL)
//     echo "Nie poprawne zapytania </br>";
// else{    $user->set_z_bazy($dane);}

function file_get_tresc($url)
{
    if($url == '')
        $url="inf.md";
	$contents = file_get_contents($url);
	$Parsedown = new Parsedown();
	return "".$Parsedown->text($contents);
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
