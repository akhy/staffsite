<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Using base controller for admin area
require_once(APPPATH.'core/MY_Admin.php');

class Home extends MY_Admin
{

	/**
	 * GET: admin/index 
	 */
	public function get_index()
	{
		$articles = Staff::current()->top_articles();

		$twiggy = $this->view('admin/index')
			->set('articles', $articles)
			->display();
	}
}