<?php

require_once('WebPage.php');

$page = new WebPage("Contact");
$page->appendToHead('<link rel="stylesheet" href="style1.css">');

$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
