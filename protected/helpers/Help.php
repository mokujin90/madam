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

    /**
     * dd/mm/YYYY -> YYYY-mm-dd
     */
    public static function formatDate($date)
    {
        $dateExp = explode('/', $date);
        return $dateExp[2] . '-' . $dateExp[1] . '-' . $dateExp[0];
    }
}