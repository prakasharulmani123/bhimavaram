<?php
class Settings
{
    function __construct() {
       //$this->CI =& get_instance();
		$CI =& get_instance();
		$CI->config->load('settings', TRUE);
    }
	
	/****************************************************
	*	Gets Site Base URL 	*	
	****************************************************/
	
	function baseUrl() {
		$CI =& get_instance();			
		return $CI->config->item('baseUrl','settings');
		}
		
	/****************************************************
	*	Gets Site Name 	*	
	****************************************************/
	
	function siteName() {
		$CI =& get_instance();			
		return $CI->config->item('siteName','settings');
		}
		
	/****************************************************
	*	Images Directory Path	*	
	****************************************************/
	
	function imgPath() {
		$CI =& get_instance();			
		return $this->baseUrl().'themes/'.$CI->layout->getTheme().'/'.$CI->config->item('imgPath','settings');
		}

	/****************************************************
	*	StyleSheet Directory Path	*	
	****************************************************/
	
	function stylePath() {
		$CI =& get_instance();				
		return $CI->config->item('stylePath','settings');
		}
		
	/****************************************************
	*	JS Scripts Directory Path	*	
	****************************************************/
	
	function scriptPath() {	
		$CI =& get_instance();
		return $CI->config->item('scriptPath','settings');
		}	
		
	/****************************************************
	*	Content Uploads Directory Path	*	
	****************************************************/	
	function uploadPath() {	
		$CI =& get_instance();
		return $CI->config->item('uploadPath','settings');
		}	
		
	/****************************************************
	*	Content Uploader Directory Path	*	
	****************************************************/	
	function uploaderPath() {	
		$CI =& get_instance();
		return $CI->config->item('uploaderPath','settings');
		}			
		
	/****************************************************
	*	Default Avatar	*	
	****************************************************/	
	function defaultAvatar() {
		$CI =& get_instance();					
		return $CI->config->item('defaultAvatar','settings');
		}	
		
	/****************************************************
	*	Gets Theme Status*	
	****************************************************/
	
	function themeEnabled() {
		$CI =& get_instance();			
		return $CI->config->item('userThemeEnabled','settings');
		}		
		
	/****************************************************
	*	Returns Site Title 	*	
	****************************************************/
	
	function siteTitle() {
		$CI =& get_instance();					
		return $CI->config->item('siteTitle','settings');
		}
		
	/****************************************************
	*	Returns Site Email 	*	
	****************************************************/
	
	function siteEmail() {
		$CI =& get_instance();					
		return $CI->config->item('siteEmail','settings');
		}
		
	/****************************************************
	*	Returns Site Email Name	*	
	****************************************************/
	
	function siteEmailName() {
		$CI =& get_instance();					
		return $CI->config->item('siteEmailName','settings');
		}				
		
	/****************************************************
	*	Returns Keywords	*	
	****************************************************/
	
	function getKeywords() {
		$CI =& get_instance();					
		return $CI->config->item('keywords','settings');
		}	

	/****************************************************
	*	Returns favicon	*	
	****************************************************/
	
	function getFavicon() {
		$CI =& get_instance();				
		return $CI->config->item('favicon','settings');
		}	
	/****************************************************
	*	Returns Social data Arrsy	*	
	****************************************************/		
	function getSocialData() {
		$CI =& get_instance();					
		return $CI->config->item('social','settings');
		}	
	/****************************************************
	*	Returns Open Graph data Arrsy	*	
	****************************************************/		
	function getMetaData() {
		$CI =& get_instance();					
		return $CI->config->item('meta','settings');
		}						

	/****************************************************
	*	Returns Facebook App Credentials	*	
	****************************************************/		
	function getFacebookData() {
		$CI =& get_instance();					
		return $CI->config->item('facebook','settings');
		}	
							
	/****************************************************
	*	Returns Facebook App Credentials	*	
	****************************************************/		
	function getTwitterData() {	
		$CI =& get_instance();			
		return $CI->config->item('twitter','settings');
		}
							
	/****************************************************
	*	Returns Instagram App Credentials	*	
	****************************************************/		
	function getInstagramData() {
		$CI =& get_instance();					
		return $CI->config->item('instagram','settings');
		}
			
	/****************************************************
	*	Returns Google App Credentials	*	
	****************************************************/		
	function getGoogleData() {
		$CI =& get_instance();				
		return $CI->config->item('google','settings');
		}
		
	/****************************************************
	*	Returns Google Analytics ID	*	
	****************************************************/		
	function getAnalyticsID() {
		$CI =& get_instance();				
		return $CI->config->item('AnalyticsID','settings');
		}		
					
}//Settings Library Ends
?>