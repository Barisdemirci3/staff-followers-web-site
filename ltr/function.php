<?php
function post($post)
{
    return trim($_POST[$post]);
}
function medeni($data)
{
    switch ($data) {
        case '0':
            return "Evli";
            break;

        case '1':
            return "Bekar";
            break;

        case '2':
            return "Boşanmış";
            break;
            default:
            return "Böyle bir veri yok!";
            break;
    }
}
function kisalt($metin){
    if(strlen($metin)>25){
        $metin = substr($metin,0,25)."...";
        return $metin;  
    }
    else{
        return $metin;
    }
}
function justtwo($metin){
    return substr($metin, 0,2);
}
function getcheck($data){
    if(!is_numeric($data)){
        return "Gelen veri sayısal bir veri değil!";
}
else{
    $data = htmlspecialchars(trim($data));
    return $data;
}
}