<?
function outputImage($url,$cparams = array(), $params=array()){
	$output = "image.php?url=$url";
	
	if($cparams['size']){
		if($cparams['mode'] == 'h'){ $m = 'height'; }else{ $m = 'width'; }
		$output .= "&$m=".$cparams['size'];		
	}
	
	if($cparams['square']){
		$output .= "&square=".$cparams['square'];		
	}
	
	if($cparams['height'] && $cparams['width']){
		$output .= "&height=".$cparams['height'];	
		$output .= "&width=".$cparams['width'];	
	}
	
	$par = '';
	foreach($params as $k=>$v){
		$par .= "$k = \"$v\" ";
	} 
	
	
	return "<img src='$output' $par />";	
}

function imageEncode($params){
	return strtr(base64_encode(addslashes(gzcompress(serialize($params),9))), '+/=', '-_,');
}
function imageDecode($params){
	return unserialize(gzuncompress(stripslashes(base64_decode(strtr($params, '-_,', '+/=')))));
}

function outputAdvancedImage($params, $extras = array(), $raw = false){
	
	if(!file_exists($_SERVER['DOCUMENT_ROOT']."/images/generated_images/pics/".md5(imageEncode($params)).".png")){ 
		$url = Factory::siteUrl()."php/utils/adv_image.php?data=".imageEncode($params);
		// create a new cURL resource
		$ch = curl_init();
		
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		// grab URL and pass it to the browser
		curl_exec($ch);
		
		// close cURL resource, and free up system resources
		curl_close($ch);
	}
	
	$output = Factory::imageDirectory()."generated_images/pics/".md5(imageEncode($params)).".png"; 
	
	//$output = "adv_image.php?data=".imageEncode($params);
	$par = '';
	
	if(is_array($extras)){
		foreach($extras as $k=>$v){
			$par .= "$k = \"$v\" ";
		} 
	}
	
	
	if($raw){ return $output; }else{
		return "<img src='$output' $par />";
	}
}

function outputTextImage($params, $extras = array(), $raw = false){
	
	if(!file_exists($_SERVER['DOCUMENT_ROOT']."/images/generated_images/text/".md5(imageEncode($params)).".png")){ 
		$url = Factory::siteUrl()."php/utils/writer.php?data=".imageEncode($params);
		// create a new cURL resource
		$ch = curl_init();
		
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		// grab URL and pass it to the browser
		curl_exec($ch);
		
		// close cURL resource, and free up system resources
		curl_close($ch);
	}
	
	$output = Factory::imageDirectory()."generated_images/text/".md5(imageEncode($params)).".png"; 
	
	$par = '';
	if(is_array($extras)){
		foreach($extras as $k=>$v){
			$par .= "$k = \"$v\" ";
		} 
	}
	
	
	if($raw){ return $output; }else{
		return "<img src='$output' $par />";
	}
}




function outputButton($params, $extras = array(), $raw = false){
	
	if(!file_exists($_SERVER['DOCUMENT_ROOT']."/images/generated_images/buttons/".md5(imageEncode($params)).".png")){ 
		$url = Factory::siteUrl()."php/utils/button.php?data=".imageEncode($params);
		// create a new cURL resource
		$ch = curl_init();
		
		// set URL and other appropriate options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		// grab URL and pass it to the browser
		curl_exec($ch);
		
		// close cURL resource, and free up system resources
		curl_close($ch);
	}
	
	$output = Factory::imageDirectory()."generated_images/buttons/".md5(imageEncode($params)).".png"; 
	
	$par = '';
	if(is_array($extras)){
		foreach($extras as $k=>$v){
			$par .= "$k = \"$v\" ";
		} 
	}
	
	
	if($raw){ return $output; }else{
		return "<img src='$output' $par />";
	}
}









function resizeTmpImage($filepath,$w,$h){
	// Open a new image
	$image = new Imagick($filepath); // $filepath is a path to a TIFF file
	
	// Scale the image
	
	
	// Store the scaled version
	
	
	
	
	
	$height=$image->getImageHeight();
	$width=$image->getImageWidth();
	
	
	if($w < $width){
		$size = $w;
		if($width > $height){
			$image->scaleImage($size, 0);
		}else{
			$image->scaleImage(0,$size);
		}
	}
	$image->writeImage($filepath);
	

}

function pdfPreview($url,$cparams=array(), $params=array()){
	global $pdf_path;
	global $pdf_folder;
	
	if(isset($cparams['size'])){
		$size=$cparams['size'];		
	}
	else{
		$size = 300;
	}
	
	if(isset($cparams['square'])){
		$square=$cparams['square'];		
	}
	else{
		$square = true;
	}
	
	$url = $pdf_folder.$url;
	
	$output= $pdf_path."pdfmaker.php?url=$url&size=$size";
	if($square){
		$output .= "&square=true";
	}
	$par = '';
	foreach($params as $k=>$v){
		$par .= "$k = \"$v\" ";
	} 
	return "<img src='$output' $par />";	
}

function make_image($url,$size=300,$square=false){
	create_thumb($url,getExtension($url),$size,$square);
}

function create_thumb($image, $extension, $size, $square){ //$image is the filename for the actual file.  $filename is directory for it to be copied to .  $extension is used to create 
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
	
	if($square){
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
	}/*
	else if(isset($_GET['height'],$_GET['width']){
		$thumb->scaleImage($_GET['width'],$_GET['height']);	
	}*/
	else{
		if($width > $height){
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

?>