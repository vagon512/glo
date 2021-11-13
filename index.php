<?php
include_once "include/functions.php";
$posts = get_posts();
$title = 'Главная';

include_once "include/header.php";
include_once "include/twit_form.php";
include_once "include/posts.php";
include_once "include/footer.php";
?>
