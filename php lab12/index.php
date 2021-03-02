<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="write.php" method="POST">
    <div>
        Имя<input name="firstname" type="text"/>
    </div>
    <div>
    Фамилия <input name="secname" type="text" />
    </div>
        <div>
        Отчество<input name="thirdname" type="text"/>
    </div>
    <div>
        Год рождения<input  name="birhtday"type="date"/>
    </div>
    <div>
    <input type="submit" value="отправить"/>
    </div>
</form>
<?php

    
?>  
</body>
</html>