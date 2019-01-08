<?php
require 'db/connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /inloggen');
}

//dump($_SESSION);
$query2 = $conn->prepare('select laatst_ingelogd_op from user_login;');
$query2->execute();
$row2 = $query2->fetch(PDO::FETCH_OBJ);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/favicon.png" type="image/x-icon" />
    <title>Home | Registreren</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mijnstyle.css">
    <?php include'assets/ga.php'; ?>
</head>
<body>
<?php include 'assets/header.php'; ?>

<section class="container">
    <img src="images/logo.png" alt="Logo Unique Vloerverwarming" class="img-fluid d-block mx-auto w-50">
</section>
<section class="container">
    <form id="gebruikerAanmaken" method="post" action="assets/registratie.php">
        <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
        <input type="hidden" name="ip" value="<?= $_SERVER['REMOTE_ADDR']; ?>">
        <div class="form-group">
            <input type="text" class="form-control" id="email" placeholder="E-mail" name="email" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" id="password" placeholder="Wachtwoord" name="password" required>
        </div>

        <div class="form-group">
            <input type="text" class="form-control" id="fullName" placeholder="Volledige naam" name="fullname">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="username" placeholder="Gebruikersnaam" name="gebruikersnaam">
        </div>

        <button type="submit" class="btn btn-primary">Aanmelden</button>
    </form>



</section>



<?php include 'assets/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Weet u zeker dat u wilt uitloggen?');
    });

    $('.redirectOffertes').on('click', function () {
        return confirm('U wordt door verwezen naar de offertes.');
    });

</script>
</body>
</html>
