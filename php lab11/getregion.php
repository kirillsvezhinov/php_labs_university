<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $outputArr = file('newBase.txt');
    $region = $_GET['region'];
    $regionArr = [];
    $peoples = [];
     foreach ($outputArr as $key => $post) {
        $arr = preg_split("/;/",$post);
        if($region == $arr[6]){
            array_push($regionArr,$post);
        } 
    }
    foreach ($regionArr as $key => $post) {
       $newPost = filterPost($post,$peoples);
       $peoples[$newPost[0]] = $newPost[1];
    }
    function filterPost($post,$peoples){
        $arr = preg_split("/;/",$post);
        $serName = "";
        if($arr[4] == 1){
            $arr[1] = "<span style=color:blue;>$arr[1]</span>";
            $arr[2] = "<span style=color:blue;>$arr[2]</span>";
            $serName = $arr[3];
            $arr[3] = "<span style=color:blue;>$arr[3]</span>";
        }
        if($arr[4] == 0){
                $arr[1] = "<span style=color:red;>$arr[1]</span>";
                $arr[2] = "<span style=color:red;>$arr[2]</span>";
                $serName = $arr[3];
                $arr[3] = "<span style=color:red;>$arr[3]</span>";
        }
        $birthDay = preg_split("/\./",$arr[9]);
        $year = 2020 - $birthDay[2];
        $arr[9] = "<span style=font-size:20px;>$year</span> ";
        $arr[14] = "<br> POST ADRES $arr[14]";
        $newPost = "$arr[1] $arr[2] $arr[3] $arr[9] $arr[14]";
        return [$serName,$newPost];
    }
    ksort($peoples,SORT_STRING);
      foreach ($peoples as $key => $post) {
        echo "$post <br>";
    }  
    ?>
    
</body>
</html>