<?php

class MdParserController
{
  private $textArray;

  public function __construct($mdPath){
    $text = file_get_contents($mdPath);
    $this->textArray = preg_split("//u", $text, -1, PREG_SPLIT_NO_EMPTY);
  }

  public function echoMdText(){
    $mdText = $this->parseMdText($this->textArray);
    echo $mdText;
  }

  private function parseMdText($textArray){
    $convertedText = "";
    $textMaxNum = count($textArray);
    for($i = 0;$i<$textMaxNum;$i++){
      if($textArray[$i] == "\n"){
        $convertedText .= "<br>";
      }else if($textArray[$i] == "#"){
        if($i==0){
          $convertedText .= "<h1>";
          for($j = $i + 1;$j<$textMaxNum;$j++){
            if($textArray[$j] == "\n"){
              $convertedText .= "</h2>";
              $i = $j;
              break;
            }else{
              $convertedText .= $textArray[$j];
            }
          }
        }else{
          if($textArray[$i - 1] == "\n"){
            $convertedText .= "<h1>";
            for($j = $i + 1;$j<$textMaxNum;$j++){
              if($textArray[$j] == "\n"){
                $convertedText .= "</h2>";
                $i = $j;
                break;
              }else{
                $convertedText .= $textArray[$j];
              }
            }
          }
        }
        
      }else{
        $convertedText .= $textArray[$i];
      }
    }
    return $convertedText;
  }
}