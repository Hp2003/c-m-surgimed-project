<?php 
    $host = 'localhost';
    $password = 'panchal4555';
    $username = 'root';
    $database = 'C_M_surgimed';

    $connection = mysqli_connect($host , $username , $password , $database);
    
    if(!$connection){
        echo mysqli_error($connection);
    }
?>