<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Set Flash Message
 * @access	public
 * @return	null
 */	
if ( ! function_exists('getSettings'))
{
	function getSettings()
	{
		$CI =& get_instance();
		$CI->config->load('settings', TRUE);
		return $this->config->item('og','settings');
		return TRUE;	
	}
}



/* End of file date_helper.php */
/* Location: ./system/helpers/date_helper.php */