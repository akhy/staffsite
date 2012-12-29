<?php 

/**
 * Class for dealing with articles 
 */
class Article extends DataMapper
{
	/**
	 * Relationships
	 */
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


	/**
	 * Other functions
	 */
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

	public function url()
	{
		return $this->staff()->username.'/article/'.$this->id.'-'.$this->slug;
	}
}