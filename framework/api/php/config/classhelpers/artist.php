<?
class Artist extends Object{
	
	
	function load($arr){
		parent::load($arr);
		$this->name = $this->artist;
		$this->tracks = $this->loadTracks();
		$this->trackcount = count($this->tracks);
		$this->aggregateRatings();
	}
	
	function loadTracks(){
		$db = Factory::getDBO();
		$db->setQuery("select f.*, c.name as genre_name from flytunes as f, music_categories as c where f.genre = c.id and artist like '".$db->sanitize($this->name)."'");
		return $db->loadObjectList();
	}
	
	function aggregateRatings(){
		$this->likes = 0;
		$this->dislikes = 0;
		$this->listens = 0;
		
		foreach($this->tracks as $a){
			$this->likes += $a->likes;
			$this->dislikes += $a->dislikes;
			$this->plays += $a->plays;
		}
		
		if(($this->likes + $this->dislikes) == 0){ 
			$this->rating = .5;
		}else{
			$this->rating = $this->likes/($this->likes+$this->dislikes);
		}
		
	}

	
}
?>