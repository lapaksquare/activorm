<?php 

class Mediamanager {
	
	var $ci;
	
	function __construct(){
		$this->ci =& get_instance();
	}
	
	function getPhotoUrl($url, $size = "", $crop = 0){   
		$filename = $url;
		$pathinfo = pathinfo($filename);
		
		if (empty($pathinfo['extension'])) return false;
		
		$crop_str = "";
		if ($crop == 1) $crop_str = "crop";
		
      
      
		$file_exists = $pathinfo['dirname'] . '/' . $pathinfo['filename'] . '_' . $size . $crop_str . "." . $pathinfo['extension'];
		if (file_exists($file_exists) && $this->ci->input->get_post('Preview') != 1){         
         return $file_exists;
		}
      

		
		list($width, $height) = explode("x", $size);
		
		/*if ($pathinfo['extension'] == "jpg" || $pathinfo['extension'] == "jpeg"){
		
			$this->ci->load->library('wideimage_library');	
			$img = WideImage::load($filename);
			$img = $img->resize($width, $height, "inside", "any");
			$url = $file_exists;
			$img->saveToFile($url, 100);
		
		}else{*/
		
         $width_pr = $width;
         $height_pr = $height;
      
			if ($crop == 1){
				  $img = getimagesize($filename);

              $img_ratio = $img[0] / $img[1];
              $req_ratio = $width / $height;
              
              //go with width
              if($img_ratio >= $req_ratio){
                  $width_pr = $width;
                  $height_pr = ($width / $img[0]) * $img[1];
                  
                  $config['x_axis'] = 0;
                  $config['y_axis'] = ($height_pr - $height) / 2;
              }
              //go with height
              else if($img_ratio < $req_ratio){
                  $width_pr = ($height / $img[1]) * $img[0];
                  $height_pr = $height;
                  
                  $config['x_axis'] = ($width_pr - $width) / 2;
                  $config['y_axis'] = 0;
              }
              
              /*
				  $cx = $img[0] / 2;
				  $cy = $img[1] / 2;
				  $x = $cx - $width / 2;
				  $y = $cy - $height / 2;
				  if ($x < 0) $x = 0;
				  if ($y < 0) $y = 0;
				  $config['x_axis'] = $x;
				  $config['y_axis'] = $y;
              */
			}
			
			$config['image_library'] = 'gd2';
			$config['source_image']	= $filename;
			$config['create_thumb'] = FALSE;
			$config['maintain_ratio'] = TRUE;
			$config['width']	 = $width_pr;
			$config['height']	= $height_pr;
			$config['new_image'] = $file_exists;
			
			$this->ci->load->library('image_lib', $config); 
			
			if ($crop == 0) 
            $this->ci->image_lib->resize();
			if ($crop == 1) {
            $this->ci->image_lib->crop();
         }
		//}
		
		return $file_exists;
	}
	
}

?>