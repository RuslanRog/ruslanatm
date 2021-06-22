<?php

require_once "app/DBConfig.php";


class LoginController extends DBConfig
{

    public $error;

    public function __construct()
    {
        parent::__construct();
    }

    public function required_validation($field)
    {
//        var_dump($field);

        if (empty($field['card_number'] && $field['pin'])) {
            $this->error .= "<p>" . " ВВЕДИТЕ ДАННЫЕ</p>";
        } else {
            return true;
        }
    }

    public function can_login($table_name, $where_condition)
    {
        $condition = '';
//        print_r($where_condition['pin']);
//        $pin = $where_condition['pin'];
//        print_r($table_name);
//        print_r($where_condition);

        foreach ($where_condition as $key => $value) {
            $condition .= $key . " = '" . $value . "' AND ";
        }
        $condition = substr($condition, 0, -5);
        /*This code will convert array to string like this-
        input - array(
             'id'     =>     '5'
        )
        output = id = '5'*/
//        echo '<br>' . $condition;
        $query = "SELECT * FROM " . $table_name . " WHERE " . $condition;
//        echo '<br>' . $query;
//        exit();
//        $result = mysqli_query($this->con, $query);
        $result = $this->connection->query($query);
        if (mysqli_num_rows($result)) {
            return true;
        } else {
            $this->error = "Ошибка ввода";
        }


    }
}

