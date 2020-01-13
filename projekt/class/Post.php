<?php
class Post {
    // konstanty klasy:
    const ACCESS_NULL = 1;
    const ACCESS_WRITE = 2;
    const ACCESS_READ = 4;
    const ACCESS_ALL = 6;

    // pola klasy:
    protected $id_post;
    protected $id_user;
    protected $title;
    protected $datetime;
    protected $tag;
    protected $post_full_title;
    protected $post_full_image;
    protected $access = "".Post::ACCESS_ALL."".Post::ACCESS_ALL;
    protected $content;
    protected $user;

    // function __construct($datetime, $tag, $post_full_title, $post_full_image, $content, $access){
    //     function __construct($user){
    //     $this->access = "".Post::ACCESS_ALL."".Post::ACCESS_ALL;
    //     $this->user = $user;
    //     $this->datetime = (new DateTime()) -> format("Y-m-d");
    // }
    
    // $post->set_title();
    // $post->set_datetime();
    // $post->set_tag();
    // $post->set_post_full_title();
    // $post->set_post_full_image();
    // $post->set_access();
    // $post->set_content();
    // $post->set_user();

    public function answer_b_add(){
        $answer = "INSERT INTO `Post` (`id_post`, `id_user`, `title`, `datetime`, `tag`, `post_full_title`, `post_full_image`, `access`, `content`) VALUES ";
        $answer .= "(NULL, '".$this->user->id_user."', '$this->title', '$this->datetime', '$this->tag', '$this->post_full_title', '$this->post_full_image', '$this->access', '$this->content')";
        return $answer;
    }

    public function show() {
        // echo "User:".$this->userName.", ".$this->fullName.", ".$this->email.
        return "Post:".$this->datetime.", ".$this->tag.", ".$this->post_full_title.", ".$this->post_full_image.", ".$this->access.", ".$this->content; 
    }
    // public function show_access($who, $){}

    //interfejs klasy – metody modyfikujące fragmenty strony
    public function set_title($title){
        $this->title = $title;
    }
    public function set_datetime($datetime=''){
        if($datetime == '')
            $this->datetime = (new DateTime()) -> format("Y-m-d");
        else
            $this->datetime = $datetime;
    }
    public function set_tag($tag){
        $this->tag = $tag;
    }
    public function set_post_full_title($post_full_title){
        $this->post_full_title = $post_full_title;
    }
    public function set_post_full_image($post_full_image){
        $this->post_full_image = $post_full_image;
    }
    public function set_access($liczba_access)
    {
        switch($liczba_access){
            case 44: $this->access = "".$this->help_access(4)."".$this->help_access(4); break;
            case 42: $this->access = "".$this->help_access(4)."".$this->help_access(2); break;
            case 41: $this->access = "".$this->help_access(4)."".$this->help_access(1); break;
            case 46: $this->access = "".$this->help_access(4)."".$this->help_access(6); break;

            case 24: $this->access = "".$this->help_access(2)."".$this->help_access(4); break;
            case 22: $this->access = "".$this->help_access(2)."".$this->help_access(2); break;
            case 21: $this->access = "".$this->help_access(2)."".$this->help_access(1); break;
            case 26: $this->access = "".$this->help_access(2)."".$this->help_access(6); break;
            
            case 14: $this->access = "".$this->help_access(1)."".$this->help_access(4); break;
            case 12: $this->access = "".$this->help_access(1)."".$this->help_access(2); break;
            case 11: $this->access = "".$this->help_access(1)."".$this->help_access(1); break;
            case 16: $this->access = "".$this->help_access(1)."".$this->help_access(6); break;

            case 64: $this->access = "".$this->help_access(6)."".$this->help_access(4); break;
            case 62: $this->access = "".$this->help_access(6)."".$this->help_access(2); break;
            case 61: $this->access = "".$this->help_access(6)."".$this->help_access(1); break;
            default: $this->access = "".$this->help_access(6)."".$this->help_access(6);
        }
    }
    public function set_content($content){
        $this->content = $content;
    }
    public function set_user($user){
        $this->user = $user;
    }
    
    //interfejs klasy – metody zwracające dane posta
    public function get_id_post(){
        return $this->id_post;
    }
    public function get_id_user(){
        return $this->id_user;
    }
    public function get_title(){
        return $this->title;
    }
    public function get_datetime(){
        return $this->datetime;
    }
    public function get_tag(){
        return $this->tag;
    }
    public function get_post_full_title(){
        return $this->post_full_title;
    }
    public function get_post_full_image(){
        return $this->post_full_image;
    }
    public function get_access(){
        return $this->access;
    }
    public function get_content(){
        return $this->content;
    }
    public function get_user(){
        return $this->user;
    }

    public function get_date_format($format="Y-m-d")
    {
        return ((new DateTime("".$this->datetime))->format($format));
    }

    function help_access($liczba){
        switch($liczba){
            case 4: return Post::ACCESS_READ;
            case 2: return Post::ACCESS_WRITE;
            case 1: return Post::ACCESS_NULL;
            default: return Post::ACCESS_ALL;
        }
    }

    public function set_z_bazy($dane, $index=0){
        // var_dump($dane);
        $this->id_post = $dane[$index]->id_post;
        $this->id_user = $dane[$index]->id_user;
        $this->title = $dane[$index]->title;
        $this->datetime = $dane[$index]->datetime;
        $this->tag = $dane[$index]->tag;
        $this->post_full_title = $dane[$index]->post_full_title;
        $this->post_full_image = $dane[$index]->post_full_image;
        $this->access=$dane[$index]->access;
        $this->content=$dane[$index]->content;
        // $this-> = $dane[$index]->;
    }
}
?> 
