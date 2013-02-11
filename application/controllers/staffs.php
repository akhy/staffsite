<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staffs extends MY_Controller {

	public $meta = array();
	public $properties = array();

	/**
	 * Inject global Twig variable
	 * - staff: Logged in staff data
	 */
	private function view($template, $username)
	{
		$staff = Staff::init()->by_username($username);

		if( ! $staff->exists() )
		{
			$this->twiggy->template('404')->display();
			exit;
		}
		$current = Staff::current();

		return $this->twiggy
			->template($template)
			->set('current', $current)
			->set('is_login', $current ? 'login' : '')
			->set('meta', $this->meta)
			->set('properties', $this->properties)
			->set('staff', $staff)
			->title($staff->fullname)
				->append(SITE_TITLE);
	}

	/**
	 * Index Page for this controller.
	 */
	public function get_index($username = null)
	{
		if( $this->uri->segment(1) == 'staffs' )
			redirect('/');

		if( ! empty($username) )
			$this->get_home($username);
		else
			$this->twiggy
				->set('staffs', Staff::all())
				->template('welcome')
				->display();
	}

	/**
	 * Show a staff's overview
	 */
	public function get_home($username)
	{	
		// Load needed
		$this->load->helper('text');
		$this->twiggy->register_function('word_limiter');

		$this->view('home', $username)
			->set('active', 'home')
			->display();
	}

	/**
	 * Show a staff's profile
	 */
	public function get_profile($username)
	{ 
		$this->view('profile', $username)
			->set('active', 'profile')
			->display();
	}

	/**
	 * Show all blog articles
	 */
	public function get_blog($username, $page = 1)
	{
		// Load needed helper and register as Twiggy function
		$this->load->helper('text');
		$this->twiggy->register_function('word_limiter');

		$this->view('blog', $username)
			->set('active', 'blog')
			->set('page', $page)
			->prepend('Artikel halaman '.$page)
			->display();
	}

	/**
	 * Show article feeds
	 */
	public function get_feed($username)
	{
		$staff = Staff::init()->by_username($username);

		header('content-type: application/rss+xml');

		echo $this->twiggy
			->layout('xml')
			->template('rss')
			->set('staff', $staff)
			->render();
	}

	/**
	 * Show all shared files
	 */
	public function get_download($username, $page = 1)
	{
		$this->view('download', $username)
			->set('active', 'download')
			->set('page', $page)
			->prepend('File halaman '.$page)
			->display();
	}

	/**
	 * Show a specific article
	 */
	public function get_article($username, $id, $slug)
	{
		// Load needed helper and register as Twiggy function
		$this->load->helper('text');
		$this->twiggy->register_function('word_limiter');
		
		$article  = Article::init()->where('id', $id)->get();

		// Setup page metadata
		$this->meta = array_merge($this->meta, $article->meta());
		$this->properties = array_merge($this->properties, $article->properties());

		// Increment viewed
		$article->increment();

		$this->view('article', $username)
			->set('active', 'blog')
			->set('article', $article)
			->prepend($article->title)
			->display();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */