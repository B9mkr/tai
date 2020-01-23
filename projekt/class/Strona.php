<?php
class Strona
{
    //pola (własności) klasy:
    private $title="Projekt";
    protected $zawartosc;
    // protected $slowa_kluczowe="narzędzia internetowe, php, formularz";
    protected $css=["css/st.css"];
    protected $header;

    protected $db;
    protected $this_user;
    protected $this_post;

    // ----------------------------------------------------------------

    function __construct($baza)
    {
        $this->db = $baza;
    }

    // ----------------------------------------------------------------
    
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

    // create_head ----------------------------------------------------
    function create_head()
    {
        $head = "<head>
            <meta charset=\"utf-8\" />
            <title>$this->title</title>
            <link rel=\"icon\" type=\"image/png\" href=\"img/planet-earth.png\"/>";
        $head .= $this->create_css($this->css);
        // $head .= '<link crossorigin="anonymous" media="all" integrity="sha512-YBhzjURrLT0ouaG+HHemxsJ+87lEDYGlXkaH7QjOkpaCqqorVOCwE6qJ8Wek2bhORLngfoUoqivhcDxi1XBAtw==" rel="stylesheet" href="https://github.githubassets.com/assets/frameworks-6018738d446b2d3d28b9a1be1c77a6c6.css">';
        // $head .= '<link crossorigin="anonymous" media="all" integrity="sha512-RnGhTERbt9kdjVfGibbdmSyLXfE3Ku2VS0tDzizUR27QoExXpTYtxEgvZdKPFMN3ljfIdMTjO2SagX10CMGwUA==" rel="stylesheet" href="https://github.githubassets.com/assets/github-4671a14c445bb7d91d8d57c689b6dd99.css">';
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
    public function get_style($url)
    {
        return '<link rel="stylesheet" href="' . $url . '" type="text/css" />';
    }

    // create_body ----------------------------------------------------
    function create_body()
    {
        $body="<body class=\"home-template\"><div class=\"site-wrapper\">";
        $body.=$this->create_header();
        $body.="<main id=\"site-main\" class=\"site-main outer\">
                <div class=\"inner\">";
        $body.=$this->zawartosc;//$this->create_tresc();
        $body.="</div></main>";
        $body.=$this->create_footer();
        $body.="</div></body>";
        return $body;
    }
    function create_header()
    {
        $header='<header class="site-header outer no-image">
        <div class="inner">
            <div class="site-header-content">
                <h1 class="site-title">'.$this->title.'</h1>
                <h2 class="site-description">Tworzenie aplikacj internetowych 2019-2020</h2>
            </div>
            <nav class="site-nav">
                <div class="site-nav-left"><div class="social-links">';
                
                $header.=$this->header_help_left();
                $header.='</div></div>
                        <div class="site-nav-right">';
                
                // $header.='<div class="social-links">
                //         <a class="social-link social-link-fb" href="https://www.facebook.com" title="Facebook" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M19 6h5V0h-5c-3.86 0-7 3.14-7 7v3H8v6h4v16h6V16h5l1-6h-6V7c0-.542.458-1 1-1z"/></svg></a>
                //         <a class="social-link social-link-tw" href="https://twitter.com" title="Twitter" target="_blank" rel="noopener"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path d="M30.063 7.313c-.813 1.125-1.75 2.125-2.875 2.938v.75c0 1.563-.188 3.125-.688 4.625a15.088 15.088 0 0 1-2.063 4.438c-.875 1.438-2 2.688-3.25 3.813a15.015 15.015 0 0 1-4.625 2.563c-1.813.688-3.75 1-5.75 1-3.25 0-6.188-.875-8.875-2.625.438.063.875.125 1.375.125 2.688 0 5.063-.875 7.188-2.5-1.25 0-2.375-.375-3.375-1.125s-1.688-1.688-2.063-2.875c.438.063.813.125 1.125.125.5 0 1-.063 1.5-.25-1.313-.25-2.438-.938-3.313-1.938a5.673 5.673 0 0 1-1.313-3.688v-.063c.813.438 1.688.688 2.625.688a5.228 5.228 0 0 1-1.875-2c-.5-.875-.688-1.813-.688-2.75 0-1.063.25-2.063.75-2.938 1.438 1.75 3.188 3.188 5.25 4.25s4.313 1.688 6.688 1.813a5.579 5.579 0 0 1 1.5-5.438c1.125-1.125 2.5-1.688 4.125-1.688s3.063.625 4.188 1.813a11.48 11.48 0 0 0 3.688-1.375c-.438 1.375-1.313 2.438-2.563 3.188 1.125-.125 2.188-.438 3.313-.875z"/></svg></a>
                //     </div>';
                
                $header.='<div class="other">';
                $header.=$this->header_help_right();
                
                // $header.='<a class="gener-button" href="?strona=log_in" title="log in" rel="noopener">
                //         <img src="img/anon.jpg"  width="50" height="50" alt="anon"/>
                //         </a>';
                $header.='</div></div>';
                $header.='</nav></div></header>';

        return $header;
    }
    function header_help_left()
    {
        $header='<a class="social-link social-link-gl" href="?strona=glowna" title="Glówna" rel="noopener">
        <svg class="svg-icon" viewBox="0 0 20 20" fill="none" stroke="#cdcece">
        <path d="M7.228,11.464H1.996c-0.723,0-1.308,0.587-1.308,1.309v5.232c0,0.722,0.585,1.308,1.308,1.308h5.232
            c0.723,0,1.308-0.586,1.308-1.308v-5.232C8.536,12.051,7.95,11.464,7.228,11.464z M7.228,17.351c0,0.361-0.293,0.654-0.654,0.654
            H2.649c-0.361,0-0.654-0.293-0.654-0.654v-3.924c0-0.361,0.292-0.654,0.654-0.654h3.924c0.361,0,0.654,0.293,0.654,0.654V17.351z
             M17.692,11.464H12.46c-0.723,0-1.308,0.587-1.308,1.309v5.232c0,0.722,0.585,1.308,1.308,1.308h5.232
            c0.722,0,1.308-0.586,1.308-1.308v-5.232C19,12.051,18.414,11.464,17.692,11.464z M17.692,17.351c0,0.361-0.293,0.654-0.654,0.654
            h-3.924c-0.361,0-0.654-0.293-0.654-0.654v-3.924c0-0.361,0.293-0.654,0.654-0.654h3.924c0.361,0,0.654,0.293,0.654,0.654V17.351z
             M7.228,1H1.996C1.273,1,0.688,1.585,0.688,2.308V7.54c0,0.723,0.585,1.308,1.308,1.308h5.232c0.723,0,1.308-0.585,1.308-1.308
            V2.308C8.536,1.585,7.95,1,7.228,1z M7.228,6.886c0,0.361-0.293,0.654-0.654,0.654H2.649c-0.361,0-0.654-0.292-0.654-0.654V2.962
            c0-0.361,0.292-0.654,0.654-0.654h3.924c0.361,0,0.654,0.292,0.654,0.654V6.886z M17.692,1H12.46c-0.723,0-1.308,0.585-1.308,1.308
            V7.54c0,0.723,0.585,1.308,1.308,1.308h5.232C18.414,8.848,19,8.263,19,7.54V2.308C19,1.585,18.414,1,17.692,1z M17.692,6.886
            c0,0.361-0.293,0.654-0.654,0.654h-3.924c-0.361,0-0.654-0.292-0.654-0.654V2.962c0-0.361,0.293-0.654,0.654-0.654h3.924
            c0.361,0,0.654,0.292,0.654,0.654V6.886z"></path></svg>
            </a>';
        
        $sql = "SELECT * FROM `User` WHERE `User`.`id_user`=(SELECT id_user FROM `Session` ORDER BY `Session`.`lastUpdate` DESC LIMIT 1)";
        if(($dane = $this->db->dane_z_bazy($sql)) != NULL) // dane = this_user
        { // kiedy jesteś załogowany
        
            $header.='<a class="social-link social-link-np" href="?strona=gen_postow" title="Nowy post" rel="noopener">
                    <svg class="svg-icon" viewBox="0 0 20 20" fill="none" stroke="#cdcece">
                        <path d="M13.68,9.448h-3.128V6.319c0-0.304-0.248-0.551-0.552-0.551S9.448,6.015,9.448,6.319v3.129H6.319
                            c-0.304,0-0.551,0.247-0.551,0.551s0.247,0.551,0.551,0.551h3.129v3.129c0,0.305,0.248,0.551,0.552,0.551s0.552-0.246,0.552-0.551
                            v-3.129h3.128c0.305,0,0.552-0.247,0.552-0.551S13.984,9.448,13.68,9.448z M10,0.968c-4.987,0-9.031,4.043-9.031,9.031
                            c0,4.989,4.044,9.032,9.031,9.032c4.988,0,9.031-4.043,9.031-9.032C19.031,5.012,14.988,0.968,10,0.968z M10,17.902
                            c-4.364,0-7.902-3.539-7.902-7.903c0-4.365,3.538-7.902,7.902-7.902S17.902,5.635,17.902,10C17.902,14.363,14.364,17.902,10,17.902
                            z"></path>
                    </svg></a>';
            // kiedy jesteś w poście ktury stworzył
            $sql='SELECT * FROM `Post` WHERE `Post`.id_post='.$this->this_post.' limit 1';
            if(($dane2=$this->db->dane_z_bazy($sql)) != NULL)
            {

                if($this->walid($dane, $dane2))
                {
                    $header.='<a class="social-link social-link-zp" href="?strona=zmien_post&this_post='.$this->this_post.'" title="Zmień post" rel="noopener">
                    <svg class="svg-icon" viewBox="0 0 20 20" fill="none" stroke="#cdcece">
                        <path d="M15.808,14.066H6.516v-1.162H5.354v1.162H4.193c-0.321,0-0.581,0.26-0.581,0.58s0.26,0.58,0.581,0.58h1.162
                            v1.162h1.162v-1.162h9.292c0.32,0,0.58-0.26,0.58-0.58S16.128,14.066,15.808,14.066z M15.808,9.419h-1.742V8.258h-1.162v1.161
                            h-8.71c-0.321,0-0.581,0.26-0.581,0.581c0,0.321,0.26,0.581,0.581,0.581h8.71v1.161h1.162v-1.161h1.742
                            c0.32,0,0.58-0.26,0.58-0.581C16.388,9.679,16.128,9.419,15.808,9.419z M17.55,0.708H2.451c-0.962,0-1.742,0.78-1.742,1.742v15.1
                            c0,0.961,0.78,1.74,1.742,1.74H17.55c0.962,0,1.742-0.779,1.742-1.74v-15.1C19.292,1.488,18.512,0.708,17.55,0.708z M18.13,17.551
                            c0,0.32-0.26,0.58-0.58,0.58H2.451c-0.321,0-0.581-0.26-0.581-0.58v-15.1c0-0.321,0.26-0.581,0.581-0.581H17.55
                            c0.32,0,0.58,0.26,0.58,0.581V17.551z M15.808,4.774H9.419V3.612H8.258v1.162H4.193c-0.321,0-0.581,0.26-0.581,0.581
                            s0.26,0.581,0.581,0.581h4.065v1.162h1.161V5.935h6.388c0.32,0,0.58-0.26,0.58-0.581S16.128,4.774,15.808,4.774z"></path>
                    </svg>
                    
                    </a>';
                }
            }
        }
        
        return $header;
    }
    function header_help_right()
    {
        $header = '';
        $sql = "SELECT * FROM `User` WHERE `User`.`id_user`=(SELECT id_user FROM `Session` ORDER BY `Session`.`lastUpdate` DESC LIMIT 1)";
        if(($dane = $this->db->dane_z_bazy($sql)) != NULL)
        {
            // $header.='<footer class="post-card-meta">
            //     <ul class="author-list">
            //         <li class="author-list-item">
            //             <div class="author-name-tooltip">'.$dane[0]->username.'</div>
            //             <a href="?strona=user&user='.$dane[0]->id_user.'" class="static-avatar">
            //                 <img class="author-profile-image" src="'.$dane[0]->img.'" alt="'.$dane[0]->username.'" />
            //             </a>
            //         </li>
            //     </ul></footer>';

            $header.='<a class="gener-button author-card" href="?strona=user&user='.$dane[0]->id_user.'" title="'.$dane[0]->username.'" rel="noopener">
                <img class="author-profile-image" src="'.$dane[0]->img.'" width="50" height="50" alt="'.$dane[0]->username.'"/></a>';
            // $header.='<a class="gener-button" href="?strona=user&user='.$dane[0]->id_user.'" title="'.$dane[0]->username.'" rel="noopener">
            //     <img src="'.$dane[0]->img.'" width="50" height="50" alt="'.$dane[0]->username.'"/></a>';
        }else{//default
            $header.='<a class="gener-button" href="?strona=log_in" title="log in" rel="noopener">
                    <svg class="svg-icon" viewBox="0 0 20 20" fill="none" stroke="#cdcece"><path d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z"></path></svg>
                </a>';
        }
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

    // ----------------------------------------------------------------
    function get_access_for($kto, $ACCESS)
    {
        $access = str_split($ACCESS);
        $ac;
        switch($kto)
        {
            case 'u':
            case 0:  $ac = $access[0]; break;
            default: $ac = $access[1];
        }

        $wyn=1;
        switch($ac)
        {
            case "2":	$wyn=2;         break;
            case "4":	$wyn=4;         break;
            case "6":	$wyn=6;         break;
            default:    $wyn=1;
        }

        return $wyn;
    }

    function walid($dane_this_user, $dane_this_post) // dane_this_post[0] zbiór objektów z bazy Post
    {
        $wyn = false;
        switch($dane_this_user[0]->status)
        {
            case 0: $wyn = true; break; // admin
            case 1:

                // echo $this->this_user;
                if (''.$this->this_user == ''.$dane_this_post[0]->id_user)
                {
                    switch ($this->get_access_for(0, $dane_this_post[0]->access)) {
                        case 6:
                        case 2: $wyn = true; break;

                        default://1,4
                            $wyn = false;
                            break;
                    }
                }
                else 
                {
                    switch ($this->get_access_for(1, $dane_this_post[0]->access)) {
                        case 6:
                        case 2: $wyn = true; break;

                        default://1,4
                            $wyn = false;
                            break;
                    }
                }
                break;
            default: 
                switch ($this->get_access_for(1, $dane_this_post[0]->access)) {
                    case 6:
                    case 4: $wyn = true; break;

                    default://1
                        $wyn = false;
                        break;
                }
                break;
        }
        return $wyn;
    }

    // interfejsy klasy------------------------------------------------
    public function set_title($new_title)
    {
        $this->title = $new_title;
    }
    public function get_title()
    {
        return $this->title;
    }

    // public function set_slowa_kluczowe($new_slowa)
    // {
    //     $this->slowa_kluczowe = $new_slowa;
    // }
    // public function get_slowa_kluczowe()
    // {
    //     return $this->slowa_kluczowe;
    // }

    public function set_zawartosc($new_zawartosc)
    {
        $this->zawartosc = $new_zawartosc;
    }
    public function get_zawartosc()
    {
        return $this->zawartosc;
    }

    public function set_db($new_baze)
    {
        $this->db = $new_baze;
    }
    public function get_db()
    {
        return $this->db;
    }

    public function set_this_user($this_user)
    {
        $this->this_user = $this_user;
    }
    public function get_this_user()
    {
        return $this->this_user;
    }

    public function set_this_post($this_post)
    {
        $this->this_post = $this_post;
    }
    public function get_this_post()
    {
        return $this->this_post;
    }
} //koniec klasy Strona
?>
