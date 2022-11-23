<?php
include "functions.php";
require __DIR__.    '/classes/Uploader.php';
require __DIR__.    '/classes/GuestBook.php';
if ($_COOKIE['name']==''){
    redirect('/login.php');
}
echo 'Привет,' . $_COOKIE['name'];
echo '</br>';
?>

<!doctype html>
<html lang="ru">
<head>
    <title>Document</title>
</head>
<body>
<?php


$dir = null;
if (isset($_POST['dir'])) {
    $dir = $_POST['dir'];

    for ($i = 2; $i - 2 < count(search(__DIR__ . '/img/' . $dir)); $i++) {
        echo '<img src=/img/' . $dir . '/' . search(__DIR__ . '/img/' . $dir)[$i] . ' width="100" height="100">';
        echo '</t>';
    }
    $uploader = new Uploader('picture');
    if ($uploader->isUploaded()) {
        if (0 == $_FILES['picture']['error']) {
            $name = $_FILES['picture']['name'];
            $uploader->upload();
            $logBook = new GuestBook(__DIR__ . '/date/log.txt');
            $logBook->append($_COOKIE['name'] . '| /img/' . $dir . '|' . $name . '|' . date("d.m.y") . '|' . date("H:i:s"));
            $logBook->save();
        }
    }
}


?>
<form action='/index.php' method='post' enctype="multipart/form-data">
    <label>
        <select name="dir">
            <?php
            for ($i = 2; $i - 2 < count(search(__DIR__ . '/img')); $i++) {
                if ($dir == search(__DIR__ . '/img')[$i]) {
                    echo '<option selected>' . search(__DIR__ . '/img')[$i] . '</option>';
                }
                echo '<option>' . search(__DIR__ . '/img')[$i] . '</option>';
            } ?>
        </select>
    </label>
    <br>
    <br>
    <input type='file' name='picture'>
    <button type="submit"> загрузить</button>
</form>


<br>
<h3>GUESTS</h3>

<?php
$getGuest = new GuestBook(__DIR__.'/date/online.txt');
$guests = $getGuest->getData();
for($i=0;$i<count($guests);$i++){
    echo $guests[$i].'<br>';
}

?>
<!--<form action="/test.php" method="post">-->
<!--    <button type="submit" name="exit">выйти</button>-->
<!--</form>-->
</body>
</html>
