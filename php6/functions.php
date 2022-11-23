<?php
//require '/classes/GuestBook.php';

function getUsersList():array
{
    $UserBook = new GuestBook(__DIR__.'/date.txt');
    $Date =[] ;
    for($i=0;$i<count($UserBook->getData());$i++){
        $Date[$i]=explode('|',$UserBook->getData()[$i]);
    }
    return ($Date);
}

function existsUser(string $login){
$userList = getUsersList();
$result = false;
for($id=0;$id <count($userList);$id++){
    if (trim($userList[$id][0]) == trim($login)){
        $result = $id;
    }
}
return $result;
};

function checkPas(string $login, string $password): bool
{
    $id = existsUser($login);
    $userList = getUsersList();

        if (trim($userList[$id][2]) == md5(trim($password))) {
            echo '1' ;
            return true;
        } else
            echo 0;
            return false;
    }


function getUserName(string $login){
    $name = null;
    $id = existsUser($login);
    $userList = getUsersList();
    return $userList[$id][1];
};

function redirect(string $url) {
header('Location: '.$url);
    die();
}

function addLogs(string $dir,string $login){
    $res = fopen( $dir,'a');
    fwrite($res, $login.PHP_EOL);
    fclose($res);
}

function search($dir){
    return (array_diff(scandir($dir), ['.', '..']));}

