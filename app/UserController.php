<?php

require_once 'app/DBConfig.php';


class UserController extends DBConfig
{
    public $card_number;

    public function __construct()
    {
//        echo $_SESSION["card_number"];
//        exit();
        $this->card_number = $_SESSION["card_number"];

        parent::__construct();
    }


    public function getUserName()
    {
//        echo $_SESSION["card_number"];
//        exit();
        $query = "
SELECT first_name, last_name, patronymic
FROM users
INNER JOIN cards
ON user_id = users.id
WHERE card_number = $this->card_number";
//        echo $query;
//        exit();
        $result = $this->connection->query($query)->fetch_assoc();
//        echo $result;
//        exit();

        if ($result == false) {
            echo 'Error: cannot execute the command';
            return false;
        } else {
            return $result;
        }


    }


    public function getCard_live_data_AND_card_name()
    {
        $query = "
SELECT id, live_data, card_name 
FROM cards
WHERE card_number = $this->card_number";

        $result = $this->connection->query($query)->fetch_assoc();
//        echo '<br>';
//        echo '<pre>';
//        print_r($result);
//        echo '</pre>';
//        echo '<br>';

        if ($result == false) {
            echo 'Error: cannot execute the command';
            return false;
        } else {
            // return true;
            return $result;
        }
    }


    public function getCardBalance()
    {
//        var_dump($this->getCard_live_data_AND_card_name());
        $arr = $this->getCard_live_data_AND_card_name();

        $id = $arr['id'];
//        echo '<br>';
//        echo $id;
//        echo '<br>';

        $query = "
SELECT card_id, balance 
FROM transactions
INNER JOIN cards 
ON cards.id = transactions.card_id
WHERE card_id = $id
ORDER BY transactions.date_operation DESC LIMIT 1";

        $result = $this->connection->query($query)->fetch_assoc();
//        echo '<br>';
//        echo '<pre>';
//        print_r($result);
//        echo '</pre>';
//        echo '<br>';

        if ($result == false) {
            echo 'Error: cannot execute the command';
            return false;
        } else {
            return $result;
        }
    }


}