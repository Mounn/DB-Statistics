<?php
    include('../db/connection.php');

    if (empty(trim($_POST['username']))) {
        $_SESSION['errors']['username'][] = 'Geen username ingevuld';
    }

    if (empty(trim($_POST['password']))) {
        $_SESSION['errors']['password'][] = 'Geen password ingevuld';
    }

    if (! empty($_SESSION['errors'])) {
        $_SESSION['old'] = $_POST;
        header('Location: /inloggen');
        exit;
    }

    if ( ! empty( $_POST ) ) {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            // Getting submitted user data from database
            $stmt = $conn->prepare("SELECT * FROM user_login WHERE username = ?; UPDATE user_login SET ipadres=?, laatst_ingelogd_op=? where username = ?");

            $stmt->bindParam(1, $_POST['username']);
            $stmt->bindParam(2, $_SERVER['REMOTE_ADDR']);
            $stmt->bindParam(3, $_POST['lio']);
            $stmt->bindParam(4, $_POST['username']);


            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_OBJ);

            // Verify user password and set $_SESSION
            if (password_verify($_POST['password'], $user->password)) {
                $_SESSION['user_id'] = $user->id;

                header('Location: /');
                exit;
            }

        }
    }

    header('Location: /inloggen?status=failed');
    exit;

