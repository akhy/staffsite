<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {

	public function get_login()
	{
		$this->twiggy->template('login')->display();
	}

	public function post_login()
	{	
		// Attempt login and store the result in $attempt
		$staff = Staff::attempt_login($this->input->post());

		if($staff):
			redirect('admin');
		else:
			redirect('login');
		endif;
	}

	public function get_logout()
	{
		$this->session->sess_destroy();

		redirect('login');
	}
}