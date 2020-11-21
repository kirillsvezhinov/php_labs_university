<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div{
            width:600px;
            margin:0 auto;
        }
        button{
            display:block;
            width:300px;
            margin:0 auto;
        }
        #hiiden{
            display:none;
        }
    </style>
</head>
<body>

<?php 
    include 'writeStats.php';
    
 
    ?>
    <?php 
    $fileID = file_get_contents('banner.txt');
    $fileName = "Текст0${fileID}.txt";
    $arr = file($fileName);


    writeStats('opendetails',$fileID); 
    ?>
    <a href="/">back</a>
    <form method="POST">
        <input type='text'  id='hiiden' name="isset">
        <input type="submit" id="btn" name="write" value="Купить ...">
    </form>
    <form method="POST">
        <input type='text'  id='hiiden' name="likes">
        <input type="submit"  name="like" value="понравилось ...">
    </form>
    <div>
        <?php 
        foreach ($arr as $key => $value) {
            echo "<br> $arr[$key] <br>";
        } 
        ?>
    </div>
    
    
    <?php
    //print_r($_POST);
     if(isset($_POST['isset'])){
        writeStats('registration',$fileID);
    }
    if(isset($_POST['likes'])){
        writeStats('like',$fileID);
    }
    
    
?>
</body>
</html>