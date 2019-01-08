<?php

require '../db/connection.php';


$sql = "SELECT * FROM uren";

$statement = $conn->prepare($sql);

$statement->execute();

$rows = $statement->fetchAll(PDO::FETCH_ASSOC);

$fileName = 'uren-export-van-'.date('Y-m-d').'.csv';
//file_put_contents('../exports/'. $fileName , $fileName);

header('Content-Type: application/excel');
header('Content-Disposition: attachment; filename="' . $fileName . '"');

$fp = fopen('php://output', 'w');

fputcsv($fp, [
    'ID',
    'Bedrijf',
    'Aanhef',
    'Voornaam',
    'Achternaam',
    'E-mail',
    'Telefoon',
    'Opmerkingen',
    'Offertenummer',
    'Gekozen vraag',
    'Status',
    'Start',
    'Eind'
], ";");

foreach ($rows as $row)
    $row['tel'] = '="' . $row['tel'] . '"';
    $row['start_traject'] = '="' . $row['start_traject'] . '"';
    $row['eind_traject'] = '="' . $row['eind_traject'] . '"';
    fputcsv($fp, $row, ";");


fclose($fp);