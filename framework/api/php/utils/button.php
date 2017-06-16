<?


//$_GET['data'] = imageEncode($_GET);



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
	    drawButton($decoded);
}

function imageDecode($params){
	return unserialize(gzuncompress(stripslashes(base64_decode(strtr($params, '-_,', '+/=')))));
}

function imageEncode($params){
	return strtr(base64_encode(addslashes(gzcompress(serialize($params),9))), '+/=', '-_,');
}







function drawButton($data){

			/* Text to write */
			if(!isset($data['text'])){
				$text = "Hello World!";
			}else{ $text = $data['text']; } 
			
			if(!isset($data['height'])){
				$height = 100;
			}else{ $height = $data['height']; } 
			
			if(!isset($data['width'])){
				$width = 200;
			}else{ $width = $data['width']; } 
			
			if(!isset($data['fontcolor'])){
				$fontcolor = "#000000";
			}else{ $fontcolor = "#".$data['fontcolor']; } 
			
			if(!isset($data['buttoncolor'])){
				$buttoncolor = "#666666";
			}else{ $buttoncolor = "#".$data['buttoncolor']; } 
			
			if(!isset($data['gradienttopcolor'])){
				$gradienttopcolor = "#a6c359";
			}else{ $gradienttopcolor = "#".$data['gradienttopcolor']; } 
			
			if(!isset($data['gradientbottomcolor'])){
				$gradientbottomcolor = "#567d1f";
			}else{ $gradientbottomcolor = "#".$data['gradientbottomcolor']; } 
			
			
			if(!isset($data['font'])){
				$font = "FunctionDisplay.otf";
			}else{ $font = $data['font']; } 
			
			
			if(!isset($data['fontpath'])){
				$fontpath = "rdata/fonts/";
			}else{ $fontpath = $data['fontpath']; } 
			
			if(!isset($data['fontsize'])){
				$fontsize = 20;
			}else{ $fontsize = $data['fontsize']; } 
			
			if(!isset($data['radius'])){
				$radius = 10;
			}else{ $radius = $data['radius']; } 
			
			
			if(!isset($data['imagepath'])){
				$path = $_SERVER['DOCUMENT_ROOT']."/images/generated_images/buttons/";
			}else{ $path = $data['imagepath']; } 
			
			
			/* Create a new Imagick object */
			$im = new Imagick();
			/* Create empty canvas */
			$im->newImage( $width, $height, "transparent", "png" );
			/* Create the object used to draw */
			$draw = new ImagickDraw();
			/* Set the button color.
			   Changing this value changes the color of the button */
			$draw->setFillColor($buttoncolor);
			/* Create the outer circle */
			$draw->roundRectangle( 0, 0, $width, $height,$radius,$radius);
			/* Create the smaller circle on the button */
			//$draw->setFillColor( "white" );
			///* Semi-opaque fill */
			//$draw->setFillAlpha( 0.2 );
			///* Draw the circle */
			//$draw->circle( 50, 50, 68, 68 );
			/* Set the font */
			$draw->setFont( $fontpath.$font );
			/* This is the alpha value used to annotate */
			$draw->setFillAlpha( 0.17 );
			/* Draw a curve on the button with 17% opaque fill */
			$draw->bezier( array(
								array( "x" => 10 , "y" => 25 ),
								array( "x" => 39, "y" => 49 ),
								array( "x" => 60, "y" => 55 ),
								array( "x" => 75, "y" => 70 ),
								array( "x" => 100, "y" => 70 ),
								array( "x" => 100, "y" => 10 ),
							 ) );
			/* Render all pending operations on the image */
			$im->drawImage( $draw );
			/* Set fill to fully opaque */
			$draw->setFillAlpha( 1 );
			/* Set the font size to 30 */
			$draw->setFontSize( $fontsize );
			/* The text on the */
			$draw->setFillColor( $fontcolor );
			
			$metrics = $im->queryFontMetrics($draw, $text);
			/* Annotate the text */
			$draw->setGravity (Imagick::GRAVITY_CENTER);
			$im->annotateImage( $draw, 0, 0, 0, $text);
			/* Trim extra area out of the image */
			$im->trimImage( 0 );
			/* Output the image */
			header( "Content-Type: image/png" );
			
			
			
			
			
			
			if(isset($data['gradient'])){
				$gradient = new Imagick();
				$gradient->newPseudoImage($width, $height, "gradient:".$gradienttopcolor."-".$gradientbottomcolor);
				/* Create a new Imagick object */
				$dummy = new Imagick();
				/* Create empty canvas */
				$dummy->newImage( $width, $height, "transparent", "png" );
				/* Create the object used to draw */
				$d = new ImagickDraw();
				/* Set the button color.
				   Changing this value changes the color of the button */
				$d->setFillColor($buttoncolor);
				/* Create the outer circle */
				$d->roundRectangle( 0, 0, $width, $height,$radius,$radius);
				$dummy->drawImage( $d );
				$dummy->compositeImage( $gradient, Imagick::COMPOSITE_OUT, 0, 0 );
				$im->compositeImage( $gradient, Imagick::COMPOSITE_OVER, 0, 0 );
				$dummy->compositeImage( $im, Imagick::COMPOSITE_OUT, 0, 0 );
				$d->setFont( $fontpath.$font );
				/* Set fill to fully opaque */
				$d->setFillAlpha( 1 );
				/* Set the font size to 30 */
				$d->setFontSize( $fontsize );
				/* The text on the */
				$d->setFillColor( $fontcolor );
				
				$metrics = $dummy->queryFontMetrics($d, $text);
				/* Annotate the text */
				$d->setGravity (Imagick::GRAVITY_CENTER);
				$dummy->annotateImage( $d, 0, 0, 0, $text);
				/* Trim extra area out of the image */
				$dummy->trimImage( 0 );
				
				$im = $dummy->clone();
				
				$gradient->destroy();
				$dummy->destroy();
			}
			
			
			
			
			
			
			if(isset($data['shadow'])){
				/* Clone the current object */
				$shadow = $im->clone();
				 
				/* Set image background color to black
						(this is the color of the shadow) */
				$shadow->setImageBackgroundColor( new ImagickPixel( 'black' ) );
				 
				/* Create the shadow */
				$shadow->shadowImage( 30, 1, 5, 5 );
				 
				/* Imagick::shadowImage only creates the shadow.
						That is why the original image is composited over it */
				$shadow->compositeImage( $im, Imagick::COMPOSITE_OVER, 0, 0 ); 
				
		
				/* Save image */
				$shadow->writeImage($path.md5(imageEncode($data)).'.png');
				$shadow->clear();
				$shadow->destroy(); /**/
			}else{
				$im->writeImage($path.md5(imageEncode($data)).'.png');
				$im->clear();
				$im->destroy(); /**/
			}

}

/*
}else{
 
	$canvas = new Imagick($cachefile);
	header("Content-Type: image/png");
	echo $canvas;
 
}
*/
?>