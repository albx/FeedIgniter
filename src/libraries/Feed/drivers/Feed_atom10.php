<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feed_atom10 extends CI_Driver{
	protected $xml;
	
	protected $CI;
	
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->helper("text");
		$this->CI->load->helper("xml");
		
		$this->xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"utf-8\"?><feed xmlsn=\"http://www.w3.org/2005/Atom\"></feed>");
	}
	
	public function add_id($id){
		$this->xml->addChild("id", $id);
		
		return $this;
	}
	
	public function add_title($title){
		$this->xml->addChild("title", xml_convert($title));
		
		return $this;
	}
	
	public function add_subtitle($subtitle){
		$this->xml->addChild("subtitle", xml_convert($subtitle));
		
		return $this;
	}
	
	public function add_link($link){
		$this->xml->addChild("link")->addAttribute("href", $link);
		
		return $this;
	}
	
	public function add_updated($updated){
		$this->xml->addChild("updated", $updated);
		
		return $this;
	}
	
	public function add_author($author){
		$author_tag = $this->xml->addChild("author");
		
		if(array_key_exists("name", $author))
			$this->add_author_name($author_tag, $author["name"]);
		if(array_key_exists("email", $author))
			$this->add_author_email($author_tag, $author["email"]);
		
		return $this;
	}
	
	public function add_entry($entry){
		$entry_tag = $this->xml->addChild("entry");
		
		if(array_key_exists("id", $entry))
			$this->add_entry_id($entry_tag, $entry["id"]);
		if(array_key_exists("title", $entry))
			$this->add_entry_title($entry_tag, $entry["title"]);
		if(array_key_exists("link", $entry))
			$this->add_entry_link($entry_tag, $entry["link"]);
		if(array_key_exists("updated", $entry))
			$this->add_entry_updated($entry_tag, $entry["updated"]);
		if(array_key_exists("summary", $entry))
			$this->add_entry_summary($entry_tag, $entry["summary"]);
		
		return $this;
	}
	
	/**
	*	Returns the atom feed as an xml string
	*	@access public
	*	@return string
	*/
	public function get(){
		return $this->xml->asXML();
	}
	
	/******************** PROTECTED FUNCTIONS ********************/
	
	protected function add_author_name($author_tag, $name){
		$author_tag->addChild("name", xml_convert($name));
	}
	
	protected function add_author_email($author_tag, $email){
		$author_tag->addChild("email", $email);
	}
	
	protected function add_entry_id($entry_tag, $id){
		$entry_tag->addChild("id", $id);
	}
	
	protected function add_entry_title($entry_tag, $title){
		$entry_tag->addChild("title", xml_convert($title));
	}
	
	protected function add_entry_link($entry_tag, $link){
		$entry_tag->addChild("link")->addAttribute("href", $link);
	}
	
	protected function add_entry_updated($entry_tag, $updated){
		$entry_tag->addChild("updated", $updated);
	}
	
	protected function add_entry_summary($entry_tag, $summary){
		$entry_tag->addChild("summary", xml_convert($summary));
	}
}

// END Feed_atom10 class

/* End of file Feed_atom10.php */
/* Location: ./application/libraries/Feed/Feed_atom10.php */