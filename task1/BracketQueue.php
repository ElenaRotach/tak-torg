<?php

class BracketQueue
{
    const OPEN_TAGS = ['[','(','{'];
    const CLOSE_TAGS = [']',')','}'];

    public function IsCorrect(string $str)
    {

        if (!$this->validate($str)) {
            return false;
        }

        $length = strlen($str);
        $str_result = [];

        for ( $i = 0; $i < $length; $i++ ) {
            if ( in_array($str[$i], self::OPEN_TAGS) ) {
                array_push($str_result, $str[$i]);
            } else {
                if ( count($str_result) === 0 ){
                    // отсутствуют открывающие скобки
                    return false;
                }
                if ( array_search($str[$i], self::CLOSE_TAGS) !== array_search($str_result[count($str_result)-1], self::OPEN_TAGS) ) {
                    // тип закрывающей скобки не соответствует последней открывающей, следовательно строка некорректна
                    return false;
                } else {
                    array_pop($str_result);
                }
            }
        }

        if ( count($str_result) > 0 ) {
            // остались открывающие скобки
            return false;
        }
        return true;
    }

    private function validate($str)
    {
        if (empty($str)) {
            return false;
        }
        if ( !preg_match('#[\[\]\(\)\{\}]#i', $str) ) {
            return false;
        }
        if ( !in_array($str[0], self::OPEN_TAGS) || !in_array($str[strlen($str)-1], self::CLOSE_TAGS) ) {
            return false;
        }
        return true;
    }
}
