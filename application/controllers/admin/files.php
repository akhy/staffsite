<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Using base controller for admin area
require_once(APPPATH.'core/MY_Admin.php');

/**
* 
*/
class Files extends MY_Admin
{

	protected function view($template)
	{
		return parent::view($template)
			->set('active', 'files');
	}

	/**
	 * GET: /admin/files
	 */
	public function get_index()
	{
		$this->get_page(1);
	}

	/**
	 * GET: /admin/files/page/{$page}
	 */
	public function get_page($page = 1)
	{
		$this->view('admin/files/list')
			->prepend('File')
			->set('page', $page)
			->display();
	}

	/**
	 * GET: /admin/files/new
	 */
	public function get_new()
	{
		$this->view('admin/files/form')
			->prepend('Upload File Baru')
			->set('form_type', 'new')
			->set('filetypes', File::$types)
			->display();
	}

	/**
	 * GET: /admin/files/{$id}/edit
	 */
	public function get_edit($id)
	{
		$file = File::init($id);

		$this->view('admin/files/form')
			->prepend('Edit "'.$file->title.'"')
			->set('form_type', 'edit')
			->set('filetypes', File::$types)
			->set('file', $file)
			->display();
	}

	/**
	 * GET: /admin/files/{$id}/delete
	 */
	public function get_delete($id)
	{
		$file = File::init($id);
		$this->session->set_flashdata('status-success', 'Artikel "'.$file->title.'" berhasil dihapus');
		$file->delete();

		redirect('admin/files');
	}

	/**
	 * GET: /admin/files/{$id}/upload
	 */
	public function get_upload($id)
	{
		$file = File::init($id);

		$this->view('admin/files/upload')
			->prepend('Reupload "'.$file->title.'"')
			->set('file', $file)
			->display();
	}

	/**
	 * POST: /admin/files/new
	 */
	public function post_new()
	{
		$error = File::create($this->input->post(), 'filename');

		if ($error)
		{
			$this->session->set_flashdata('error', $error);
			$this->session->set_flashdata('old', $this->input->post());
			redirect('admin/files/new');
		}

		$this->session->set_flashdata('status-success', 'File telah di-upload');
		redirect('admin/files');
	}

	/**
	 * POST: /admin/files/{$id}/edit
	 */
	public function post_edit($id)
	{
		$error = File::edit($id, $this->input->post());

		if ($error)
		{
			$this->session->set_flashdata('error', $error);
			$this->session->set_flashdata('old', $this->input->post());
			redirect('admin/files/'.$id.'/edit');
		}

		$this->session->set_flashdata('status-success', 'Keterangan file berhasil diubah');
		redirect('admin/files');
	}

	/**
	 * POST: /admin/files/{$id}/upload
	 */
	public function post_upload($id)
	{
		$file = File::init($id);

		$file->unlink();
		$file->filename = File::upload('filename');
		$file->updated_at = date('Y-m-d H:i:s');
		$file->save();

		redirect('admin/files');
	}

}