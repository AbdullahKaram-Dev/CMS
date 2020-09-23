<?php
session_start();
if (isset($_GET['id'])){

    session_destroy();
    header("LOCATION: index.php");
}

