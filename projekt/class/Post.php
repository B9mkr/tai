<?php
// include_once("Baza.php");
include_once("User.php");

// CREATE TABLE IF NOT EXISTS `Post` (
//     `id_post` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
//     `id_user` int(10) UNSIGNED NOT NULL,
//     `datetime` date NOT NULL,
//     `tag` varchar(40) NOT NULL,
//     `post_full_title` varchar(20) NOT NULL,
//     `post_full_image` varchar(50) NOT NULL,
//     `access` int(2) NOT NULL,
//     `content` varchar(60) NOT NULL,
//     PRIMARY KEY (`id_posts`),
//     KEY `id_user` (`id_user`)
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

class Post {
    const ACCESS_READ = 4;
    const ACCESS_WRITE = 2;
    const ACCESS_ALL = 6;

    protected $date_time;
    protected $tag;
    protected $post_full_title;
    protected $post_full_image;
    protected $access;
    protected $content;
    protected $user;

    // function __construct($date_time, $tag, $post_full_title, $post_full_image, $content, $access){
        function __construct($user){
        $this->access = Post::ACCESS_ALL;
        $this->user = $user;
    }
    public function answer_b_add(){
        $answer = "INSERT INTO `Post` (`id_post`, `id_user`, `datetime`, `tag`, `post_full_title`, `post_full_image`, `access`, `content`) VALUES ";
        $answer .= "(NULL, '$this->user->id_user', '$this->date_time', '$this->tag', '$this->post_full_title', '$this->post_full_image', '$this->access', '$this->content')";
        return $answer;
    }

    public function show() {
        // echo "User:".$this->userName.", ".$this->fullName.", ".$this->email.
        return "Post:".$this->date_time.", ".$this->tag.", ".$this->post_full_title.", ".$this->post_full_image.", ".$this->access.", ".$this->content; 
    }
    // public function show_access($who, $){}

    public function set_userName($userName){
        $this->userName = $userName;
    }
    public function get_userName(){
        return $this->userName;
    }

}
?> 