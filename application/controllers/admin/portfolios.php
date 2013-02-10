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
		$this->view('admin/portfolios/edit')
			->display();
	}

	public function post_index()
	{
		Staff::current()->update_portfolio_credential(
			$this->input->post('username'),
			$this->input->post('password')
			);

		redirect('admin/portfolios');
	}
}