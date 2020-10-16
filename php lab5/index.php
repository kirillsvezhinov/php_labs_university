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
        <input type="submit" value="Создать">
        </form> 
    </div>
    <?php

    $arrSize = intval($_POST['size']);
    $arrVal = $_POST['minmax'];
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
        echo "<br>";
        for ($i=0; $i < count($arr) ; $i++) { 
            for ($j=0; $j < count($arr) ; $j++) { 
                echo "<span>".$arr[$i][$j]."</span>";
            }
            echo '<br>';
        }
    }
    
    function editArray($arr,$arrSize){
        for ($i=0; $i < count($arr) ; $i++) { 
            for ($j=0; $j < count($arr) ; $j++) { 
               if($arr[$i][$j] % 3 === 0){
                   $arr[$i][$j] = 0;
               }
            }
        }
        echo "Заменить элемент равный трем каждого столбца: <br>";
        echoArr($arr);
        return $arr;
    }
    $arr = create_array($arrSize,$min,$max);
    echoArr($arr);
    editArray($arr,$arrSize);
    
    $arr = addFirstColumn($arr,$arrSize);
    findVals($arr);
    
    
    function addFirstColumn($arr,$arrSize){
        $transformArr = array();
        for ($i=0; $i < count($arr) ; $i++) { 
            array_push($transformArr, array_column($arr,$i));
            
        }
        $firstColumn = $transformArr[0];
        for ($i=2; $i <=count($transformArr); $i+=2) { 

            $first = array_slice($transformArr,0,$i);
            array_push($first,$firstColumn);
            $end = array_slice($transformArr,$i,count($transformArr));
            $outArr =  array_merge($first,$end);
            $transformArr = $outArr;
           
        }
        $transformArr = array_values($transformArr);
        echo "2ой пункт Вставить после каждого столбца 1ый столбец начиная со 2го<br>";
        echo "Первоначальная матрица <br>";
        untransform($transformArr);
        return $transformArr;
        
    }
    function findVals($arr){
        echo "3ый пункт удалить столбцы где хотябы один элемент кратен 5ти<br>";
         $main = $arr;
        for ($i=0; $i < count($arr); $i++) { 
            for ($j=0; $j < count($arr); $j++) { 
                if($arr[$i][$j] % 5 == 0 && $arr[$i][$j] != 0 ){
                    unset($main[$i]);
                    break;
                    echo "<br>";
                }
            }
        } 
        $main = array_values($main);
        $main = array_diff($main, array(''));
        if(count($main) === 0){
            echo "Все столбцы были удалены";
        }elseif(count($main) === 1){
            $test  = $main[0]; 
            for ($i=0; $i < count($main[0]) ; $i++) { 
               echo "<span>".$main[0][$i]."</span><br>";
           }
           
        }else{
            $columnArr = $main;
            array_unshift($main, null);  
            $main = call_user_func_array('array_map', $main);//  транспонирование матрицы в исходный вид 
              for ($i=0; $i < count($main); $i++) {            
                for ($j=0; $j < count($main[$i]); $j++) {
                    echo "<span>".$main[$i][$j]."</span>";
                }
                echo '<br>';
            }
            if(count($columnArr) > 3){
                swapOnecolumn($columnArr);  
            }else{
                echo "Не достаточного размера массив чтоб произвести замену 3его  и последнего столбца";
            }
           } 
    }
    function swapOnecolumn($arr){
        echo "4пункт Поменять местами 3ий и последний столбец";
        $transformArr = $arr;
        echo "3ий стоблец : ";
        for ($i=0; $i < count($arr[2]); $i++) { 
           echo " ".$arr[2][$i];
        }
        echo "Последний стоблец : ";
        $lastElem = array_pop($arr);
        for ($i=0; $i < count($lastElem) ; $i++) { 
            echo " ".$lastElem[$i];
        }
        echo '<br>';

        $thirdColumn = $transformArr[2];
        $lastColumn = $transformArr[count($transformArr)-1];



        // обрезание массива , вставка и склеивание
        $sortedArr = array();
            $first = array_slice($transformArr,0,2);
            $first = array_merge($first,$lastColumn);
            //print_r($first);
            $end = array_slice($transformArr,3);
            $end[count($end)] = $thirdColumn;
            $sortedArr = array_merge($first,$end);
           // print_r($end);

    

   
        unTransform($sortedArr);
             
    }
    function  unTransform($arr){ 
        // приведение матрицы в нормальное состояние
        $secondArr = array();
        for ($i=0; $i < count($arr) ; $i++) {
            if(count($arr[$i]) > 0){
                array_push($secondArr, array_column($arr,$i));
            } 
        }
        echoArr($secondArr);
    }
?>
    
</body>
</html>