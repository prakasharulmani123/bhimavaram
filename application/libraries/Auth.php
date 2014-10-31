<?php
class Auth
{
    function __construct() {
       $this->CI =& get_instance();
	   $CI =& get_instance();
    }
	
	/****************************************************
	*	Adds new user								 	*	
	****************************************************/
	
	function addUser($data,$confirmation=false) {
			$CI =& get_instance();			
			$uid=$insert=$CI->df->insert_data_id('users',$data);
			$this->_welcomeUser($uid,true);	
			return $uid;
		}
	
	function _welcomeUser($uid,$confirmation=false)
	{
		$CI =& get_instance();
		$user=$CI->df->get_single_row('users',array('uid'=>$uid));
		$CI->load->library('emails');
		if($confirmation)
		{
			$content="Welcome to the ".$CI->settings->siteName()." community, it's great to have you join us.<br><br>";
			$key=$CI->general->randomKey(20);
			$this->CI->df->update_record('users',array('confirmkey'=>$key),array('uid'=>$user['uid']));
			
//			$msg.=base_url()."index.php/site/verify/".$user['uid'].'/'.$key;
			$content.=anchor('site/verify/'.$user['uid'].'/'.$key).'<br><br>'."To make the most of ".$CI->settings->siteName().", please take a second to verify your email address by clicking the link above.<br>we can't wait to see what you're doing";
			
			$message='Thanks for creating a/c with Bhimavaram.com';
			$CI->emails->send_mail($user['email'],'Please Confirm Your Email Address ('.$user['email'].')',$content);
		}
		else
		{
			$message="Welcome ".$user['name'].'. Please complete your profile '.anchor('profile/index','here');
		}
		set_message('success',$message);
		return true;
	}
	
	/****************************************************
	*	Check Reditrect Source 	*	
	****************************************************/			
	function checkRedirectSource()
	{
		if($_SESSION['redirectSource'])
		{
			redirect($_SESSION['redirectSource']);
		}
	}
	
	function setRedirectSource()
	{
		$uristring=uri_string();
		$_SESSION['redirectSource']=$uristring;
	}
	
	function setLogin($uid)
	{
		$CI =& get_instance();
		$u=$CI->df->get_single_row('users',array('uid'=>$uid));
		$sess=array('loggedin'=>true,'uid'=>$u['uid'],'name'=>$u['name'],'picture'=>$u['picture'],'email'=>$u['email']);
		set_session($sess);
		return true;		
	}	
	function checkLogin()
	{
		$CI =& get_instance();
		if(!userdata('uid'))
		{
			//set_session('error','Login to continue');
			set_session('redirectSource',$CI->uri->uri_string());
			redirect('start/signin');
		}
	}
	
	function checkRelogin()
	{		
		if(userdata('uid'))
		{
			redirect(base_url());
		}
	}
	
	
	function checkAdminLogin()
	{
		$CI =& get_instance();
		if(!userdata('adminid'))
		{
			echo "You're not loggedin as admin";
			exit;
		}
	}	
				
}//Auth Library Ends
?>