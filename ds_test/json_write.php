<?php

    $arr = array();
    $arr['name'] = '杨润洲';
    $arr['birth_place'] = 'Liuyanghe';
    $arr['age'] = 23;
    
    $acc = array();
    $acc['secondary_school'] = 'LYH';
    $acc['high_school'] = 'LYHYZ';
    $acc['university'] = 'NUAA';
    shuffle($acc);//将数组随机打乱排序，同时会删除非索引键名
    
    array_push($arr, $acc);
    
    $data_divided=json_encode($arr);
    header('Content-Type: application/json');
    print($arr);

?>