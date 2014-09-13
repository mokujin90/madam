<?php

class Help{
    const DATETIME="Y-m-d H:i:s";
    public static function dump($object, $die = true)
    {
        CVarDumper::dump($object, 10, true);
        if ($die) {
            die;
        }
    }

    public static function dumpError($model)
    {
        CVarDumper::dump($model->getErrors(), 10, true);
        die;
    }

    /**
     * Из выбранного трехмерного массива создаст двумерный вида [key1=>key1,key2=>key2] (при жестком режиме, иначе же ключи будут
     * @param $array
     * @param $keys
     */
    public static function getIndex($array,$keys,$strict=true){
        $result = array();
        if(is_array($array)){
            foreach($array as $item){
                if(isset($item[$keys]))
                    $strict ? $result[$item[$keys]] = $item[$keys] : $result[]=$item[$keys];
            }
        }

        return $result;
    }

    /**
     * Метод, который приведет массив к пустому, если такого массива не существует
     * @param $array
     */
    public static function recommend(&$array){
        $array = is_array($array) ? $array : array();
    }

    public static function setArray($array){
        return is_array($array) ? $array : array($array);
    }

    /**
     * Из массива AR-объектов получить массив вида [id]=>нужное поле
     * @param $cursor CActiveRecord[]
     * @param $value ключ из модели, который должен быть в значении нового массива
     * @param string $key
     * @return array
     */
    public static function decorate($cursor,$value,$key='id'){
        $result = array();
        if(is_array($cursor)){
            foreach($cursor as $item){
                $result[$item->{$key}] = $item->{$value};
            }
        }

        return $result;
    }

    public static function currentDate($format=self::DATETIME){
        return date($format);
    }

    /**
     * По дате отдаст номера дня недели в формате проекта, а не ISO-8601 (т.е. -1)
     * @param $date
     */
    public static function getWeekDay($date){
        return date('N', strtotime( $date))-1;
    }

    public static function getDayText($date, $is_week = false) {
        $dateVal = isset($date) ? $date: new DateTime();
        if($is_week){
            $day = $dateVal->format('N') - 1;
            $dateVal->modify("-$day days");
            $text = $dateVal->format('d/m/Y');
            $text .= ' - ';
            $dateVal->modify("+6 days");
            $text .= $dateVal->format('d/m/Y');
            return $text;
        } else {
            return $dateVal->format('d/m/Y');
        }
    }

    public static function getDate($date){
        $dateVal = isset($date) ? $date: new DateTime();
        return $dateVal->format('Y-m-d');
    }

    public static function getModifyDate($date, $modify){
        $dateVal = isset($date) ? clone $date: new DateTime();
        $dateVal->modify($modify);
        return $dateVal->format('Y-m-d');
    }

    /**
     * dd/mm/YYYY -> YYYY-mm-dd
     */
    public static function formatDate($date)
    {
        $dateExp = explode('/', $date);
        return $dateExp[2] . '-' . $dateExp[1] . '-' . $dateExp[0];
    }

    public static function formatDateICal($dateTime)
    {
        return $dateTime->format('Ymd') . "T" . $dateTime->format('His');
    }

    /**
     * Метод ***еша
     * @param $d1
     * @param $d2
     * @return array
     */
    public static function dateDiff($d1, $d2)
    {
        $d1 = (is_string($d1) ? strtotime($d1) : $d1);
        $d2 = (is_string($d2) ? strtotime($d2) : $d2);
        $diff_secs = abs($d1 - $d2);
        $base_year = min(date("Y", $d1), date("Y", $d2));

        $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
        return array(
            "years" => date("Y", $diff) - $base_year,
            "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
            "months" => date("n", $diff) - 1,
            "days_total" => floor($diff_secs / (3600 * 24)),
            "days" => date("j", $diff) - 1,
            "hours_total" => floor($diff_secs / 3600),
            "hours" => date("G", $diff),
            "minutes_total" => floor($diff_secs / 60),
            "minutes" => (int)date("i", $diff),
            "seconds_total" => $diff_secs,
            "seconds" => (int)date("s", $diff)
        );
    }

    /**
     * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
     * @param  $number Integer Число на основе которого нужно сформировать окончание
     * @param  $endingsArray  Array Массив слов или окончаний для чисел (1, 4, 5),
     *         например array('яблоко', 'яблока', 'яблок')
     * @return String
     */
    public static function getNumEnding($number, $endingArray)
    {
        $number = $number % 100;
        if ($number>=11 && $number<=19) {
            $ending=$endingArray[2];
        }
        else {
            $i = $number % 10;
            switch ($i)
            {
                case (1): $ending = $endingArray[0]; break;
                case (2):
                case (3):
                case (4): $ending = $endingArray[1]; break;
                default: $ending=$endingArray[2];
            }
        }
        return $ending;
    }

    /**
     * По массиву из любой модели будет формировать список из ошибок для jGrowl
     * @param $errors
     */
    public static function drawError($errors){
        $result = '';
        foreach($errors as $field){
            foreach($field as $error){
                $result.=$error."<br/>";
            }
        }
        return $result;
    }

    public static function sendMail($to, $theme, $view, $model){
        if(empty($to)){
            return false;
        }
        $mailer =& Yii::app()->mailer;
        $mailer->CharSet = 'UTF-8';
        $mailer->From = Yii::app()->params['fromEmail'];
        $mailer->FromName = Yii::app()->params['fromName'];
        $mailer->IsSMTP();                                      // set mailer to use SMTP

        $mailer->Host = "smtp.yandex.ru";  // specify main and backup server
        $mailer->SMTPAuth = true;     // turn on SMTP authentication
        $mailer->Username = "termin@wconsults.ru";  // SMTP username
        $mailer->Password = "123456"; // SMTP passwordtest@termin.wconsults.ru
        $mailer->Port = 465;
        $mailer->SMTPSecure = 'ssl';

        $mailer->ClearAddresses();
        if (is_array($to)) {
            foreach ($to as $item) {
                $mailer->AddBCC($item);
            }

        } else {
            $mailer->AddBCC($to);
        }
        $mailer->Subject = Yii::t('mailer', $theme);
        $mailer->Body = Yii::app()->controller->renderPartial("/mailer/$view", array('request' => $model), true);
        $mailer->IsHTML(true);
        if (!$mailer->Send()) {
            return false;
            /*echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mailer->ErrorInfo;
            exit;*/
        }
        return true;
    }
    public static function sendSms($to, $message, $model){
        if(empty($to)){
            return false;
        }
        $url = "http://gateway.smstrade.de"; // URL of gateway
        $request = ""; // initialize variable request
        $param["key"] = "snJBDy2dcddb231eJUaMEKu"; // gateway key
        $param["to"] = $to; // recipient of SMS
        $param["message"] = $message; // content of message
        $param["route"] = "gold";// using gold route
        $param["from"] = "TERMIN";// sender of SMS
        $param["debug"] = "1";// SMS will not be sent - test modus

        foreach($param as $key=>$val) // run all parameters
        {
            $request.= $key."=".urlencode($val); // values need to be url-encoded
            $request.= "&"; // separate parameters with &
        }


        // SMS can be sent now
        $response = @file($url."?".$request); // submit request

        $response_code = intval($response[0]); // read response code
        return $response_code == 100;
        /*
        $response_code_arr[0] = "no connection with gateway";
        $response_code_arr[10] = "wrong recipient";
        $response_code_arr[20] = "sender ID too long";
        $response_code_arr[30] = "text message too long";
        $response_code_arr[31] = "incorrect text message format";
        $response_code_arr[40] = "wrong SMS type";
        $response_code_arr[50] = "login error";
        $response_code_arr[60] = "insufficent balance";
        $response_code_arr[70] = "network not supported by this route";
        $response_code_arr[71] = "feature not available through this route";
        $response_code_arr[80] = "SMS could not be sent";
        $response_code_arr[90] = "sending SMS not possible";
        $response_code_arr[100] = "SMS sent successfully.";*/
    }
}