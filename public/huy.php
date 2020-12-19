<?php
require_once "init.php";
use ProcessForward\Process;
use ProcessForward\ProcessManager;
use ProcessForward\ProcessRequest;
$id = isset($_POST["id"]) ? $_POST["id"] : @$_COOKIE["id_process"];
try {
    $pm = new ProcessManager();
    $pm->kill($id);
    setcookie("id_process", "", time()-3600);
} catch (\Throwable $th) {
    //throw $th;
}
header('Location: index.php') ;