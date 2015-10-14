<?php
/* parameters:
$name : the name of the html input
$options : the array of options ($value=>$label)
$selected : the currently selected value(s) (array or value)
$correction : the good answer (array or value)
$showanswer : whether to display the correct answer or not ($showanswer=false can still display whether the user input is right or wrong)
*/

function CreateInputDropdown($name, $options, $selected=array(), $multiple=false, $addhtml=''){
	if(!$options)	 return false;
	if(!$selected)	$selected = array();
	if(!is_array($selected))	$selected = array($selected);
	$result = '<select name="'.$name.'" ';
	if($multiple)	$result .= 'multiple="multiple" size="'.($multiple>1?$multiple:3).'" ';
	if($addhtml)	$result .= $addhtml.' ';
	$result .= '>';
	foreach($options as $value=>$label)		$result .= '
<option value="'.$value.'"'.(in_array($value,$selected)?' selected="true"':'').'>'.$label.'</option>';
	$result .= '</select>';
	return $result;
}

function CreateInputRadio($name, $options, $selected=false, $correction=false, $addhtml='', $before='', $after='<br/>', $showanswer=false){
	if(!$options)	 return false;
	$result = '';
	foreach($options as $value=>$label){
		$is_selected = ($value==$selected);
		$result .= '
'.$before.'<input type="radio" name="'.$name.'" '.$addhtml.' value="'.$value.'"'.($is_selected?' checked="checked"':'').'/>&nbsp;'.$label;
		if($correction){
			if($is_selected || ($showanswer && $correction == $value)){
				$result .= getImage( ($correction==$value && $is_selected)?'correct':'wrong');
			}
		}
		$result .= $after;
	}
	return $result;
}

function CreateInputCheckboxes($name, $options, $selected=array(), $correction=false, $addhtml='', $before='', $after='<br/>', $showanswer=false){
	if(!$options)	 return false;
	if(!$selected || !is_array($selected))	$selected = array();
	$result = '';
	$result .= $before.lang('multipleanswers').$after;
	foreach($options as $value=>$label){
		$is_selected = in_array($value,$selected);
		$result .= '
'.$before.'<input type="checkbox" name="'.$name.'" '.$addhtml.' value="'.$value.'"'.($is_selected?' checked="checked"':'').'/>&nbsp;'.$label;
		if($correction){
			if($is_selected || ($showanswer && in_array($value, $correction))){
				$result .= getImage( (in_array($value, $correction) && $is_selected)?'correct':'wrong');
			}
		}
		$result .= $after;
	}
	return $result;
}

function CreateInputText($name, $value='', $addtext=''){
	return '<input type="text" name="'.$name.'" '.$addtext.' value="'.$value.'"/>';
}
function CreateTextarea($name, $value='', $addtext=''){
	return '<textarea '.$addtext.' name="'.$name.'">'.$value.'</textarea>';
}

function getTypes(){
	return array(
		'dropdown'=>lang('Dropdown'),
		//'select'=>lang('Select'),
		'radio'=>lang('Radio'),
		'checkboxes'=>lang('Checkboxes'),
		'textbox'=>lang('Textbox'),
		'textarea'=>lang('Textarea')
	);
}
