<?php 

/**
* Portfolio handling
*/
class Portfolio extends CI_Model
{
	public $conn;
	public $user = null;
	public $activities = null;

	function __construct()
	{
		parent::__construct();
		$this->conn = get_instance()->load->database('portfolio', true);

		return $this;
	}

	public function auth($staff)
	{
		$username = $staff->portfolio_username;
		$password = $staff->portfolio_password;

		$user = $this->conn
			->from('users')
			->where('username', $username)
			->where('password', $password)
			->get()
			;
			
		if($user->num_rows() < 1)
			return null;

		$this->user = $user->row();

		return $this;
	}

	public function activities()
	{
		if($this->user === null)
			return null;

		if($this->activities !== null)
			return $this->activities;

		$activities = $this->conn
			->select('c.alias, c.category_name, a.content')
			->from('activities a')
			->join('activity_categories c', 'a.activity_category_id = c.id')
			->order_by('c.order')
			->where('a.user_id', $this->user->id)
			->get()
			->result();

		$activities_tmp = array();
		foreach($activities as $activity)
		{
			$data = json_decode($activity->content);
			$data_tmp = (object) null;
			foreach($data as $dt)
			{
				$field = $dt->field;
				$data_tmp->$field = $dt->content;
			}

			array_push($activities_tmp, (object) array(
				'name' => $activity->category_name,
				'alias' => $activity->alias,
				'data' => $data_tmp,
				));
		}

		return $this->activities = $activities_tmp;
	}

	public function activities_grouped()
	{
		$activities = $this->activities();

		$tmp = array();
		foreach($activities as $activity)
		{
			if( ! isset($tmp[$activity->name]) )
				$tmp[$activity->name] = array();

			array_push($tmp[$activity->name], $activity->data);
		}

		return $tmp;
	}
}