<?php
use MdParser\MdParserController;

require_once(__DIR__."/md_parser_controller.php");

if(!empty($_GET["file_name"])){
  $fileName = htmlspecialchars($_GET["file_name"]);
}else{
  header("HTTP/1.0 404 Not Found");
  exit(0);
}

$filePath = __DIR__."/../".$fileName;
if(file_exists($filePath)){
  $mdParserController = new MdParserController($filePath);
  $mdParserController->echoMdText();
}else{
  header("HTTP/1.0 404 Not Found");
  exit(0);
}