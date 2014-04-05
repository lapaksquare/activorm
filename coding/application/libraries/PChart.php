<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . "/third_party/pChart/class/pDraw.class.php";
require_once APPPATH . "/third_party/pChart/class/pImage.class.php";
require_once APPPATH . "/third_party/pChart/class/pData.class.php";
require_once APPPATH . "/third_party/pChart/class/pCache.class.php";

class PChart {
   const BAR_HORIZONTAL = 10;
   const BAR_VERTICAL = 11;
   
   const LINE_PLOT = 20;
   const LINE_SIMPLE = 21;
   const LINE_NETWORK = 22;

   const PIE_2D = 30;
   const PIE_3D = 31;
   
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
   
   public function dong(){
      $MyData = new pData();   
      $MyData->addPoints(array(3,12,15,8,5,-5),"Probe 1"); 
      $MyData->addPoints(array(2,7,5,18,19,22),"Probe 2"); 
      $MyData->setSerieWeight("Probe 1",2);
      $MyData->setSerieWeight("Probe 1",2);
      $MyData->setAxisName(0,"Temperatures"); 
      $MyData->addPoints(array("Jan","Feb","Mar","Apr","May","Jun"),"Labels"); 
      $MyData->setSerieDescription("Labels","Months"); 
      $MyData->setAbscissa("Labels"); 

      /* Create the pChart object */ 
      $myPicture = new pImage(700,230,$MyData); 

      /* Turn of Antialiasing */ 
      $myPicture->Antialias = FALSE; 

      /* Draw the background */ 
      $Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107); 
      $myPicture->drawFilledRectangle(0,0,700,230,$Settings); 

      /* Overlay with a gradient */ 
      $Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50); 
      $myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings); 
      $myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>80)); 

      /* Add a border to the picture */ 
      $myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0)); 

      /* Write the chart title */  
      $myPicture->setFontProperties(array("FontName"=> PCHART_PATH . "/fonts/Forgotte.ttf","FontSize"=>8,"R"=>255,"G"=>255,"B"=>255)); 
      $myPicture->drawText(10,16,"Average recorded temperature",array("FontSize"=>11,"Align"=>TEXT_ALIGN_BOTTOMLEFT)); 

      /* Set the default font */ 
      $myPicture->setFontProperties(array("FontName"=> PCHART_PATH . "/fonts/pf_arma_five.ttf","FontSize"=>6,"R"=>0,"G"=>0,"B"=>0)); 

      /* Define the chart area */ 
      $myPicture->setGraphArea(60,40,650,200); 

      /* Draw the scale */ 
      $scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>200,"GridG"=>200,"GridB"=>200,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
      $myPicture->drawScale($scaleSettings); 

      /* Turn on Antialiasing */ 
      $myPicture->Antialias = TRUE; 

      /* Enable shadow computing */ 
      $myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10)); 

      /* Draw the line chart */ 
      $myPicture->drawLineChart(); 
      $myPicture->drawPlotChart(array("DisplayValues"=>TRUE,"PlotBorder"=>TRUE,"BorderSize"=>2,"Surrounding"=>-60,"BorderAlpha"=>80)); 

      /* Write the chart legend */ 
      $myPicture->drawLegend(590,9,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL,"FontR"=>255,"FontG"=>255,"FontB"=>255)); 

      /* Render the picture (choose the best way) */ 
      $myPicture->autoOutput("pictures/example.drawLineChart.plots.png"); 
   }
   
   public function line_plot($data){
      
      
   }
}

?>