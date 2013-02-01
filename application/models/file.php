<?php 

/**
 * Class for dealing with files 
 */
class File extends DataMapper
{

	public static $types = array(
		null => '',
		'doc' => 'Document (Word, OpenOffice Write, WordPad)',
		'ppt' => 'Presentation (Powerpoint, Keynote, Impress)',
		'xls' => 'Spreadsheet (Excel, Gnumeric)',
		'txt' => 'Text File',
		'src' => 'Source Code (PHP, SQL, Java, etc)',
		'zip' => 'Archive (Zip, Rar, Tar)',
		);

	var $validation = array(
		'title' => array(
			'label' => 'Judul',
			'rules' => array('required'),
		),
		'filetype' => array(
			'label' => 'Jenis File',
			'rules' => array('required'),
		),
		'filename' => array(
			'label' => 'File',
			'rules' => array('required'),
		),
	);


	// =======================================================
	//  STATIC METHODS
	// =======================================================

	public static function init($param = null)
	{
		$result = new File;

		if(is_numeric($param))
			return $result->where('id', $param)->get();

		if(is_array($param))
			foreach($param as $key => $value)
				$result->$key = $value;

		return $result;
	}

	public static function create($array, $picfield)
	{
		$file = File::init($array);

		$file->filename = File::upload($picfield);
		$file->staff_id = Staff::current()->id;
		$file->created_at = date('Y-m-d H:i:s');
		$file->updated_at = date('Y-m-d H:i:s');

		if($file->save())
			return false;
		else
			return $file->error;
	}

	public static function upload($fieldname)
	{
		$CI =& get_instance();
		$upload_path = realpath('content/files/').'/'.Staff::current()->username;

		if( ! is_dir($upload_path) )
		{
			mkdir($upload_path);
			chmod($upload_path, 0777);	
		}

		$new_name = $_FILES[$fieldname]['name'];
		move_uploaded_file(
			$_FILES[$fieldname]['tmp_name'], 
			$upload_path.'/'.$new_name);

		return $new_name;
	}

	public static function edit($id, $array)
	{
		$file = File::init($id);

		foreach($array as $key => $value)
			$file->$key = $value;
		
		$file->updated_at = date('Y-m-d H:i:s');

		if($file->save())
			return false;
		else
			return $file->error;
	}

	/**
	 * Override
	 */
	public function delete()
	{
		unlink(realpath($this->url()));

		return parent::delete();
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

	public function image_url()
	{
		return 'img/mime/'.$this->filetype.'.svg';
	}

	public function url()
	{
		return 'content/files/'.$this->staff()->username.'/'.$this->filename;
	}
}