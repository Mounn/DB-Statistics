<?php
require 'db/connection.php';
session_destroy();
header('Location: /');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mijnstyle.css">
    <?php include'assets/ga.php'; ?>
</head>
<body>
<?php include'assets/header.php'; ?>

<section class="container">
    <div class="row mt-3">
        <div class="col text-center">
            <h1>Uniquevloerverwarming Klantenservice</h1>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col text-center">
            <h2>U word zo uitgelogd...</h2>
            <h4>Een moment geduld a.u.b.</h4>
        </div>
    </div>
</section>







<?php include'assets/footer.php'; ?>

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
    })
</script>
</body>
</html>
