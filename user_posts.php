<?php
include_once "include/functions.php";
$id=0;
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
}
$posts = get_posts($id);

if($id>0){
    $add_title = "пользователя @".$posts[0]['login'];
}
$title = "Твиты ".$add_title;
include_once "include/header.php";

include_once "include/posts.php";
include_once "include/footer.php";
?>
