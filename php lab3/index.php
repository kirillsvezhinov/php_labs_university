<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>создание массива</h1>
    <div>
        <form  method="POST">
        Введите размер массива: <input type="text" name="size" /><br><br>
        Введите диапозон значений: <input type="text" name="minmax" placeholder='min max' /><br><br>
        Введите доп диапозон <input type="text" name="range" placeholder='x x' /><br><br>
        <input type="submit" value="Создать">
        </form> 
    </div>
    <?php
    error_reporting(E_ALL &  E_STRICT);

    $arrSize = $_POST['size'];
    $arrVal = $_POST['minmax'];
    $arrRange = $_POST['range'];

    function findMaxVal($arr){
        $maxVal = 0;
        for ($i=0; $i < count($arr); $i++) { 
            if(abs($arr[$i]) > $maxVal){
                $maxVal = $i;
            }
        }
        echo "<br>Индекс максимального по мудолю элемента равен       ".$maxVal;
    };

    function echoArr($arr){

        foreach ($arr as $elem) {
            echo "$elem.<br />";
        }
    }

    function findFirstElem($arr){
        $index = 0;
        $sum = 0;
        for ($i=0; $i < count($arr); $i++) {
            if($arr[$i] > 0){
                $index = $i;
                break;      
            } 
        }

        for ($i=$index; $i < count($arr); $i++) { 
            $sum+=$arr[$i];
        }
        echo '<br> Сумма элементов после первого положительного равна    '.$sum;
    }; 

    function sortArr($arr, $arrRange){
        echo "<br> Заданный диапозон :".$arrRange[0]."-".$arrRange[1];
        
        $arrRange = range($arrRange[0],$arrRange[1]);

         $sortArr = array();
        for ($i=0; $i < count($arr); $i++) { 
            if(in_array($arr[$i], $arrRange)){
                array_push($sortArr, $arr[$i]);
                unset($arr[$i]);



            }
        };

        $sortArr = array_merge($sortArr,$arr);
        
       echo "<br>Отсоритированный массив по диапозону <br>";
       echoArr($sortArr);
        //print_r($sortArr); 
    }

    $arrSize = intval($arrSize);
    $arrVal = preg_split('/ /',$arrVal);
    $min = intval($arrVal[0]);
    $max = intval($arrVal[1]);

    $arrRange = preg_split('/ /',$arrRange);
    

    $arr = array();
    for ($i=0; $i <= $arrSize ; $i++) { 
        $randomizeVal = rand($min, $max);
        array_push($arr, $randomizeVal);
    }



    echoArr($arr);

    findMaxVal($arr);

    findFirstElem($arr);
   
    sortArr($arr,$arrRange);

    ?>
    
</body>
</html>