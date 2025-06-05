<?php
include('config/database.php');

$fname = pg_escape_string($conn, $_POST['f_name']); 
$lname = pg_escape_string($conn, $_POST['l_name']);
$email = pg_escape_string($conn, $_POST['e_mail']);
$passw = $_POST['p_assw']; // sin escapar aquí para poder hashear bien

$hashed_password = password_hash($passw, PASSWORD_DEFAULT); // Hashear la contraseña

$sql_validate_email = "
    SELECT 
        COUNT(id) as total
    FROM 
        users
    WHERE
        email = '$email' AND
        status = TRUE
";

$ans = pg_query($conn, $sql_validate_email);

if ($ans) {
    $row = pg_fetch_assoc($ans);
    if ($row['total'] > 0) {
        echo "User already exists !!!";
    } else {
        $sql = "
            INSERT INTO users (firstname, lastname, email, password)
            VALUES ('$fname', '$lname', '$email', '$hashed_password')
        ";

        $ans_insert = pg_query($conn, $sql);
        if ($ans_insert) {
            echo "User has been created successfully";
        } else {
            echo "Error during insertion";
        }
    }
} else {
    echo "Query error during email validation";
}
?>
