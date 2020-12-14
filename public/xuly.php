<?php
require_once "init.php";

use ProcessForward\Process;
use ProcessForward\ProcessActionConst;
use ProcessForward\ProcessManager;
use ProcessForward\ProcessRequest;
$id = isset($_POST["id"]) ? $_POST["id"] : @$_COOKIE["id_process"];
$action = @$_POST["action"];
if(!$action){
    echo "0";
    exit;
}
$accounts = @$_POST["accounts"];
$groups = @$_POST["groups"];
$options = @$_POST["options"];
$owned = "faceboo_bot";
setcookie("accounts", $accounts, time() + (86400 * 30), "/");
setcookie("groups", $groups, time() + (86400 * 30), "/");
setcookie("options", $options, time() + (86400 * 30), "/");
if(is_string($accounts)){
    $accounts = explode("\n", $accounts);
}
if(is_string($groups)){
    $groups = explode("\n", $groups);
}
if(is_string($options)){
    $options = explode("\n", $options);
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
    "result" => [],
    "error" => [],
    "owned" => $owned,
];
$request = new ProcessRequest($_GET,$_request);
$pm = new ProcessManager();
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
if($result == true){
    header('Location: index.php') ;
}
?>