<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . "/third_party/pChart/class/pDraw.class.php";
require_once APPPATH . "/third_party/pChart/class/pImage.class.php";
require_once APPPATH . "/third_party/pChart/class/pData.class.php";

class PChart {
	function __construct(){
      define('PCHART_PATH', APPPATH . "/third_party/pChart/");
   }
   
   public function ding(){
      $myDataset = array(0, 1, 1, 2, 3, 5, 8, 13);
      
      $myData = new pData(); 
      $myData->addPoints($myDataset);
      
      $myImage = new pImage(500, 300, $myData);
      $myImage->setFontProperties(array(
         "FontName" => PCHART_PATH . "/fonts/GeosansLight.ttf",
         "FontSize" => 15)
      );
      $myImage->setGraphArea(25,25, 475,275);
      $myImage->drawScale();
      $myImage->drawBarChart();
      
      header("Content-Type: image/png");
      $myImage->Render(null);
   }
}

?>