<?php require 'db/connection.php';

if (isset($_SESSION['user_id'])) {
    header('Location: /');
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/favicon.png" type="image/x-icon"/>
    <title>Online stats and much more!</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mijnstyle.css">
    <?php include 'assets/ga.php'; ?>
</head>
<body id="LoginForm">

<header>
    <div class="overlay"></div>
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop" width="2560" height="1600">
        <source src="videos/background.mp4" type="video/mp4" >
    </video>
    <div class="container h-100 justify-content-center">
        <div class="d-flex text-center h-100">
            <div class="container">
                <h1 class="form-heading">Login</h1>
                <div class="login-form">
                    <div class="main-div">
                        <div class="panel">
                            <h2 class="text-white">Use your gaming credentials</h2>
                            <p class="text-white">Fill in your username and password</p>
                        </div>
                        <form id="Login" method="post" action="assets/login.php">
                            <input type="hidden" name="lio" value="<?= date('Y-m-d H:i:s'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" placeholder="Username" name="username"
                                       value="<?= e(old('username')); ?>">
                                <?php if (isset($_SESSION['errors']['username'])): ?>
                                    <div class="alert alert-danger mt-1"><?= e($_SESSION['errors']['username'][0]); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="form-group">
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                <?php if (isset($_SESSION['errors']['password'])): ?>
                                    <div class="alert alert-danger mt-1"><?= e($_SESSION['errors']['password'][0]); ?></div>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!--<div class="container">-->
<!--    <h1 class="form-heading">login Form</h1>-->
<!--    <div class="login-form">-->
<!--        <div class="main-div">-->
<!--            <div class="panel">-->
<!--                <h2>Klantenservice</h2>-->
<!--                <p>Vul uw gebruikersnaam en wachtwoord in</p>-->
<!--            </div>-->
<!--            <form id="Login" method="post" action="assets/login.php">-->
<!--                <input type="hidden" name="lio" value="--><?//= date('Y-m-d H:i:s'); ?><!--">-->
<!--                <div class="form-group">-->
<!--                    <input type="text" class="form-control" id="username" placeholder="Gebruikersnaam" name="username"-->
<!--                           value="--><?//= e(old('username')); ?><!--">-->
<!--                    --><?php //if (isset($_SESSION['errors']['username'])): ?>
<!--                        <div class="alert alert-danger mt-1">--><?//= e($_SESSION['errors']['username'][0]); ?><!--</div>-->
<!--                    --><?php //endif; ?>
<!--                </div>-->
<!---->
<!--                <div class="form-group">-->
<!--                    <input type="password" class="form-control" id="password" placeholder="Wachtwoord" name="password">-->
<!--                    --><?php //if (isset($_SESSION['errors']['password'])): ?>
<!--                        <div class="alert alert-danger mt-1">--><?//= e($_SESSION['errors']['password'][0]); ?><!--</div>-->
<!--                    --><?php //endif; ?>
<!--                </div>-->
<!--                <button type="submit" class="btn btn-primary">Login</button>-->
<!---->
<!--            </form>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->



<?php if (isset($_GET['status'])): ?>
    <?php if ($_GET['status'] === 'failed'): ?>
        <div class="modal" tabindex="-1" role="dialog" id="error">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Oeps...</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>De gegevens komen niet overeen in ons systeem.</p>
                        <p>Probeer het opnieuw.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>


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

    <?php if (isset($_GET['status'])): ?>
    <?php if($_GET['status'] === 'failed'): ?>
    $('#error').modal('show');
    <?php endif; ?>
    <?php endif; ?>
</script>
</body>
</html>

<?php unset ($_SESSION['errors']); ?>
