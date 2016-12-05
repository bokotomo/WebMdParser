<?php

class MdParserController
{
  private $textArray;

  public function __construct($mdPath){
    $text = file_get_contents($mdPath);
    $this->textArray = preg_split("//u", $text, -1, PREG_SPLIT_NO_EMPTY);
  }

  public function echoMdText(){
    echo file_get_contents("header.txt");
    $mdText = $this->parseMdText($this->textArray);
    echo $mdText;
    echo file_get_contents("footer.txt");
  }

  private function getShapeNum($textArray, $textMaxNum, $index){
    $titleNum = 1;
    for($j = $index + 1;$j<$textMaxNum;$j++){
      if($textArray[$j] == "#"){
        $titleNum++;
      }else{
        break;
      }
    }
    return $titleNum;
  }

  private function parseMdText($textArray){
    $convertedText = "";
    $textMaxNum = count($textArray);
    for($i = 0;$i<$textMaxNum;$i++){
      if($textArray[$i] == "\n"){
        $convertedText .= "<br>";
      }else if($textArray[$i] == "h" && $textArray[$i + 1] == "t" && $textArray[$i + 2] == "t" && $textArray[$i + 3] == "p"){
        $urlText = "";
        for($j = $i + 4;$j<$textMaxNum;$j++){
          if($textArray[$j] == "\n" || $textArray[$j] == " " || $textArray[$j] == "　"){
            $i = $j;
            break;
          }else if($j == $textMaxNum - 1){
            $urlText .= $textArray[$j];
            $i = $j;
            break;
          }else{
            $urlText .= $textArray[$j];
          }
        }
        $convertedText .= "<a href='http{$urlText}' target='_blank'>http{$urlText}";
        $convertedText .= "</a>";
        if($textArray[$i] == "\n"){
          $convertedText .= "<br>";
        }else if($i == $textMaxNum - 1){
          //none
        }else{
          $convertedText .= $textArray[$i];
        }
      }else if($textArray[$i] == "#"){
        //h1
        $titleNum = $this->getShapeNum($textArray, $textMaxNum, $i);
        if($i==0){
          $convertedText .= "<div class='title{$titleNum}'>";
          for($j = $i + $titleNum;$j<$textMaxNum;$j++){
            if($textArray[$j] == "\n"){
              $convertedText .= "</div>";
              $i = $j;
              break;
            }else if($j == $textMaxNum - 1){
              $convertedText .= $textArray[$j];
              $convertedText .= "</div>";
              $i = $j;
              break;
            }else{
              $convertedText .= $textArray[$j];
            }
          }
        }else{
          if($textArray[$i - 1] == "\n"){
            $convertedText .= "<div class='title{$titleNum}'>";
            for($j = $i + $titleNum;$j<$textMaxNum;$j++){
              if($textArray[$j] == "\n"){
                $convertedText .= "</div>";
                $i = $j;
                break;
              }else if($j == $textMaxNum - 1){
                $convertedText .= $textArray[$j];
                $convertedText .= "</div>";
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