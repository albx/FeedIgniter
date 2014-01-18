<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed_rss20 extends CI_Driver{
	protected $xml;
	protected $channel;
	
	protected $CI;
	
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->helper("text");
		$this->CI->load->helper("xml");
		
		$this->xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\"?><rss version=\"2.0\"></rss>");
		$this->channel = $this->xml->addChild("channel");
	}
	
	/**
	*	Add the title tag to the rss feed
	*	@params string
	*	@access public
	*	@return object
	*/
	public function add_title($title){
		$this->channel->addChild("title", xml_convert($title));
		
		return $this;
	}
	
	/**
	*	Add the description tag to the rss feed
	*	@params string
	*	@access public
	*	@return object
	*/
	public function add_description($description){
		$this->channel->addChild("description", xml_convert($description));
		
		return $this;
	}
	
	/**
	*	Add the link tag to the rss feed
	*	@params string
	*	@access public
	*	@return object
	*/
	public function add_link($link){
		$this->channel->addChild("link", $link);
		
		return $this;
	}
	
	public function add_language($language){
		$this->channel->addChild("language", $language);
		
		return $this;
	}
	
	public function add_copyright($copyright){
		$this->channel->addChild("copyright", $copyright);
		
		return $this;
	}
	
	public function add_managingEditor($managing_editor){
		$this->channel->addChild("managingEditor", $managing_editor);
		
		return $this;
	}
	
	public function add_webMaster($webmaster){
		$this->channel->addChild("webMaster", $webmaster);
	}
	
	public function add_pubDate($pub_date){
		$this->channel->addChild("pubDate", $pub_date);
		
		return $this;
	}
	
	public function add_lastBuildDate($last_build_date){
		$this->channel->addChild("lastBuildDate", $last_build_date);
		
		return $this;
	}
	
	public function add_category($category){
		$this->channel->addChild("category", $category);
		
		return $this;
	}
	
	public function add_generator($generator){
		$this->channel->addChild("generator", $generator);
		
		return $this;
	}
	
	public function add_docs($docs){
		$this->channel->addChild("docs", $docs);
		
		return $this;
	}
	
	/*public function add_cloud($cloud){
	}*/
	
	public function add_ttl($ttl){
		$this->channel->addChild("ttl", $ttl);
		
		return $this;
	}
	
	/*public function add_image($image){
	}*/
	
	public function add_rating($rating){
		$this->channel->addChild("rating", $rating);
		
		return $this;
	}
	
	/*public function add_textInput($text_input){
	}*/
	
	public function add_skipHours($skip_hours){
		$skip_hours_tag = $this->channel("skipHours");
		foreach($skip_hours as $hour){
			$skip_hours_tag->addChild("hour", $hour);
		}
		
		return $this;
	}
	
	public function add_skipDays($skip_days){
		$skip_days_tag = $this->channel->addChild("skipDays");
		foreach($kip_days as $day){
			$skip_days_tag->addChild("day", $day);
		}
		
		return $this;
	}
	
	/**
	*	Add an item tag to the rss feed
	*	@params array
	*	@access public
	*	@return object
	*/
	public function add_item($item){
		$item_tag = $this->channel->addChild("item");
		
		if(array_key_exists("title", $item))
			$this->add_item_title($item_tag, $item["title"]);
			
		if(array_key_exists("link", $item))
			$this->add_item_link($item_tag, $item["link"]);
		
		if(array_key_exists("description", $item))
			$this->add_item_description($item_tag, $item["description"]);
			
		if(array_key_exists("author", $item))
			$this->add_item_author($item_tag, $item["author"]);
			
		if(array_key_exists("category", $item))
			$this->add_item_category($item_tag, $item["category"]);
			
		if(array_key_exists("comments", $item))
			$this->add_item_comments($item_tag, $item["comments"]);
		
		if(array_key_exists("enclosure", $item))
			$this->add_item_enclosure($item_tag, $item["enclosure"]);
			
		if(array_key_exists("guid", $item))
			$this->add_item_guid($item_tag, $item["guid"]);
		
		if(array_key_exists("pubDate", $item))
			$this->add_item_pubDate($item_tag, $item["pubDate"]);
			
		if(array_key_exists("source", $item))
			$this->add_item_source($item_tag, $item["source"]);
		
		return $this;
	}
	
	/**
	*	Returns the rss feed as an xml string
	*	@access public
	*	@return string
	*/
	public function get(){
		return $this->xml->asXML();
	}
	
	/******************** PROTECTED FUNCTIONS ********************/
	
	protected function add_item_title($item, $title){
		$item->addChild("title", xml_convert($title));
	}
	
	protected function add_item_link($item, $link){
		$item->addChild("link", $link);
	}
	
	protected function add_item_description($item, $description){
		$item->addChild("description", xml_convert($description));
	}
	
	protected function add_item_author($item, $author){
		$item->addChild("author", xml_convert($author));
	}
	
	protected function add_item_category($item, $category){
		$item->addChild("category", $category);
	}
	
	protected function add_item_comments($item, $comments){
		$item->addChild("comments", $comments);
	}
	
	protected function add_item_enclosure($item, $enclosure){
		$enclosure_tag = $item->addChild("enclosure");
		foreach($enclosure as $key=>$value){
			$enclosure_tag->addAttribute($key, $value);
		}
	}
	
	protected function add_item_guid($item, $guid){
		$item->addChild("guid", $guid);
	}
	
	protected function add_item_pubDate($item, $pub_date){
		$item->addChild("pubDate", $pub_date);
	}
	
	protected function add_item_source($item, $source){
		$source_tag = $item->addChild("source", xml_convert($source["value"]));
		$source_tag->addAttribute("url", $source["url"]);
	}
}

// END Feed_rss20 class

/* End of file Feed_rss20.php */
/* Location: ./application/libraries/Feed/Feed_rss20.php */