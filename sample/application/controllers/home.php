<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		//$this->load->driver("feed");
		$this->load->helper("url");
	}
	
	public function index(){
		$this->load->driver("feed");
		
		$this->feed->rss20()
									->add_title("Prova rss CI")
						 			->add_description("Questa è una prova di feed RSS creato da una lib CI")
						 			->add_link(site_url());
		
		$this->feed->view();
	}
	
	public function atom(){
		$this->load->driver("feed");
		
		$this->feed->atom10()
									->add_title("Prova Atom")
									->add_subtitle("Questa è una prova di feed atom")
									->add_entry(array(
										"id" => uniqid(),
										"title" => "Prova entry 1"
									))
									->add_entry(array(
										"id" => uniqid(),
										"title" => "Prova entry 2"
									));
		
		$this->feed->view();
	}
	
	public function feed_with_init(){
		$this->load->driver("feed", array("feed" => "rss20"));
		$this->feed->feed()
									->add_title("Prova rss CI")
						 			->add_description("Questa è una prova di feed RSS creato da una lib CI")
						 			->add_link(site_url());
		
		$this->feed->view();
	}
}
?>