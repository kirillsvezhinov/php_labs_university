<?php 

$json = file_get_contents('showing.json');
    $obj = json_decode($json,true);
    $numPost = $_SERVER[PHP_SELF];


    $numPost = substr($numPost,5);
    $numPost = substr($numPost,0,-4);
    $numPost = intval($numPost)-1;       // номер страницы


    $obj['pages'][$numPost]['show'] = $obj['pages'][$numPost]['show'] +1; //счетчик показа статьи
    writeTags($obj['pages'][$numPost]['keywords']); // запись клика с тегами
    $obj = json_encode($obj);
    $file = fopen('showing.json','w+');
    fwrite($file, $obj);
    fclose($file);    

    function writeTags($arr){
        $secondjson = file_get_contents('tags.json');
        $tagsArr = json_decode($secondjson,true);
        foreach ($arr as $key => $value) {
            $tagsArr[$arr[$key]] = $tagsArr[$arr[$key]]+1;
        }
        $tagsArr = json_encode($tagsArr);
        $file = fopen('tags.json','w+');
        fwrite($file, $tagsArr);
        fclose($file);  
    }
?>