<?php 
class Party extends Object{
	var $id = NULL;
	var $name = NULL;
	var $date = NULL;
	var $timeslot = NULL;
	var $order = NULL;
	
	
	
	
	
	function __construct($id = false, $cart = false,$order = false){
		if(!$id ){ 
			if($cart){
				$this->event_type = $cart->event_type->id;
				$this->name = $cart->event_type->name;
				$this->date = strtotime($cart->date." ".date("g:i:s a",$cart->timeslot));
				$this->timeslot = $cart->timeslot; 
				$this->food = serialize($cart->food);
				$this->addons = serialize($cart->addons);
				$this->theme = serialize($cart->theme);
				$this->attendants = $cart->attendants;
				if(isset($cart->child_name)){ $this->child_name = $cart->child_name; }
				if(isset($cart->child_age)){ $this->child_age = $cart->child_age; }
			}
			if($order){
				$this->id = (isset($cart->pre_id)) ? $cart->pre_id : $order->txn_id;
				$this->order = $order->txn_id;
				$this->customer_first_name = $order->first_name;
				$this->customer_last_name = $order->last_name;
				$this->customer_email = $order->payer_email;
				
			}else if(isset($cart->pre_id)){
				$this->id = $cart->pre_id;
				$this->payment_status = "PENDING";
				$this->customer_first_name = $cart->customer_first_name;
				$this->customer_last_name = $cart->customer_last_name;
				$this->customer_email = $cart->customer_email;
				$this->customer_phone = $cart->customer_phone;
				if(isset($cart->child_name)){ $this->child_name = $cart->child_name; }
				if(isset($cart->child_age)){ $this->child_age = $cart->child_age; }
			}
		}else{
			$this->load(getParty($id));
		}
	}
}

/*
	
CART


[event_type] => Object Object
        (
            [id] => 3
            [name] => Diamond Package
            [padding] => 7
            [details] => 

1 ½ hour party • 15 guests ($14.50 per extra child) • Party Favor Bags • 2 Large Pizzas • Juice & Snacks for the kids • Tableware for the kids (plates,utensils & napkins) • 1 Dozen Latex Balloons • Choice of Theme • Special MLO T-shirt for the birthday boy or girl

            [price] => 360
            [guests] => 15
            [guest_cost] => 14.5
            [has_theme] => 1
        )

    [food] => Array
        (
            [0] => Object Object
                (
                    [id] => 34
                    [name] => Wings - Hot (50 pieces)
                    [price] => 24.95
                    [qty] => 1
                )

            [1] => Object Object
                (
                    [id] => 32
                    [name] => Penne w/ Vodka Sauce - Large (serves 15-20)
                    [price] => 65
                    [qty] => 1
                )

        )

    [addons] => Array
        (
            [0] => Object Object
                (
                    [id] => 42
                    [name] => Fruit Snacks & Juice Boxes (for 15 children)
                    [price] => 14.99
                    [qty] => 1
                )

        )

    [theme] => Object Object
        (
            [id] => 10
            [name] => Fire Engine
            [image] => 
        )

    [attendants] => 14
    [timeslot] => 1307545200
    [date] => 2011-06-30
	
*/