<?php
require_once "init.php";
use ProcessForward\Process;
use ProcessForward\ProcessManager;
use ProcessForward\ProcessRequest;

$id = isset($_POST["id"]) ? $_POST["id"] : @$_COOKIE["id_process"];
$action = @$_POST["action"];
if(!$action){
    echo "0";
    exit;
}
$pm = new ProcessManager();
$accounts = @$_POST["accounts"];
$groups = @$_POST["groups"];
$options = @$_POST["options"];
$_result = @$_POST["result"];
$error = @$_POST["error"];
$owned = "faceboo_bot";
if($action == "update"){
    //var_dump($_POST);
}
setcookie("accounts", $accounts, time() + (86400 * 30), "/");
setcookie("groups", $groups, time() + (86400 * 30), "/");
setcookie("options", $options, time() + (86400 * 30), "/");
if(is_string($accounts)){
    $accounts = decodeString($accounts);
}
if(is_string($groups)){
    $groups = decodeString($groups);
}
if(is_string($options)){
    $options = decodeString($options);
}
if(is_string($_result)){
    $_result = decodeString($_result);
}
if(is_string($error)){
    $error = decodeString($error);
}
$parameter = [
    "accounts" => $accounts,
    "groups" => $groups,
    "options" => $options,
];
$_request = [
    "id" => $id,
    "process_forward_aware" => isset($_POST["process_forward_aware"]),
    "action" => $action,
    "parameter" => $parameter,
    "result" => $_result,
    "error" => $error,
    "owned" => $owned,
];
if($action == "update"){
    //var_dump($_request);
}

$request = new ProcessRequest($_GET,$_request);
$result = $pm->handle($request,false);
if($result instanceof Process){
    $id = $result->getId();
    setcookie("id_process", $id , time() + (86400 * 30), "/");
    if($action == "instance"){
        $result->setParameter($parameter);
        $result->setOwned($owned);
        $result = $pm->update($id,$result);
    };
}
if($action == "kill"){
    setcookie("id_process", "", time()-3600);
}
if($result === true){
    header('Location: index.php') ;
    exit();
}
$pm->release($result);

function decodeString($string){
    $string = str_replace("'",'"',$string);
    $result = json_decode($string,true);
    if(!$result)
        $result = explode("\n", $string);
    return $result;
}       

?>