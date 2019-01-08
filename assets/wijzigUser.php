<?php
require '../db/connection.php';
if ($_SESSION['token']==$_POST['token']) {


    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        exit;
    }

    $query = $conn->prepare('update user_login set username = ? ');



    $query->bindParam(1, $_POST['editUser']);



    $query->execute();

    header('Location: /gebruikers');
} else {
    echo '<h1>Er is iets misgegaan met de sessie validatie. Probeer uw cookie te verwijderen en probeer het daarna nog eens</h1>';

    header('Location: /gebruikers');
}


