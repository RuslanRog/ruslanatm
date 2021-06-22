<?php

session_start();
$_SESSION = array();

require_once 'app/LoginController.php';

// Создаю объект LoginController, передаю данные с post
$data = new LoginController;

$message = '';

if (isset($_POST["login"])) {
    $field = array(
        'card_number' => $_POST["card_number"],
        'pin' => $_POST["pin"]
    );

    // Валидируем и входим, переходим на login_success.php
    if ($data->required_validation($field)) {
        if ($data->can_login("cards", $field)) {
            $_SESSION["card_number"] = $_POST["card_number"];
//            echo $_SESSION["card_number"];
//            exit();
            header("location:login_success.php");
        } else {
            $message = $data->error;
        }
    } else {
        $message = $data->error;
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          type="text/css">
    <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
</head>

<body class="bg-dark">
<div class="py-4 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1 class="display-4 text-capitalize text-info" contenteditable="true">ATM</h1>
            </div>
            <div class="col-md-4">
                <div class="row text-center">
                    <div class="col-md-12">
                        <h1 class="display-4 text-white">БАНКОМАТ</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
<div class="py-5 text-center bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="p-5 col-lg-6 col-10 mx-auto border">
                <?php
                if (isset($message)) {
                    echo '<label class="text-danger">' . $message . '</label>';
                }
                ?>
                <form method="post">
                    <h3 class="" style="">НОМЕР КАРТЫ</h3>
                    <div class="form-group">
                        <input type="text" name="card_number" class="form-control" placeholder="номер карты" id="form14">
                    </div>
                    <h3 class="">ПИН КОД</h3>
                    <div class="form-group">
                        <input type="password" name="pin" class="form-control" placeholder="пин код" id="form15">
                        <small class="form-text text-muted text-right"></small>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">ВХОД</button>
                </form>
                <p></p>
                <p>Number: 1111222233334444 Pin: 2349</p>
                <p>Number: 1122334455667788 Pin: 1140</p>
                <p>Number: 3452203433332414 Pin: 0045</p>
                <p>Number: 2131222132365771 Pin: 2345</p>
                <p>Number: 3451117828749965 Pin: 9346</p>
                <p>Number: 8912452333344337 Pin: 8340</p>
                <p>Number: 8071224333344876 Pin: 7341</p>
                <p>Number: 7601124533344567 Pin: 0345</p>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h5 class="shadow-lg text-light text-center text-uppercase">Info centr 0800-555-880-780</h5>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
</body>

</html>
