<?php
require __DIR__.'/classes/GuestBook.php';
include "functions.php";
var_dump($_COOKIE);?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>reg</title>
</head>
<body>
<form action='/reg.php' method='post' >
    <p>name</p>
    <input type="text" name='name'>
    <p>login</p>
    <input type="text" name='login'>
    <br>
    <p>password</p>
    <input type="text" name='password'>
    <br>
    <button type="submit"> войти </button>
    <br>

</form>
<?php
if (isset($_POST['login']) && isset($_POST['password'])){
    $newUsers = new GuestBook(  __DIR__.'/date.txt');
    $newUsers->append($_POST['login'].'|'.$_POST['name'].'|'.md5( trim($_POST['password'])).PHP_EOL);
    $newUsers->save();
    redirect( '/login.php') ;
}
?>
</body>
</html>
<?php
