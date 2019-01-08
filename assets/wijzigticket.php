<?php
require '../db/connection.php';
if ($_SESSION['token']==$_POST['token']) {


    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        exit;
    }

    $query = $conn->prepare('update uren set status = ? where id = ?');



    $query->bindParam(1, $_POST['ticketStatus']);
    $query->bindParam(2, $_POST['id']);


    $query->execute();

    header('Location: /open-tickets');
} else {
    echo '<h1>Er is iets misgegaan met de sessie validatie. Probeer uw cookie te verwijderen en probeer het daarna nog eens</h1>';

    header('Location: /open-tickets');
}


