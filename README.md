FeedIgniter is a simple CodeIgniter (version 2.1.4) library to manage RSS 2.0 and Atom 1.0 Feed.

All classes are in the src/ folder.

To make it works put all the Feed/ folder in the applications/libraries and then load it in your controller using:

	$this->load->driver("feed");
	
You can use rss 2.0 driver or atom 1.0 driver calling the following functions:
	
	$this->feed->rss20()
	$this->feed->atom10()
	
Or you can set your feed driver using this syntax:

	$this->load->driver("feed", array("feed" => "rss20"));	// to load rss 2.0
	$this->load->driver("feed", array("feed" => "atom10"));	// to load atom 1.0
	
and then using the feed() function to access to all the driver's methods

	$this->feed->feed()
	
To view the feed use the view() function:
	
	$this->feed->view()
	

You will find some samples in the sample/ folder.