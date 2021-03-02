<?php
header("Cache-Control: no-cache, must-revalidate");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>

<div style="width:800px;">
    <div style="width:500px" class="tab">
        <h3>Добавление записей</h3>
        <div class="tab-nav" style="display:flex" >
            <div class="tab-block" style="margin:5px; cursor:pointer">Книги</div>
            <div class="tab-block" style="margin:5px; cursor:pointer">Клиенты</div>
            <div class="tab-block" style="margin:5px; cursor:pointer">Выдача книг</div>
        </div>
        <div >
            <div class="tab-content">
                <form method="GET">
                    <div>Название книги <input name="bookName" type="text" /> </div>
                    <div>Автор <input name="author" type="text"/></div>
                    <input type="submit" value="заполнить"/>
                </form>
            </div >
            <div class="tab-content">
            <form method="GET">
                    <div>Имя <input name="clientName" type="text" /> </div>
                    <div>Фамилия <input name="clientSername" type="text"/></div>
                    <input type="submit" value="заполнить"/>
                </form>
            </div>
            <div  class="tab-content">
            <form method="GET">
                    <div> Книга
                        <select name="changeBook">
                        <?php 
                        $link = @mysqli_connect("localhost","root","","library");
                        $query = "SELECT bookName,author,ID FROM books";
                        $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
                        while($row = mysqli_fetch_array($res)){
                            echo "<option value=$row[ID]>$row[bookName],$row[author]</option>";
                        }
                        mysqli_close($link);
                        ?>
                        </select> 
                    </div>
                    <div> Клиент
                    <select name="changeClient">
                    <?php 
                        $link = @mysqli_connect("localhost","root","","library");
                        $query = "SELECT Name,Sername,IDclient FROM clients";
                        $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
                        while($row = mysqli_fetch_array($res)){
                            echo "<option value=$row[IDclient]>$row[Name] $row[Sername]</option>";
                        }
                        mysqli_close($link);
                    ?>
                    </select>
                    </div>
                    <div>Дата выдачи<input name="dateOfIssue" type="date"/></div>
                    <div>Срок выдачи<input name="days" type="number"/></div>
                    <input type="submit" value="заполнить"/>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="tab">
        <h3>Редактирование</h3>
        <div class="tab-nav-sec" style="display:flex" >
            <div class="tab-block-sec" style="margin:5px; cursor:pointer">Книги</div>
            <div class="tab-block-sec" style="margin:5px; cursor:pointer">Клиенты</div>
            <div class="tab-block-sec" style="margin:5px; cursor:pointer">Выдача книг</div>
        </div>
        <div>
            <div class="tab-content-sec" style="width:600px">
                
                    <?php
                    $link = @mysqli_connect("localhost","root","","library");
                    $query = "SELECT ID as bookID,bookName,author FROM books";
                    $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
                    while($row = mysqli_fetch_array($res)){
                   
                            ?>
                            <form method="POST" class="redForm">
                            <div>
                                <input style="display:inline-block; width:170px" type=text name=deletedBookName value="<?php echo $row['bookName']?>">
                                <input style="display:inline-block; width:120px" type=text name=deletedBookAuthor value="<?php  echo  $row['author'] ?>">
                                <input type=text name=deletedID value="<?php  echo  $row['bookID'] ?>" hidden>
                                <input style="display:inline-block; width:120px"  type=submit value="Редактировать">
                            </div>

                            </form>
                        <?php 
                    }
                    mysqli_close($link);
                    ?>
              
            </div >
            <div class="tab-content-sec">
            
                    <?php
                    $link = @mysqli_connect("localhost","root","","library");
                    $query = "SELECT Name,Sername,IDclient FROM clients";
                    $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
                    while($row = mysqli_fetch_array($res)){
                   
                            ?>
                            <form method="POST" class="redForm">
                            <div>
                                <input style="display:inline-block; width:170px" type=text name=deletedClientName value="<?php echo $row['Name']?>">
                                <input style="display:inline-block; width:120px" type=text name=deletedClientSername value="<?php  echo  $row['Sername'] ?>">
                                <input type=text name=deletedID value="<?php  echo  $row['IDclient'] ?>" hidden>
                                <input style="display:inline-block; width:120px" type=submit name=red value="Редактировать">
                            </div>

                            </form>
                        <?php
                    }
                    mysqli_close($link);
                    ?>
             
            </div>
            <div class="tab-content-sec">
            
                    <?php
                    $link = @mysqli_connect("localhost","root","","library");
                    $query = "SELECT Name,Sername,BookName,dateOfIssue,issueDate,lending_books.ID as IDL FROM clients RIGHT JOIN lending_books ON clients.IDCLIENT = lending_books.IDCLIENT LEFT JOIN books ON books.ID = lending_books.IDBOOK ORDER BY sername";
                    $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
                    while($row = mysqli_fetch_array($res)){
                   
                            ?>
                            <form method="POST" class="redForm">
                            <div>
                                <input style="display:inline-block; width:170px" type=text name=deletedClientNameL value="<?php echo $row['Name']?>" readonly >
                                <input style="display:inline-block; width:120px" type=text name=deletedClientSername: value="<?php  echo  $row['Sername'] ?>"readonly >
                                <input style="display:inline-block; width:170px" type=text name=deletedBookNameL value="<?php echo $row['BookName']?>"readonly >
                                <input style="display:inline-block; width:120px" type=text name=deletedDateOfIssue value="<?php  echo  $row['dateOfIssue'] ?>">
                                <input style="display:inline-block; width:120px" type=text name=deletedissueDate value="<?php  echo  $row['issueDate'] ?>">
                                <input type=text name=deletedIDL value="<?php  echo  $row['IDL'] ?>" hidden>
                                <input style="display:inline-block; width:120px" type=submit name=r value="Редактировать">
                            </div>
                            </form>

                     <?php   
                    }
                    mysqli_close($link);
                    ?>
              
           
            </div>
        </div>
    </div>
</div>
<div class="tab">
        <h3>Удаление</h3>
        <div class="tab-nav-del" style="display:flex" >
            <div class="tab-block-del" style="margin:5px; cursor:pointer">Книги</div>
            <div class="tab-block-del" style="margin:5px; cursor:pointer">Клиенты</div>
            <div class="tab-block-del" style="margin:5px; cursor:pointer">Выдача книг</div>
        </div>
        <div>
            <div class="tab-content-del" style="width:600px">
               
                    <?php
                    $link = @mysqli_connect("localhost","root","","library");
                    $query = "SELECT ID,bookName,author FROM books";
                    $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
                    while($row = mysqli_fetch_array($res)){
                   
                            ?>
                             <form method="POST" action="rewrite.php" class="redForm">
                            <div>
                                <input style="display:inline-block; width:170px" data-book="<?php echo  $row["ID"]; ?>" type=text name=deletedBookName value="<?php echo $row['bookName']?>">
                                <input style="display:inline-block; width:120px" type=text name=deletedBookAuthor value="<?php  echo  $row['author'] ?>">
                                <input style="display:inline-block; width:120px"  type=submit  value="Удалить">
                            </div>
                            </form>
                           
                        <?php 
                    }
                    mysqli_close($link);
                    ?>
              
            </div >
            <div class="tab-content-del">
           
                    <?php
                    $link = @mysqli_connect("localhost","root","","library");
                    $query = "SELECT Name,Sername FROM clients";
                    $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
                    while($row = mysqli_fetch_array($res)){
                   
                            ?>
                             <form method="POST" action="rewrite.php" class="redForm">
                            <div>
                                <input style="display:inline-block; width:170px" type=text name=deletedClientName value="<?php echo $row['Name']?>">
                                <input style="display:inline-block; width:120px" type=text name=deletedClientAuthor value="<?php  echo  $row['Sername'] ?>">
                                <input style="display:inline-block; width:120px" type=submit name=red value="Удалить">
                            </div>
                            </form>
                           
                        <?php
                    }
                    mysqli_close($link);
                    ?>
          
            </div>
            <div class="tab-content-del">
           
                    <?php
                    $link = @mysqli_connect("localhost","root","","library");
                    $query = "SELECT Name,Sername,BookName,dateOfIssue,issueDate,lending_books.ID as IDDEL FROM clients LEFT JOIN lending_books ON clients.IDCLIENT = lending_books.IDCLIENT LEFT JOIN books ON books.ID = lending_books.IDBOOK ORDER BY sername";
                    $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
                    while($row = mysqli_fetch_array($res)){
                   
                            ?>
                            <form method="POST" class="redForm">
                                <div>
                                    <input style="display:inline-block; width:170px" type=text name=deletedClientNameL value="<?php echo $row['Name']?>" readonly >
                                    <input style="display:inline-block; width:120px" type=text name=deletedClientSername: value="<?php  echo  $row['Sername'] ?>"readonly >
                                    <input style="display:inline-block; width:170px" type=text name=deletedBookNameL value="<?php echo $row['BookName']?>"readonly >
                                    <input style="display:inline-block; width:120px" type=text name=deletedDateOfIssue value="<?php  echo  $row['dateOfIssue'] ?>">
                                    <input style="display:inline-block; width:120px" type=text name=deletedissueDate value="<?php  echo  $row['issueDate'] ?>">
                                    <input type=text name=deletedIDL value="<?php  echo  $row['IDDEL'] ?>" hidden>
                                    <input style="display:inline-block; width:120px" type=submit name=r value="Удалить">
                                </div>
                            </form>
                     <?php   
                    }
                    mysqli_close($link);
                    ?>
              
            </div>
        </div>
    </div>
</div>
<div style="margin:30px">
    <form method="GET" action="output.php">
        <select name="type">
            <option value="1" >Список книг заданных авторов, упорядоченный по убыванию по авторам или по
                возрастанию по названиям</option>
                <option value="2" >Список клиентов, фамилии которых заканчиваются на «ов»;</option>
                <option value="3" >Список кодов книг, которые выдавались (без повторов);</option>
                <option value="4" >Список клиентов, которым выдавались книги с указанием количества выдач;</option>
                <option value="5" >Список книг, которые не выдавались;</option>
                <option value="6" >Список клиентов, бравших книги более 5 раз</option>
                <option value="7" >Список клиентов с полем, содержащим количество выдач книг данному клиенту</option>
                <option value="8" >Список книг с указанием, сколько раз она выдавалась и среднего срока выдачи.</option>
                <option value="9" >Список клиентов, бравших одну и ту же книгу более 1 раза. В списке отобразить
                    название книги и сколько раз она бралась.</option>
                <option value="10" >Список книг, которые брались более 10 раз на срок не менее 30 дней.</option>
                    
                </select>
                <input type="submit"  value="получить данные"/>
    </form>
</div>
<script src="main.js"></script>

<?php

$bookName = $_GET['bookName'];
$author = $_GET['author'];

$clientName = $_GET['clientName'];
$clientSername = $_GET['clientSername'];

$changeBook = $_GET['changeBook'];
$changeClient = $_GET['changeClient'];
$dateOfIssue = $_GET['dateOfIssue'];
$days = $_GET['days'];

$bookname = preg_split("/,/",$changeBook);


$link = @mysqli_connect("localhost","root","","library");


$booknameDel = $_POST['deletedBookName'];
$bookAuthorDel = $_POST['deletedBookAuthor'];
$bookIDDel = $_POST['deletedID'];

$clientNameDel = $_POST['deletedClientName'];
$clientSernameDel = $_POST['deletedClientSername'];
$clientIDDel = $_POST['deletedID'];


$deletedDateOfIssue = $_POST['deletedDateOfIssue'];
$deletedissueDate = $_POST['deletedissueDate'];
$deletedIDL = $_POST['deletedIDL'];


$delID = $_POST['IDDEL'];
if($delID !=""){
    $query = "DELETE FROM lending_books WHERE ID='$delID'";
    $res = mysqli_query($link,$query);
}
if($deletedDateOfIssue != "" && $deletedissueDate != ""){
    $query = "UPDATE lending_books SET dateOfIssue='$deletedDateOfIssue',issueDate='$deletedissueDate' WHERE ID='$deletedIDL'";
    $res = mysqli_query($link,$query);
}
if($clientNameDel !="" && $clientSernameDel != ""){
    print_r($_POST);
    $query = "UPDATE clients SET Name='$clientNameDel',Sername='$clientSernameDel' WHERE IDclient='$clientIDDel'";
    $res = mysqli_query($link,$query);
}


if($booknameDel !="" && $bookAuthorDel != ""){
    $query = "UPDATE books SET bookName='$booknameDel',author='$bookAuthorDel' WHERE ID='$bookIDDel'";
    $res = mysqli_query($link,$query);
    header("Refresh: 0");
}


if($bookName != "" && $author != ""){
    $query = "INSERT INTO books (bookName,author) values('$bookName','$author')";
    $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
}

if($clientName != "" && $clientSername != ""){
    $query = "INSERT INTO clients (Name,Sername) values('$clientName','$clientSername')";
    $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
}
if($changeBook != "" && $changeClient !="" && $dateOfIssue != "" && $days != ""){
    $query ="INSERT INTO lending_books (IDBOOK,IDCLIENT,dateOfIssue,issueDate) values('$changeBook','$changeClient','$dateOfIssue','$days')";
    $res = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link)); 
}

?>
</body>
</html>