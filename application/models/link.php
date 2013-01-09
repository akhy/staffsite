<?php 

/**
 * Class for dealing with files 
 */
class Link extends DataMapper
{

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