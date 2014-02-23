<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cigen extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function build ($controller_name=false, $primary_key=false, $field=false, $table_name=false)
	{

		if($controller_name==false OR $table_name==false OR $primary_key==false OR $field==false){
			exit("ERROR ! CHECK YOUR COMMAND");
		}

		$this->load->helper('file');
		// Container Builder
		$container_path = "./app/controllers/". $controller_name .".php";
		$container_content = file_get_contents('./generator/controller.php');
		$container_content = str_replace('{controller_name_1}', ucfirst($controller_name), $container_content);
		$container_content = str_replace('{controller_name}', $controller_name, $container_content);
		$container_content = str_replace('{table_name}', $table_name, $container_content);
		$container_content = str_replace('{primary_key}', $primary_key, $container_content);
		$container_content = str_replace('{first_field}', $field, $container_content);

		if ( ! write_file($container_path, $container_content))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "C";
		}


		// Model Builder
		$model_path = "./app/models/". $controller_name ."_model.php";
		$model_content = file_get_contents('./generator/model.php');
		$model_content = str_replace('{model_name_1}', ucfirst($controller_name) . '_model', $model_content);
		$model_content = str_replace('{model_name}', $controller_name, $model_content);
		$model_content = str_replace('{table_name}', $table_name, $model_content);
		$model_content = str_replace('{primary_key}', $primary_key, $model_content);
		$model_content = str_replace('{first_field}', $field, $model_content);

		if ( ! write_file($model_path, $model_content))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "M" ;
		}


		// Views Add 
		if (!file_exists("./app/views/". $controller_name)) {
			mkdir("./app/views/". $controller_name);
		}
		
		// ADD 
		$view_path_update = "./app/views/". $controller_name . "/". $controller_name ."_add.php";
		$view_content_update = file_get_contents('./generator/add.php');
		$view_content_update = str_replace('{controller_name}', $controller_name, $view_content_update);
		$view_content_update = str_replace('{first_field}', $field, $view_content_update);
		if ( ! write_file($view_path_update, $view_content_update))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "A" ;
		}


		// Update
		$view_path_update = "./app/views/". $controller_name . "/". $controller_name ."_update.php";
		$view_content_update = file_get_contents('./generator/update.php');
		$view_content_update = str_replace('{controller_name}', $controller_name, $view_content_update);
		$view_content_update = str_replace('{first_field}', $field, $view_content_update);
		if ( ! write_file($view_path_update, $view_content_update))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "P" ;
		}

		// Listing
		$view_path_listing = "./app/views/". $controller_name . "/". $controller_name ."_listing.php";
		$view_content_listing = file_get_contents('./generator/listing.php');
		$view_content_listing = str_replace('{controller_name}', $controller_name, $view_content_listing);
		$view_content_listing = str_replace('{primary_key}', $primary_key, $view_content_listing);
		if ( ! write_file($view_path_listing, $view_content_listing))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "L ::: CRUD CREATED" ;
		}


		$li  = "<li class='list-group-item'><?php echo anchor(base_url('$controller_name'), '".ucfirst($controller_name)."') ?></li>"; 
		$sidebar_path = "./app/views/layout/sidebar.php";
		$sidebar_content = file_get_contents('./app/views/layout/sidebar.php');
		$sidebar_content = str_replace('<!--SECTION-->', "$li \n <!--SECTION-->", $sidebar_content);
		if ( ! write_file($sidebar_path, $sidebar_content))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "Add Sidebar Success \n" ;
		}
		$this->build_sql($primary_key,$field,$table_name);

		echo "\nsubl app/controllers/$controller_name".".php"." app/models/$controller_name"."_model.php";
		echo " app/views/$controller_name";

	}

	public function remove($controller_name=null, $table_name = false)
	{
		$this->load->helper('file');
		exec("rm -rf " . "./app/controllers/$controller_name" . ".php");
		exec("rm -rf " . "./app/models/$controller_name" . "_model.php");
		exec("rm -rf " . "./app/views/$controller_name");
		echo "All $controller_name Structure was deleted \n";

		// Remove Sidebar
		$li  = "<li class='list-group-item'><?php echo anchor(base_url('$controller_name'), '".ucfirst($controller_name)."') ?></li>"; 
		$sidebar_path = "./app/views/layout/sidebar.php";
		$sidebar_content = file_get_contents('./app/views/layout/sidebar.php');
		$sidebar_content = str_replace($li, "", $sidebar_content);
		if ( ! write_file($sidebar_path, $sidebar_content))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "Remove Sidebar \n" ;
		}
		if($table_name){
			$this->load->dbforge();
			$this->dbforge->drop_table($table_name);
		}

	}

	public function build_config($folder,$database)
	{
		$this->load->helper('file');
		$config_path = "./app/config/config.php";
		$config_content = file_get_contents('./app/config/config.php');
		$config_content = str_replace('cigen', $folder, $config_content);
		if ( ! write_file($config_path, $config_content))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "Base URL Created \n" ;
		}


		$config_path = "./app/config/database.php";
		$config_content = file_get_contents('./app/config/database.php');
		$config_content = str_replace('wordpress', $database, $config_content);
		if ( ! write_file($config_path, $config_content))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "Database Created \n" ;
		}



	}

	public function sidebar($controller){
		$this->load->helper("file");
		$li  = "<li class='list-group-item'><?php echo anchor(base_url('$controller'), '".ucfirst($controller)."') ?></li>"; 
		$sidebar_path = "./app/views/layout/sidebar.php";
		$sidebar_content = file_get_contents('./app/views/layout/sidebar.php');
		$sidebar_content = str_replace('<!--SECTION-->', "$li \n <!--SECTION-->", $sidebar_content);
		if ( ! write_file($sidebar_path, $sidebar_content))
		{
			echo 'Unable to write the file';
		}
		else
		{
			echo "Add Sidebar Success \n" ;
		}
	}

	public function help()
	{
		echo "cigen build controller_name primary_key first_field table_name \n";
		echo "cigen build_config  folder_name database_name \n";
		echo "cigen remove  controller_name \n";
	}

	public function build_sql($primary_key,$first_field,$table_name)
	{
		$this->load->dbforge();
		$this->dbforge->drop_table($table_name);
		$fields = array(
			"$primary_key" => array(
				'type' => 'INT',
				'constraint' =>11, 
				'unsigned' => TRUE,
				'auto_increment' => TRUE
				),
			"$first_field" => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key($primary_key, TRUE);
		$this->dbforge->create_table($table_name,TRUE);
	}


	public function sublime($controller_name)
	{
		echo "subl app/controllers/$controller_name" . ".php ";
		echo "app/controllers/$controller_name" . "_model.php ";
		echo "app/views/$controller_name/$controller_name";
	}
	
}

/* End of file generator.php */
/* Location: ./app/controllers/generator.php */
