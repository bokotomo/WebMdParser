<?php
if(!empty($_GET["file_name"])){
  $fileName = $_GET["file_name"];
}else{
  header("HTTP/1.0 404 Not Found");
  exit(0);
}
require_once(__DIR__."/md_parser_controller.php");
$filePath = __DIR__."/../".$fileName;
if(file_exists($filePath)){
  $MdParserController = new MdParserController($filePath);
  $MdParserController->echoMdText();
}else{
  header("HTTP/1.0 404 Not Found");
  exit(0);
}