<?php
include_once "include/functions.php";
$posts = get_posts();
$title = 'Главная';
$error = get_error_message();

include_once "include/header.php";

if($_SESSION['user']['id']) {
    include_once "include/twit_form.php";
}


include_once "include/posts.php";
include_once "include/footer.php";
?>
