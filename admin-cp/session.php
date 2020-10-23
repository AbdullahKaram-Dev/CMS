<?php
session_start();
include_once '../include/config.php';

if (isset($_SESSION['id'])) {
    $sql = mysqli_query($connectToDB, "SELECT * FROM `members` WHERE `user_id` = '$_SESSION[id]' AND `role` = ('admin' OR 'writer')");

    if (mysqli_num_rows($sql) != 1) {

        header("LOCATION: ../index.php ");
    } else {

    }

} else {

    header("LOCATION: ../index.php ");
}


?>