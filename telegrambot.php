<?php
    include('vendor/autoload.php'); //Подключаем библиотеку
    use Telegram\Bot\Api; 
    $telegram = new Api('589088703:AAEOxhv4-VGIzRNgQFIKzkIb8We-Z5Yla8c'); //Устанавливаем токен, полученный у BotFather
    $result = $telegram -> getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя
    $text = $result["message"]["text"]; //Текст сообщения
    $chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
    $name = $result["message"]["from"]["username"]; //Юзернейм пользователя
    $keyboard = [["Копать"],["Охота"],["Рыбалка"]]; //Клавиатура
    $hunt = [["снарка"],["черепаху"],["летающую свинью"],["носорога"],["утенка"],["волка Гланка"],["медведя"],["онаниста"],["корову"],["енота"],["мишку коалу"],["лису"],["мышку"],["корову"],["енота"],["Дурова"]];
    $hunt_place = [["тундре"],["саване"],["кустарнике"],["полумраке бара"],["зарослях конопли"],["перезоде метро"],["офисе роскомнадзора"]];
    $top_hunt = [[0],['nickname']];
    if ($text){
        if($text == "!копать"){
            $numer_place =  mt_rand(0, count($hunt_place) - 1);
            $number_hunt =  mt_rand(0, count($hunt) - 1);
            $weight = mt_rand(1, 1500 - 1);
            $reply1 = 'Вы затаились в ' . $hunt_place[$number_place] . ' и поджидаете... Вы что-то слышите и стреляете в том направлении...';
            $reply2 = 'Поздравляю, ' . $name . ' Вы только что положили в свой мешок ' . $hunt[$number_hunt] . '! Весом в' . $weight . 'кило!'
            if ($weight > $top_hunt[1]){
                $top_hunt[1] = $weight;
                $top_hunt[2] = $name;
                $reply3 = 'Поздравляю,' . $name . 'Вы установили новый рекорд по охоте!';
            }
            else {
                $reply3 = 'Извини,' . $name . ', но это не новый рекорд! Однако, хорошая попытка';
            }
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true, 'text' => $reply ]);
            sleep(2);
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true, 'text' => $reply2 ]);
            sleep(2);
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true, 'text' => $reply3 ]);
        }
    }
    else{
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение." ]);
    }
?>