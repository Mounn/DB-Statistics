<?php

$subject = 'Registratie klantenservice Unique Vloerverwarming';
$email = '
    Beste gebruiker,
    
    U heeft een account geregistreerd met de volgende gegevens: 
    Gebruikersnaam: '. $_POST['gebruikersnaam'] . ' 
    Wachtwoord: '. $_POST['password'] . '
    
    U kunt nu gebruik maken van de Unique Vloerverwarming klantenservice. U kunt op de link hieronder klikken om verder te gaan:
    http://eimert.test/inloggen
    
    Met vriendelijke groet,
    
    Het registratiesysteem van Unique Vloerverwarming   
        
        ';
$to = 'bas@succes.media';
$from = 'bas@succes.media';

$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=iso-8859-1";
$headers[] = "From: Klantenservice Unique Vloerverwarming <{$from}>";
$headers[] = "Reply-To: Klantenservice Unique Vloerverwarming <{$from}>";
$headers[] = "X-Mailer: PHP/".phpversion();


mail($to, $subject, $email, implode("\r\n", $headers), "-f".$from );



?>