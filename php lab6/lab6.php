<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
    input{
        width:300px;
        height:40px;
    }
</style>
</head>
<body>

</div>
<div style="width:300px; margin:0 auto;">
<h3>Предлоежние</h3>
<form  method="POST">
    Введите предложение: <input type="text" name="words" placeholder='' /><br><br>
    <input type="submit" value="Отправить">
</form>
</div>
<?php 

    $words =$_POST['words'];
    echo "Исходное предлоежние ${words} <br>";
    $wordsArr = trim($words);
    $wordsArr = preg_split('/ /',$wordsArr);
    $wordsArr = array_diff($wordsArr, array('')); //удалить пустые элементы

  /*   $lastWord = $wordsArr[count($wordsArr)-1];
    $lastWord = substr($lastWord,0,-1);
    $wordsArr[count($wordsArr)-1] = $lastWord; // удалить точку */
    $deletedElem = array_pop($wordsArr);
    unset($deletedElem);
    
    for ($i=0; $i < count($wordsArr)-1; $i++) {   // сравнение с последним словом
        if($wordsArr[$i] == $wordsArr[count($wordsArr)-1]){
            unset($wordsArr[$i]);
        }
    }
    $wordsArr = array_diff($wordsArr, array('')); //удалить пустые элементы
    $wordsArr = array_values($wordsArr); // переиндексация
    
    
    function findSameChar($word){
        $prevWord = $word;
        $chars = array();
        for ($i = 0; $i < mb_strlen($prevWord); $i++ ) {
            $chars[] = mb_substr($prevWord, $i, 1); // 
        }
       // print_r($chars);
        $editWord = array_unique($chars); // удаление одинаковых элемментов       
        $editWord = implode($editWord);  // джоин строки
        //print_r($editWord);
        

        if($prevWord != $editWord){
            return  true;
        }else{
            
            return false;
        }
    }

    for ($i=0; $i < count($wordsArr) ; $i++) { 
        if(findSameChar($wordsArr[$i]) == true){
            unset($wordsArr[$i]);
        }
    }
    $wordsArr = array_diff($wordsArr, array('')); //удалить пустые элементы
    $wordsArr = array_values($wordsArr); // переиндексация
    echo "конечное предложение с учетом что удалились слова с одинаковыми буквами и так же произведено сравнение с слов с последним <br>";
    foreach ($wordsArr as  $value) {
        echo " ".${value};
    }
    


?>

</body>
</html>