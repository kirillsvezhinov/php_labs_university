<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $link = @mysqli_connect("localhost","root","","csv_db");
    if(!$link) die ("что то пошло не так");
    $query = "SELECT * from  tbl_name";
    $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
        while($row = mysqli_fetch_array($result)){
            echo "
            <div style='width:400px; border:1px solid grey; padding:10px; cursor:pointer'>
                <form method='POST' action='item.php'>
                <input name='data' value='{$row}' hidden>
                <input name='lbl' value='{$row['COL 1']}' hidden>
                <input name='p1' value='{$row['COL 2']}' hidden>
                <input name='p2' value='{$row['COL 3']}' hidden>
                    <label>
                        <h3>{$row['COL 1']}</h3>
                        <input type='submit' value='новость' hidden>
                    </label>
                </form>
            </div>
            ";
        }
    ?>
</body>
</html>