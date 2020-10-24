<?php 


$file = fopen('output.txt', w) or die("не удалось открыть файл");
$str = file_get_contents("input.txt");
echo "Исходное предложение<br> {$str} ";
$wordsArr = preg_split("/[\s]+/",$str);
//print_r($wordsArr);

 $pattern = '/а|о|у|э|ы|я|ё|ю|е|и|А|О|У|Э|Ы|Я|Ё|Ю|Е/';
     for ($i=0; $i <count($wordsArr); $i++) { 
        preg_match_all($pattern,$wordsArr[$i],$matches);
       if(count($matches[0]) > 1){
            $old = $matches[0];
            $new = array_unique($matches[0]);
            if($old !== $new){
                $wordsArr[$i] = checkRegistr($wordsArr[$i]);
            }
       }
    } 
    function checkRegistr($word){
        if(mb_strtolower($word) !== $word) {
            return mb_strtolower($word);
       }else{
           return mb_strtoupper($word);
       } 
    }


    $wordsStr = implode(" ",$wordsArr);
    echo "<br>Заменить регистр в словах где более двух одинаковых гласных. <br>Отредактированное предлоежние: <br>$wordsStr";
    
    fwrite($file,$wordsStr);
    
?>