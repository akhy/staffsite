<?php 

/**
 * Class for dealing with files 
 */
class LinkType extends DataMapper
{
	public static function all()
	{
		$lt = new LinkType;
		return $lt->get(); 
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

}