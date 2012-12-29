<?php 

/**
 * Class for dealing with files 
 */
class File extends DataMapper
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

	public function image_url()
	{
		$icon = array(
			'doc'  => 'doc.svg',
			'docx' => 'doc.svg',
			'ppt'  => 'ppt.svg',
			'pptx' => 'ppt.svg',
			'xls'  => 'xls.svg',
			'xlsx' => 'xls.svg',
			);

		$ext = array_pop(explode('.', $this->filename));
		return 'img/mime/'.$icon[$ext];
	}

	public function url()
	{
		return 'content/files/'.$this->staff()->username.'/'.$this->filename;
	}
}