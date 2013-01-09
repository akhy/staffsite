<?php 

/**
 * Class for dealing with articles 
 */
class Article extends DataMapper
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
		return new Article;
	}

	public static function CI()
	{
		return get_instance();
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