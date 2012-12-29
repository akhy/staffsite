<?php 

/**
 * Class for dealing with categories 
 */
class Category extends DataMapper
{

	public function staff()
	{
		$s = new Staff;
		$result = $s->where('id', $this->staff_id)->get();

		return $result;
	}

	public function articles()
	{
		$a = new Article;
		$result = $a->where('category_id', $this->id)->order_by('created_at', 'desc')->get();

		return $result;
	}


	// =======================================================
	//  URL HANDLING
	// =======================================================

	public function url()
	{
		return base_url().'content/avatar/'.$this->picture;
	}

}