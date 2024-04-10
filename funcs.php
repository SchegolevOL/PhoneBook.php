<?php

function debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function add($phoneBook){
    $phone=!empty($_POST['phone'])?trim($_POST['phone']):'';
    $name=!empty($_POST['name'])?trim($_POST['name']):'';
    array_push($phoneBook, [$name,$phone]);
    file_put_contents('phone.json', json_encode($phoneBook, JSON_FORCE_OBJECT));

    return $phoneBook;
}