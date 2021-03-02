<?php 
header("Cache-Control: no-cache, must-revalidate");
$type = $_GET['type'];
$link = @mysqli_connect("localhost","root","","library");
   if(!$link) die ("что то пошло не так");
    switch ($type) {
        case '1':
            $query = "SELECT * FROM books ORDER BY author";
            $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
            echo "<divСписок книг заданных авторов, упорядоченный по убыванию по авторам или по
            возрастанию по названиям</div>";
             while ($row=mysqli_fetch_array($result)) 
            { 
             echo '<p>Имя книги '.$row['bookName'].'. Автор: '.$row['author'].'</p>';
            } 
            break;
        case '2':
            $query = "SELECT * FROM clients WHERE Sername LIKE '%ов' ";
            $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
            echo "<div>Списки клиентов заканчивающихся на (ов)</div>";
             while ($row=mysqli_fetch_array($result)) 
             { 
             echo '<p>Имя '.$row['Name'].'. Фамилия '.$row['Sername'].'</p>';
             }
            
            break;
        case '3': // отредачить можно через join сделать в одном запросе все
            $query = "SELECT books.bookName FROM lending_books LEFT JOIN books ON lending_books.IDBOOK = books.ID GROUP BY books.bookName";
            $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
            echo "<div>Список кодов книг, которые выдавались (без повторов);</div>";
                while ($row=mysqli_fetch_array($result)) 
                { 
                    echo "$row[bookName] <br>";
                }
                
            
            break;
        case '4':
            $query = "SELECT 
                Name,Sername, COUNT(books.bookName) as booksCount 
                FROM clients 
                LEFT JOIN lending_books ON lending_books.IDCLIENT = clients.IDclient 
                LEFT JOIN books ON lending_books.IDBOOK = books.ID 
                GROUP BY Name
            "; 
            $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
            echo "<div>Список клиентов, которым выдавались книги с указанием количества выдач</div>";
            while($row=mysqli_fetch_array($result)){
                if($row[booksCount] == 0){
                    continue;
                }
                echo "$row[Name]  $row[Sername] : $row[booksCount] <br>"; 
            }


            break;
        case '5':
            echo "<div>Список книг, которые не выдавались;</div>";
            $query = "SELECT *
            FROM books 
            LEFT JOIN lending_books ON books.ID = lending_books.IDBOOK
            WHERE lending_books.IDCLIENT IS NULL;";

            $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
            while($row=mysqli_fetch_array($result)){
                echo "$row[bookName] $row[author] <br>";
            }
            
            break;
        case '6':
            echo "";
            $query = "SELECT 
            Name,Sername, IF(COUNT(books.bookName)>5, COUNT(books.bookName), NULL) as booksCount 
            FROM clients 
            LEFT JOIN lending_books ON lending_books.IDCLIENT = clients.IDclient 
            LEFT JOIN books ON lending_books.IDBOOK = books.ID 
            GROUP BY Name"; 
            $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
            echo "<div>Список клиентов, бравших книги более 5 раз</div>";
            while($row=mysqli_fetch_array($result)){
                if($row[booksCount] == 0){
                    continue;
                }
                echo "$row[Name]  $row[Sername] взял книг: $row[booksCount] <br>"; 
            }
            break;
        case '7':
            $query = "SELECT Name,Sername, COUNT(books.bookName) as booksCount 
            FROM clients 
            LEFT JOIN lending_books ON lending_books.IDCLIENT = clients.IDclient 
            LEFT JOIN books ON lending_books.IDBOOK = books.ID 
            GROUP BY Name"; 
            $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
            echo "<div>Список клиентов с полем, содержащим количество выдач книг данному клиенту.</div>";
            while($row=mysqli_fetch_array($result)){
                echo "$row[Name]  $row[Sername] выдалось книг : $row[booksCount] <br>"; 
            }
        break;
        case '8':

            $query = "SELECT bookName, COUNT(bookName) as count, ROUND(SUM(lending_books.issueDate)/COUNT(bookName)) as days  
                FROM books 
                LEFT JOIN lending_books ON books.ID = lending_books.IDBOOK 
                GROUP BY bookName";
             $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
          
            echo "<div>Список клиентов с полем, содержащим количество выдач книг данному клиенту.</div>";
            while($row=mysqli_fetch_array($result)){
             if($row["days"] == NULL){
                    echo "
                    $row[bookName] <br> 
                    Выдавалось : 0 раз <Br> 
                    Среднее время выдачи : 0 дней <br>";
                    continue; 
                } 
                echo "
                $row[bookName] <br> 
                Выдавалось : $row[count] раз <Br> 
                Среднее время выдачи : $row[days] дней <br>"; 
            }
        break;
        case '9':
            $query = "SELECT bookName, clients.Name, clients.Sername,COUNT(*) as count  
                FROM books 
                RIGHT JOIN lending_books ON books.ID=lending_books.IDBOOK 
                LEFT JOIN clients ON lending_books.IDCLIENT = clients.IDclient 
                GROUP BY bookName,clients.Name,clients.Sername 
                HAVING count>1";
            echo "<div>Список клиентов, бравших одну и ту же книгу более 1 раза. В списке отобразить
            название книги и сколько раз она бралась.</div>";
            $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));

            while($row = mysqli_fetch_array($result)){
                if($row['count'] == 2 || $row['count'] == 3 || $row['count'] == 4){
                    echo "$row[Sername] $row[Name] брал книгу $row[bookName] $row[count] раза  <br>";
                    continue;
                }
                echo "$row[Sername] $row[Name] брал книгу $row[bookName] $row[count] раз  <br>";
            }
            break;
        case '10':
            echo "<div>Список книг, которые брались более 10 раз на срок не менее 30 дней.</div>";
            $query = "SELECT bookName,COUNT(*)as count
            FROM books 
            RIGHT JOIN lending_books ON books.ID = lending_books.IDBOOK 
            WHERE lending_books.issueDate > 30
            GROUP BY bookName HAVING count > 10";
            $result = mysqli_query($link,$query) or die ("Ошибка".mysqli_error($link));
            while($row = mysqli_fetch_array($result)){
                echo "$row[bookName] выдавалась $row[count] раз  <br>";
            }
            break;
        default:
            # code...
            break;
    }

 

   mysqli_close($link);  
?>