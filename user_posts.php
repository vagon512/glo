<?php
include_once "include/functions.php";
$id = 0;
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
}

if(isset($_SESSION['user']['id'])){
    $id = $_SESSION['user']['id'];
}
if($id>0 && !empty($posts[0]['login'])){
    $add_title = "пользователя @".$posts[0]['login'];
}
else{
    $add_title = "пользователя";
}

$title = "Твиты ".$add_title;

$posts = get_posts($id);
include_once "include/header.php";

include_once "include/posts.php";
include_once "include/footer.php";
?>
