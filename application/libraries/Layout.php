<?php
class Layout
{
    function __construct() {
       //$this->CI =& get_instance();
		$CI =& get_instance();
		$CI->config->load('settings', TRUE);
    }
	
	/****************************************************
	*	Gets Theme Name								 	*	
	****************************************************/	
	function getTheme() {
		$CI =& get_instance();			
		$themeEnabled=$CI->settings->themeEnabled();
		if($themeEnabled)
		{
			$themeDirectory=userdata('themeDirectory');
		}
		else
		{
			$themeDirectory='default';
		}
		return $themeDirectory;
	}
	
	/****************************************************
	*	Publishes Layout Data							 	*	
	****************************************************/		
	function publish($data, $layout = 'layout_inner')
	{
	//	print_r($data);
//		echo array_key_exists('header',$data);
		$CI =& get_instance();

		//Default Values
		$themeDirectory=$this->getTheme();
		$headerPath='header';
		$footerPath='footer';
		$head=array();
		$footer=array();
		$footerData=array();
		$title=$CI->settings->siteName()." | ".$CI->settings->siteTitle();
		//Generate Layout Header
		if(array_key_exists('header',$data))
		{
			$head['css']=isset($data['header']['css'])?$data['header']['css']:false;
			$head['js']=isset($data['header']['js'])?$data['header']['js']:false;
			$headerPath=isset($data['header']['custom'])?$data['header']['custom']:'header';
			$title=isset($data['header']['title'])?$data['header']['title']:$title;
		}
		if(array_key_exists('footer',$data))
		{
			$footerData['js']=isset($data['footer']['js'])?$data['footer']['js']:false;
		}		
//		$head['meta']=$this->generateHead($themeDirectory);//to include stylesheet
		//check for custom header : else : show default
				
		$page['header']=$CI->load->view($themeDirectory.'/'.$headerPath,$head,true);
		$metaData=$CI->settings->getMetaData();
		foreach($metaData as $metaKey=>$metaValue)
		{
			$meta[$metaKey]=$metaValue;
		}					
		if(array_key_exists('meta',$data))
		{
			foreach($data['meta'] as $metaKey=>$metaValue)
			{
				echo $metaValue;
				$meta[$metaKey]=$metaValue;
			}
		}
		//print_r($meta);
		//Generate Layout Body
		$body['content']=$data['content'];
		
		$page['body']=$CI->load->view($themeDirectory.'/'.$data['content']['template'],$body,true);
		if(!array_key_exists('sidebar',$data) || $data['sidebar']!=false)		
		{
			$sidedata=$data['sidebar']['data']?$data['sidebar']['data']:array();
			$sidebarTemplate=$data['sidebar']['custom']?$data['sidebar']['custom']:'sidebar';
			$page['sidebar']=$CI->load->view($themeDirectory.'/sidebars/'.$sidebarTemplate,$sidedata,true);			
		}
		else
		{
			$page['sidebar']=$CI->load->view($themeDirectory.'/sidebars/'.'nosidebar',$sidedata,true);
		}
		$page['meta']=$this->getHead($title,$meta,$head);
		$page['footerData']=$this->getFooterData($footerData);
		
		//Generate Layout Footer
		if(array_key_exists('footer',$data) && array_key_exists('custom',$data['footer']))
		{			
			$footerPath=isset($data['footer']['custom'])?$data['footer']['custom']:'footer';	
		}
		if(array_key_exists('footer',$data) && array_key_exists('js',$data['footer']))
		{			
			$footer['js']=$data['footer']['js'];	
		}
					
		$page['footer']=$CI->load->view($themeDirectory.'/'.$footerPath,$footer,true);
		$CI->load->view($layout,$page);		
	}//Publish Function Ends
	
	/****************************************************
	*	Generates Head Data with Open Graph etc.								 	*	
	****************************************************/		
	function getHead($title,$meta,$head)
	{
		$output="";
		$output.="<title>".$title."</title>";
		foreach($meta as $key=>$value)		
		{
			$output.=meta($key, $value);
		}
		
		if(isset($head))
		{
			//add default style
			$output.=$this->getStyleLink('bootstrap.css');
			$output.=$this->getStyleLink('bootstrap_todc.css');
			$output.=$this->getStyleLink('style.css');
			$output.=$this->getStyleLink('font-awesome.min.css');
			
			//New Design CSS start.
			$output.=$this->getStyleLink('style_newdesign.css');
			$output.=$this->getStyleLink('font-awesome_newdesign.css');
			//New Design CSS end.
			
			//Generate custom styles
			if(array_key_exists('css',$head) && $head['css']!==false)
			{
				$stylesheets=$head['css'];
				if(is_array($stylesheets))
				{
					foreach($stylesheets as $style)
					{
						$output.=$this->getStyleLink($style);
					}
				}//style array ends
				else
				{
					$output.=$this->getStyleLink($stylesheets);
				}//not array ends
			}
			//Generate custom scripts
			if(array_key_exists('js',$head) && $head['js']!==false)
			{
				$scripts=$head['js'];
				if(is_array($scripts))
				{
					foreach($scripts as $script)
					{
						$output.=$this->getScriptLink($script);
					}
				}//style array ends
				else
				{
					$output.=$this->getScriptLink($scripts);
				}//not array ends
			}
			
		}
		$output.=$this->getAnalyticsCode();//Add Google Analytics Code
		return $output;
	}//getHead Ends
	
	/****************************************************
	*	Generates Footer Data Scripts etc.								 	*	
	****************************************************/		
	function getFooterData($foot)
	{
		$CI =& get_instance();
		$output="";
		/*$output.='<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>';*/
                $output.=$this->getScriptLink('jquery.min.js');
		$output.='<script>var baseUrl="'.$CI->settings->baseUrl().'";</script>';
		$output.=$this->getScriptLink('bootstrap.min.js');
		$output.=$this->getScriptLink('jquery.raty.min.js');
		$output.=$this->getScriptLink('wysihtml5-0.3.0.min.js');
		$output.=$this->getScriptLink('bootstrap-wysihtml5.js');
		$output.=$this->getScriptLink('jquery.li-scroller.1.0.js');
		$output.=$this->getScriptLink('jquery.vticker.min.js');	
		$output.=$this->getScriptLink('base.js');
		$output.=$this->getScriptLink('parsley.js');
		$output.=$this->getScriptLink('innerfade/jquery.innerfade.js');
		$output.=$this->getScriptLink('external.js');
		$output.=$this->getScriptLink('ddsmoothmenu.js');
		
				
		if(array_key_exists('js',$foot) && $foot['js']!==false)
		{						
			//Generate custom scripts
				$scripts=$foot['js'];
				if(is_array($scripts))
				{
					foreach($scripts as $script)
					{
						$output.=$this->getScriptLink($script);
					}
				}//style array ends
				else
				{
					$output.=$this->getScriptLink($scripts);
				}//not array ends			
		}
		return $output;
	}//getFooterData Ends
	
	
	function getStyleLink($path)
	{
		$CI =& get_instance();
		$stylePath=$CI->settings->stylePath();
		if (strpos($path, '~') === false)
		{
			
			return link_tag('themes/'.$this->getTheme().'/'.$stylePath.$path);
		}
		else
		{
			$path=str_replace('~','',$path);
			return link_tag('themes/'.$path);
		}
	}
	
	function getScriptLink($path)
	{
		$CI =& get_instance();
		$scriptPath=$CI->settings->scriptPath();
		if (strpos($path, '~') === false)
		{
			
			$scriptSrc='themes/'.$this->getTheme().'/'.$scriptPath.$path;
		}
		else
		{
			$path=str_replace('~','',$path);
			$scriptSrc='themes/'.$path;
		}
		return '<script src="'.$CI->settings->baseUrl().$scriptSrc.'" type="text/javascript"></script>';
	}	
	
	//Create Google ANalytics Code
	function getAnalyticsCode()
	{
		$CI =& get_instance();
		$analyticsID=$CI->settings->getAnalyticsID();
		return '<script type="text/javascript">'."var _gaq = _gaq || [];_gaq.push(['_setAccount', '".$analyticsID."']);_gaq.push(['_trackPageview']);  (function() {var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);})();</script>";
	}
///////////////////////
	function admin_publish($data)
	{
	//	print_r($data);
//		echo array_key_exists('header',$data);
		$CI =& get_instance();

		//Default Values
		$themeDirectory=$this->getTheme();
		$headerPath='admin_header';
		$footerPath='admin_footer';
		$head=array();
		$footer=array();
		$footerData=array();
		$title=$CI->settings->siteName()." | ".$CI->settings->siteTitle();
		//Generate Layout Header
		if(array_key_exists('header',$data))
		{
			$head['css']=isset($data['header']['css'])?$data['header']['css']:false;
			$head['js']=isset($data['header']['js'])?$data['header']['js']:false;
			$headerPath=isset($data['header']['custom'])?$data['header']['custom']:'admin_header';
			$title=isset($data['header']['title'])?$data['header']['title']:$title;
		}
		if(array_key_exists('footer',$data))
		{
			$footerData['js']=isset($data['footer']['js'])?$data['footer']['js']:false;
		}		
//		$head['meta']=$this->generateHead($themeDirectory);//to include stylesheet
		//check for custom header : else : show default
				
		$page['header']=$CI->load->view($themeDirectory.'/'.$headerPath,$head,true);
		$metaData=$CI->settings->getMetaData();
		foreach($metaData as $metaKey=>$metaValue)
		{
			$meta[$metaKey]=$metaValue;
		}					
		if(array_key_exists('meta',$data))
		{
			foreach($data['meta'] as $metaKey=>$metaValue)
			{
				echo $metaValue;
				$meta[$metaKey]=$metaValue;
			}
		}
		//print_r($meta);
		//Generate Layout Body
		$body['content']=$data['content'];
		
		$page['body']=$CI->load->view($themeDirectory.'/'.$data['content']['template'],$body,true);
		if(!array_key_exists('sidebar',$data) || $data['sidebar']!=false)		
		{
			$sidedata=$data['sidebar']['data']?$data['sidebar']['data']:array();
			$sidebarTemplate=$data['sidebar']['custom']?$data['sidebar']['custom']:'admin_sidebar';
			$page['sidebar']=$CI->load->view($themeDirectory.'/sidebars/'.$sidebarTemplate,$sidedata,true);			
		}
		else
		{
			$page['sidebar']=$CI->load->view($themeDirectory.'/sidebars/'.'nosidebar',$sidedata,true);
		}
		$page['meta']=$this->getHead($title,$meta,$head);
		$page['footerData']=$this->getFooterData($footerData);
		
		//Generate Layout Footer
		if(array_key_exists('footer',$data) && array_key_exists('custom',$data['footer']))
		{			
			$footerPath=isset($data['footer']['custom'])?$data['footer']['custom']:'admin_footer';	
		}
		if(array_key_exists('footer',$data) && array_key_exists('js',$data['footer']))
		{			
			$footer['js']=$data['footer']['js'];	
		}
					
		$page['footer']=$CI->load->view($themeDirectory.'/'.$footerPath,$footer,true);
		$CI->load->view('admin_layout',$page);		
	}//adminPublish Function Ends			
}//Settings Library Ends
?>