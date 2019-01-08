<?php
/**
 * Created by PhpStorm.
 * User: PC Bas
 * Date: 7-11-2018
 * Time: 10:41
 */

session_start();
// CSRF Integratie
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $length = 32;
    $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
}

//dump($_SESSION);


    $servername = 'localhost';
    $username = 'root';
    $password = '';

//    $servername = 'localhost';
//    $username = 'klantenservice';
//    $password = 'sV?0sh9H7czIaszk';



try {
    $conn = new PDO("mysql:host=$servername;dbname=klantenservice", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);
    // set the PDO error mode to exception
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
try {
    $conn2 = new PDO("mysql:host=$servername;dbname=mydb", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
    ]);
    // set the PDO error mode to exception
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}

function dump($value = null) {
    echo '<pre>';
    print_r($value);
    exit;
}

function old($key) {
    if (isset($_SESSION['old'][$key])) {
        return $_SESSION['old'][$key];
    }

    return '';
}

function e($input) {
    return htmlspecialchars($input);
}

//function csrf() {
//    $length = 32;
//    $_SESSION['token'] = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $length);
//}

?>

SELECT * FROM Matchstats;
SELECT * FROM GameStatistics;
SELECT * FROM Matches;
SELECT * FROM APIs;
SELECT * FROM Games;
SELECT * FROM Donations;
SELECT * FROM IGNs;
SELECT * FROM SubscriptionTypes;
SELECT * FROM Subscriptions;
SELECT * FROM Users;

USE `mydb`;

call new_procedure;