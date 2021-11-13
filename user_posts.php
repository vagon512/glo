<?php
include_once "include/functions.php";
$id=0;
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];
}
$posts = get_posts($id);

include_once "include/header.php";

include_once "include/posts.php";
include_once "include/footer.php";
?>
