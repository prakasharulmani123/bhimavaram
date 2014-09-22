<?php
class Widgets
	{
		 function __construct() {
			$CI =& get_instance();
			$CI->config->load('settings', TRUE);
			}
		
		//Get widget code
		function getWidget($name,$data)
		{
			$CI =& get_instance();
			$theme=$CI->layout->getTheme();
			return $CI->load->view($theme.'/widgets/'.$name,$data,true);
		}//
	}//Library Ends
?>