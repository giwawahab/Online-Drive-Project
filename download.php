<?php
session_start();
require 'functions.php';

$id 	 = $_GET['id'] ?? null;
$user_id = $_SESSION['MY_DRIVE_USER']['id'] ?? 0;

$id = (int)$id;
$user_id = (int)$user_id;

$query = "select * from mydrive where id = '$id' limit 1";
$row = query_row($query);

if($row)
{

	if(check_file_access($row))
	{
		$file_path = $row['file_path'];
		$file_name = $row['file_name'];

		header('Content-Disposition: attachment; filename"'.$file_name.'"');
		readfile($file_path);
		exit();
	}else{
		echo "Sorry, you dont have access  to that file";
	}
	

}else{

	echo "Sorry, that file was not found";
}
