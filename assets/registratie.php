<?php
require '../db/connection.php';


if ($_SESSION['token']==$_POST['token']) {


    $query = $conn->prepare('insert into user_login values (id,?,?,?,?,?,?)');
    $query->bindParam(1, $_POST['email']);
    $query->bindParam(2, password_hash($_POST['password'], PASSWORD_BCRYPT));
    $query->bindParam(3, $_POST['fullname']);
    $query->bindParam(4, $_POST['gebruikersnaam']);
    $query->bindParam(5, $_POST['ip']);
    $query->bindParam(6, $_SESSION['token']);

    $query->execute();


    include 'mail.php';

    header('Location: /inloggen');
} else {
    echo '<h1>Er is iets misgegaan met de sessie validatie. Probeer uw cookie te verwijderen en probeer het daarna nog eens</h1>';
//    header('Location: /');
}



?>