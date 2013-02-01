<?php 

/**
 * Class for dealing with articles 
 */
class Article extends DataMapper
{
	var $validation = array(
		'title' => array(
			'label' => 'Judul',
			'rules' => array('required'),
		),
		'content' => array(
			'label' => 'Konten',
			'rules' => array('required'),
		),
		'category_id' => array(
			'label' => 'Kategori',
			'rules' => array('required'),
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

	public static function init($param = null)
	{
		$result = new Article;

		if(is_numeric($param))
			return $result->where('id', $param)->get();

		if(is_array($param))
			foreach($param as $key => $value)
				$result->$key = $value;

		return $result;
	}

	public static function CI()
	{
		return get_instance();
	}

	public static function create($array)
	{
		$article = Article::init($array);

		$article->slug = url_title(strtolower($article->title), '-');
		$article->staff_id = Staff::current()->id;
		$article->created_at = date('Y-m-d H:i:s');
		$article->updated_at = date('Y-m-d H:i:s');


		if($article->save())
			return false;
		else
			return $article->error;
	}

	public static function edit($id, $array)
	{
		$article = Article::init($id);

		foreach($array as $key => $value)
			$article->$key = $value;
		
		$article->slug = url_title(strtolower($article->title), '-');
		$article->updated_at = date('Y-m-d H:i:s');

		if($article->save())
			return false;
		else
			return $article->error;
	}

	// =======================================================
	//  RELATIONSHIPS
	// =======================================================

	public function staff()
	{
		$s = new Staff;
		return $s->get_by_id($this->staff_id);
	}

	public function category()
	{
		$c = new Category;
		return $c->where('id', $this->category_id)->get();
	}


	// =======================================================
	//  DATA HANDLING
	// =======================================================

	public function increment()
	{
		$this->where('id', $this->id)->update('viewed', $this->viewed + 1);
	}

	public function created()
	{
		return date('j F Y H:i', strtotime($this->created_at));
	}

	public function updated()
	{
		return date('j F Y H:i', strtotime($this->updated_at));
	}


	// =======================================================
	//  URL HANDLING
	// =======================================================

	public function url()
	{
		return $this->staff()->username.'/article/'.$this->id.'-'.$this->slug;
	}
}