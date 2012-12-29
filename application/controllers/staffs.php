<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staffs extends MY_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index($username)
	{
		if( $this->uri->segment(1) == 'staffs' )
		{
			redirect('/');
		}

		$this->home($username);
	}

	/**
	 * Show a staff's overview
	 */
	public function home($username)
	{
		// Load needed
		$this->load->helper('text');
		$this->twiggy->register_function('word_limiter');

		$s = new Staff;
		$staff = $s->where('username', $username)->get();

		$this->twiggy->template('home')
			->set('active', 'home')
			->title($staff->fullname)
				->append(SITE_TITLE)
			->set('staff', $staff)
			->display();
	}

	/**
	 * Show a staff's profile
	 */
	public function profile($username)
	{
		$s = new Staff;
		$staff = $s->where('username', $username)->get();

		$this->twiggy->template('profile')
			->set('active', 'profile')
			->title($staff->fullname)
				->append(SITE_TITLE)
			->set('staff', $staff)
			->display();
	}

	/**
	 * Show all blog articles
	 */
	public function blog($username, $page = 1)
	{
		// Load needed
		$this->load->helper('text');
		$this->twiggy->register_function('word_limiter');

		$s = new Staff;
		$staff = $s->where('username', $username)->get();

		$this->twiggy->template('blog')
			->set('active', 'blog')
			->title('Blog Page '.$page)
				->append($staff->fullname)
				->append(SITE_TITLE)
			->set('page', $page)
			->set('staff', $staff)
			->display();
	}

	/**
	 * Show all shared files
	 */
	public function download($username, $page = 1)
	{
		$s = new Staff;
		$staff = $s->where('username', $username)->get();
		$files = $staff->files()->get_paged($page, 10);

		$this->twiggy->template('download')
			->set('active', 'download')
			->title('Unduh File page '.$page)
				->append($staff->fullname)
				->append(SITE_TITLE)
			->set('page', $page)
			->set('staff', $staff)
			->set('files', $files)
			->display();
	}

	/**
	 * Show a specific article
	 */
	public function article($id, $slug)
	{
		$a = new Article;
		$article  = $a->where('id', $id)->get();
		$staff    = $article->staff();
		$category = $article->category();

		// Increment viewed
		$article->increment();

		$this->twiggy->template('article')
			->set('active', 'blog')
			->title($article->title)
				->append($staff->fullname)
				->append(SITE_TITLE)
			->set('article', $article)
			->set('category', $category)
			->set('staff', $staff)
			->display();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */