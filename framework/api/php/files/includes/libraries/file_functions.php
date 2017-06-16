<?
/*
Filename: file_functions.php
Purpose: this loads the utilities library that will hold the file functions that will be used in the site. 
*/
$error = '';

/*
Function: getExtension
Purpose: Accepts filename and returns its extension
*/
function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return strtolower($ext);
}


/*
Function: handle_upload
Purpose: Takes in a folder and an uploaded file handle and handles renaming, error checking, and saving of the file.  Returns the filename if it is successful.  

*/

function handle_upload($folder,$file,$id=''){
	global $error;
	$uploads_dir = $folder;
	$filename = $file['name'];
	$filename = cleanFileName($filename,getExtension($filename));
	if(file_exists($uploads_dir.strtolower($filename))){
			$filename = renameFile($uploads_dir,strtolower($filename));
	}
	$upload_directory = $uploads_dir.strtolower($filename);		
	$fsize = $file['size'];	
	if(checkFileSize($fsize) && acceptedExtension($filename) && matchedType($filename,$file['type'])){	
		$copied = move_uploaded_file($file['tmp_name'], $upload_directory);
	} else{
		$copied = false;
	}				
	if($copied){
		return  strtolower($filename);
	}
	else{
		$error = "File could not be copied";
		return false;
	}
}


/*
Function: handle_image_upload
Purpose: Takes in a folder and an uploaded file handle and handles renaming, error checking, and saving of the file.  Returns the filename if it is successful.  

*/

function handle_image_upload($folder,$file,$width=false,$height=false){
	global $error;
	$uploads_dir = $folder;
	$filename = $file['name'];
	resizeTmpImage($file['tmp_name'],$width,$height);
	
	$filename = cleanFileName($filename,getExtension($filename));
	if(file_exists($uploads_dir.strtolower($filename))){
			$filename = renameFile($uploads_dir,strtolower($filename));
	}	
	$upload_directory = $uploads_dir.strtolower($filename);	
	$fsize = $file['size'];	
	if(checkFileSize($fsize) && acceptedExtension($filename) && matchedType($filename,$file['type'])){	
		$copied = copy($file['tmp_name'], $upload_directory);
	} else{
		$copied = false;
	}				
	if($copied){
		return  strtolower($filename);
	}
	else{
		return false;
	}
}



/*
Function: cleanFileName
Purpose: Takes a filename and extension and returns the filename with all whitespace and non alphanumeric characters removed.
*/
function cleanFileName($filename,$ext = false){
	if(!$ext){
		$ext = getExtension($filename);
	}
	$my_new_string = preg_replace("/[^a-zA-Z0-9\s_]/", "", removeExtension($filename,$ext));

	$my_new_string = str_replace(" ","-",$my_new_string); 
	
	return $my_new_string.".$ext";
}



function renameFile($location,$filename,$i=1){
	$name = stripExtension($filename);
	$ext = getExtension($filename);
	$new_name = $name."-".$i.".".$ext;
	if(!file_exists($location.$new_name)){
		return $new_name;
	}
	else{
		return renameFile($location,$filename,$i+1);
	}
}

function stripExtension($str){
	 $i = strrpos($str,".");
	 if (!$i) { return ""; }
	 $name = substr($str,0,$i);
	 return $name;
}

function moveFile($from,$to,$file){
	if(!is_dir($to)){ mkdir($to); }
	
	$src = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR,DIRECTORY_SEPARATOR,$from.DIRECTORY_SEPARATOR.$file);

	if(file_exists($to.DIRECTORY_SEPARATOR.$file)){
		$f = renameFile($to,$file);		
		$dest = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR,DIRECTORY_SEPARATOR,$to.DIRECTORY_SEPARATOR.$f);
		return rename($src,$dest);
	}else{
		$dest = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR,DIRECTORY_SEPARATOR,$to.DIRECTORY_SEPARATOR.$file);
		return rename($src,$dest);
	}
}

function copyFile($from,$to,$file){
	if(!is_dir($to)){ mkdir($to); }
	
	$src = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR,DIRECTORY_SEPARATOR,$from.DIRECTORY_SEPARATOR.$file);

	if(file_exists($to.DIRECTORY_SEPARATOR.$file)){
		$f = renameFile($to,$file);		
		$dest = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR,DIRECTORY_SEPARATOR,$to.DIRECTORY_SEPARATOR.$f);
		return copy($src,$dest);
	}else{
		$dest = str_replace(DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR,DIRECTORY_SEPARATOR,$to.DIRECTORY_SEPARATOR.$file);
		return copy($src,$dest);
	}
}





function copyDirectory( $source, $target ) {
	if ( is_dir( $source ) ) {
		@mkdir( $target );
		$d = dir( $source );
		while ( FALSE !== ( $entry = $d->read() ) ) {
			if ( $entry == '.' || $entry == '..' ) {
				continue;
			}
			$Entry = $source . '/' . $entry; 
			if ( is_dir( $Entry ) ) {
				copyDirectory( $Entry, $target . '/' . $entry );
				continue;
			}
			copy( $Entry, $target . '/' . $entry );
		}
 
		$d->close();
	}else {
		copy( $source, $target );
	}
}



function moveDirectory( $source, $target ) {
	copyDirectory($source,$target);
	delete_directory($source.DIRECTORY_SEPARATOR);
}



/*
Function: removeExtension
Purpose: takes a filename and an extension and removes the extension from the file.
*/
function removeExtension($filename,$ext){
	return str_replace(".$ext","",$filename);
}





/*
Function: checkFileSize
Purpose: Takes file size and an optional max size parameter (in megabytes) and compares the two.  Returns true if size is less than maximum/


*/
function checkFileSize($size,$msize=19){
	global $error;
	$max = $msize* 1024 * 1024;	
	if($size < $max){
		return true;
	}
	else{
		$error = "Please keep all files under $msize MB";
		return false;
	}
}







/*
Function: acceptedExtension
Purpose: Checks the file extension versus a list of known and accepted extensions.
*/
function acceptedExtension($f){
	global $error;
	$ext = getExtension($f);
	switch($ext){
		case "txt":
		case "doc":
		case "docx":
		case "xls":
		case "xlsx":
		case "ppt":
		case "pdf":
		case "jpg":
		case "jpeg":
		case "png":
		case "gif":
			return true;
			break;
		default:
			$error = "This Extension is not accepted.";
			return false;
			break;
	}
}


/*
Function: isImage
Purpose: Checks the file extension versus a list of known and accepted extensions.
*/
function isImage($f){
	global $error;
	$ext = getExtension($f);
	switch($ext){
		case "jpg":
		case "jpeg":
		case "png":
		case "gif":
		case "tiff":
			return true;
			break;
		default:
			return false;
			break;
	}
}




/*
Function: matchedType;
Purpose: Takes in filename and mimetype and attempts to match the mimetype based on the filename
*/
function matchedType($name,$type){
	$ext = getExtension($name);
	$test = true;
	global $error;
	switch($ext){
		case "jpg":
		case "jpeg": 
			if($type == "image/jpeg" || $type == "image/pjpeg" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}
			break;
		case "png":
			if($type == "image/png" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}
			break;
		case "gif":
			if($type == "image/gif" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}
			$test = true;
			break;
		case "txt":
			 if($type == "text/plain" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}	
		case "doc":
			if($type == "application/msword" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}
			break;	
		case "docx":
			if($type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}
			break;			
		case "xls":
			if($type == "application/vnd.ms-excel" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}
			break;	
		case "xlsx":
			if($type == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}
			break;	
		case "ppt":
			if($type == "application/vnd.ms-powerpoint" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}
			break;	
		case "pptx":
			if($type == "application/vnd.openxmlformats-officedocument.presentationml.presentation" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}
			break;	
		case "pdf":
			if($type == "application/pdf" || $type == ''){
				$test = true;
			}
			else{
				$test = false;
			}
			break;	
		default:
			$test = false;
			break;
	}
	
	if(!$test){
		echo $type;
		$error = "The file type does not match its extension";
	}	
	return $test;
	
	
}

/*
.docm,application/vnd.ms-word.document.macroEnabled.12
.docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document
.dotm,application/vnd.ms-word.template.macroEnabled.12
.dotx,application/vnd.openxmlformats-officedocument.wordprocessingml.template
.potm,application/vnd.ms-powerpoint.template.macroEnabled.12
.potx,application/vnd.openxmlformats-officedocument.presentationml.template
.ppam,application/vnd.ms-powerpoint.addin.macroEnabled.12
.ppsm,application/vnd.ms-powerpoint.slideshow.macroEnabled.12
.ppsx,application/vnd.openxmlformats-officedocument.presentationml.slideshow
.pptm,application/vnd.ms-powerpoint.presentation.macroEnabled.12
.pptx,application/vnd.openxmlformats-officedocument.presentationml.presentation
.xlam,application/vnd.ms-excel.addin.macroEnabled.12
.xlsb,application/vnd.ms-excel.sheet.binary.macroEnabled.12
.xlsm,application/vnd.ms-excel.sheet.macroEnabled.12
.xlsx,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet
.xltm,application/vnd.ms-excel.template.macroEnabled.12
.xltx,application/vnd.openxmlformats-officedocument.spreadsheetml.template
*/


/*
Function: legalTypes
Purpose: Checks the file extension versus a list of known and accepted extensions.
*/
function legalTypes($f){
	global $error;
	$ext = getExtension($f);
	switch($ext){
		case "php":
		case "inc":
		case "html":
		case "htm":
		case "c":
		case "asp":
		case "aspx":
		case "vb":
		case "vbs":
		case "exe":
		case "bin":
		case "ps":
		case "rb":
		case "sql":
			return false;
			break;
		default:			
			return true;
			break;
	}
}



/*
Function: typeCipher
Purpose: Checks the file extension versus a list of known and accepted extensions.
*/
function typeCipher($f){
	global $error;
	$ext = getExtension($f);
	switch($ext){
		case "txt":
			return "Text Document";
			break;
		case "doc":
		case "docx":
			return "Microsoft Word Document";
			break;
		case "xls":
		case "xlsx":
			return "Microsoft Excel Document";
			break;
		case "ppt":
			return "Microsoft Power Point Document";
			break;
		case "pdf":
			return "Adobe PDF File";
			break;
		case "jpg":
		case "jpeg":
		case "png":
		case "gif":
			return "Image File";
			break;
		default:			
			return strtoupper($ext)." File";
			break;
	}
}



/*
Function: legalTypes
Purpose: Checks the file extension versus a list of known and accepted extensions.
*/
function fileFilter($arr){
	$output = array();
	
	if($arr){
		foreach($arr as $f){
			if(legalTypes($f)){
				$output[] = $f;
			}
		}
	}
	return $output;
}



/*
Function:  walk_directory
Purpose: Takes in a directory name and returns all files within the root of that directory
*/

function walk_directory($dirname, $verbose = FALSE){
   global $ds;
   $output = array();
   //echo $dirname."<br />";
   $dir_handle = false;
   if (is_dir($dirname)) { $dir_handle = opendir($dirname); }
   if (!$dir_handle) { return false; }
   
   while($file = readdir($dir_handle)) {
      if ($file != "." && $file != "..") {
         if(!$verbose){
			 if (!is_dir($dirname.$ds.$file)){
				$output[] = $file;
			 }   
		 }else{
		 	//echo $dirname.$ds.$file." ";
			//var_dump(is_dir($dirname.$ds.$file));
			//echo "<br />";
		 	if (!is_dir($dirname.$ds.$file)){
				$output['files'][] = $file;
			}else{
		 		$output['folders'][] = $file;
			}
		 }
      }
   }
   closedir($dir_handle);
   return $output;
}

function clear_directory($dirname) //Clears a directory contents, leaving the directory intact
{
   if (is_dir($dirname))
      $dir_handle = opendir($dirname);
   if (!$dir_handle)
      return false;
   while($file = readdir($dir_handle)) {
      if ($file != "." && $file != "..") {
         if (!is_dir($dirname.$ds.$file))
            unlink($dirname.$ds.$file);
         else
            delete_directory($dirname.'/'.$file);    
      }
   }
   closedir($dir_handle);
   return true;
}

function delete_directory($dirname) // Completely deletes a directory and its contents
{ 
   if (is_dir($dirname))
      $dir_handle = opendir($dirname);
   if (!$dir_handle)
      return false;
   while($file = readdir($dir_handle)) {
      if ($file != "." && $file != "..") {
         if (!is_dir($dirname.$ds.$file))
            unlink($dirname.$ds.$file);
         else
            delete_directory($dirname.'/'.$file);    
      }
   }
   closedir($dir_handle);
   rmdir($dirname);
   return true;
}

?>