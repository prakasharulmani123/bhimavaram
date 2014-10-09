<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/************************************************************
*	Setting variables for site template and other defaults 	*	
************************************************************/
//Path to Assets
//$config['baseUrl']				= 'http://maaswarnandhra.com/';
$config['baseUrl']				= 'http://localhost/bhimavaram/branches/testing/';
$config['imgPath']				= 'img/';
$config['stylePath']				= 'css/';
$config['scriptPath']			= 'js/';
$config['uploadPath']			= './uploader/';
$config['uploaderPath']			= $config['baseUrl'].'uploader/files/';
$config['defaultAvatar']		= $config['imgPath'].'avatar.png';
$config['userThemeEnabled']		= false;
$config['themes']				= array(										
										'default'=>array('name'=>'Default Theme','directory'=>'default')
									);

//Site Meta
$config['siteName']				= 'MaaSwarnAndhra';
$config['siteTitle']			= 'Social news portal for our own andhra';
$config['keywords']				= array('yellowpages','classifieds','news','telugu','andhra');
$config['favicon']				= $config['imgPath'].'favicon.ico';

//Social Account Usernames
$config['social']['twitter']	= 'MaaSwarnAndhra';
$config['social']['facebook']	= 'MaaSwarnAndhra';
$config['social']['pinterest']	= 'MaaSwarnAndhra';
$config['social']['instagram']	= 'MaaSwarnAndhra';
$config['social']['googleplus']	= 'MaaSwarnAndhra';

//Email Settings
$config['siteEmail']			= 'hello@MaaSwarnAndhra.com';
$config['siteEmailName']		= 'MaaSwarnAndhra';

//Page Meta - Facebook
$config['meta']['og:image']			= $config['baseUrl'].'public/images/'.'oglogo.png';
$config['meta']['og:type']			= 'website';
$config['meta']['og:url']			= $config['baseUrl'];
$config['meta']['og:description']	= 'Social news portal for our own andhra';
$config['meta']['og:title']			= 'MaaSwarnAndhra';
$config['meta']['og:site_name']		= 'MaaSwarnAndhra';
//Page Meta - Twitter
$config['meta']['twitter:card']		= 'summary';
$config['meta']['twitter:site']		= '@MaaSwarnAndhra';
$config['meta']['twitter:description']	= 'A lovely turtle that is flying';
$config['meta']['twitter:image']		= $config['baseUrl'].'public/images/'.'oglogo.png';
$config['meta']['twitter:creator']	= '@designfellow';
/*$config['meta']['twitter:image:width']	= '500';
$config['meta']['twitter:image:height']	= '500';
*/
//Google Analytics ID
$config['AnalyticsID']			= 'UA-9712619-19';


/************************************************************
*	Social API Keys & Settings 								*	
************************************************************/

//Facebook App Settings
$config['facebook']['key']				='539674316094391';
$config['facebook']['secret']			='5407d5c32faba51683d86c79000753a5';
$config['facebook']['scope']			=array('email','user_about_me','user_birthday','publish_actions');
$config['facebook']['callback_url']		='http://maaswarnandhra.com/index.php/facebook/success';

//Twitter App Settings
$config['twitter']['key']				='';
$config['twitter']['secret']			='';
$config['twitter']['callback_url']		='';

//Instagram App Settings
$config['instagram']['key']				='';
$config['instagram']['secret']			='';
$config['instagram']['scope']			='';
$config['instagram']['callback_url']	='';

//Google App Settings
$config['google']['key']				='';
$config['google']['secret']				='';
$config['google']['scope']				='';
$config['google']['callback_url']		='';


/******************************DO NOT EDIT BELOW THis LINES******************************/


/* End of file config.php */
/* Location: ./application/config/config.php */
