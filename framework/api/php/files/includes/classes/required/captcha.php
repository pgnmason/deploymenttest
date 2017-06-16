<?

class Captcha extends Object{



	function render($type = "math"){
		
		switch($type){
			case "math":
				return Captcha::mathCaptcha();
				break;
			case "slide":
				return Captcha::slideCaptcha();
				break;
			case "image":
				return Captcha::imageCaptcha();
				break;
			default:
				return Captcha::mathCaptcha();
				break;
		}
		
	}
	
	
	
	function mathCaptcha(){
		$numbers = array("ZERO","ONE","TWO","THREE","FOUR","FIVE","SIX","SEVEN","EIGHT","NINE","TEN");
		$operations = array("PLUS","MINUS","MULTIPLIED BY");
		
		
		$first_num = rand(0,10);
		$last_num = rand(0,10);
		$operation = rand(0,2);
		
		
		$string = $numbers[$first_num]." ".$operations[$operation]." ".$numbers[$last_num];
		
		switch($operation){
			case 0:
				$answer = $first_num + $last_num;
				break;
			case 1:
				$answer = $first_num - $last_num;
				break;
			case 2:
				$answer = $first_num * $last_num;
				break;

		}
		
		
		$output = array($string,$answer);
		
		
		return $output;	
		
	}




}

?>