<?php

session_start();

require_once 'app/UserController.php';
require_once 'app/CachController.php';


$UserData = new UserController();
// Использую методы объекта получаю данные.
// И далее использую в html
$user = $UserData->getUserName();

//ТЕСТ
//echo $user['first_name'] . " " . $user['last_name'] . " " .$user['patronymic'] . '<br>';
//echo '<br>' . '<br>';

$card_info = $UserData->getCard_live_data_AND_card_name();

//ТЕСТ
//echo " Номер карты: " . $_SESSION['card_number'] ." ". " Дата аннулирования: " . $card_info['live_data'] ." ". " Имя: " . $card_info['card_name'];
//echo '<br>' . '<br>';

$balance = $UserData->getCardBalance();


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
<div class="py-3 bg-dark">
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
            <div class="col-md-4" style=""><a class="btn btn-outline-danger text-center m-3" href="
            <?php
                echo '/';
                ?>
">ВЫХОД</a>
            </div>
        </div>
    </div>
</div>
<div class="py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-white text-center">Здравствуйте</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-white text-center"><?php echo $user['first_name'] . " " . $user['last_name'] . " " . $user['patronymic']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-white text-center">Номер карты</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-white text-center"><?php echo $_SESSION['card_number']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-white text-center"> Срок действия</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-white text-center"><?php echo $card_info['live_data']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-white text-center">Имя</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-white text-center"><?php echo $card_info['card_name']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="text-white text-center">Баланс</h3>
                    </div>
                    <div class="col-md-6">
                        <h3 class="text-white text-center"><?php echo $balance['balance']; ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="">
                <h2 class="text-white text-center mb-3">Вывод средств<br></h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <h3 class="text-white text-center">Введите сумму кратную 50 грн</h3>
                            </div>
                            <div class="col-md-6 text-center">
                                <form method="post" class="form-inline text-center pt-1">
                                    <div class="input-group">
                                        <input type="text" name="cach" class="form-control text-center"
                                               placeholder="сумма">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">ВЫДАТЬ</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <h3 class="text-white text-center">Заберите купюры</h3>
                            </div>
                            <div class="col-md-6 text-center">
                                <h3 class="text-white text-center"><?php

                                    if (isset($_POST["cach"])) {
//                                        print_r($_POST["cach"]);
//                                        exit();
                                        $CachObj = new CachController();
                                        $money = $CachObj->iGiveCash($_POST["cach"]);
                                        if ($money) {
                                            foreach ($money as $val) {
                                                echo $val . ' ';
                                            }
                                        }
                                    }
                                    ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h5 class="shadow-lg text-light text-center text-uppercase">Info center 0800-555-880-780</h5>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
</body>

</html>
