<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<? 
include 'writeStats.php';
$numphoto = rand(1,5);
$photo = "0"."$numphoto.gif";
echo "<a href=showinfo.php><img src=$photo alt=`01`></a>";
echo "<br>";
$banner = fopen('banner.txt','w+');
fwrite($banner,$numphoto);
fclose($banner);
writeStats('showing',$numphoto);
$json = file_get_contents('counter.json');
$obj = json_decode($json,true);
foreach ($obj as $key => $arr) {
    foreach ($arr as $key => $arr2) {
        foreach ($arr2 as $key => $value) {
            echo "$key : $value";
            echo "<br>";
        }
        echo "<br>";
    }
}
?>
</body>
</html>