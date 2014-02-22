<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cigen extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function build ($controller_name=null, $table_name="table" ,$primary_key="ID")
	{
		$this->load->helper('file');
		
		// Container Builder
		$container_path = "./app/controllers/". $controller_name .".php";
		$container_content = file_get_contents('./generator/controller.php');
		$container_content = str_replace('{controller_name_1}', ucfirst($controller_name), $container_content);
		$container_content = str_replace('{controller_name}', $controller_name, $container_content);
		$container_content = str_replace('{table_name}', $table_name, $container_content);
		$container_content = str_replace('{primary_key}', $primary_key, $container_content);

		if ( ! write_file($container_path, $container_content))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "Controller '$controller_name' Created \n";
		}


		// Model Builder
		$model_path = "./app/models/". $controller_name ."_model.php";
		$model_content = file_get_contents('./generator/model.php');
		$model_content = str_replace('{model_name_1}', ucfirst($controller_name) . '_model', $model_content);
		$model_content = str_replace('{model_name}', $controller_name, $model_content);
		$model_content = str_replace('{table_name}', $table_name, $model_content);
		$model_content = str_replace('{primary_key}', $primary_key, $model_content);

		if ( ! write_file($model_path, $model_content))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "Model '$controller_name' Created \n" ;
		}


		// Views Add 
		if (!file_exists("./app/views/". $controller_name)) {
			mkdir("./app/views/". $controller_name);
		}
		
		// ADD 
		$view_path_update = "./app/views/". $controller_name . "/". $controller_name ."_add.php";
		$view_content_update = file_get_contents('./generator/add.php');
		$view_content_update = str_replace('{model_name_1}', ucfirst($controller_name) . '_model', $view_content_update);
		$view_content_update = str_replace('{model_name}', $controller_name, $view_content_update);
		$view_content_update = str_replace('{table_name}', $table_name, $view_content_update);
		$view_content_update = str_replace('{primary_key}', $primary_key, $view_content_update);
		if ( ! write_file($view_path_update, $view_content_update))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "View  '$controller_name' Add Created \n" ;
		}


		// Update
		$view_path_update = "./app/views/". $controller_name . "/". $controller_name ."_update.php";
		$view_content_update = file_get_contents('./generator/add.php');
		$view_content_update = str_replace('{model_name_1}', ucfirst($controller_name) . '_model', $view_content_update);
		$view_content_update = str_replace('{model_name}', $controller_name, $view_content_update);
		$view_content_update = str_replace('{table_name}', $table_name, $view_content_update);
		$view_content_update = str_replace('{primary_key}', $primary_key, $view_content_update);
		if ( ! write_file($view_path_update, $view_content_update))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "View  '$controller_name' Update Created \n" ;
		}

		// Listing
		$view_path_listing = "./app/views/". $controller_name . "/". $controller_name ."_listing.php";
		$view_content_listing = file_get_contents('./generator/add.php');
		$view_content_listing = str_replace('{model_name_1}', ucfirst($controller_name) . '_model', $view_content_listing);
		$view_content_listing = str_replace('{model_name}', $controller_name, $view_content_listing);
		$view_content_listing = str_replace('{table_name}', $table_name, $view_content_listing);
		$view_content_listing = str_replace('{primary_key}', $primary_key, $view_content_listing);
		if ( ! write_file($view_path_listing, $view_content_listing))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "View '$controller_name' Listing Created \n" ;
		}


		echo "subl app/controllers/$controller_name".".php"." app/models/$controller_name"."_model.php";
		echo "\nsubl app/views/$controller_name";

	}

	public function remove($controller_name=null)
	{
		$this->load->helper('file');
		exec("rm -rf " . "./app/controllers/$controller_name" . ".php");
		exec("rm -rf " . "./app/models/$controller_name" . "_model.php");
		exec("rm -rf " . "./app/views/$controller_name");
		echo "success";
	}

	public function help()
	{
		echo "cigen build controller_name table_name primary_key";
	}

}

/* End of file generator.php */
/* Location: ./app/controllers/generator.php */