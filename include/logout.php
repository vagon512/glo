<?php
include_once "functions.php";
session_destroy();

header("location:". get_url());
exit(0);

