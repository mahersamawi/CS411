<?php
//signout.php
//include 'connect.php';
//include 'header.php';

session_start();
session_unset();
session_destroy();

header("Location: forum_index.php");
?>