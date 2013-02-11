<?php 

/**
 * Class for dealing with files 
 */
class Link extends DataMapper
{
	var $validation = array(
		'url' => array(
			'label' => 'URL',
			'rules' => array('required'),
		),
		'linktype_id' => array(
			'label' => 'Tipe link',
			'rules' => array('required'),
		),
	);

	public static function init($param = null)
	{
		$result = new Link;

		if(is_numeric($param))
			return $result->where('id', $param)->get();

		if(is_array($param))
			foreach($param as $key => $value)
				$result->$key = $value;

		return $result;
	}

	public static function create($array)
	{
		$link = Link::init($array);
		$link->staff_id = Staff::current()->id;

		if($link->save())
			return false;
		else
			return $link->error;
	}

	public static function edit($id, $array)
	{
		$link = Link::init($id);

		foreach($array as $key => $value)
			$link->$key = $value;
		
		if($link->save())
			return false;
		else
			return $link->error;
	}

	/**
	 * Relationships
	 */

	public function staff()
	{
		$s = new Staff;
		$staff = $s->where('id', $this->staff_id)->get();

		return $staff;
	}

	public function type()
	{
		$t = new LinkType;
		$type = $t->where('id', $this->linktype_id)->get();

		return $type;
	}

	public function image_url()
	{
		return 'img/icon/'.$this->type()->picture;
	}

}