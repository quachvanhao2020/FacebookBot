<?php
require_once "init.php";
use ProcessForward\ProcessManager;
use Laminas\Http\Client;
use Laminas\Http\PhpEnvironment\Request as ERequest;
use Laminas\Http\Request;
$erequest = new ERequest();
$request = new Request();
$request->setUri($erequest->getUri());
$request->getUri()->setPath("xuly.php");
//$request->getUri()->setPath("ketqua.php");
$request->setMethod(Request::METHOD_POST);
var_dump($request);
$id = @$_COOKIE["id_process"];
$client = new Client(
    null,
    [
        'adapter' => 'Laminas\Http\Client\Adapter\Curl',
        'maxredirects' => 0,
        'timeout'      => 30,
    ]
);
$request = new Request();
$request->setUri('http://127.0.0.1:8080/xuly.php');
$response = $client->send($request);
var_dump($response);