<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    div{
        margin:5px;
    }
    </style>
</head>
<body>
    <form method="POST">
        <div>название каталога<input name="dir" type="text"></div>
        <div>
            <select name="filter">
            <option value='delete'>удалить с указанием расшрения</option>
            <option value="sort">Отсоритровать с учетом даты</option>
            </select>
        </div>
        <div>Введите дату либо расширение<input name="subfilter" type="text" placeholder="год.месяц.день"></div>
       
       <div> <input type="submit" value="отправить"></div>
    </form>
    <?php

    $dir = $_POST['dir'];
    $filter = $_POST['filter'];
    $subfilter = $_POST['subfilter'];
    $path = getcwd();
    $path = "$path\\$dir";
    $direction = scandir($path,1);
    $files = array();

    if($filter == 'sort'){
        echo "указанная дата :$subfilter";
        $arr = preg_split('/\./',$subfilter);
        echo "<br>";
        foreach ($direction as $key => $file) {
            if($file == '.' || $file == '..'){
                continue;
            }
            $time = filectime("$path\\$file");
            if($time < mktime(0,0,0,$arr[1],$arr[0],$arr[2])){
                //echo $file."<br>";
                $info = pathinfo("$path\\$file");
                $files[$file] = $info[extension];
            }
            
        }
        asort($files);
        echoarr($files,'sorted');

    }
    
    if($filter == 'delete'){
        foreach ($direction as $key => $file) {
            if($file == '.' || $file == '..'){
                continue;
            }
            $info = pathinfo("$path\\$file");
            if($info[extension] != $subfilter){
              $files[$file] = $direction[$key];
            }else{
                unlink("$path\\$file");
            }
        }
        echoarr($files,'deleted');
    } 
    function echoArr($direction,$type){
        if($type ==='sorted'){
            foreach ($direction as $key => $file) {
                echo $key."<br>";
                
            }
        }else{
            foreach ($direction as $key => $file) {
                echo $file."<br>";
                
            }
        }
       
    }
?>
</body>
</html>