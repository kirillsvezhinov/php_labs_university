<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include 'index.php';
    $emailErr = 0;
    $numberErr =0;
    $addresErr = 0;
    $genderErr =0;
    foreach ($errorsArr as $post => $arr) {   
        foreach ($arr as $key => $val) {
            //print_r($key);
            if($key == "email"){
                $emailErr++;
            }
            if($key =="number"){
                $numberErr++;
            }
            if($key == "addres"){
                $addresErr++;
            }
            if($key == "gender"){
                $genderErr++;
            }
        } 
    }
    $allErrors = $emailErr + $numberErr + $addresErr + $genderErr;
    echo "Всего ошибок найдено в файле $allErrors<br> <br> <br>";
    echo "Email $emailErr <br> Number $numberErr <br> Gender $genderErr <br> addres $addresErr <br>";
        foreach ($errorsArr as $post => $arr) {   
        echo "$post <br>";
        $counter = 0;
         foreach ($arr as $key => $val) {
            echo "$key <br>";
            $counter++;
        } 
        echo "Всего ошибок в поле $counter <br>";

    
    } 
    ?>
    
</body>
</html>