<?php 
class form{
	var $form_id;
	var $method;
	var $debug;
	var $data;
	var $errorMsg = array();
 
	var $parse = false;
 
	function __construct($form_id, $method, $debug, $data = array()){
		$this -> form_id = $form_id;
		$this -> method = $method;
		$this -> debug = $debug;
 
		$this -> data = $data;
	}
 
	function formBegin($class =''){
		$form_begin = '<form id="'.$this -> form_id.'" method="'.$this -> method.'" '.($class ? 'class="'.$class.'"' : '').'>';
		return $form_begin;
	}
 
	function genInput($checkFunction = '',$type, $name, $value = '', $class = '', $error_msg= '', $add =''){
		if($this -> debug && !empty($this -> data) && !empty($checkFunction)){
			if($checkFunction($this -> data[$this -> form_id][$name])){
				$this -> errorMsg[] = $error_msg;
				$error = 'style="border: 1px solid red"';
			}
		}
		if($type == 'checkbox'){
			$input = '<input type="'.$type.'" name="'.$this -> form_id.'['.$name.']" '.($value == 'on' ? 'checked' : '').' '.($class ? 'class="'.$class.'"' : '').' '.$add.' '.$error.'/>';
		}
		else{
			$input = '<input type="'.$type.'" name="'.$this -> form_id.'['.$name.']" '.($value ? 'value="'.$value.'"' : '').''.($class ? 'class="'.$class.'"' : '').' '.$add.' '.$error.'/>';
		}
		return $input;
	}
 
	function genTextarea($checkFunction = '', $name, $value ='', $class ='', $error_msg = '', $add = ''){
 
		if($this -> debug && !empty($this -> data) && !empty($checkFunction)){
			if($checkFunction($this -> data[$this -> form_id][$name])){
				$this -> errorMsg[] = $error_msg;
				$error = 'style="border: 1px solid red"';
			}
		}
		$textarea = '<textarea name="'.$this -> form_id.'['.$name.']" '.($class ? 'class="'.$class.'"' : '').' '.$add.' '.$error.'>'.($value ? ''.$value.'' : '').'</textarea>';
		return $textarea;
	}
 
	function genRadio($checkFunction = '', $name,$items , $error_msg = ''){
		if($this -> debug && !empty($this -> data) && !empty($checkFunction)){
			if($checkFunction($this -> data[$this -> form_id][$name])){
				$this -> errorMsg[] = $error_msg;
				$error = 'style="border: 1px solid red"';
			}
		}
		$radio = '';
		foreach ($items as $a => $lines){
			if(empty($lines[4])){
				$radio .= '<input type="radio" name="'.$this -> form_id.'['.$name.']" value="'.$lines[0].'" '.(!empty($lines[1]) ? 'class="'.$lines[1].'"' : 'as').' '.$lines[3].' '.$error.'/>';
			}
			else {
				$radio .= str_replace('%','<input type="radio" name="'.$this -> form_id.'['.$name.']" value="'.$lines[0].'" '.($lines[1] ? 'class="'.$lines[1].'"' : '').' '.$lines[3].' '.$error.'/>', $lines[4]);
			}
		}
		return $radio;
	}
 
	function genSelect($checkFunction,$name, $class,$items, $error_msg = ''){
		if($this -> debug && !empty($this -> data) && !empty($checkFunction)){
			if($checkFunction($this -> data[$this -> form_id][$name])){
				$this -> errorMsg[] = $error_msg;
				$error = 'style="border: 1px solid red"';
			}
		}
		$select = '<select name="'.$this -> form_id.'['.$name.']"  '.$error.'>';
		foreach ($items as $a => $lines){
			$select .= '<option value="'.$lines[0].'" '.($lines[0] ? 'class="'.$lines[0].'"' : '').' '.$lines[3].' '.$lines[4].'>'.$lines[1].'</option>';
		}
		$select .= '</select>';
		return $select;
	}
 
	function formEnd(){
		$form_end = '</form>';
		if(empty($this -> errorMsg) && !empty($this -> data)){
			$this -> parse = true;
		}
		return $form_end;
	}
}
?>