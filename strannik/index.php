<?php
    header('Content-Type: text/html; charset=utf-8');
    // подрубаем API
    require_once("vendor/autoload.php");
    // создаем переменную бота
    $token = "516040162:AAHNNT7zIAtS0b5tkJtpC1UU4N3IT8_fzsc";
    $bot = new \TelegramBot\Api\Client($token);
    include('vendor/autoload.php'); //Подключаем библиотеку
    use Telegram\Bot\Api;
    if(!file_exists("registered.trigger")){ 
	   /**
	   * файл registered.trigger будет создаваться после регистрации бота. 
	   * если этого файла нет значит бот не зарегистрирован 
       */
	 
	   // URl текущей страницы
	   $page_url = "https://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	   $result = $bot->setWebhook($page_url);
	   if($result){
		  file_put_contents("registered.trigger",time()); // создаем файл дабы прекратить повторные регистрации
	   }
    }
    $result = $telegram -> getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя
    $text = $result["message"]["text"]; //Текст сообщения
    $chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя
    $name = $result["message"]["from"]["username"]; //Юзернейм пользователя
    $keyboard = [["Копать"],["Охота"],["Рыбалка"]]; //Клавиатура
    $hunt = array('снарка', 'черепаху', 'летающую свинью', 'носорога', 'утенка', 'волка Гланка', 'медведя', 'онаниста', 'корову', 'енота', 'мишку коалу', 'лису', 'мышку', 'корову', 'енота', 'Дурова');
    $hunt_place = array('тундре', 'саване', 'кустарнике', 'полумраке бара', 'зарослях конопли', 'перезоде метро', 'офисе роскомнадзора');
    $top_hunt = array(0,'nickname', 'hunt');
    $fish = array('селедку', 'русалку', 'палтуса', 'аквалангиста', 'якорь от лодки', 'сырую пачку сигарет', 'испорченный презерватив', 'пластиковый стакан', 'кита', 'обломок Атлантиды', 'кусок Титаника', 'Лох-Несское чудовище', 'лампу джина');
    $fish_place = array('черную дыру', 'туалет', 'раковину', 'стакан молока', 'лужу', 'лужу грязи', 'детский плавательный бассейн', 'индийский океан', 'реку', 'озеро', 'слив ванной', 'аквариум');
    $top_fish = array(0, 'nickname', 'fish');
    $kop = array('мумию фараона Тутунхамона', 'икону', 'скелет', 'инсталятор Windows 3.11', 'тотем индейцев', 'мамонтенка', 'ледяную глыбу', 'доски Ноева Ковчега', 'метеорит', 'рубль с Лениным', 'амулет Мерлина', 'рыцарские доспехи', 'кривой нож', 'трубу с туркменким газом', 'лунный грунт');
    $kop_place = array('Гималаях', 'углу', 'Интернете', 'архиве', 'кармане', 'винчестере', 'бабушкином огороде', 'цветочном горшке', 'старом сортире', 'собственной памяти');
    $top_kop = array(0, 'nickname', 'kop');
    if ($text){
        $bot->command('start', function ($message) use ($bot) {
            $answer = 'Добро пожаловать!';
            $bot->sendMessage($message->getChat()->getId(), $answer);
        });
        $bot->command('help', function ($message) use ($bot) {
        $answer = 'Команды:
        /help - помощ';
        $bot->sendMessage($message->getChat()->getId(), $answer);
        });
        if($text == "!охота"){
            $numer1 =  rand(0, count($hunt_place));
            $number2 =  rand(0, count($hunt));
            $weight = rand(1, 1500);
            $reply1 = 'Вы затаились в ' . $hunt_place[$number1] . ' и поджидаете... Вы что-то слышите и стреляете в том направлении...';
            $reply2 = 'Поздравляю, ' . $name . ' Вы только что положили в свой мешок ' . $hunt[$number2] . '! Весом в' . $weight . 'кило!';
            if ($weight > $top_hunt[1]){
                $top_hunt[1] = $weight;
                $top_hunt[2] = $name;
                $top_hunt[3] = $hunt[$number2];
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
        if($text == "!рыбалка"){
            $numer1 =  rand(0, count($fish_place));
            $number2 =  rand(0, count($fish));
            $weight = rand(1, 1500);
            $reply1 = 'Вы забрасываете удочку в ' . $fish_place[$number1] . ' и поджидаете... Вы видете поклевку и начинаете подсекать...';
            $reply2 = 'Поздравляю, ' . $name . ' Вы только словили ' . $fish[$number2] . '! Весом в' . $weight . 'кило!';
            if ($weight > $top_fish[1]){
                $top_fish[1] = $weight;
                $top_fish[2] = $name;
                $top_fish[3] = $hunt[$number2];
                $reply3 = 'Поздравляю,' . $name . 'Вы установили новый рекорд по рыбалке!';
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
        if($text == "!копать"){
            $numer1 =  rand(0, count($kop_place));
            $number2 =  rand(0, count($kop));
            $weight = rand(1, 1500);
            $reply1 = 'Вы начали раскопки в ' . $kop_place[$number1] . ' и усиленно роете ломатами, экскавартором... Вам кажется, что Ваш совочек ударился обо что-то твердое. Может это клад?!';
            $reply2 = 'Поздравляю, ' . $name . ' Вы только что выкопали ' . $kop[$number2] . '! Возраст '. $weight . 'лет!';
            if ($weight > $top_kop[1]){
                $top_kop[1] = $weight;
                $top_kop[2] = $name;
                $top_kop[3] = $kop[$number2]
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
        if ($text == "!трофеи"){
            $reply1 = $top_hunt[2] . 'занимает первое место по охоте, застрелиив ' . $top_hunt[3] . ', весом в ' . $top_hunt[1] . 'кило!';
            $reply2 = $top_fish[2] . 'занимаем первое место в рыбалке, выудив' . $top_fish[3] . ', весом в ' . $top_fish[1] . 'кило!';
            $reply3 = $top_kop[2] . 'занимает первое место в археологии! Он выкопал' . $top_kop[3] . '. Возраст составляет ' . $top_kop[1] . 'лет!';            
            $telegram->sendMessage([ 'chat_id' => $chat_id, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true, 'text' => $reply1 ]);
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