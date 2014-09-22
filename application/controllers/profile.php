<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	  
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	$this->auth->checkLogin();
   }
   
	public function index()
	{
		$this->auth->checkLogin();
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			if($data['picture']=="")
			{
				unset($data['picture']);
			}
			else
			{
				set_session('picture',$data['picture']);
			}			
			set_session('name',$data['name']);
			$this->df->update_record('users',$data,array('uid'=>userdata('uid')));
			set_message('success','Profile successfully updated!');
			redirect('profile/index/profile');
		}
		else
		{
			$data=$this->general->processData($data);
			$this->load->library('auth');
			$data['header']['css']=array('edit_profile.css');
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','edit_profile.js','picture_upload.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='edit_profile';		
			$this->layout->publish($data);				
		}
	}
	
	function password()
	{
		$this->auth->checkLogin();
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			$user=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$pass=$data['password'];
			$cpass=$data['confirmpassword'];
			if($pass==$cpass)
			{
				$this->load->library('encrypt');
				$encpass=$this->encrypt->encode($pass);
				$this->df->update_record('users',array('password'=>$encpass),array('uid'=>userdata('uid')));
				set_message('success','Password updated successfully!');
				redirect('profile/index');
			}
			else
			{
				set_message('error',"Oops! Passwords doesn't match!");
				redirect('profile/index');			
			}
		}
		else
		{
				set_message('error',"Oops! Please enter both passwords!");
				redirect('profile/index');
		}
	}
	
	
	function notifications()
	{
		$this->auth->checkLogin();
		$data=$this->general->get_post_values();
		$data=$this->general->processData($data);
		$profile['messaging']=isset($data['messaging'])?$data['messaging']:'0';				
		$profile['newsletter']=isset($data['newsletter'])?$data['newsletter']:'0';
		$update=$this->df->update_record('users',$profile,array('uid'=>userdata('uid')));				
		if($update)
		{
			set_message('success','Notification settings updated successfully!');
			redirect('profile/index');			
		}
		else
		{
			set_message('error','Oops! Something gone wrong!!');
			redirect('profile/index');						
		}
	}
	
}//controller ends

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */