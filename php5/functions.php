<?php
function getUsersList():array
{
    $dirHash = __DIR__ . '/hash.txt';
    $dirLog = __DIR__ . '/login.txt';
    $dirName = __DIR__ . '/name.txt';
    $userList = [];
    $resLog = fopen($dirLog, 'r');
    $resHash = fopen($dirHash, 'r');
    $resName = fopen($dirName, 'r');

    $id = 0;
    while (!feof($resLog) && !feof($resHash) && !feof($resName)) {
        $userList[$id]['login'] = trim(fgets($resLog));
        $userList[$id]['password'] = trim(fgets($resHash));
        $userList[$id]['name'] = trim(fgets($resName));
        $id++;
    }
    fclose($resHash);
    fclose($resLog);
    fclose($resName);
    return ($userList);
}

function existsUser(string $login){
$userList = getUsersList();
$result = false;
for($id=0;$id <= count($userList)-1;$id++){
    if (trim($userList[$id]['login']) == trim($login)){
        $result = $id;
    }
}
return $result;
};

function checkPas(string $login, string $password):bool{
    $userList = getUsersList();
    $id = existsUser($login);
    if (($userList[$id]['password'])==(md5($password))){
        return true;
    }
    else
        return false;
}

function getUserName(string $login){
    $name = null;
    if ($id = existsUser($login)){
    $userList = getUsersList();
    $name = $userList[$id]['name'];}
    return $name;
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

