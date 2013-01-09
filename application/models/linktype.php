<?php 

/**
 * Class for dealing with files 
 */
class LinkType extends DataMapper
{

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