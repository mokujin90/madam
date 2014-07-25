<?php

class Help{

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
}