<?php

$host         = 'localhost';
$DataBaseName = 'cms_system';
$username     = 'root';
$password     = '';

$connectToDB = mysqli_connect($host,$username,$password,$DataBaseName);
mysqli_set_charset($connectToDB,'utf8');


if(!$connectToDB)
{
    echo mysqli_connect_error('error in connect') . mysqli_connect_errno();
}


function CloseConnectDataBase()
{
    global $connectToDB;
    mysqli_close($connectToDB);

}


