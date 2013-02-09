<?php 

/**
 * Class for dealing with staffs 
 */
class Staff extends DataMapper
{

	/**
	 * Rules
	 */
	var $validation = array(
		'fullname' => array(
			'label' => 'Nama lengkap',
			'rules' => array('required'),
		),
		'username' => array(
			'label' => 'Username',
			'rules' => array('required', 'unique'),
		),
		'email' => array(
			'label' => 'Email Address',
			'rules' => array('required', 'unique', 'valid_email'),
		),
		'gender' => array(
			'label' => 'Jenis Kelamin',
			'rules' => array('valid_match' => array('m', 'f')),
		),
		'bio' => array(
			'label' => 'Biografi singkat',
			'rules' => array('max_length' => 160),
		),

		'pob' => array(
			'label' => 'Tempat Lahir',
			'rules' => array('required', 'max_length' => 20),
		),
		'dob' => array(
			'label' => 'Tempat Lahir',
			'rules' => array('required', 'valid_date'),
		),
		'address' => array(
			'label' => 'Alamat',
			'rules' => array('max_length' => 200),
		),

		'position' => array(
			'label' => 'Posisi/Jabatan',
			'rules' => array('max_length' => 50),
		),
		'research' => array(
			'label' => 'Riset',
			'rules' => array('max_length' => 160),
		),
		'activity' => array(
			'label' => 'Aktifitas',
			'rules' => array('max_length' => 160),
		),

	);

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
		get_instance()->session->unset_userdata('staff_id');

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

		get_instance()->session->set_userdata('staff_id', $staff->id);

		return $staff;
	}

	public static function current()
	{
		$staff_id = get_instance()->session->userdata('staff_id');

		return $staff_id ? Staff::init()->where('id', $staff_id)->get() : false;
	}

	public static function upload_picture($fieldname)
	{
		$CI =& get_instance();
		$CI->load->library('upload', array(
			'upload_path'   => realpath('content/avatar'),
			'allowed_types' => 'jpg',
			'max_size'      => '2000',
			'overwrite'     => true,
			'file_name'     => Staff::current()->username.'.jpg',
			));

		return $CI->upload->do_upload($fieldname);
	}



	// =======================================================
	//  RELATIONSHIPS
	// =======================================================

	public function articles()
	{
		$result = Article::init()->where('staff_id', $this->id);

		return $result;
	}

	public function latest_articles()
	{
		return $this->articles()->order_by('created_at', 'desc');
	}

	public function top_articles()
	{
		return $this->articles()->order_by('viewed', 'desc');
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

	public function categories()
	{
		$c = new Category;
		$result = $c->where('staff_id', $this->id);

		return $result;
	}

	public function activities_grouped()
	{
		$portfolio = new Portfolio;
		$portfolio->auth($this);

		return $portfolio->activities_grouped();
	}

	// =======================================================
	//  DATA HANDLING
	// =======================================================

	public function by_username($username)
	{
		return $this->where('username', $username)->get();
	}

	public static function update_profile($attributes)
	{
		$staff = Staff::current();

		foreach($attributes as $key => $value)
		{
			$staff->$key = $value;
		}

		if($staff->save())
		{
			return true;
		}
		else
		{
			return $staff->error;
		}
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