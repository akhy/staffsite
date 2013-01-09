<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Profile extends MY_Controller
{

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		if( ! Staff::current() )
			redirect('login');
	}


	/**
	 * Inject global Twig variable
	 * - staff: Logged in staff data
	 */
	private function view()
	{
		$staff = Staff::current();

		return $this->twiggy
			->layout('admin')
			->title(SITE_TITLE)
			->set('staff', $staff)
			->set('profile', (array) $staff->stored)
			;
	}

	public function get_index()
	{
		$this->get_edit();
	}

	public function get_edit()
	{

		$this->view()
			->template('admin/profile/index')
			->display();
	}

}