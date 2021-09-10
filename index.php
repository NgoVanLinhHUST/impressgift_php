<?php
session_start();
include "functions/admin_functions.php";
include "config/connection.php";

include "pages/includes/header.php";


if (!empty($_GET['action'])) {
    if (file_exists("pages/" . $_GET['action'] . ".php")) {
        include "pages/" . $_GET['action'] . ".php";
    } else {
        include "pages/home.php";
    }
} else {
    include "pages/home.php";
}

include "pages/includes/footer.php";
