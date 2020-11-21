<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    //include 'index.php';

    $outputArr = file('newBase.txt');
    $maleArr = array();
    $femaleArr = array();
    $maleweight = 0;
    $femaleweight =0;
    $malegrowth=0;
    $femalegrowth=0;
    $femaleYear = 0;
    $maleYear = 0;


   // $firstPost = time();
    $firstDate = time();
    $yangDate = -100000000000000000000000000000;
    $oldpeople = "";
    $yangpeople = "";


    $serverArr=[];
    $domainArr = array('dodgit.com','mailinator.com','pookmail.com','spambob.com','trashymail.com');
    $analitickArr = [];


    $holydays = array('01.01','07.01','14.02','23.02','08.03','01.05','31.12');
    $holydaysPeoples = [];
    foreach ($outputArr as $key => $post) {
        $arr = preg_split("/;/",$post);
        $birth = preg_split("/\./",$arr[9]);
         if($firstDate > mktime(0,0,0,$birth[1],$birth[0],$birth[2])){
            $firstDate = mktime(0,0,0,$birth[1],$birth[0],$birth[2]);
            $oldpeople = $post;
        }
        if($yangDate < mktime(0,0,0,$birth[1],$birth[0],$birth[2])){
            $yangDate = mktime(0,0,0,$birth[1],$birth[0],$birth[2]);
            $yangpeople = $post;
        }

        $serverArr[$arr[15]] = 0;

        foreach ($holydays as $key => $holyday) {
      
            if(strpos($arr[9],$holyday) === false){
                continue;
            }else{
                $holydaysPeoples[$post] = $holyday;
               //array_push($holydaysPeoples[$key],$post);

                //echo "$arr[9] asdasd <br>";
            }
        }
        foreach ($domainArr as $key => $damain) {
            if(strpos($arr[7],$damain) != 0){
                $analitickArr[$damain] = $analitickArr[$damain]+1;
            }
        }


        if($arr[4] == 1){
            array_push($maleArr,$post);
            $maleweight = $maleweight + $arr[12];
            $malegrowth = $malegrowth + $arr[13];
            
            $birthDay = preg_split("/\./",$arr[9]);
            $year = 2020 - $birthDay[2];
            $maleYear = $maleYear + $year;
        }else{
            array_push($femaleArr,$post);
            $femaleweight = $femaleweight + $arr[12];
            $femalegrowth = $femalegrowth + $arr[13];
            $year = 2020 - $birthDay[2];
            $femaleYear = $femaleYear + $year;
        }
    }
    //$serversArr = [];
    foreach ($outputArr as $key => $post) {
        $arr = preg_split("/;/",$post);
        foreach ($serverArr as $key => $index) {
            if($key = $arr[15]){
                $serverArr[$key] = $serverArr[$key] + 1;
            break;
            }
        }
    }
    
    echo "Количество мужчин".count($maleArr)."<br> Средний вес мужчин".round($maleweight/count($maleArr))."<br> Средний рост мужчин".round($malegrowth/count($maleArr))."<br> Средний возраст мужчин".round($maleYear/count($maleArr));
    
    echo "<br> Количество женщин".count($femaleArr)."<br> Средний вес женщин".round($femaleweight/count($femaleArr))."<br> Средний рост женщин".round($femalegrowth/count($femaleArr))."<br> Средний возраст женщин".round($femaleYear/count($femaleArr));
    

    
    function group($group,$type,$num){
        $maleweight = round($type/count($group));
        $counterMin = 0;
        $counterMax = 0;
        $counterSouSou = 0;
        foreach ($group as $key => $post) {
            $arr = preg_split("/;/",$post);
            if($arr[$num] < $maleweight){
                $counterMin++;
            }
            if($arr[$num] == $maleweight){
                $counterMax++;
            }
            if($arr[$num] > $maleweight){
                $counterSouSou++;
            }
        }
        $arr = [$counterMin,$counterSouSou,$counterMax];
        return $arr; 
    }
    function findYear($group,$type){
        $midYear = round($type/count($group));
        $growthMin = 0;
        $growthMid = 0;
        $growthMax = 0;
        foreach ($group as $key => $val) {
            //echo $post;
            $post = preg_split("/;/",$val);
            $birthDay = preg_split("/\./",$post[9]);
            $year = 2020 - $birthDay[2];
            if($year < $midYear){
                $growthMin++;
                
            }
            if($year == $midYear){
                $growthMid++;
            }
            if($year > $midYear){
                $growthMax++;
                //echo "$year <br>";
            }
        }
        $arr = [$growthMin,$growthMid,$growthMax];
        return $arr;
    }
    $maleweightArr = group($maleArr,$maleweight,12);
    $femaleweightArr = group($femaleArr,$femaleweight,12);
    $malegrowthArr = group($maleArr,$malegrowth,13);
    $femalegrowthArr = group($femaleArr,$femalegrowth,13);

    $maleageArr = findYear($maleArr,$maleYear);
    $femaleageArr = findYear($femaleArr,$femaleYear);
    ?>
      <form method="GET" action="getregion.php">
        <input type="text" name="region" placeholder/> Введите область
        <input type="submit" value="вывести"/>
    </form>

    <?php 
    


    echo "<h4>Вес</h4> <br>";
    echo "<br> Мужчины имеющие  вес ниже среднего $maleweightArr[0]   <br>";
    echo "<br> Мужчины имеющие  вес  средний $maleweightArr[1]   <br>";
    echo "<br> Мужчины имеющие  вес выше среднего $maleweightArr[2]  <br>";
    echo "<br> Женщины имеющие  вес ниже среднего $femaleweightArr[0]   <br>";
    echo "<br> Женщины имеющие  вес  средний $femaleweightArr[1]   <br>";
    echo "<br> Женщины имеющие  вес выше среднего $femaleweightArr[2]  <br>";
    echo "<h4>Рост</h4> <br>";
    echo "<br> Мужчины имеющие  рост ниже среднего $malegrowthArr[0]   <br>";
    echo "<br> Мужчины имеющие  рост  средний $malegrowthArr[1]   <br>";
    echo "<br> Мужчины имеющие  рост выше среднего $malegrowthArr[2]  <br>";
    echo "<br> Женщины имеющие  рост ниже среднего $femalegrowthArr[0]   <br>";
    echo "<br> Женщины имеющие  рост  средний $femalegrowthArr[1]   <br>";
    echo "<br> Женщины имеющие  рост выше среднего $femalegrowthArr[2]  <br>";
 
    echo "<h4>Возраст</h4> <br>";
    echo "<br> Мужчины имеющие  возраст ниже среднего $maleageArr[0]   <br>";
    echo "<br> Мужчины имеющие  возраст  средний $maleageArr[1]   <br>";
    echo "<br> Мужчины имеющие  возраст выше среднего $maleageArr[2]  <br>";
    echo "<br> Женщины имеющие  возраст ниже среднего $femaleageArr[0]   <br>";
    echo "<br> Женщины имеющие  возраст  средний $femaleageArr[1]   <br>";
    echo "<br> Женщины имеющие  возраст выше среднего $femaleageArr[2]  <br>"; 
    echo "<h4>Самый пожилой человек</h4> <br>";
    echo "<div>$oldpeople</div>";
    echo "<h4>Самый молодой человек</h4>";
    echo "<div>$yangpeople</div>";
    ?>
  

    <?php 

    
    echo "<h4>Аналитика по почтовым доменам</h4> <br>";
    foreach ($analitickArr as $key => $value) {
        echo "$key : $value <br>";
    }
    asort($holydaysPeoples);
    echo "<h4>Люди родившиеся в праздники</h4> <br>";
foreach ($holydays as $key => $value) {
    echo "<h4>$value</h4>";
    foreach ($holydaysPeoples as $key => $people) {
        if($value == $people){
            //echo "$key";
            $name = preg_split("/;/",$key);
            echo "$name[1] $name[2] $name[3] <br>";
        }
    }
}

    
    
    ?>
    
    
    
</body>
</html>