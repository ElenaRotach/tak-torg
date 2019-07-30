<?php
private function build(int $rows_count, string $simbol)
    {
        if ( $rows_count < 0 || empty($simbol) || strlen($simbol) > 1 ){
            throw new Exception('Некорректные параметры');
        }
        $result = [];
        for ( $i = 0; $i < $rows_count; $i++) {
            $result[] = str_repeat(' ', $rows_count - $i) . str_repeat($simbol, $i*2+1) . str_repeat(' ', $rows_count - $i);
        }
        return $result;
    }
