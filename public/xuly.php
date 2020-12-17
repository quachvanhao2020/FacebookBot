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
$accounts = [];
$groups = [];
$options = [];
$actions_link = [];
$actions_post = [];
$blood = "";
if($id){
    try {
        $process = $pm->get($id);
        $parameter = $process->getParameter();
        $accounts = $parameter["accounts"];
        $groups = $parameter["groups"];
        $actions_link = $parameter["actions_link"];
        $actions_post = $parameter["actions_post"];
        $options = $parameter["options"];
        $blood = $process["blood"];
    } catch (\Throwable $ex) {
        setcookie("id_process", "", time()-3600);
    }
}

$_result = @$_POST["result"];
$error = @$_POST["error"];

if(isset($_POST["accounts"])){
    $accounts = $_POST["accounts"];
}
if(isset($_POST["groups"])){
    $groups = $_POST["groups"];
}
if(isset($_POST["options"])){
    $options = $_POST["options"];
}
if(isset($_POST["actions_link"])){
    $actions_link = $_POST["actions_link"];
}
if(isset($_POST["actions_post"])){
    $actions_post = $_POST["actions_post"];
}
$owned = "faceboo_bot";

if(isset($_POST["blood"])){
    $blood = $_POST["blood"];
}
if($action == "update"){
    //var_dump($_POST);
}
if(is_array($actions_link)){
    $actions_link = array_flip($actions_link);
}
if(is_array($actions_post)){
    $actions_post = array_flip($actions_post);
}
if(is_string($accounts)){
    $accounts = decodeString($accounts);
    if(is_array($accounts)){
        foreach ($accounts as $key => $value) {
            $_accounts = explode("|",$value);
            $accounts[$key] = [
                "username" => $_accounts[0],
                "password" => $_accounts[1],
                "fa2" => $_accounts[2],
            ];
        }
    }
}
if(is_string($groups)){
    $groups = decodeString($groups);
}
if(is_string($options)){
    $options = decodeString($options);
}
if(is_string($_result)){
    $_result = json_decode($_result,true);
}
if(is_string($error)){
    $error = decodeString($error);
}
$parameter = [
    "accounts" => $accounts,
    "groups" => $groups,
    "options" => $options,
    "actions_link" => $actions_link,
    "actions_post" => $actions_post,
];
$_request = [
    "id" => $id,
    "process_forward_aware" => isset($_POST["process_forward_aware"]),
    "action" => $action,
    "parameter" => $parameter,
    "result" => $_result,
    "error" => $error,
    "owned" => $owned,
    "blood" => $blood,
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
    $string = str_replace("\r",'',$string);
    $result = json_decode($string,true);
    if(!$result)
        $result = explode("\n", $string);
    return $result;
}       

?>