<?php
class Strona
{
    //pola (własności) klasy:
    private $title="Projekt";
    protected $zawartosc;
    protected $slowa_kluczowe = "narzędzia internetowe, php, formularz";
    
    protected $datetime;
    protected $dateshow;
    protected $img="img/text/lovew";

    protected $user;
    protected $post;

    //interfejs klasy – metody modyfikujące fragmenty strony
    public function set_title($new_title)
    {
        $this->title = $new_title;
    }
    public function set_slowa_kluczowe($new_slowa)
    {
        $this->slowa_kluczowe = $new_slowa;
    }
    public function set_zawartosc($new_zawartosc)
    {
        $this->zawartosc = $new_zawartosc;
    }
    public function set_datetime($new_date)
    {
        $this->datetime = $new_date;
    }
    public function set_dateshow($new_date)
    {
        $this->dateshow = $new_date;
    }
    public function set_img($img="img/text/lovew")
    {
        $this->img = $img;
    }
    public function set_user($user)
    {
        $this->user = $user;
    }
    public function set_post($post)
    {
        $this->post = $post;
    }

    public function get_title()
    {
        return $this->title;
    }
    public function get_slowa_kluczowe()
    {
        return $this->slowa_kluczowe;
    }
    public function get_zawartosc()
    {
        return $this->zawartosc;
    }
    public function get_datetime()
    {
        return $this->datetime;
    }
    public function get_dateshow()
    {
        return $this->dateshow;
    }
    public function get_img()
    {
        return $this->img;
    }
    public function get_user()
    {
        return $this->user;
    }
    public function get_post()
    {
        return $this->post;
    }


    public function get_style($url)
    {
        return '<link rel="stylesheet" href="' . $url . '" type="text/css" />';
    }

    //interfejs klasy – funkcje wyświetlające stronę
    function show()
    {
        echo $this->create_Strona();
    }

    //interfejs klasy – funkcje generujące stronę
    function create_Strona()
    {
        $strona="<!DOCTYPE html><html>";
        $strona.=$this->create_head();
        $strona.=$this->create_body();
        $strona.="</html>";
        return $strona;
    }
    function create_head()
    {
        $head = "<head>
            <meta charset=\"utf-8\" />
            <title>$this->title</title>
            <link rel=\"icon\" type=\"image/png\" href=\"img/planet-earth.png\"/>";
        $head .= $this->create_css($css=["css/st.css"]);
        $head .= "</head>";
        return $head;
    }
    function create_css($urls_css)
    {
        $css="";
        foreach($urls_css as $cs){
            $css .= $this->get_style($cs);
        }
        return $css;
    }
    function create_body()
    {
        $body="<body class=\"home-template\"><div class=\"site-wrapper\">";
        $body.=$this->create_header();
        $body.="<main id=\"site-main\" class=\"site-main outer\">
                <div class=\"inner\">";
        $body.=$this->create_tresc();
        $body.="</div></main>";
        $body.=$this->create_footer();
        $body.="</div></body>";
        return $body;
    }
    function create_header()
    {
        $header="<header class=\"site-header outer no-image\">
        <div class=\"inner\">
            <div class=\"site-header-content\">
                <h1 class=\"site-title\">
                    $this->title
                </h1>
                <h2 class=\"site-description\">Tworzenie aplikacj internetowych 2019-2020</h2>
            </div>
            <nav class=\"site-nav\">
                <div class=\"site-nav-left\"><div class=\"other\">";
                // $header.="<a class=\"gener-button\" href=\"index4.html\" title=\"GEN\" rel=\"noopener\">
                //     <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"svg-icon\" viewBox=\"0 0 20 20\"><path d=\"M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10\"></path></svg>
                // </a>";
                $header.="</div></div><div class=\"site-nav-right\">";
                // $header.="<div class=\"social-links\">
                //         <a class=\"social-link social-link-fb\" href=\"https://www.facebook.com\" title=\"Facebook\" target=\"_blank\" rel=\"noopener\"><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 32 32\"><path d=\"M19 6h5V0h-5c-3.86 0-7 3.14-7 7v3H8v6h4v16h6V16h5l1-6h-6V7c0-.542.458-1 1-1z\"/></svg></a>
                //         <a class=\"social-link social-link-tw\" href=\"https://twitter.com\" title=\"Twitter\" target=\"_blank\" rel=\"noopener\"><svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 32 32\"><path d=\"M30.063 7.313c-.813 1.125-1.75 2.125-2.875 2.938v.75c0 1.563-.188 3.125-.688 4.625a15.088 15.088 0 0 1-2.063 4.438c-.875 1.438-2 2.688-3.25 3.813a15.015 15.015 0 0 1-4.625 2.563c-1.813.688-3.75 1-5.75 1-3.25 0-6.188-.875-8.875-2.625.438.063.875.125 1.375.125 2.688 0 5.063-.875 7.188-2.5-1.25 0-2.375-.375-3.375-1.125s-1.688-1.688-2.063-2.875c.438.063.813.125 1.125.125.5 0 1-.063 1.5-.25-1.313-.25-2.438-.938-3.313-1.938a5.673 5.673 0 0 1-1.313-3.688v-.063c.813.438 1.688.688 2.625.688a5.228 5.228 0 0 1-1.875-2c-.5-.875-.688-1.813-.688-2.75 0-1.063.25-2.063.75-2.938 1.438 1.75 3.188 3.188 5.25 4.25s4.313 1.688 6.688 1.813a5.579 5.579 0 0 1 1.5-5.438c1.125-1.125 2.5-1.688 4.125-1.688s3.063.625 4.188 1.813a11.48 11.48 0 0 0 3.688-1.375c-.438 1.375-1.313 2.438-2.563 3.188 1.125-.125 2.188-.438 3.313-.875z\"/></svg></a>
                //     </div>";
                $header.="<div class=\"other\">";
                        // $header.="<a class=\"gener-button\" href=\"index4.html\" title=\"GEN\" rel=\"noopener\">
                        //     <svg xmlns=\"http://www.w3.org/2000/svg\" class=\"svg-icon\" viewBox=\"0 0 20 20\"><path d=\"M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10\"></path></svg>
                        // </a>";
                        // $header.="<a class=\"gener-button\" href=\"?strona=log_in\" title=\"log in\" rel=\"noopener\">
                        //     <svg class=\"svg-icon\" viewBox=\"0 0 20 20\"><path d=\"M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z\"></path></svg>
                        // </a>";
                        $header.="<a class=\"gener-button\" href=\"?strona=log_in\" title=\"log in\" rel=\"noopener\">
                        <img src=\"img/anon.jpg\"  width=\"50\" height=\"50\" alt=\"anon\"/>
                        </a>";
                $header.="</div></div></div>
            </nav>
        </div>
    </header>";
    // sun // <svg class=\"svg-icon\" viewBox=\"0 0 20 20\"><path fill=\"none\" d=\"M5.114,5.726c0.169,0.168,0.442,0.168,0.611,0c0.168-0.169,0.168-0.442,0-0.61L3.893,3.282c-0.168-0.168-0.442-0.168-0.61,0c-0.169,0.169-0.169,0.442,0,0.611L5.114,5.726z M3.955,10c0-0.239-0.193-0.432-0.432-0.432H0.932C0.693,9.568,0.5,9.761,0.5,10s0.193,0.432,0.432,0.432h2.591C3.761,10.432,3.955,10.239,3.955,10 M10,3.955c0.238,0,0.432-0.193,0.432-0.432v-2.59C10.432,0.693,10.238,0.5,10,0.5S9.568,0.693,9.568,0.932v2.59C9.568,3.762,9.762,3.955,10,3.955 M14.886,5.726l1.832-1.833c0.169-0.168,0.169-0.442,0-0.611c-0.169-0.168-0.442-0.168-0.61,0l-1.833,1.833c-0.169,0.168-0.169,0.441,0,0.61C14.443,5.894,14.717,5.894,14.886,5.726 M5.114,14.274l-1.832,1.833c-0.169,0.168-0.169,0.441,0,0.61c0.168,0.169,0.442,0.169,0.61,0l1.833-1.832c0.168-0.169,0.168-0.442,0-0.611C5.557,14.106,5.283,14.106,5.114,14.274 M19.068,9.568h-2.591c-0.238,0-0.433,0.193-0.433,0.432s0.194,0.432,0.433,0.432h2.591c0.238,0,0.432-0.193,0.432-0.432S19.307,9.568,19.068,9.568 M14.886,14.274c-0.169-0.168-0.442-0.168-0.611,0c-0.169,0.169-0.169,0.442,0,0.611l1.833,1.832c0.168,0.169,0.441,0.169,0.61,0s0.169-0.442,0-0.61L14.886,14.274z M10,4.818c-2.861,0-5.182,2.32-5.182,5.182c0,2.862,2.321,5.182,5.182,5.182s5.182-2.319,5.182-5.182C15.182,7.139,12.861,4.818,10,4.818M10,14.318c-2.385,0-4.318-1.934-4.318-4.318c0-2.385,1.933-4.318,4.318-4.318c2.386,0,4.318,1.933,4.318,4.318C14.318,12.385,12.386,14.318,10,14.318 M10,16.045c-0.238,0-0.432,0.193-0.432,0.433v2.591c0,0.238,0.194,0.432,0.432,0.432s0.432-0.193,0.432-0.432v-2.591C10.432,16.238,10.238,16.045,10,16.045\"></path></svg>
    // moon// <svg class=\"svg-icon\" viewBox=\"0 0 20 20\"><path fill=\"none\" d=\"M10.544,8.717l1.166-0.855l1.166,0.855l-0.467-1.399l1.012-0.778h-1.244L11.71,5.297l-0.466,1.244H10l1.011,0.778L10.544,8.717z M15.986,9.572l-0.467,1.244h-1.244l1.011,0.777l-0.467,1.4l1.167-0.855l1.165,0.855l-0.466-1.4l1.011-0.777h-1.244L15.986,9.572z M7.007,6.552c0-2.259,0.795-4.33,2.117-5.955C4.34,1.042,0.594,5.07,0.594,9.98c0,5.207,4.211,9.426,9.406,9.426c2.94,0,5.972-1.354,7.696-3.472c-0.289,0.026-0.987,0.044-1.283,0.044C11.219,15.979,7.007,11.759,7.007,6.552 M10,18.55c-4.715,0-8.551-3.845-8.551-8.57c0-3.783,2.407-6.999,5.842-8.131C6.549,3.295,6.152,4.911,6.152,6.552c0,5.368,4.125,9.788,9.365,10.245C13.972,17.893,11.973,18.55,10,18.55 M19.406,2.304h-1.71l-0.642-1.71l-0.642,1.71h-1.71l1.39,1.069l-0.642,1.924l1.604-1.176l1.604,1.176l-0.642-1.924L19.406,2.304z\"></path></svg>

        return $header;
    }
    function create_footer()
    {
        $footer="<footer class=\"site-footer outer\">
        <div class=\"site-footer-content inner\">
            <section class=\"copyright\"><a href=\"?strona=glowna\">main</a> &copy; 2020</section>
            <nav class=\"site-footer-nav\">
                <a href=\"?strona=glowna\">Ostatnie posty</a>
                <a href=\"https://www.facebook.com\" target=\"_blank\" rel=\"noopener\">Facebook</a>
                <a href=\"https://twitter.com\" target=\"_blank\" rel=\"noopener\">Twitter</a>
            </nav>
        </div>
        </footer>:";
        return $footer;
    }
    function create_tresc()
    {
        $tresc="
        <article class=\"post-full post tag-it\">
        <header class=\"post-full-header\">
           <section class=\"post-full-meta\">
              <time class=\"post-full-meta-date\" datetime=\"".$this->datetime."\">".$this->dateshow."</time>
              <span class=\"date-divider\">/</span> <a href=\"?tag=s\">tag</a>
           </section>
           <h1 class=\"post-full-title\">$this->title</h1>
        </header>
        <figure class=\"post-full-image\">";
        $tresc.=$this->create_img($this->img);
        $tresc.="</figure>
        <section class=\"post-full-content\">
           <div class=\"post-content\">";
            
        $tresc .= $this->zawartosc;
        
        $tresc.="</div></section></article>";
            
        return $tresc;
    }
    function create_img($url="img/text/lovew")
    {
        return "<img
            srcset=\"".$url."300.png 300w,
            ".$url."600.png 600w,
            ".$url."1000.png 1000w,
            ".$url."2000.png 2000w\"
            sizes=\"(max-width: 800px) 400px,
            (max-width: 2000px) 700px, 1400px\"
            src=\"".$url."2000.png\"
            alt=\"img\"/>";
    }
} //koniec klasy Strona
?>