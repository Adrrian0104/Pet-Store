<?php

include('config/database.php');

$email = $_POST['e_mail'];
$passw = $_POST['p_assw'];

// En producción deberías usar password_hash() y password_verify()
$hashed_password = $passw;

$sql = "
    SELECT
        u.id
    FROM
        users u
    WHERE
        email = '$email' AND     
        password = '$hashed_password'
";

$res = pg_query($conn, $sql);

if ($res && pg_num_rows($res) > 0) {
    $row = pg_fetch_assoc($res);
    
    // Usuario autenticado correctamente
    header('Location: http://localhost/Pet-Store/src/home.html');
    exit;

} else {
    echo "Correo o contraseña incorrectos.";
}

?>
