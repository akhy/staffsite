<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Using base controller for admin area
require_once(APPPATH.'core/MY_Admin.php');

/**
* 
*/
class Articles extends MY_Admin
{


	protected function view($template)
	{
		return parent::view($template)
			->set('active', 'articles');
	}

	/**
	 * GET: /admin/articles
	 */
	public function get_index()
	{
		$this->get_page(1);
	}

	/**
	 * GET: /admin/articles/page/{$page}
	 */
	public function get_page($page = 1)
	{
		$this->view('admin/articles/list')
			->prepend('Artikel Blog')
			->set('page', $page)
			->display();
	}

	/**
	 * GET: /admin/articles/new
	 */
	public function get_new()
	{
		$this->view('admin/articles/form')
			->prepend('Tulis Artikel Baru')
			->set('form_type', 'new')
			->set('scripts', array('lib/redactor/redactor.min.js'))
			->set('styles', array('lib/redactor/css/redactor.css'))
			->display();
	}

	/**
	 * GET: /admin/articles/{$id}/edit
	 */
	public function get_edit($id)
	{
		$article = Article::init($id);

		$this->view('admin/articles/form')
			->prepend('Edit "'.$article->title.'"')
			->set('form_type', 'edit')
			->set('article', $article)
			->set('scripts', array('lib/redactor/redactor.min.js'))
			->set('styles', array('lib/redactor/css/redactor.css'))
			->display();
	}

	/**
	 * POST: /admin/articles/new
	 */
	public function post_new()
	{
		$error = Article::create($this->input->post());

		if ($error)
		{
			$this->session->set_flashdata('error', $error);
			$this->session->set_flashdata('old', $this->input->post());
			redirect('admin/articles/new');
		}

		$this->session->set_flashdata('status-success', 'Artikel telah dipublikasikan');
		redirect('admin/articles');
	}

	/**
	 * POST: /admin/articles/{$id}/edit
	 */
	public function post_edit($id)
	{
		$error = Article::edit($id, $this->input->post());

		if ($error)
		{
			$this->session->set_flashdata('error', $error);
			$this->session->set_flashdata('old', $this->input->post());
			redirect('admin/articles/'.$id.'/edit');
		}

		$this->session->set_flashdata('status-success', 'Perubahan pada artikel telah disimpan');
		redirect('admin/articles');
	}

	/**
	 * GET: /admin/articles/{$id}/delete
	 */
	public function get_delete($id)
	{
		$article = Article::init($id);
		$this->session->set_flashdata('status-success', 'Artikel "'.$article->title.'" berhasil dihapus');
		$article->delete();

		redirect('admin/articles');
	}

}