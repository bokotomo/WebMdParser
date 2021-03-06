<?php

namespace MdParser;

use MdParser;

/**
 * .md file Parser API.
 *
 * @package MdParser
 */
class MdParserController
{
  /** @var array */
  private $textArray;
  /** @var string */
  private $fileName;

  /**
  * load mdfile from $mdPath
  * 
  * @param string $mdPath mdfile name
  */
  public function __construct($fileName){
    $filePath = __DIR__."/../".$fileName;
    $text = file_get_contents($filePath);
    $this->textArray = preg_split("//u", $text, -1, PREG_SPLIT_NO_EMPTY);
    $this->fileName = $fileName;
  }

  /**
  * show mdfile's text that is converted htmlfile
  */
  public function echoMdText(){
    $headerText = file_get_contents("header.txt");
    $headerText = str_replace("HTML_TITLE", $this->fileName, $headerText);
    $headerText = str_replace("CSS_PATH", "webmdparser/style.css", $headerText);
    echo $headerText;
    $mdText = $this->parseMdText($this->textArray);
    echo $mdText;
    echo file_get_contents("footer.txt");    
  }

  /**
  * response Number of Shape
  * 
  * @param array $textArray $index array that is mdfile's text
  * @param int $textMaxNum Number of array that is mdfile's text
  * @param int $index now index
  * @return int Shape's Number
  */
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

  /**
  * parse htmltext from array
  * 
  * @param array $textArray. array that is mdfile's text
  * @return string converted mdfile's text
  */
  private function parseMdText($textArray){
    $convertedText = "";
    $textMaxNum = count($textArray);
    for($i = 0;$i<$textMaxNum;$i++){
      if($textArray[$i] == "\n"){
        $convertedText .= "<br>";
      }else if($textArray[$i] == " " && $textArray[$i + 1] == " " && $textArray[$i + 2] == "\n"){
        $convertedText .= "<br>";
        $i += 2;
      }else if($textArray[$i] == "<" && $textArray[$i + 1] == "i" && $textArray[$i + 2] == "m" && $textArray[$i + 3] == "g"){
        $convertedText .= "<img";
        for($j = $i + 4;$j<$textMaxNum;$j++){
          if($textArray[$j] == "\n" || $textArray[$j] == ">"){
            $convertedText .= ">";
            $i = $j;
            break;
          }else if($j == $textMaxNum - 1){
            $convertedText .= $textArray[$j];
            $i = $j;
            break;
          }else{
            $convertedText .= $textArray[$j];
          }
        }
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