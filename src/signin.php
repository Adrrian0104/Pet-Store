<?php

include('config/database.php');
    
    $email=$_POST['e_mail'];
    $passw=$_POST['p_assw'];
    $hashed_password = password_hash($passw, PASSWORD_DEFAULT);
    $sql="
        SELECT
            id,
                COUNT(id) as total
            FROM
                users u
            WHERE
                email='$email' and 
                password='$hashed_password'
    ";
?>