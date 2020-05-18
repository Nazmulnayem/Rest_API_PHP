<?php

 define("base","localhost/Raw_php_Rest_API/Rest_API_PHP/");

$urlExtra ="/Raw_php_Rest_API/Rest_API_PHP/";

$url = $_SERVER['REQUEST_URI'];

$url = substr($url,strlen($urlExtra));

$method = "get";

if(isset($_SERVER['REQUEST_METHOD']))

$method = strtolower($_SERVER['REQUEST_METHOD']);


$controller = "home";

$view = "index";

$pos = strpos($url, "?");

if($pos > 0){
    $url = substr($url,0, strpos($url,"?"));
}



$a = explode("/",$url);

if(is_array($a) && count($a) > 0)
{
    if(isset($a[0]) && $a[0] != "")
    {
        $controller = strtolower($a[0]);
    }
    if(isset($a[1]) && $a[1] != "")
    {
        $view = strtolower($a[1]);
    }
    for($i = 2; $i < count($a); $i++ )
    {

        $param[] =$a[$i];
    }

}
include 'DAL/'.$controller.'.php';

$obj = new $controller();

if($method == "get")
{
    foreach ($_GET as $k=>$v){

        $obj->$k = $v;
    }
    $obj->Index();
}
else if($method == "post")
{
   foreach ($_POST as $k=>$v){

       $obj->$k = $v;
   }
    $obj->Insert();

}
else if($method == "put")
{
    $put_vars = array();
    parse_str(file_get_contents("php://input"),$put_vars);
    foreach ($put_vars as $k=> $v){
        $obj->$k = $v;
    }


    $obj->Update();

}
else if($method == "delete"){

    $delete_vars = array();
    parse_str(file_get_contents("php://input"),$delete_vars);
    foreach ($delete_vars as $k=> $v){
        $obj->$k = $v;
    }

    $obj->Delete();
}



