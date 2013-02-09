<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Using base controller for admin area
require_once(APPPATH.'core/MY_Admin.php');

class Portfolios extends MY_Admin
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('portfolio');
	}

	public function get_index()
	{
		$portfolio = new Portfolio;
		$portfolio->auth( Staff::current() );

	}
}