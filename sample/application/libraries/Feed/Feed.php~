<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed extends CI_Driver_Library{
	protected $valid_drivers = array("feed_rss20", "feed_atom10");
	
	/**
	*	Specify the content type of the page, depending on the feed type
	*	@access protected
	*/
	protected $content_type;
	
	/**
	*	Specify the current feed type
	*	@access protected
	*/
	protected $feed;
	
	function __construct($config=array()){
		if(!empty($config)){
			$this->initialize($config);
		}
	}
	
	/**
	*	Create a Rss 2.0 instance.
	*	@access public
	*	@return object a Rss 2.0 instance
	*/
	public function rss20(){
		$this->initialize(array("feed" => "rss20"));
		
		return $this->feed();
	}
	
	/**
	*	Create an Atom 1.0 instance.
	*	@access public
	*	@return object an Atom 1.0 instance
	*/
	public function atom10(){
		$this->initialize(array("feed" => "atom10"));
		
		return $this->feed();
	}
	
	/**
	*	Display the feed
	*	@access public
	*	@return void
	*/
	public function view(){
		header($this->content_type);
		echo $this->{$this->feed}->get();
	}
	
	/**
	*	Get the instance of the current feed loaded
	*	@access public
	*	@return object the current feed's instance
	*/
	public function feed(){
		if(empty($this->feed) or !$this->is_valid_feed($this->feed))
			return NULL;
			
		return $this->{$this->feed};
	}
	
	/****************************** Protected functions ******************************/
	
	/**
	*	Initialize the class configuration and sets feed and content type
	*	@access protected
	*	@param array the configuration array
	*	@return void
	*/
	protected function initialize($config){
		if($this->is_valid_feed($config["feed"])){
			$this->set_content_type($config["feed"]);
			$this->feed = $config["feed"];
		}
	}
	
	/**
	*	Check if the feed passed is amoung the valid feed
	*	@access protected
	*	@param string the feed type to check
	*	@return bool TRUE if the feed type is valid, FALSE otherwise
	*/
	protected function is_valid_feed($feed){
		foreach($this->valid_drivers as $driver){
			if($driver == "feed_".$feed){
				return TRUE;
			}
		}
		
		return FALSE;
	}
	
	/**
	*	Set the content type based on the feed type passed
	*	@access protected
	*	@param string the feed type
	*	@return void
	*/
	protected function set_content_type($feed){
		switch($feed){
			case "rss20":
				$this->content_type = "Content-Type: application/rss+xml";
				break;
			case "atom10":
				$this->content_type = "Content-Type: application/atom+xml";
				break;
		}
	}
}

// END Feed class

/* End of file Feed.php */
/* Location: ./application/libraries/Feed/Feed.php */