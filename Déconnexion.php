<?php 
 session_start();

 session_destroy();

 header('Location: Liste.php');

 exit();