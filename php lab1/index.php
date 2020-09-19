<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
        <h2>Введите размерность таблицы</h2>
    <div class="form">
        <form  method="POST">
            <input type="text" name="rows">
            <input type="text" name="columns" >
            <input type="submit" value="создать таблицу">
        </form>
    </div>
    <?php
    $rows = $_POST['rows'];
    $cols = $_POST['columns'];
    $square = false;
    if($rows == $cols){
        $square = true;
    }
    $squareClass = '';
  
    echo "<table class='tbl'>";
    for ($tr =1; $tr <= $rows; $tr ++)
    {
    echo "<tr>"; 
      if(($tr == '1')){ 
           $class = 'yellow'; 
        } 
            for($td =1;$td <=$cols; $td++)
            {
                if(($td * $tr) % 2 == 0 && ($tr != '1')){
                    $class = 'green';
                }
                if(($td * $tr) % 2 != 0 && ($tr != '1')){
                    $class = 'blue';
                }
                if(($tr != '1') &&  ($td == '1')){  
                    $class = 'yellow';
                }
                if($tr == $td && $square== true && $tr !='1' && td !='1'){
                    $squareClass='pink';
                }else{
                    $squareClass = '';
                }

                
                echo "<td class='$class $squareClass'>" .$tr * $td."</td>"; 
                
               
            }
      $class = '';
    echo "</tr>";
    }   
    echo "</table>";
?>

    
</body>
</html>
