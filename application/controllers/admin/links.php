<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Using base controller for admin area
require_once(APPPATH.'core/MY_Admin.php');

/**
* 
*/
class Links extends MY_Admin
{


	protected function view($template)
	{
		return parent::view($template)
			->set('linktypes', LinkType::all())
			->set('active', 'links');
	}

	/**
	 * GET: /admin/links
	 */
	public function get_index()
	{
		$this->view('admin/links/list')
			->prepend('Link')
			->display();
	}

	/**
	 * GET: /admin/links/new
	 */
	public function get_new()
	{
		$this->view('admin/links/form')
			->prepend('Tambah Link Baru')
			->set('form_type', 'new')
			->display();
	}

	/**
	 * GET: /admin/links/{$id}/edit
	 */
	public function get_edit($id)
	{
		$link = Link::init($id);

		$this->view('admin/links/form')
			->prepend('Edit Link')
			->set('form_type', 'edit')
			->set('link', $link)
			->display();
	}

	/**
	 * POST: /admin/links/new
	 */
	public function post_new()
	{
		$error = Link::create($this->input->post());

		if ($error)
		{
			$this->session->set_flashdata('error', $error);
			$this->session->set_flashdata('old', $this->input->post());
			redirect('admin/links/new');
		}

		$this->session->set_flashdata('status-success', 'Link telah ditambahkan');
		redirect('admin/links');
	}

	/**
	 * POST: /admin/links/{$id}/edit
	 */
	public function post_edit($id)
	{
		$error = Link::edit($id, $this->input->post());

		if ($error)
		{
			$this->session->set_flashdata('error', $error);
			$this->session->set_flashdata('old', $this->input->post());
			redirect('admin/links/'.$id.'/edit');
		}

		$this->session->set_flashdata('status-success', 'Link telah diubah');
		redirect('admin/links');
	}

	/**
	 * GET: /admin/links/{$id}/delete
	 */
	public function get_delete($id)
	{
		$link = Link::init($id);
		$this->session->set_flashdata('status-success', 'Link "'.$link->url.'" berhasil dihapus');
		$link->delete();

		redirect('admin/links');
	}

}