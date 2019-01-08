<?php
require 'db/connection.php';
require 'php-riot-api-master/php-riot-api.php';
require 'php-riot-api-master/FileSystemCache.php';

//csrf();

if (!isset($_SESSION['user_id'])) {
    header('Location: /inloggen');
}


$querytest = $conn2->prepare('select * from users');
$querytest->execute();
$rowtest = $querytest->fetch(PDO::FETCH_OBJ);


$query = $conn->prepare('select * from uren where eind_traject is null order by id desc limit 1');
$query2 = $conn->prepare('select laatst_ingelogd_op from user_login;');


$query->execute();
$query2->execute();

$row = $query->fetch(PDO::FETCH_OBJ);
$row2 = $query2->fetch(PDO::FETCH_OBJ);


$query = $conn->prepare('select * from user_login;');
$query->execute();

$rows = $query->fetchAll(PDO::FETCH_OBJ);

$query2 = $conn->prepare('select laatst_ingelogd_op from user_login;');
$query2->execute();
$row2 = $query2->fetch(PDO::FETCH_OBJ);

$api = new riotapi('euw1', new FileSystemCache('cache/'));

$query4 = $conn->prepare('create view gebruikers AS SELECT * FROM user_login;');

$query5 = $conn->prepare('SELECT t1.id, t2.id FROM t1 CROSS JOIN t2;');
$query5->execute();
$row5 = $query5->fetch(PDO::FETCH_OBJ);



//$r = $api->getChampion();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="De klantenservice voor UniqueVloerverwarming.">
    <link rel="icon" href="images/favicon.png" type="image/x-icon"/>
    <title>Home</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/mijnstyle.css">
    <?php include 'assets/ga.php'; ?>
</head>
<body>
<?php include 'assets/header.php'; ?>

<section class="container">
    <div class="row mt-3">
        <div class="col text-center">
            <h4 class="display-4 text-white">HOME PANEL</h4>
        </div>
    </div>
</section>
<section class="container">
    <div class="row">
        <div class="col-sm-12 text-white">
            <div class="table-responsive text-white">
                <?php
                    try {
                        $r = $api->getSummonerByName("Jhazzzzzzzz");
                        print_r($r);
                    } catch(Exception $e) {
                        echo "Error: " . $e->getMessage();
                    };
                ?>
                <?php
                    echo e($rowtest->UserPassword);
                    echo e($rowtest->Username);


                ?>

            </div>
        </div>

    </div>




</section>
<!--
<section class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <p class="display-4">Urenregistratie</p>
                </div>
                <div class="card-body">
                    <p class="text-justify">
                        Ga direct naar de Urenregistratie
                    </p>
                    <a href="/urenregistratie"><button class="btn btn-primary">Klik hier</button></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <p class="display-4">Urenschema</p>
                </div>
                <div class="card-body">
                    <p class="text-justify">
                        Ga direct naar het urenschema
                    </p>
                    <a href="/alleuren"><button class="btn btn-primary">Klik hier</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row pt-2">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <p class="display-4">Vragenlijst</p>
                </div>
                <div class="card-body">
                    <p class="text-justify">
                        Ga direct naar de vragenlijst
                    </p>
                    <a href="/vragen"><button class="btn btn-primary">Klik hier</button></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <p class="display-4">Offertes inzien</p>
                </div>
                <div class="card-body">
                    <p class="text-justify">
                        Ga direct naar de offertes.
                    </p>
                    <a href="#"><button class="btn btn-primary">Klik hier</button></a>
                </div>
            </div>
        </div>
    </div>

</section>
-->
<section class="container">
</section>
<?php include 'assets/footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"
        integrity="sha256-CutOzxCRucUsn6C6TcEYsauvvYilEniTXldPa6/wu0k=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $('.confirmation').on('click', function () {
        return confirm('Weet u zeker dat u wilt uitloggen?');
    });
    $('.redirectOffertes').on('click', function () {
        return confirm('U wordt door verwezen naar de offertes.');
    });
    <?php if ($row): ?>
    let start = moment('<?= $row->start_traject; ?>');

    setInterval(tickTimer, 1000);

    function tickTimer() {
        let now = moment();

        minutes = now.diff(start, 'minutes').toString().padStart(2, '0');
        seconds = (now.diff(start, 'seconds') % 60).toString().padStart(2, '0');

        $('span#timer').text(
            minutes + ':' + seconds
        );
    }

    tickTimer();
    <?php endif; ?>


    (function ($) {

        let $query = $('#query');
        let $answers = $('.question');

        $query.on('input', function () {
            let query = $query.val();

            $answers.each(function (index, value) {
                value = $(value);

                let showAnswer = value.find('.card-header').text().trim().toLowerCase().includes(query.toLowerCase());

                value.toggleClass('d-none', !showAnswer);
                value.toggleClass('d-block', showAnswer);

            });
        });

    })(jQuery);

</script>
</body>
</html>
