<?php
/**
* Calendar Generation Class
*
* This class provides a simple reuasable means to produce month calendars in valid html
*
* @version 2.8
* @author Jim Mayes <jim.mayes@gmail.com>
* @link http://style-vs-substance.com
* @copyright Copyright (c) 2008, Jim Mayes
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.txt GPL v2.0
*/

class Calendar{
	var $date;
	var $year;
	var $month;
	var $day;
	
	var $week_start_on = FALSE;
	var $week_start = 7;// sunday
	
	var $link_days = TRUE;
	var $link_to;
	var $formatted_link_to;
	
	var $mark_today = TRUE;
	var $today_date_class = 'today';
	
	var $mark_selected = TRUE;
	var $selected_date_class = 'selected';
	
	var $mark_passed = TRUE;
	var $passed_date_class = 'passed';
	
	var $highlighted_dates;
	var $default_highlighted_class = 'highlighted';
	
	var $month_links = false; // NATE EDIT
	var $day_header_format = "letter";  // NATE EDIT
	var $next_month_text = "Next Month";
	var $last_month_text = "Last Month";
	var $set_day_as_class = true;
	
	/* CONSTRUCTOR */
	function Calendar($date = NULL, $year = NULL, $month = NULL){
		$self = htmlspecialchars($_SERVER['PHP_SELF']);
		$this->link_to = $self;
		
		if( is_null($year) || is_null($month) ){
			if( !is_null($date) ){
				//-------- strtotime the submitted date to ensure correct format
				$this->date = date("Y-m-d", strtotime($date));
			} else {
				//-------------------------- no date submitted, use today's date
				$this->date = date("Y-m-d");
			}
			$this->set_date_parts_from_date($this->date);
		} else {
			$this->year		= $year;
			$this->month	= str_pad($month, 2, '0', STR_PAD_LEFT);
		}	
	}
	
	function set_date_parts_from_date($date){
		$this->year		= date("Y", strtotime($date));
		$this->month	= date("m", strtotime($date));
		$this->day		= date("d", strtotime($date));
	}
	
	
	
	
	function day_of_week($date){
		$day_of_week = date("N", $date);
		if( !is_numeric($day_of_week) ){
			$day_of_week = date("w", $date);
			if( $day_of_week == 0 ){
				$day_of_week = 7;
			}
		}
		//var_dump($day_of_week);
		return (int) $day_of_week; // NATE EDIT
	}
	/****** NATE EDIT  *********/
	
	function day_name($localized_day_name){
		
		switch($this->day_header_format){
			case "letter":
				return $localized_day_name{0};
				break;
			case "abbrev":
				return strtoupper(substr($localized_day_name,0,3));
				break;
			case "full":
				return ucwords($localized_day_name);
				break;
		}
	}
	
	function output_calendar($year = NULL, $month = NULL, $calendar_class = 'calendar'){
		
		if( $this->week_start_on !== FALSE ){
			echo "The property week_start_on is replaced due to a bug present in version before 2.6. of this class! Use the property week_start instead!";
			exit;
		}
		
		//--------------------- override class methods if values passed directly
		$year = ( is_null($year) )? $this->year : $year;
		$month = ( is_null($month) )? $this->month : str_pad($month, 2, '0', STR_PAD_LEFT);
	
		//------------------------------------------- create first date of month
		$month_start_date = strtotime($year . "-" . $month . "-01");
		$last_month_start_date = strtotime($year."-".($month-1)."-01"); // NATE EDIT
		//------------------------- first day of month falls on what day of week
		$first_day_falls_on = $this->day_of_week($month_start_date);
		//----------------------------------------- find number of days in month
		$days_in_month = date("t", $month_start_date);
		//-------------------------------------------- create last date of month
		$month_end_date = strtotime($year . "-" . $month . "-" . $days_in_month);
		$next_month_start_date = mktime(0,0,0,$month+1,1,$year);//strtotime($year."-".($month+1)."-01"); // NATE EDIT
		
		//----------------------- calc offset to find number of cells to prepend
		$start_week_offset = $first_day_falls_on - $this->week_start;
		
		$prepend = ( $start_week_offset < 0 )? 7 - abs($start_week_offset) : $first_day_falls_on - $this->week_start;
		
		/*var_dump($start_week_offset);
		echo "<br />";
		var_dump($first_day_falls_on);
		echo "<br />";
		var_dump($this->week_start);
		echo "<br />";
		
		var_dump($prepend);
		echo "<br />";*/
		
		//-------------------------- last day of month falls on what day of week
		$last_day_falls_on = $this->day_of_week($month_end_date);
		//------------------------------------------------- start table, caption
		$output  = "";//NATE EDIT
		
		
		/******** NATE EDIT ********/
		$pos = strpos("?",$this->link_to);
		if($pos === false){
			$connector = "?";
		}else{
			$connector = "&";
		}
		
		
		if($this->month_links){
			$output .= "<div id='calendar_header'>"."<a href=\"" . $this->link_to .$connector. "startmonth=" . $last_month_start_date . "\" class=\"last_month\">" .$this->last_month_text. "</a>". ucfirst(strftime("%B %Y", $month_start_date)) ."<a href=\"" . $this->link_to .$connector. "startmonth=" . $next_month_start_date . "\" class=\"next_month\">" .$this->next_month_text. "</a>". "</div>\n";
		}else{
			$output .= "<div id='calendar_header'>" . ucfirst(strftime("%B %Y", $month_start_date)) . "</div>\n";
		}
		
		$output .= "<div id='calendar_body'>";
		
		$output  .= "<table class=\"" . $calendar_class . "\" cellspacing=\"0\">\n";
		
		$col = '';
		$th = '';
		for( $i=1,$j=$this->week_start,$t=(3+$this->week_start)*86400; $i<=7; $i++,$j++,$t+=86400 ){
			$localized_day_name = gmstrftime('%A',$t);
			$col .= "<col class=\"" . strtolower($localized_day_name) ."\" />\n";
			$th .= "\t<th title=\"" . ucwords($localized_day_name) ."\">" . $this->day_name($localized_day_name)."</th>\n";  //NATE EDIT
			$j = ( $j == 7 )? 0 : $j;
		}
		
		//------------------------------------------------------- markup columns
		$output .= $col;
		
		//----------------------------------------------------------- table head
		$output .= "<thead>\n";
		$output .= "<tr>\n";
		
		$output .= $th;
		
		$output .= "</tr>\n";
		$output .= "</thead>\n";
		
		//---------------------------------------------------------- start tbody
		$output .= "<tbody>\n";
		$output .= "<tr>\n";
		
		//---------------------------------------------- initialize week counter
		$weeks = 1;
		
		//--------------------------------------------------- pad start of month
		
		//------------------------------------ adjust for week start on saturday
		for($i=1;$i<=$prepend;$i++){
			$output .= "\t<td class=\"pad cell-$i\">&nbsp;</td>\n";
		}
		
		//--------------------------------------------------- loop days of month
		for($day=1,$cell=$prepend+1; $day<=$days_in_month; $day++,$cell++){
			
			/*
			if this is first cell and not also the first day, end previous row
			*/
			//echo "$cell == $day<br />"; //NATE EDIT
			if( $cell == 1 && $day != 1 ){
				$output .= "<tr>\n";
			}
			
			//-------------- zero pad day and create date string for comparisons
			$day = str_pad($day, 2, '0', STR_PAD_LEFT);
			$day_date = $year . "-" . $month . "-" . $day;
			
			/***************** NATE EDIT *************/
			if($this->set_day_as_class){
				$localized_day_name = gmstrftime('%A',strtotime($day_date));
				$classes[] = $this->day_name($localized_day_name);
			}
			
			
			
			//-------------------------- compare day and add classes for matches
			if( $this->mark_today == TRUE && $day_date == date("Y-m-d") ){
				$classes[] = $this->today_date_class;
			}
			
			if( $this->mark_selected == TRUE && $day_date == $this->date && (strtotime($day_date)+86399) >= time()){ // NATE EDIT - ADDED LAST CONDITIONAL
				$classes[] = $this->selected_date_class;
			}
			
			if( $this->mark_passed == TRUE && $day_date < date("Y-m-d") ){
				$classes[] = $this->passed_date_class;
			}
			
			if( is_array($this->highlighted_dates) ){
				if( in_array($day_date, $this->highlighted_dates) ){
					$classes[] = $this->default_highlighted_class;
				}
			}
			
			//----------------- loop matching class conditions, format as string
			if( isset($classes) ){
				$day_class = ' class="';
				foreach( $classes AS $value ){
					$day_class .= $value . " ";
				}
				$day_class = substr($day_class, 0, -1) . '"';
			} else {
				$day_class = '';
			}
			
			//---------------------------------- start table cell, apply classes
			// detect windows os and substitute for unsupported day of month modifer
			$title_format = (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN')? "%A, %B %#d, %Y": "%A, %B %e, %Y";
			
			$output .= "\t<td" . $day_class . " title=\"" . ucwords(strftime($title_format, strtotime($day_date))) . "\">";
			
			//----------------------------------------- unset to keep loop clean
			unset($day_class, $classes);
			
			//-------------------------------------- conditional, start link tag 
			switch( $this->link_days ){
				case 0 :
					$output .= $day;
				break;
				
				case 1 :
					if( empty($this->formatted_link_to) ){
						$output .= "<a href=\"" . $this->link_to .$connector. "date=" . $day_date . "\">" . $day . "</a>";
					} else {
						$output .= "<a href=\"" . strftime($this->formatted_link_to, strtotime($day_date)) . "\">" . $day . "</a>";
					}
				break;
				
				case 2 :
					if( is_array($this->highlighted_dates) ){
						if( in_array($day_date, $this->highlighted_dates) ){
							if( empty($this->formatted_link_to) ){
								$output .= "<a href=\"" . $this->link_to .$connector. "date=" . $day_date . "\">";
							} else {
								$output .= "<a href=\"" . strftime($this->formatted_link_to, strtotime($day_date)) . "\">";
							}
						}
					}
					
					$output .= $day;
					
					if( is_array($this->highlighted_dates) ){
						if( in_array($day_date, $this->highlighted_dates) ){
							if( empty($this->formatted_link_to) ){
								$output .= "</a>";
							} else {
								$output .= "</a>";
							}
						}
					}
				break;
			}
			
			//------------------------------------------------- close table cell
			$output .= "</td>\n";
			
			//------- if this is the last cell, end the row and reset cell count
			if( $cell == 7 ){
				$output .= "</tr>\n";
				$cell = 0;
			}
			
		}
		
		//----------------------------------------------------- pad end of month
		if( $cell > 1 ){
			for($i=$cell;$i<=7;$i++){
				$output .= "\t<td class=\"pad cell-$i\">&nbsp;</td>\n";
			}
			$output .= "</tr>\n";
		}
		
		//--------------------------------------------- close last row and table
		$output .= "</tbody>\n";
		$output .= "</table>\n</div>\n";
		
		$output .= "<div id='calendar_foot'></div>";
		
		//--------------------------------------------------------------- return
		return $output;
		
	}
	
}
?>