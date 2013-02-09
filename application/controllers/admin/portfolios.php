<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Using base controller for admin area
require_once(APPPATH.'core/MY_Admin.php');

class Portfolios extends MY_Admin
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('portfolio');
	}

	public function get_index()
	{
		$portfolio = new Portfolio;
		$p = $portfolio->auth( Staff::current() );

		echo '<pre>';
		var_dump($p->activities_grouped());
		echo '</pre>';

		// foreach($p->activities() as $activity)
		// {
		// 	echo '<br>==============================================';
		// 	echo '<h3>'.$activity->name.' '.count($activity->items).'</h3>';
			
		// 	foreach($activity->items as $key => $item)
		// 	{
		// 		echo '<pre>';
		// 		echo "Item ".$key."\n";
		// 		echo "\n";
		// 		var_dump($item);
		// 		echo '</pre>';
		// 	}
		// }
	}
}