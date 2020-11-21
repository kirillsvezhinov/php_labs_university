<?php
function writeStats($type,$numphoto){
            
    $json = file_get_contents('counter.json');
    $obj = json_decode($json,true);
    $num = $numphoto-1;
        $first =  $obj['banners'][$num]['showing'];
        $second = $obj['banners'][$num]['opendetails'];
        $third = $obj['banners'][$num]['registration'];
        $four = $obj['banners'][$num]['like'];
        
        $obj['banners'][$num]['CTR'] = number_format($second/$first,2,'.',''); // переход по сслыке к показам
        $obj['banners'][$num]['CTI'] = number_format($four/$second,2,'.',''); // лайки к открытым ссылкам
        $obj['banners'][$num]['CTB'] = number_format($third/$first,2,'.','');  // кнопка купить к показам

    

    $obj['banners'][$num][$type] = $obj['banners'][$num][$type]+1;

    $obj = json_encode($obj);
    $file = fopen('counter.json','w+');
    fwrite($file, $obj);
    fclose($file);  



return $obj;
}
?>