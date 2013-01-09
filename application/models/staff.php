<?php 

/**
 * Class for dealing with staffs 
 */
class Staff extends DataMapper
{

	public function __construct()
	{
		parent::__construct();

		$this->CI = get_instance();
	}

	
	// =======================================================
	//  STATIC METHODS
	// =======================================================

	public static function init()
	{
		return new Staff;
	}

	public static function CI()
	{
		return get_instance();
	}

	public static function attempt_login($post)
	{
		static::CI()->session->unset_userdata('staff_id');

		$post['password'] = md5($post['password']);
		$staff = Staff::init()
			->group_start()
				->where('username', $post['identity'])
				->or_where('email', $post['identity'])
			->group_end()
			->where('password', $post['password'])
			->get();

		if ( ! $staff->exists() )
			return false;

		static::CI()->session->set_userdata('staff_id', $staff->id);

		return $staff;
	}

	public static function current()
	{
		$staff_id = static::CI()->session->userdata('staff_id');

		return $staff_id ? Staff::init()->where('id', $staff_id)->get() : false;
	}


	// =======================================================
	//  RELATIONSHIPS
	// =======================================================

	public function articles()
	{
		$result = Article::init()->where('staff_id', $this->id)->order_by('created_at', 'desc');

		return $result;
	}

	public function files()
	{
		$a = new File;
		$result = $a->where('staff_id', $this->id)->order_by('created_at', 'desc');

		return $result;
	}

	public function links()
	{
		$l = new Link;
		$result = $l->where('staff_id', $this->id);

		return $result;
	}


	// =======================================================
	//  DATA HANDLING
	// =======================================================

	public function by_username($username)
	{
		return $this->where('username', $username)->get();
	}


	// =======================================================
	//  URL HANDLING
	// =======================================================

	public function picture_url()
	{
		return base_url().'content/avatar/'.$this->picture;
	}

	public function home_url()
	{
		return base_url().$this->username;
	}

	public function profile_url()
	{
		return base_url().$this->username.'/profile';
	}

	public function download_url()
	{
		return base_url().$this->username.'/download';
	}

	public function blog_url()
	{
		return base_url().$this->username.'/blog';
	}
}