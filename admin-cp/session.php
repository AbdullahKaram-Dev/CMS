<?php
session_start();

if(isset($_SESSION['id']) && $_SESSION['role'] === 'admin'){


}else{

    header("LOCATION: ../index.php ");
}