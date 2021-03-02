<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="width: 30%; margin: 0 auto;">
        <form method="POST">
            <div>
                <p>Имя базы данных пользователя</p>
                <input type="text" placeholder="Введите имя  пользователя" name="user">
                
            </div>
            <div>
                <p>Имя базы данных пользователя</p>
                <input type="text" placeholder="Введите имя базы данных" name="db">
            </div>
            <div>
                <input type="submit" value="Подключение"/>
            </div>
        </form>
    </div>
    <?php
    $username = $_POST['user'];
    $databaseName = $_POST['db'];
    function connection($username,$dbname){
        if($username != "root"){
            echo  "Не верный пользователь";
            return "";
        }
        if($dbname != "csv_db"){
            echo "Не верное имя базы данных";
            return "";
        }
        $link = @mysqli_connect("localhost","$username","","$dbname");
        if(!$link) die ("что то пошло не так");
        $_SESSION['user'] = $username;
        $_SESSION['db'] = $dbname;
        echo "Успешное подлючение";
        return $link;
    }
    function getPost($id){
        $user = $_SESSION['user'];
        $db = $_SESSION['db'];
        echo $user;
        echo $db;
        $link = connection($user,$db);
        $query = "SELECT * FROM tbl_name WHERE ID='$id' ";
        $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($linkedDB));
        while($row = mysqli_fetch_array($result)){
        echo "<br>";
        echo "<h3>{$row['COL 1']}</h3>";
        echo "<br>";
        echo "<h4>{$row['COL 2']}</h4>";
        echo "<br>";
        echo "<h4>{$row['COL 3']}</h4>";
        echo "<br>";
        echo "<h4>{$row['COL 4']}</h4>";
        echo "<br>";
        echo "<img src={$row['COL 5']}  alt={$row['COL 5']}>";
        echo "<br>";

        }
    }
    function getIncludePost($str){
        $user = $_SESSION['user'];
        $db = $_SESSION['db'];
        $link = connection($user,$db);
        $query = "SELECT * FROM  tbl_name";
        $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));

        while($row = mysqli_fetch_array($result)){
            echo "<br>";
            if($include = mb_stristr($row['COL 2'],"facebook")){
                echo "<h4>{$row['COL 1']}</h4>";
            }
        }
    }
    ?>
    <div style="width: 30%; margin: 0 auto;">
            <form method="POST">
                <div>
                    <p>Введите айди поста</p>
                    <input type="text" name="postID"/>
                </div>
                <div>
                    <input type="submit" value="Получить пост"/>
                </div>
            </form>
    </div>
    <div style="width: 30%; margin: 0 auto;">
            <form method="POST">
                <div>
                    <p>Введите название  компании</p>
                    <input type="text" name="str"/>
                </div>
                <div>
                    <input type="submit" value="Получить пост"/>
                </div>
            </form>
    </div>
    <?php
        if(isset($username) && isset($databaseName)){
            $link = connection($username,$databaseName);
        }
        $postId = $_POST['postID'];
        $company = $_POST['str'];
        if(isset($postId)){
            getPost($postId);
        }
        if(isset($company)){
            getIncludePost($company);
        } 
    ?>
</body>
</html>