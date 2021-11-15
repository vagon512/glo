<?php
include_once "config.php";

function debug($var, $stop = false){
    echo "<pre>";
    print_r($var);
    echo "</pre>";
    if($stop == true) die();
}

function test(){
    echo "hello";
}

function get_url($page=''){
    return HOST."/".$page;
}

function get_page_title($title=''){
   if(!empty($title)){
     return SITE_NAME." - ".$title;
   }
   else{
       return SITE_NAME;
   }
}

function db(){
    try{
        return new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASS,
          [
              PDO::ATTR_EMULATE_PREPARES => false,
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
          ]
        );
    }
    catch(PDOException $e){
        die($e->getMessage());
    }
}

function db_query($sql, $exec = false){
    if(empty($sql)){
        return false;
    }

    if($exec){
       return db()->exec($sql);
    }

    return db()->query($sql);
}

function get_posts($user_id = 0){
    if($user_id > 0){
        $sql = "SELECT posts.*, users.name, users.login, users.avatar FROM `posts` JOIN `users` on posts.user_id=users.id WHERE posts.user_id='$user_id'";
    }
    else {
        $sql = "SELECT posts.*, users.name, users.login, users.avatar FROM `posts` JOIN `users` on posts.user_id=users.id";
    }
    return db_query($sql)->fetchAll();
}

//функции для работы с пользователем
function get_user_info($login){
    return db_query("SELECT * FROM users WHERE login = '$login'")->fetch();
}

function register_user($auth_data){
    if(empty($auth_data) || !isset($auth_data['login']) ||
    empty($auth_data['login']) || empty($auth_data['passwd']) || empty($auth_data['retypepasswd'])){
        return false;
    }

    $user = get_user_info($auth_data['login']);
    if(!empty($user)){
        $_SESSION['error'] = "пользователь ".$auth_data['login']. " уже существует";
        header("location:". get_url('register.php'));
        exit(0);
    }

    if($auth_data['retypepasswd'] !== $auth_data['passwd']){
        $_SESSION['error'] = "пароли не совпадают";
        header("location:". get_url('register.php'));
        exit(0);
    }


   if(add_user($auth_data['login'], $auth_data['passwd'])){
       header("location:". get_url());
   }
}

function add_user($login, $passwd){
    $login = trim($login);
    $name = ucfirst($login);
    $passwd = password_hash($passwd, PASSWORD_DEFAULT);

    return db_query("INSERT INTO users (id, login, pass, name) VALUES(0, '$login', '$passwd', '$name');", true);
}

function login($auth_data){
 //   debug($auth_data, true);
    if(empty($auth_data) || !isset($auth_data['login']) || empty(isset($auth_data['login'])) ){
      return false;
    }

    $user = get_user_info($auth_data['login']);
 //   debug($user, true);
    if(empty($user)){
        $_SESSION['error'] = "Такого пользователя не существует";
        header("location:". get_url());
        exit(0);
    }
    if(password_verify($auth_data['passwd'], $user['pass'])){
        $_SESSION['user'] = $user;
        $_SESSION['error'] = '';
        header("location:".get_url('user_posts.php?id='.$user['id']));
    }
    else{
        $_SESSION['error'] = "Пароль неверный";
        header("location:". get_url());
        exit(0);
    }
}

function get_error_message(){
    $error = '';
    if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
        $error = $_SESSION['error'];
    }
    $_SESSION['error'] = '';
    return $error;
}