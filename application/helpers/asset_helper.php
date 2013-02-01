<?php 

function css($name)
{
	$url = base_url().$name;
	
	return '<link rel="stylesheet" type="text/css" href="'.$url.'"/>';
}

function less($name)
{
	$url = base_url().$name;
	
	return '<link rel="stylesheet/less" type="text/css" href="'.$url.'"/>';
}

function js($name)
{
	$url = base_url().$name;
	
	return '<script type="text/javascript" src="'.$url.'"></script>';
}

function dropdown($array, $key)
{
	$result = array(null => '');
	foreach($array as $row)
	{
		$result[$row->id] = $row->$key;
	}

	return $result;
}