<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php 

//static $id = 0;

$firstName = $_POST['firstname'];
$secondName = $_POST['secname'];
$thirdName = $_POST['thirdname'];
$birthDay = $_POST['birhtday'];

$birthDay = preg_split("/-/",$birthDay);
$birthDay = 2020-intval($birthDay[0]);


print_r($_POST);
$link = @mysqli_connect("localhost","root","","phplab");
if(!$link) die ("что то пошло не так");


$query = "INSERT INTO `users`(`Фамилия`, `Имя`, `Отчество`, `Возраст`) VALUES ('$secondName','$firstName','$thirdName',$birthDay)";

//$id = "SELECT * FROM your_table ORDER BY ID DESC LIMIT 1;";
//echo "ID $id";
$result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
if($result){
    //$id++;
    echo "<h2>Данные успешно записаны</h2>";
}


mysqli_close($link); 


?>
<form action="read.php" method="GET">
    <select name="type">
    <option value="ABS">В алфавитном порядке по фамилии</option>
    <option value="AGE">Сортировка по возрасту</option>
    </select>
    <input type="submit" value="вывести значения"/>
</form>

</body>
</html>