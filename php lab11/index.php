<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $fileName = 'OLDBASE.TXT';
    $file = file($fileName);
    $errorsArr = array();
    $outputArr = array();
    foreach ($file as $key => $post) {
        $arr = preg_split("/,/",$post);
       if(count($arr) != '17'){
        continue;
        }  
        $newPost = validatePost($post,$errorsArr);
      array_push($outputArr,$newPost);
    
    }
    $outputArr = array_values($outputArr);
   $outputArr = reWriterFile($outputArr);

    function writeNewFile($outputArr){
        $doc = fopen('newBase.txt',"w+");
        //fwrite($outputArr);
        foreach ($outputArr as $key => $value) {
            fwrite($doc,$value);
        }
        fclose($doc);
    }
    writeNewFile($outputArr);

    function reWriterFile($arr){
        foreach ($arr as $key => $post) {
            $arr[$key] = reWriter($post);
           // $arr[$key] = reWriteGender($post);
        }

        return $arr;
    }
    function reWriter(&$post){
        $arr = preg_split("/;/",$post);
        
        foreach ($arr as $key => $value) {
            switch ($key) {
                case '0':
                    $num = $arr[0];
                    $numarr = str_split($num);
                    while(count($numarr) != 6){
                        array_unshift($numarr,0);
                    }
                    $numarr = implode("",$numarr);
                    $arr[0] = $numarr;
                   
                break;
                case '4': 
                    if($arr[4] == "male"){
                        $arr[4] = 1;
                    }
                    if($arr[4]== 'female'){
                        $arr[4] = 0;
                    }  
                case '8':
                    $arrNums = preg_split("//",$arr[8]);
                    //echo $arr[8];
                    $newNum = array_diff($arrNums, array('-'));
                    $newNum = array_values($newNum);
                    //echo "<br>";
                    if(count($newNum) == 12){
                        $first = array_slice($newNum,0,4);
                        array_push($first,"-");
                        $second = array_slice($newNum,4,3);
                        array_push($second,"-");
                        $third = array_slice($newNum,7);
                        $arrNums = array_merge($first,$second,$third);
                        
                    }
                     if(count($newNum) == 11){
                        $first = array_slice($newNum,0,3);
                        array_push($first,"-");
                        $second = array_slice($newNum,3,3);
                        array_push($second,"-");
                        $third = array_slice($newNum,6);
                        $arrNums = array_merge($first,$second,$third);
                    } 
                    if(count($newNum) == 10){
                       $first = array_slice($newNum,0,2);
                       array_push($first,"-");
                       $second = array_slice($newNum,2,3);
                       array_push($second,"-");
                       $third = array_slice($newNum,5);
                       $arrNums = array_merge($first,$second,$third);

                    }
                    $arr[8] = implode("",$arrNums);
                break;
                case '9':
                    $birthDay = preg_split("/\//",$arr[9]);
                    foreach ($birthDay as $key => $value) {
                        if($value[0] != '0'){
                            if($value / 10 < 1){
                
                                $birthDay[$key] = "0$value";
                            }
                        }
                        
                    }
                    $day = array_shift($birthDay);
                    $year = array_pop($birthDay);
                    array_push($birthDay,$day,$year);
                    $birthDay = implode(".",$birthDay);
                    $arr[9] = $birthDay;
                break;
                case '12':
                    $arr[12] = round($arr[12]);
                break;
                case '14':
                    $addres = preg_split("/ /",$arr[14]);
                    //print_r($addres);
                    //echo "<br>";
                    $houseNum = array_shift($addres);
                    $addres[count($addres)-1] = $addres[count($addres)-1].",";
                    //echo $houseNum[count($houseNum)-1];
                    array_push($addres,$houseNum);
                    //print_r($addres);
                    //echo "<br>";
                    $addres = implode(" ",$addres);
                    $arr[14] = $addres;
                   // echo "$addres <br>";
                break;
                default:
                    # code...
                    break;
            }
        }
        
        $newPost = implode(";",$arr);
     return $newPost;
    }

    function validatePost(&$post,&$errorsArr){
        $arr = preg_split("/,/",$post);
        //print_r($arr);
        foreach ($arr as $key => $value) {
            switch ($key) {
                case '7':
                    
                    //echo "cheked $value <br>";
                    if(filter_var($value, FILTER_VALIDATE_EMAIL) == false){
                        //if (preg_match("/^([aA-zZ]*)@([aA-zZ]*\.[a-z]*)/", $value) == false){
                        $errorsArr[$post]['email']['val'] = $value;
                        $errorsArr[$post]['email']['count'] = $errorsArr[$post]['email']['count'] +1;
                        $value = str_replace('@@',"@",$value);
                        if(filter_var($value, FILTER_VALIDATE_EMAIL) == true){
                            $arr[$key] = $value;

                        }else{
                            $domainArr = array('dodgit.com','mailinator.com','pookmail.com','spambob.com','trashymail.com');

                            foreach ($domainArr as $key => $damain) {
                                if(strpos($value,$damain) != 0 ){
                                    $pos = strpos($value,$damain);
                                    $str = substr($value,0,$pos);
                                    $str = "$str@$damain";
                                    $arr[7] = $str;
                                    break;
                                }
                            }
                        }
                    }        
                    
                    break;
                case '4':
                    if(preg_match("/female|male/",$value) == false){
                        $errorsArr[$post]['gender']['val'] = $value;
                        $errorsArr[$post]['gender']['count'] = $errorsArr[$post]['gender']['count'] +1;
                        return "";
                    }
                break;
                case '8': 
                    if(preg_match("/^\d{2,3}-\d{2,3}-\d{4}/",$value) == false){
                      
                        $errorsArr[$post]['number']['val'] = $value;
                        $errorsArr[$post]['number']['count'] = $errorsArr[$post]['number']['count'] + 1;
                        $number = preg_split("//",$value);
                        foreach ($number as $key => $char) {
                            if(preg_match("/\D/",$char) && $char !='-'){
                                $number[$key] = "";
                                continue;
                            }
                        }
                        
                        $number = array_values($number);
                        $number = implode("",$number);
                        $arr[8] = $number;
                    }
                break;
                case '14':
                    if(preg_match("/^\d+ [A-Za-z]/",$value) == false){
                        
                        $errorsArr[$post]['addres']['val'] = $value;
                        $errorsArr[$post]['addres']['count'] = $errorsArr[$post]['addres']['count'] + 1;
                        $addres = preg_split("//",$value);
                        foreach ($addres as $key => $char) {
                            if(preg_match("/[^A-Za-z0-9]/",$char) && $char !=' ' ){
                                $addres[$key] = "";
                            }
                        }
                        $addres = array_values($addres);
                        $addres = implode("",$addres);
                        $arr[14] = $addres;
                    }else{
                        //echo "$value <br>";
                    }
                break;
                
                default:
                    break;
            }
            
        }
        $newPost = implode(";",$arr);
        return $newPost;
    }

?>
    
</body>
</html>