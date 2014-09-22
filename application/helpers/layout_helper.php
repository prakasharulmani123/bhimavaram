<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Returns Theme Name
 */	
if ( ! function_exists('currentTheme'))
{
	function currentTheme()
	{
		$CI =& get_instance();
		return $CI->layout->getTheme();
	}
}

/* End of file General_helper.php */
