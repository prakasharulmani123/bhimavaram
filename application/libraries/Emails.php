<?php
class Emails
{
    function __construct() {
	   $CI =& get_instance();
    }
	/****************************************************
	*	Sends Email 									*	
	****************************************************/		
	function send_mail($to,$subject,$content,$template=false,$from=false,$notification=true)
		{
			$CI =& get_instance();
			if($from==false)
			{
				$from=$CI->settings->siteEmail();
			}
			$CI->load->library('email');
			$CI->load->helper('email');
			$CI->email->to($to);
			$CI->email->from($from);
			$CI->email->subject($subject);			
			$content=$this->getTemplated($subject,$content);
			$CI->email->message($content);
			$CI->email->send();
			$CI->email->clear();
			return TRUE;
			//echo $this->email->print_debugger();
			
		}//Send_Email Ends

	/****************************************************
	*	Add Email Content to Template 										*	
	****************************************************/		
		
		function getTemplated($subject,$content)
		{
			$CI =& get_instance();
			$data['content']=$content;
			$data['subject']=$subject;
			return $CI->load->view($CI->layout->getTheme().'/'.'email_template',$data,true);
		}
				
}//Emails Library Ends
?>