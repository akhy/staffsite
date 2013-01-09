<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Home extends MY_Controller
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
		return $this->twiggy->set('staff', Staff::current());
	}


	/**
	 * Route: admin/index 
	 */
	public function get_index()
	{
		$twiggy = $this->view()
			->template('admin/index')
			->display();
	}
}