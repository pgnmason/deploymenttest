<?
loadComponent("message");

class MLOMessage extends Message{
	
	function __construct($data = false,$subject=false){
		$this->subject = ($subject) ? $subject : "My Little Outback Order Confirmation";
		$this->sender = "no-reply@mylittleoutback.com";
		$this->sender_name = "My Little Outback Automated Confirmation";
		$this->email_list = array(Factory::getSystemEmail());
		parent::load($data);
	}
	
	function setConfirmation($order,$event){
		
		
		$this->email_list[] = $order->payer_email;
		$this->email_list[] = "mandawgus@gmail.com";
		$this->email_list[] = "party@mylittleoutback.com";
		$this->subject .= ":".$event->name." Confirmation";
		$message = "<p>Dear ".$event->customer_first_name.",</p>
<p>
Thank you for choosing My Little Outback for your special occasion. This e-mail confirms we have received your deposit for ".$event->child_name."'s birthday party, on ".date("l, F jS, Y",$event->date)." at ".date("g:i a",$event->date).".  You have successfully reserved the ".$event->name.".  </p>
<p>Please retain this e-mail for your records.</p>
<p>Order details are below.</p>";
		
		$message .= $this->orderDetails($order,$event);
		
		$message .= '


<p>
One of our party planners will give you a call the Wednesday before your child&#8217;s party, at the number you provided, to help plan your party and answer any questions you might have.  </p>
<p>
If you can&#8217;t seem to wait that long and want to start planning it sooner, call us at 412-325-1040 &lt;tel:412-325-1040&gt;  or e-mail &lt;<a href="mailto:party@mylittleoutback.com">mailto:party@mylittleoutback.com</a>&gt;  us Monday - Friday between 10am and 5pm.
 </p>
<p>
<p>FAQ: Party Planning Questions</p>
<p>
1.What party package do you want? If you have not chosen a party package please visit us online at www.mylittleoutback.com/party.html &lt;<a href="http://www.mylittleoutback.com/party.html">http://www.mylittleoutback.com/party.html</a>&gt; . Please choose 1 and let us know which package you would like.</p>
<p>
2.How many guests 12 and under are you going to invite? If you still do not know the exact number of guests by the Wednesday before your party, please provide an estimate and a count will be taken at the party. </p>
<p>
3.How many children are two and under? This will make it easier if party favors come with your package. Please remember that we count all children 12 and under as guests of the party.</p>
<p>
4.Will you want more food at the party &lt;<a href="http://mylittleoutback.com/party.html">http://mylittleoutback.com/party.html</a>&gt; ? A large pizza has 10 pieces. We estimate a child will only eat one slice, and an adult will eat 2 slices each. You can order more pizza, wings, chicken tenders, and/or salad, too. All our food is catered by Lucci&#8217;s Pizza &lt;<a href="http://www.urbanspoon.com/r/23/271005/restaurant/Squirrel-Hill-CMU/Luccis-Pizza-Pittsburgh">http://www.urbanspoon.com/r/23/271005/restaurant/Squirrel-Hill-CMU/Luccis-Pizza-Pittsburgh</a>&gt;  or Milky Way &lt;<a href="http://www.urbanspoon.com/r/23/271109/restaurant/Squirrel-Hill-CMU/Milky-Way-Pittsburgh">http://www.urbanspoon.com/r/23/271109/restaurant/Squirrel-Hill-CMU/Milky-Way-Pittsburgh</a>&gt;  on Murray Ave in Squirrel Hill. (Do not call restaurants directly.) Please visit our party page on our website for a complete list of food available for parties. Feel free to bring soft drinks, ice cream, cake, cupcakes, and decorations. </p>
<p>
5.What color tableware would you like? We only provide the child guests with plates, napkins, and forks. Extra tableware can be obtained for an additional price for the adults. Choose from Blue, Yellow, or Red, and if you like you can pick from our growing selection of themed tableware and party favors. Our list of themes &lt;<a href="http://mylittleoutback.com/party.html">http://mylittleoutback.com/party.html</a>&gt;  keeps growing so check back frequently to see what&#8217;s new.</p>
<p>
6.Would you like balloons? We can provide 6, 12, 18, or 24 latex balloons in a number of different colors. You can pick one color or mix and match. Ask a party planner for stocked color choices.    </p>
<p>
7.Where are you getting the birthday cake? We do not provide cakes or cupcakes at this time. There are many good bakeries in the area. If you would like a suggestion please feel free to give a party planner a call.</p>
<p>
8.Invitations? You package comes with invitations. Please feel free to pick them up at the caf&eacute; during normal business hours. We do not provide stamps, but a post office is close by if you need them.  </p>
<p>
9.How many adults are going to be at the party? Unfortunately, we have limited space. Please try to limit the number of adults as best you can. Adults take up much more room than children, so a party with 20 adults will take up 3 times the space as 20 children. </p>
<p>
10.  Can I bring my own food? No outside food other than Cake, Ice Cream, and Soda at parties. All food orders must be into MLO (do not call restaurants directly) by the Thursday before your party. Please order all food from My Little Outback.<br />
<br />
 <br />
<br />
We do not sell cakes or ice cream. To look at our food options please visit our websitehttp://mylittleoutback.com/party.html &lt;<a href="http://mylittleoutback.com/party.html">http://mylittleoutback.com/party.html</a>&gt; <br />
<br />
 <br />
<br />
What to expect the day of your party.
<p>
1.Please arrive for your party 30 min before your reservation. You can check in at the caf&eacute;. Once your room is available you will be escorted to one of three private party rooms to set up for your party.
<p>
2.As your guests arrive our associates will check your guests in at the caf&eacute; and provide each child with a nametag, and directions to the party room.
<p>
3.For the first 45-50 minutes your guests can use the play center or hang back in the private party room.
<p>
4.After the 45-50 minutes the food will arrive (add on for Silver Package) and your party can continue with food and cake.
<p>
5.After the allotted time your party will come to an end. Feel free to help clean the room or let your party planner do all the work.
<p>
	6.After the 1 &frac12; hours please vacate the room so we may set up for the next party.<br />
	<br />
Don&#8217;t see the answer you are looking for? Check out our website for a full list of frequency asked questions &lt;<a href="http://mylittleoutback.com/popup.html">http://mylittleoutback.com/popup.html</a>&gt; .
<p>
Deposit is non-refundable. Party can only be rescheduled up to two weeks (14 days) before reserved party. Please be on time for your party. We cannot extend your party if you are late.  A credit card or driver&#8217;s license is needed on file at start of party. Private party rooms are assigned based on size and time of party.
<p>
	My Little Outback<br />
	1936 Murray Ave<br />
	Pittsburgh, PA 15217<br />
	412-325-1040 &lt;tel:412-325-1040&gt; <br />
	www.mylittleoutback.com &lt;<a href="http://www.mylittleoutback.com/">http://www.mylittleoutback.com/</a>&gt;  </p>';
		
		$this->message = $message;
	}
	
	
	
	
	
	
	function setPreConfirmation($event){
		
		
		
		$this->email_list[] = $event->customer_email;
		$this->email_list[] = "mandawgus@gmail.com";
		$this->email_list[] = "party@mylittleoutback.com";
		$this->subject .= ":".$event->name." Confirmation";
		$message = "<p>Dear ".$event->customer_first_name.",</p>
<p>
Thank you for choosing My Little Outback for your special occasion. This e-mail confirms we have received your pre-registration for ".$event->child_name."'s birthday party, on ".date("l, F jS, Y",$event->date)." at ".date("g:i a",$event->date).".  Your registration for the  ".$event->name." is NOT COMPLETE!  You still need to pay your deposit through Paypal to confirm your registration.  If you receive this email after paying, please discard the last statement.</p>
<p>Please retain this e-mail for your records.</p>
<p>Order details are below.</p>";
		
		$message .= $this->orderDetails(NULL,$event);
		
		$message .= '


<p>
Once payment is received, you should receive another email confirming payment.  Once this is sent, your party registration is complete.  All unverified registrations shall be deleted after 24 hours.
 </p>
<p>FAQ: Party Planning Questions</p>
<p>
1.What party package do you want? If you have not chosen a party package please visit us online at www.mylittleoutback.com/party.html &lt;<a href="http://www.mylittleoutback.com/party.html">http://www.mylittleoutback.com/party.html</a>&gt; . Please choose 1 and let us know which package you would like.</p>
<p>
2.How many guests 12 and under are you going to invite? If you still do not know the exact number of guests by the Wednesday before your party, please provide an estimate and a count will be taken at the party. </p>
<p>
3.How many children are two and under? This will make it easier if party favors come with your package. Please remember that we count all children 12 and under as guests of the party.</p>
<p>
4.Will you want more food at the party &lt;<a href="http://mylittleoutback.com/party.html">http://mylittleoutback.com/party.html</a>&gt; ? A large pizza has 10 pieces. We estimate a child will only eat one slice, and an adult will eat 2 slices each. You can order more pizza, wings, chicken tenders, and/or salad, too. All our food is catered by Lucci&#8217;s Pizza &lt;<a href="http://www.urbanspoon.com/r/23/271005/restaurant/Squirrel-Hill-CMU/Luccis-Pizza-Pittsburgh">http://www.urbanspoon.com/r/23/271005/restaurant/Squirrel-Hill-CMU/Luccis-Pizza-Pittsburgh</a>&gt;  or Milky Way &lt;<a href="http://www.urbanspoon.com/r/23/271109/restaurant/Squirrel-Hill-CMU/Milky-Way-Pittsburgh">http://www.urbanspoon.com/r/23/271109/restaurant/Squirrel-Hill-CMU/Milky-Way-Pittsburgh</a>&gt;  on Murray Ave in Squirrel Hill. (Do not call restaurants directly.) Please visit our party page on our website for a complete list of food available for parties. Feel free to bring soft drinks, ice cream, cake, cupcakes, and decorations. </p>
<p>
5.What color tableware would you like? We only provide the child guests with plates, napkins, and forks. Extra tableware can be obtained for an additional price for the adults. Choose from Blue, Yellow, or Red, and if you like you can pick from our growing selection of themed tableware and party favors. Our list of themes &lt;<a href="http://mylittleoutback.com/party.html">http://mylittleoutback.com/party.html</a>&gt;  keeps growing so check back frequently to see what&#8217;s new.</p>
<p>
6.Would you like balloons? We can provide 6, 12, 18, or 24 latex balloons in a number of different colors. You can pick one color or mix and match. Ask a party planner for stocked color choices.    </p>
<p>
7.Where are you getting the birthday cake? We do not provide cakes or cupcakes at this time. There are many good bakeries in the area. If you would like a suggestion please feel free to give a party planner a call.</p>
<p>
8.Invitations? You package comes with invitations. Please feel free to pick them up at the caf&eacute; during normal business hours. We do not provide stamps, but a post office is close by if you need them.  </p>
<p>
9.How many adults are going to be at the party? Unfortunately, we have limited space. Please try to limit the number of adults as best you can. Adults take up much more room than children, so a party with 20 adults will take up 3 times the space as 20 children. </p>
<p>
10.  Can I bring my own food? No outside food other than Cake, Ice Cream, and Soda at parties. All food orders must be into MLO (do not call restaurants directly) by the Thursday before your party. Please order all food from My Little Outback.<br />
<br />
 <br />
<br />
We do not sell cakes or ice cream. To look at our food options please visit our websitehttp://mylittleoutback.com/party.html &lt;<a href="http://mylittleoutback.com/party.html">http://mylittleoutback.com/party.html</a>&gt; <br />
<br />
 <br />
<br />
What to expect the day of your party.
<p>
1.Please arrive for your party 30 min before your reservation. You can check in at the caf&eacute;. Once your room is available you will be escorted to one of three private party rooms to set up for your party.
<p>
2.As your guests arrive our associates will check your guests in at the caf&eacute; and provide each child with a nametag, and directions to the party room.
<p>
3.For the first 45-50 minutes your guests can use the play center or hang back in the private party room.
<p>
4.After the 45-50 minutes the food will arrive (add on for Silver Package) and your party can continue with food and cake.
<p>
5.After the allotted time your party will come to an end. Feel free to help clean the room or let your party planner do all the work.
<p>
	6.After the 1 &frac12; hours please vacate the room so we may set up for the next party.<br />
	<br />
Don&#8217;t see the answer you are looking for? Check out our website for a full list of frequency asked questions &lt;<a href="http://mylittleoutback.com/popup.html">http://mylittleoutback.com/popup.html</a>&gt; .
<p>
Deposit is non-refundable. Party can only be rescheduled up to two weeks (14 days) before reserved party. Please be on time for your party. We cannot extend your party if you are late.  A credit card or driver&#8217;s license is needed on file at start of party. Private party rooms are assigned based on size and time of party.
<p>
	My Little Outback<br />
	1936 Murray Ave<br />
	Pittsburgh, PA 15217<br />
	412-325-1040 &lt;tel:412-325-1040&gt; <br />
	www.mylittleoutback.com &lt;<a href="http://www.mylittleoutback.com/">http://www.mylittleoutback.com/</a>&gt;  </p>';
		
		$this->message = $message;
	
	}
	
	
	
	function orderDetails($order,$e){
		
		$c = new Cart($e->event_type);
		$c->food =unserialize($e->food);
		$c->theme = unserialize($e->theme);
		$c->addons = unserialize($e->addons);
		$c->attendants = $e->attendants;
		
		 $message = "<p><strong>Details</strong></p><br>";
		$skip = array("id","date","timeslot","location","food","addons","theme"); 
		foreach($e as $k=>$v){
			if(in_array($k,$skip)){ continue; }
			
			if($k == "event_type"){ 
				$v = getEventType($v)->name; 
			}
			$message .= "<p><strong>".ucwords(implode(" ",explode("_",$k))).":</strong> ".$v."</p>";
		}
		 $message .= "<br><br><p><strong>Food</strong></p><br>";
		foreach($c->food as $dish){
			$message .= "<p>".$dish->qty." <em> - ".ucwords(implode(" ",explode("_",$dish->name)))."</em> <strong>$".$dish->price ."</strong></p>";
		} 
		
		$message.="<p><strong>Total: $".$c->foodTotal()."</strong></p>";
		
		$message .= "<br><br><p><strong>Addons</strong></p><br>";
		
		foreach($c->addons as $dish){
			$message .= "<p>".$dish->qty." <em> - ".ucwords(implode(" ",explode("_",$dish->name)))."</em> <strong>$".$dish->price ."</strong></p>";
		} 
		
		$message.="<p><strong>Total: $".$c->addonTotal()."</strong></p>";
		
		
		
		if(is_object($c->theme)){
			$message .= "<p><strong>Theme: </strong>".ucwords(implode(" ",explode("_",$c->theme->name )))."</p>";
		}else{ $c->theme =NULL; }
		
		 $message .= "<br><br><p><strong>Totals</strong></p><br>";
		
$message .= "<p><strong>Food:</strong> $".$c->foodTotal()."</p>";
$message .= "<p><strong>Add Ons:</strong> $".$c->addonTotal()."</p>";
$message .= "<p><strong>Theme:</strong> $".$c->themeTotal()."</p>";
$message .= "<p><strong>Extra Child Cost:</strong> $".($c->baseTotal() - $c->event_type->price)."</p>";
$message .= "<p><strong>Party Base Cost:</strong> $".$c->event_type->price."</p>";
$message .= "<p><strong>GRAND TOTAL:</strong> $".$c->total()."</p>";
		
		
		return $message;
	}
	
	
	
	
	
	
	
}







?>
