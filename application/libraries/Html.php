<?php
class Html
{
    function __construct() {
       //$this->CI =& get_instance();
		$CI =& get_instance();
		$CI->config->load('settings', TRUE);
    }
	
	/****************************************************
	*	Generates Unordered List from array				 *	
	****************************************************/	
	function generateUL($listData,$attr=false,$link=false){
		$CI =& get_instance();
		$output="<ul";
		$output.=$this->getAttr($attr);
		$output.=">";
		//generate List Items		
		foreach($listData as $name=>$att)
		{
			$output.="<li";
			if(is_array($att))
			{				
				foreach($att as $k=>$v)
				{
					$output.=' '.$k.'="'.$v.'"';
				}
				if($link)
				{
				$output.=">".anchor($att['link'],ucwords($name)).'</li>';
				}
				else
				{
				$output.=">".ucwords($name).'</li>';	
				}
			}
			else
			{
				$output.=">".ucwords($att).'</li>';
			}
			
		}
		return $output.='</ul>';
	}
	
	/****************************************************
	*	Returns Image from the theme/img folder			*	
	****************************************************/			
	function themeImg($src,$attr=false)
	{
		$CI =& get_instance();
		$theme=currentTheme();
		$imgPath=$CI->settings->imgPath().$src;
		$attr['src']=$imgPath;
		return img($attr);
	}
	
	/****************************************************
	*	Displays Image from a given path			 	*	
	****************************************************/		
	function showImg($src,$attr=false)
	{
		$attr['src']=$src;
		return img($attr);
	}
	/****************************************************
	*	Returns HTML Header Title					*	
	****************************************************/		
	function showHeading($size,$message,$attr=false)
	{
		$output='<h'.$size;
		$output.=$this->getAttr($attr);		
		$output.='>'.$message.'</h'.$size.'>';		
		return $output;
		
	}	
	/****************************************************
	*	Returns HTML for alertmessage					*	
	****************************************************/		
	function showAlert($type,$message,$attr=false)
	{
		
	}
	
	/****************************************************
	*	Process and Generate Attributes				*	
	****************************************************/			
	function getAttr($attr)
	{
		$output='';
		if(is_array($attr))
		{
			foreach($attr as $k=>$v)
				{
					$output.=' '.$k.'="'.$v.'"';
				}
		}
		return $output;
	}
	
	/****************************************************
	*	Process and Generate Form Fields				*
	****************************************************/			
	function formField($type,$name,$values,$attr=array(),$selected=false)
	{		
		switch ($type) {
		case "input":
			$attr['name']=$name;
			$attr['value']=set_value($name,$values);		
			return form_input($attr);
			break;
		case "hidden":
			$attr['name']=$name;
			$attr['value']=set_value($name,$values);		
			return form_hidden($attr);
			break;
		case "textarea":
			$attr['name']=$name;
			$attr['value']=set_value($name,$values);		
			return form_textarea($attr);
			break;
		case "password":
			$attr['name']=$name;
			$attr['value']=set_value($name,$values);		
			return form_password($attr);
			break;
		case "upload":
			$attr['name']=$name;
			$attr['value']=set_value($name,$values);		
			return form_upload($attr);
			break;											
		case "dropdown":
				$attrb=$this->getAttr($attr);
				$dropdown='<select name="'.$name.'" '.$attrb.'>';
				foreach($values as $k=>$v)
				{
					$dropdown.=($selected==$k)?'<option value="'.$k.'" '.set_select($name,$k,true).'>'.ucwords($v).'</option>':'<option value="'.$k.'" '.set_select($name,$k).'>'.ucwords($v).'</option>';
				}
				$dropdown.='</select>';
			 return $dropdown;
			break;
		case "checkbox":
			$attr['name']=$name;
			$attr['value']=$values;
			$attrb=$this->getAttr($attr);
			return '<input type="checkbox" '.$attrb.' '.set_checkbox($name,$values,$selected).' />';
			break;	
		case "radio":
			$attr['name']=$name;
			$attr['value']=$values;
			$attrb=$this->getAttr($attr);
			return '<input type="radio" '.$attrb.' '.set_radio($name,$values,$selected).' />';
			break;	
		case "submit":
			$attr['name']=$name;
			$attr['value']=$values;		
			return form_submit($attr);
			break;									
		case "label":
			$attr['name']=$name;
			$attr['value']=$values;	
			return form_label($values,$name,$attr);	
			break;
		}	
	}
	
}//Html Library Ends
?>