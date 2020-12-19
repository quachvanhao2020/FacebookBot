<?php

function tofloat($num) {
    $dotPos = strrpos($num, '.');
    $commaPos = strrpos($num, ',');
    $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
  
    if (!$sep) {
        return floatval(preg_replace("/[^0-9]/", "", $num));
    }

    return floatval(
        preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
        preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
    );
}

function un_humman_number($string){
    $ar = [
        "K" => 1000,
        "M" => 1000000,
    ];
    foreach ($ar as $key => $value) {
        if(strpos($string,$key)){
            $string = str_replace($key,"",$string);
            $float = tofloat($string);
            return $float*$value;
        }
    }
    return 0;
}

function to_int_count($data){
    if(is_int($data)) return $data;
    $result = 0;
    if(is_string($data)){
        $p = strpos($data," ");
        $data = substr($data,0,$p);
        $result = un_humman_number($data);
    }
    return $result;
}

var_dump(to_int_count("100,25K binh luan"));