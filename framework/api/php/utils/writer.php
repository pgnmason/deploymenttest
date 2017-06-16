<?php
ini_set("display_errors",1);
if(isset($_GET['data'])){
	
	//imagepng($im) or die("ERROR WITH THE HANDLE");
	/*if(isset($data['size'])){
		$size = $data['size'];
		$mode = 'd';
	}else if(isset($data['height']) && !isset($data['width'])){
		$size = $data['height'];
		$mode = 'h';
		unset($data['height']);
	}
	else if(!isset($data['height']) && isset($data['width'])){
		$size = $data['width'];
		$mode = 'w';
		unset($data['width']);
	}
	else{
		$mode = 'd';
		$size = 300;
	}
	
	*/
	$decoded = imageDecode($_GET['data']);
	
	//echo $decoded."\n\n\n\n";
	//echo $data['data']."\n\n\n\n";
	
		//echo "<pre>";
		//print_r($decoded);
		
		//echo "</pre>";
	    textWriter($decoded);
}

function imageDecode($params){
	return unserialize(gzuncompress(stripslashes(base64_decode(strtr($params, '-_,', '+/=')))));
}

function imageEncode($params){
	return strtr(base64_encode(addslashes(gzcompress(serialize($params),9))), '+/=', '-_,');
}


function textWriter($data){

/* Text to write */
if(!isset($data['text'])){
	$text = "Hello World!";
}else{ $text = $data['text']; } 

if(!isset($data['color'])){
	$color = "#000000";
}else{ $color = "#".$data['color']; } 

if(!isset($data['font'])){
	$font = "ASJiggyRoman.ttf";
}else{ $font = $data['font']; } 


if(!isset($data['fontpath'])){
	$fontpath = "../fonts/";
}else{ $fontpath = $data['fontpath']; } 

if(!isset($data['size'])){
	$size = 20;
}else{ $size = $data['size']; } 

if(!isset($data['imagepath'])){
	$path = $_SERVER['DOCUMENT_ROOT']."/images/generated_images/text/";
}else{ $path = $data['imagepath']; } 


/**** V 1.05 MLO CHANGE ADDING CASING ******/

if(isset($data['uppercase'])){
	$text = strtoupper($text);
}

if(isset($data['lowercase'])){
	$text = strtolower($text);
}

if(isset($data['propercase'])){
	$text = ucwords($text);
}






/* Create Imagick objects */
$image = new Imagick();
$draw = new ImagickDraw();
$color = new ImagickPixel($color);
$background = new ImagickPixel('none'); // Transparent

/* Font properties */
$draw->setFont($fontpath.$font);
$draw->setFontSize($size);
$draw->setFillColor($color);
$draw->setStrokeAntialias(true);
$draw->setTextAntialias(true);

/* Get font metrics */
$metrics = $image->queryFontMetrics($draw, $text);

/* Create text */
$draw->annotation(0, $metrics['ascender'], $text);

/* Create image */
$image->newImage($metrics['textWidth'], $metrics['textHeight'], $background);
$image->setImageFormat('png');
$image->drawImage($draw);




if(isset($data['shadow'])){
	/* Clone the current object */
	$shadow = $image->clone();
	 
	/* Set image background color to black
			(this is the color of the shadow) */
	$shadow->setImageBackgroundColor( new ImagickPixel( 'black' ) );
	 
	/* Create the shadow */
	$shadow->shadowImage( 30, 1, 5, 5 );
	 
	/* Imagick::shadowImage only creates the shadow.
			That is why the original image is composited over it */
	$shadow->compositeImage( $image, Imagick::COMPOSITE_OVER, 0, 0 ); 
	
	/* Save image */
	$shadow->writeImage($path.md5(imageEncode($data)).'.png');
	$shadow->clear();
	$shadow->destroy(); /**/
	/*header('Content-Type: image/png');
	echo $shadow;*/
}else{ /*header('Content-Type: image/png'); echo $image; */
	$image->writeImage($path.md5(imageEncode($data)).'.png');
	$image->clear();
	$image->destroy(); /**/
}





	

}
?>
