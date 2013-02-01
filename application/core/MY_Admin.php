<?php 

/**
* 
*/
class MY_Admin extends MY_Controller
{
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->current = Staff::current();
		if( ! Staff::current() )
			redirect('login');
	}


	/**
	 * Inject global Twig variable
	 * - staff: Logged in staff data
	 */
	protected function view($template)
	{
		// $current = Staff::current();
		// $this->current = $current;

		return $this->twiggy
			->template($template)
			->layout('admin')

			// current logged in staff
			->set('current', $this->current)

			// <body> class
			->set('is_login', $this->current ? 'login' : '')

			// some flashdata
			->set('error', $this->session->flashdata('error'))
			->set('old', $this->session->flashdata('old'))

			// base title
			->title(SITE_TITLE)
			// ->set('staff', $current)
			;
	}

}