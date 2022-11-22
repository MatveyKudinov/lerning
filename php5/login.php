<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<?php
var_dump($_COOKIE);

if (isset($_POST['login']) && isset($_POST['password'])){
    if (checkPas($_POST['login'],$_POST['password']) ){
        addLogs(__DIR__.'/loginNow.txt',(string) existsUser($_POST['login']).'|'.$_POST['login']);
        setcookie('name',getUserName($_POST['login']),time() + 3600  );
        redirect( '/index.php') ;
    }
    else{
        redirect( '/login.php');
    }
}
?>



<form action='/index.php' method='post' >
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
<?php
