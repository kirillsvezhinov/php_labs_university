<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        span{
            display:inline-block;
            width:30px;
            height:30px;
            text-align:center;
    }
    </style>
</head>
<body>
    <h1>создание массива</h1>
    <div>
        <form  method="POST">
        Введите размер массива: <input type="text" name="size" /><br><br>
        Введите диапозон значений: <input type="text" name="minmax" placeholder='min max' /><br><br>
        Введите p1 и p2 <input type="text" name="range" placeholder='p1 p2' /><br><br>
        <input type="submit" value="Создать">
        </form> 
    </div>
    <?php

    $arrSize = intval($_POST['size']);
    $arrVal = $_POST['minmax'];
    $range = $_POST['range'];
    $rangeVal = preg_split('/ /',$range);
    $arrVal = preg_split('/ /',$arrVal);
    $min = intval($arrVal[0]);
    $max = intval($arrVal[1]);
    function create_array($size,$min,$max) {
        $arr = array();
        for ($i = 0; $i < $size; $i++){
            for ($j = 0; $j < $size; $j++){
                $arr[$i][$j] = rand($min,$max);
            }
        }
        
        return $arr;
    }
    function echoArr($arr){
        for ($i=0; $i < count($arr) ; $i++) { 
            for ($j=0; $j < count($arr) ; $j++) { 
                echo "<span>".$arr[$i][$j]."</span>";
            }
            echo '<br>';
        }
    }
    
    function hideVals($arr,$min,$max){
        $counter = 0;
        for ($i=0; $i < count($arr) ; $i++) { 
            for ($j=0; $j < count($arr) ; $j++) { 
                if($arr[$i][$j] >= $min && $arr[$i][$j] <= $max){
                    $counter++;
                    //echo "({$i},{$j})";
                   echo " ".$arr[$i][$j];
                }
            }   
        }
        echo "<br> Количество элементов удовлетворяющие условие ".$counter;
    }
    $arr = create_array($arrSize,$min,$max);
    echoArr($arr);
    echo "p1 =".$rangeVal[0]."<br> p2 =$rangeVal[1]<br>";
    echo "элементы матрицы удовлетворяющие условие p1<= arr[i][j] <= p2 <br>";
    hideVals($arr,$rangeVal[0],$rangeVal[1]);
    
    ?>
    
</body>
</html>