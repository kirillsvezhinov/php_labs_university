<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div><a rel="stylesheet" href="page1.php">С чего начать создание системы Электронной Коммерции <a/></div>
    <div><a rel="stylesheet" href="page2.php">Стратегия Интернет-маркетинга<a/></div>
    <div><a rel="stylesheet" href="page3.php">E-MARKETPLACES или виртуальные торговые площадки <a/></div>
    <div><a rel="stylesheet" href="page4.php">Интернет-банкинг<a/></div>
    <div><a rel="stylesheet" href="page5.php">Интернет-страхование <a/></div>
    <div><a rel="stylesheet" href="page6.php">Программный комплекс управления Интернет-магазином <a/></div>
    <div><a rel="stylesheet" href="page7.php">Системы управления Web-контентом (Web-content Management Systems) <a/></div>
    <div><a rel="stylesheet" href="page8.php">Онлайновые аукционы - как это делается <a/></div>
    <div><a rel="stylesheet" href="page9.php">Корпоративные информационные порталы <a/></div>
    <div><a rel="stylesheet" href="page10.php">Брокерские услуги в Интернет. Интернет-трейдинг <a/></div>
    
    <?php 
    $json = file_get_contents('tags.json');
    $obj = json_decode($json,true);
    ?>
    <div style="display:flex; width:500px; margin:0 auto; flex-wrap:wrap;">
    <?php
    foreach ($obj as $key => $value) {
        $size = 14+$value;
        echo "<div style=font-size:${size}px;margin:10px>$key</div>";
    }

    ?>
    </div>
</body>
</html>