<?php

require_once 'app/UserController.php';

// Класс выдает наличные и валидирует входящие данные.
// По хорошему эти действия нужно разделить по классам.
class CachController extends DBConfig
{

    public function iGiveCash($request)
    {
        $UserData = new UserController();
        $balance = $UserData->getCardBalance();
        $user_balance = $balance['balance'];

        $originalRequest = $request;

        $availableNotes = [500, 200, 100, 50];
        $result = [];

        if ($request > 0) {
            for ($i = 0; $i < count($availableNotes); $i++) {
                $note = $availableNotes[$i];
                while ($request - $note >= 0) {
                    $request -= $note;
                    $result[] = $note;
                }
            }
        } else {
            echo "Пожалуйста введите суму";
        }
//        return $result;
        $sum = (int)'';

        foreach ($result as $item) {
//            echo '<br>' . 'item = ' . $item . '<br>';
            $sum += $item;
        }
//        echo '<br>' . 'result sum = ' . $sum . '<br>';
        if ($sum > $user_balance) {
            echo '<label class="text-danger">' . 'СУММА БОЛЬШЕ БАЛАНСА' . '</label>';
        } else {
            if ($sum > $originalRequest or $sum < $originalRequest) {
                echo '<label class="text-danger">' . 'СУММА НЕ КРАТНА 50 !' . '</label>';
            } else {
                return $result;
            }
        }
    }


}

//$money = new CachController();
//$m = $money ->iGiveCash('480');
//        echo '<br>';
//        echo '<pre>';
//        print_r($m);
//        echo '</pre>';
//        echo '<br>';