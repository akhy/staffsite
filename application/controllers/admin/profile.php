<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Using base controller for admin area
require_once(APPPATH.'core/MY_Admin.php');

/**
* 
*/
class Profile extends MY_Admin
{

	protected function view($template)
	{
		return parent::view($template)
			->set('active', 'profile')
			;
	}

	public function get_index()
	{
		$this->get_edit();
	}

	public function get_edit()
	{
		$this->view('admin/profile/edit')
			->prepend('Edit Profil')
			->set('profile', (array) $this->current->stored)
			->display();
	}

	public function post_edit()
	{
		$error = Staff::update_profile($this->input->post());

		$this->session->set_flashdata('error', $error);
		$this->session->set_flashdata('old', $this->input->post());

		redirect('admin/profile');
	}

	public function get_picture()
	{
		$this->view('admin/profile/picture')
			->prepend('Ubah Gambar Profil')
			->set('profile', (array) $this->current->stored)
			->display();
	}

	public function post_picture()
	{
		$upload = Staff::upload_picture('picture');

		if(! $upload)
			$this->session->set_flashdata('error', 'Gagal meng-upload gambar');
		else
			$this->session->set_flashdata('success', 'Gambar profil berhasil diubah');

		redirect('admin/profile/edit');
	}
}