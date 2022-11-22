<?php
include "functions.php";
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

    for ($i = 2; $i - 2 < count(search(__DIR__ . '/img/'.$dir)); $i++) {
        echo '<img src=/img/'.$dir.'/'.search(__DIR__.'/img/'.$dir)[$i].' width="100" height="100">';
        echo '</t>';
    }
    if (isset($_FILES['picture'])) {
        if (0 == $_FILES['picture']['error']) {
            $name = $_FILES['picture']['name'];
            $rest = move_uploaded_file($_FILES['picture']['tmp_name'], __DIR__ . '/img/' . $dir . '/' . $name);
            addLogs('log.txt', $_COOKIE['name'].'| /img/'.$dir.'|'.$name.'|'.date("d.m.y").'|'.date("H:i:s"));
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

</body>
</html>
