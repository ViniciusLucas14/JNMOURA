<?php
require'config.php';
$url = $_GET["url"] ?? "Index/index";
$url = explode("/", $url);

$controller = "";
$method = "";

 if(isset($url[0])){
    $controller = $url[0];
 }

 if(isset($url[1])){
    if($url[1] !=''){
        $method = $url[1];
    }
 }

 spl_autoload_register(function($class){
    if (file_exists(LBS.$class.".php")) {
        require LBS.$class.".php";
    } //INVOCANDO A LIBRARY
});
require 'Controllers/Error.php';
$error = new Errors();
//$obj = new Controllers();
// echo $controller."--".$method;
$controllersPath = "Controllers/".$controller.'.php';
    if(file_exists($controllersPath)){
        require $controllersPath;
                                                    //instanciamos a classe
        $controller = new $controller();            //() significa que é uma classe 
        if(isset($method)){                         //isset = verifica se a variavel é definida
            if(method_exists($controller,$method)){ //verifica se o método existe no controlador
                $controller->{$method}();           //verificamos se o metodo existe;
            }else{
                $error ->error();
            }
        }
    }else{
        $error ->error();
    }
?>