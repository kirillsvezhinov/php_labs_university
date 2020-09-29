<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</div>
<div style="width:300px; margin:0 auto;">
<h3>Введите снилс</h3>
<form  method="POST">
    Снилс: <input type="text" name="snils" placeholder='XXX-XXX-XXX XX' /><br><br>
    <input type="submit" value="Отправить">
</form>
</div>
<?php


function sumElems($arrNums){
    $last = count($arrNums);
    $res = 0;
    for ($i=0; $i <count($arrNums); $i++){ 
        $res+=$arrNums[$i]*$last;
        $last-=1;
        } 
 return $res; 
}

$snils = NULL;
$deletecharcters = array("-"," ");
if(isset($_POST['snils'])){
    $snils=$_POST['snils'];
}
$valide = str_replace($deletecharcters,"",$snils);
if(strlen($valide) === 11){
    $arr = preg_split('/ /',$snils);
    $firstarr = preg_split('/-/',$arr[0]);
    $arrNums = str_split(implode($firstarr));
    
    $sum = sumElems($arrNums);
    switch ($sum) {
        case ($sum<100):

            if($sum == $arr[1]){
                print('Снилс введен верно');
            }else{
                print('Снилс введен  не верно');
            }
        break;
        case ($sum === 100 || $sum === 101):

            if($arr[1] === "00"){
                print('Снилс введен верно');
            }else{
                print('Снилс введен не верно');
            }break;
        case ($sum > 101):
            $sum = $sum%101;
            if($sum == $arr[1]){
                print('Снилс введен верно');
            }else{
                print('Снилс введен не верно');
            }break;
    }
}else{
    print('Введите правильно снилс');
}
?>

</body>
</html>