<?php
    include('config/database.php');
    $fname= $_POST['f_name'];
    $lname=$_POST['l_name'];
    $email=$_POST['e_mail'];
    $passw=$_POST['p_assw'];

    $sql_validate_email="
            select count(id)
         from users
         where email='$email'and 
         status= true;

    ";
    $ans = pg_query($conn, $sql_validate_email);
    if($ans){//$ans==true
        $row=pg_fetch_assoc($ans);
        if($row['total']>0){
            echo "User already exist !!!";

        }else{
            $sql ="INSERT INTO user 
            (firstname, lastname, email, password)
            VALUES ('$fname','$lname','$email','$passw')
            ";
            $ans = pg_query($conn,$sql);
            if($ans){
                echo "User has been created successfully";
            }else{
                echo "Error";
            }
        }
    }else{
        echo "Query error";
    }

   
?>