<?php
include 'db/connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: /inloggen');
}

$query = $conn->prepare('select * from user_login;');
$query->execute();

$rows = $query->fetchAll(PDO::FETCH_OBJ);

$query2 = $conn->prepare('select laatst_ingelogd_op from user_login;');
$query2->execute();
$row2 = $query2->fetch(PDO::FETCH_OBJ);




//dump($rows);
//$query = $conn->prepare('select sum(timestampdiff(minute, start_traject, ifnull(eind_traject, now()))) as totale_tijd, count(*) as totale_registraties from uren');
//$query->execute();
//
//$totaal = $query->fetch(PDO::FETCH_OBJ);
//
//$query = $conn->prepare('select opmerkingen from uren where ');
//
//$query2 = $conn->prepare('select laatst_ingelogd_op from user_login;');
//$query2->execute();
//$row2 = $query2->fetch(PDO::FETCH_OBJ);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/favicon.png" type="image/x-icon"/>
    <title>Home | Gebruikers</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mijnstyle.css">
    <?php include 'assets/ga.php'; ?>
</head>
<body>
<?php include('assets/header.php'); ?>
<section class="container">
    <div class="row mt-3">
        <div class="col text-center">
            <h4 class="display-4">Hier vind u een overzicht van alle gebruikers:</h4>
        </div>
    </div>
</section>
<section class="container">
    <div class="card">
        <div class="card-header">
            <span class="lead">Gebruikers</span>
            <span class="float-right lead">
                <a class="mt-5" href="/registreren">Nieuwe gebruiker aanmaken</a>
            </span>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>E-mail</th>
                    <th>Volledige naam</th>
                    <th>Gebruikersnaam</th>
                    <th>IP-adres</th>
                    <th>Laatst ingelogd op</th>
                    <th>Acties</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td>
                            <strong><?= e($row->id); ?></strong>
                        </td>
                        <td><?= e($row->email); ?></td>
                        <td><?= e($row->full_name); ?></td>
                        <td><?= e($row->username);  ?></td>
                        <td><?= e($row->ipadres); ?></td>
                        <td><?php
                                if($row->laatst_ingelogd_op === null){
                                    echo "Nog niet ingelogd";
                                } else{
                                    echo e($row->laatst_ingelogd_op);
                                }
                            ?>
                        </td>
                        <td>
                            <a class="lead" href="#" data-toggle="modal" data-target="#opmerkingen-dropdown-<?= e($row->id); ?>"
                               aria-expanded="false" aria-controls="opmerkingen-dropdown-<?= e($row->id); ?>">
                                Meer
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php foreach ($rows as $row): ?>

                <div class="modal fade" id="opmerkingen-dropdown-<?= e($row->id); ?>" tabindex="-1" role="dialog"
                     aria-labelledby="opmerkingen-dropdown-<?= e($row->id); ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Gebruiker wijzigen</h5>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="lead font-italic">Wachtwoord wijzigen</p>
                                <form action="/assets/wijzigWachtwoord" method="POST">
                                    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                                    <input type="hidden" name="id" value="<?= e($row->id); ?>">
                                    <input type="text" name="editPass" placeholder="Nieuw wachtwoord" class="form-control">
                                    <button id="wijzigWachtwoord" class="btn btn-primary btn-lg btn-block mt-3" type="submit">Wijzig wachtwoord</button>
                                </form>
                                <hr>
                                <p class="lead font-italic">Gebruikersnaam wijzigen</p>
                                <form action="/assets/wijzigUser" method="POST">
                                    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                                    <input type="hidden" name="id" value="<?= e($row->id); ?>">
                                    <input type="text" name="editUser" placeholder="Nieuwe gebruikersnaam" class="form-control">
                                    <button id="wijzigUser" class="btn btn-primary btn-lg btn-block mt-3" type="submit">Wijzig gebruikersnaam</button>
                                </form>
                                <hr>
                                <p class="lead font-italic">E-mail wijzigen</p>
                                <form action="/assets/wijzigEmail" method="POST">
                                    <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">
                                    <input type="hidden" name="id" value="<?= e($row->id); ?>">
                                    <input type="text" name="editEmail" placeholder="Nieuwe E-mail" class="form-control">
                                    <button id="wijzigEmail" class="btn btn-primary btn-lg btn-block mt-3" type="submit">Wijzig E-mail</button>
                                </form>
                                <hr>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>


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
    })
</script>
</body>
</html>
