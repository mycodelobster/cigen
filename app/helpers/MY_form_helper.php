<?php

function set_success($message = 'success'){
	$CI =& get_instance();
	$CI->session->set_flashdata('alert_success',strtoupper($message));
}
function set_error($message = 'error'){
	$CI =& get_instance();
	$CI->session->set_flashdata('alert_error',strtoupper($message));
}

function alert(){
	$CI =& get_instance();
	if($CI->session->flashdata('alert_success')){
		echo "<div class='alert alert-success'>";
		echo $CI->session->flashdata('alert_success');
		echo "<a class='close' data-dismiss='alert' href='#'>&times;</a></div>";
	}
	if($CI->session->flashdata('alert_error')){
		echo "<div class='alert alert-danger'>";
		echo $CI->session->flashdata('alert_error');
		echo "<a class='close' data-dismiss='alert' href='#'>&times;</a></div>";
	}
	if($CI->form_validation->error_array()){
		echo "<div class='alert alert-danger'>";
		echo strtoupper($CI->form_validation->error_array());
		echo "<a class='close' data-dismiss='alert' href='#'>&times;</a></div>";
	}
}

// Form Generator
function form_text($name,$value = false){
	$value = ($value)? $value : '';
	echo "<div class='form-group'>";
	echo "<label for='$name'>".ucfirst(str_replace("_", " ", $name))."</label>";
	echo "<input value='$value' type='text' name='$name' class='form-control'>";
	echo "</div>";
}

function form_password($name,$value = false){
	$value = ($value)? $value : '';
	echo "<div class='form-group'>";
	echo "<label for='$name'>".ucfirst($name)."</label>";
	echo "<input value='$value' type='password' name='$name' class='form-control'>";
	echo "</div>";
}


function form_textarea($name,$value = false){
	$value = ($value)? $value : '';
	echo "<div class='form-group'>";
	echo "<label for='$name'>".ucfirst($name)."</label>";
	echo "<textarea name='$name' rows='10' class='form-control'>$value</textarea>";
	echo "</div>";
}

function form_select($name,$options=array(),$current=false){
	echo "<div class='form-group'>";
	echo "<label for='$name'>".ucfirst($name)."</label>";
	echo "<select name='$name' class='form-control'>";
	foreach ($options as $item) {
		$selected = ($current==$item['value'])? "selected" : "";
		echo "<option value='".$item['value']."' $selected >".$item['text']."</option>";
	}
	echo "</select>";
	echo "</div>";
}

function form_button($name='Submit',$class='btn-primary'){
	echo "<button type='submit' class='btn $class'>$name</button>";
}

function button_action($url=null,$text=null,$style="btn-primary")
{
	echo "<a href='".base_url($url)."' class='btn $style'>$text</a>"; 
}

// TABLE GENERATOR
function generate_table($data=array(),$primary_key='id'){
	if($data){
		$table = "<table class='table table-bordered'>";

	// Table heading
		$table .= "<thead>";
		$table .= "<tr>";
		foreach ($data[0] as $key => $value) {
			$table .= "<th>".ucwords(str_replace("_", " ", $key))."</th>";
		}
		$table .= "<th>Action</th>";
		$table .= "</tr>";
		$table .= "</thead>";

	// Table Body
		$table .= "<tbody>";
		
		foreach ($data as $item) {
			$table .= "<tr>";
			foreach ($item as $key => $value) {
				$pm[] = $value;
				$table .= "<td>$value</td>";
			}
			$table .= "<td>";
			$table .= "<a href='".current_url()."/update/".$item->{$primary_key}."' class='btn btn-primary'>Update</a>";
			$table .= "<a href='".current_url()."/delete/".$item->{$primary_key}."' class='btn btn-primary' style='margin-left:5px'>Delete</a>";
			$table .= "</td>";
			$table .= "</tr>";
		}
		$table .= "</tbody>";
		$table .= "</table>";
		echo $table;
	}

}

// DEBUG FUNCTION
function debug($str){
	echo "<pre>";
	echo var_dump($str);
	echo "</pre>";
	exit();
}
?>
