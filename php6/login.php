<?php
require __DIR__.'/classes/GuestBook.php';
include "functions.php";
var_dump($_COOKIE);

if (isset($_POST['login']) && isset($_POST['password'])){
    if (checkPas($_POST['login'],$_POST['password']) ){

        $name = getUserName($_POST['login']);
        setcookie('name',$name,time() + 3600  );
        $online = new GuestBook(__DIR__.'/date/online.txt');
        $online->append($name);
        $online->save();
        redirect( '/index.php') ;
    }
    else{
        redirect( '/login.php');
    }
}
?>

    <!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>
<body>
<form action='/login.php' method='post' >
    <p>login</p>
    <input type="text" name='login'>
    <br>
    <p>password</p>
    <input type="text" name='password'>
    <br>
    <button type="submit"> войти </button>
    <br>
</form>
</body>
</html>
