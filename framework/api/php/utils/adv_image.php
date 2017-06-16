<?
if(isset($_GET['data'])){
	
	//imagepng($im) or die("ERROR WITH THE HANDLE");
	/*if(isset($_GET['size'])){
		$size = $_GET['size'];
		$mode = 'd';
	}else if(isset($_GET['height']) && !isset($_GET['width'])){
		$size = $_GET['height'];
		$mode = 'h';
		unset($_GET['height']);
	}
	else if(!isset($_GET['height']) && isset($_GET['width'])){
		$size = $_GET['width'];
		$mode = 'w';
		unset($_GET['width']);
	}
	else{
		$mode = 'd';
		$size = 300;
	}
	
	*/
	
	$decoded = imageDecode($_GET['data']);
	
	//echo $decoded."\n\n\n\n";
	//echo $_GET['data']."\n\n\n\n";
	
		//echo "<pre>";
		//print_r($decoded);
		
		//echo "</pre>";
	    adv_image($decoded);
}

function imageDecode($params){
	return unserialize(gzuncompress(stripslashes(base64_decode(strtr($params, '-_,', '+/=')))));
}

function imageEncode($params){
	return strtr(base64_encode(addslashes(gzcompress(serialize($params),9))), '+/=', '-_,');
}



function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return strtolower($ext);
}

function create_thumb($image, $mode, $extension, $size){ //$image is the filename for the actual file.  $filename is directory for it to be copied to .  $extension is used to create 
	switch($extension){
		case "jpg":
		case "jpeg":
			header("Content-type: image/jpeg");
			//$src = imagecreatefromjpeg($image);
			break;
		case "gif":
			header("Content-type: image/gif");
			//$src = imagecreatefromgif($image);
			break;
		case "png":
			header("Content-type: image/png");
			//$src =  imagecreatefrompng($image);
			break;
		default:
			echo "PLEASE UPLOAD A VALID IMAGE TYPE";
	}
	
	$thumb = new Imagick();
	$thumb->readImage($image);
	$height=$thumb->getImageHeight();
	$width=$thumb->getImageWidth();
	
	
	
	
	
	
	
	
	if(isset($_GET['square'])){
		if($width > $height){
			$thumb->scaleImage(0,$size);
			$w = $thumb->getImageWidth();
			$dif = ($w-$size)/2;
			$thumb->cropImage($size, $size, $dif, 0);		
		}else{
			$thumb->scaleImage($size, 0);
			$h = $thumb->getImageHeight();
			$dif = ($h-$size)/2;
			$thumb->cropImage($size, $size, 0,$dif);	
		}
	}else if(isset($_GET['height'],$_GET['width'])){	
		/*if($width > $height){
			$thumb->scaleImage(0,$_GET['height']);
			$w = $thumb->getImageWidth();
			$dif = ($w-$_GET['width'])/2;
			$thumb->scaleImage($_GET['width'],$_GET['height'],false);		
		}else{
			$thumb->scaleImage($_GET['width'], 0);
			$h = $thumb->getImageHeight();
			$dif = ($h-$_GET['height'])/2;
			$thumb->scaleImage($_GET['width'],$_GET['height'],false);		
		}
		*/
	
	
	
		$thumb->scaleImage($_GET['width'],$_GET['height'],false);	
		
		
		
		
		
		
	}
	else{
		if(($width > $height && $mode == 'd') || $mode == 'w'){
			$thumb->scaleImage($size, 0);
		}else{
			$thumb->scaleImage(0,$size);
		}
	}
	
	
	
	
		//$thumb->resizeImage($newheight,$newwidth,Imagick::FILTER_LANCZOS,1)
	echo $thumb;
	
	$thumb->clear();
	$thumb->destroy(); 
}



function outputHeaders($image){
	
	switch(getExtension($image)){
		case "jpg":
		case "jpeg":
			header("Content-type: image/jpeg");
			//$src = imagecreatefromjpeg($image);
			break;
		case "gif":
			header("Content-type: image/gif");
			//$src = imagecreatefromgif($image);
			break;
		case "png":
			header("Content-type: image/png");
			//$src =  imagecreatefrompng($image);
			break;
		default:
			echo "PLEASE UPLOAD A VALID IMAGE TYPE";
	}
}

function adv_image($params){
	if(!isset($params['url'])){
		die("No Image Supplied. Program Exiting");
	}
	
	if(!isset($data['imagepath'])){
		$path = $_SERVER['DOCUMENT_ROOT']."/images/generated_images/pics/";
	}else{ $path = $data['imagepath']; } 
	
	//print_r($params);
	
	$image = $params['url'];
	/**/
	$thumb = new Imagick();
	$thumb->readImage($image);
	$height=$thumb->getImageHeight();
	$width=$thumb->getImageWidth();
	
	if(isset($params['max_height']) && $params['max_height'] < $thumb->getImageHeight()){
		$thumb->scaleImage(0, $params['max_height']);
	}
	
	if(isset($params['max_width']) && $params['max_width'] < $thumb->getImageWidth()){
		$thumb->scaleImage($params['max_width'], 0);
	}
	
	
	
	
	
	
	//echo "HEIGHT: $height\nWIDTH:$width\n";
	
	if(isset($params['overlay'])){
		$overlay = new Imagick($params['overlay']);
		$overlay_height = $overlay->getImageHeight();
		$overlay_width = $overlay->getImageWidth();
		
		
		//echo "HEIGHT: $overlay_height\nWIDTH:$overlay_width\n";
		$thumb->compositeImage($overlay,$overlay->getImageCompose(),$width - ($overlay->getImageWidth()+1),0);
	}
	
	if(isset($params['shadow']) && $params['shadow']){
		
		
		if(isset($params['shadow_size'])){
			$s_size = $params['shadow_size'];
		}else{ 
			$s_size = 5;
		}
		
		if(isset($params['shadow_opacity'])){
			$s_opac = $params['shadow_opacity'];
		}else{ 
			$s_opac = 70;
		}
		
		if(isset($params['shadow_sigma'])){
			$s_sig = $params['shadow_sigma'];
		}else{ 
			$s_sig = 3;
		}
		
		
	
	
		/* Clone the current object */
		$foreground = $thumb->clone();
		 
		/* Set image background color to black
				(this is the color of the shadow) */
		$thumb->setImageBackgroundColor( new ImagickPixel( 'black' ) );
		 
		/* Create the shadow */
		$thumb->shadowImage( $s_opac, $s_sig, $s_size, $s_size );
		 
		/* Imagick::shadowImage only creates the shadow.
				That is why the original image is composited over it */
		$thumb->compositeImage( $foreground, Imagick::COMPOSITE_OVER, 10, -3 ); 
	}
	//ROTATING
	if(isset($params['rotate'])){
		$thumb->rotateImage(new ImagickPixel("#ffffff"), $params['rotate']); 
	}
	
	
	
	
	//RESIZING
	if(isset($params['width']) || isset($params['height']) || isset($params['size'])){
		
		if(isset($params->size)){
			
			
			$new_width = $params['size'];
			$new_height = $params['size'];
			$size = $params['size'];
			
			if($width > $height){
				$thumb->scaleImage(0,$size);
				$w = $thumb->getImageWidth();
				$dif = ($w-$size)/2;
				$thumb->cropImage($size, $size, $dif, 0);		
			}else{
				$thumb->scaleImage($size, 0);
				$h = $thumb->getImageHeight();
				$dif = ($h-$size)/2;
				$thumb->cropImage($size, $size, 0,$dif);	
			}
			
			
			$square = true;
		}else{
		
			if(isset($params['height']) && !isset($params['width'])){ $size = $params['height']; $mode = 'h';}
			else if(!isset($params['height']) && isset($params['width'])){ $size = $params['width']; $mode = 'w'; }
			else{ 
			
				if(isset($params['crop']) && $params['crop'] !== false){
					$mode = 'c';
				}else{
					$mode = 's'; 
				}
					if($params['height'] > $params['width']){
						$size = $params['height'];
					}else{
						$size = $params['width'];
					}
			}
		
			$square = false;
			/*if(){
				$new_width = $params['width'];
			}
			
			if(v){
				$new_height = $params['height'];
			}	*/
			
			if(($width > $height && $mode == 's') || $mode == 'w'){ //resize based on width
				
				$thumb->scaleImage($params['width'], 0);
			}else if(($height > $width && $mode == 's') || $mode == 'h'){ // resize based on height;
				$thumb->scaleImage(0,$params['height']);
			}else if($mode == "c"){  // crop image
				
				if($width > $height){
					$thumb->scaleImage(0,$params['height']);
					$w = $thumb->getImageWidth();
					$dif = ($w-$params['width'])/2;
					$thumb->cropImage($params['width'], $params['height'], $dif, 0);		
				}else if($height > $width){
					$thumb->scaleImage($params['width'], 0);
					$h = $thumb->getImageHeight();
					$dif = ($h-$params['height'])/2;
					$thumb->cropImage($params['width'], $params['height'], 0,$dif);	
				}
				
				
				
			}
			
			
		}
		
	}
	
	
	if(isset($params['post_overlay'])){
		$overlay = new Imagick($params['post_overlay']);
		$overlay_height = $overlay->getImageHeight();
		$overlay_width = $overlay->getImageWidth();
		$height=$thumb->getImageHeight();
		$width=$thumb->getImageWidth();
		
		$overlay->scaleImage($width,0);
		
		//echo "HEIGHT: $overlay_height\nWIDTH:$overlay_width\n";
		$thumb->compositeImage($overlay,$overlay->getImageCompose(),$width - ($overlay->getImageWidth()),0);
	}
	
	
	
	
	//echo "HEIGHT: $new_height\nWIDTH:$new_width\n";
	
	$height=$thumb->getImageHeight();
	$width=$thumb->getImageWidth();
	
	
	
	
	
	
	$write_path = $path.md5(imageEncode($params)).'.'.getExtension($image);
	$thumb->writeImage($write_path);
	$thumb->clear();
	$thumb->destroy();//echo "HEIGHT: $height\nWIDTH:$width\n";
	/* */
	
	
  /* outputHeaders($image);
	echo $thumb;
	
	$thumb->clear();
	$thumb->destroy();  */
}



?>