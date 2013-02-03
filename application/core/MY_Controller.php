<?php 

/**
* 
*/
class MY_Controller extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$this->load->spark('Twiggy/0.8.5');
	}

}