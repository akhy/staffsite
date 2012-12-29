<?php 

/**
 * Class for dealing with staffs 
 */
class Staff extends DataMapper
{

	public function articles()
	{
		$a = new Article;
		$result = $a->where('staff_id', $this->id)->order_by('created_at', 'desc');

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
		$result = $l->where('staff_id', $this->id)->get();

		return $result;
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