<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        span{
            display:block;
            width:700px;
            margin:0 auto;
            font-weight:700;
           
            margin-bottom:30px;
            margin-top:30px;
        }
        div{
            width:600px;
            margin:0 auto;
        }
    </style>
</head>
<body>
    <form method='POST'>
        <div>
        <select name="type" id="">
            <option value="sport">Спорт</option>
            <option value="tech" >Технологии</option>
        </select>
        </div>
        <div>
            Введите число<input type="text" name="date" placeholder="xxxx xx xx">
        </div>
        <div>
            <input type="submit" value="Найти статьи">
        </div>
    </form>

    <?php 
        $category = $_POST['type'];
        $date = $_POST['date'];
        echo "<span>Дата  ${date}</span>";
        $date = str_replace(' ', '', $date);
        $path = getcwd();
        $path = $path."\\".$date;
        $titles = array();

        if (is_dir($path)) {
           
            if ($dh = opendir($path)) {
                while (($file = readdir($dh)) !== false) {
                    if(preg_match("/${category}/",$file) === 1){
                        $article = fopen($path."\\".$file,r) or die ("не удалось открыть файл");
                        $title = fgets($article);
                        $titles["$title"] = file_get_contents($path."\\".$file,r); 
                    }   
                }
                closedir($dh);
            }
        }else{
            echo "Найдено 0 статей";
        }
        ksort($titles,SORT_STRING);
        echoArr($titles);
        function echoArr($arr){
            foreach ($arr as $key => $value) {
                echo "<span>".$key."</span><div>".$arr[$key]."</div>";
            }
        }
    ?>
    
</body>
</html>