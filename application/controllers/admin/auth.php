<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	//$this->load->library('auth');  
	//$this->auth->checkAdminLogin();
   }
   function index()
   {
	   	$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			if($data['username']=='venkat' && $data['password']=='bhima123')
			{
				set_session('adminid',1);
				redirect('admin/news/managenews');
			}
			else
			{
				set_message('error','Oops! Wrong credentials!');
				redirect('admin/auth/index');		
			}
		}
		else
		{
			//$data['header']['css']=array('jobs/add.css');
			$data['sidebar']=false;
			//$data['footer']['custom']='plain_footer';
			//$data['header']['custom']='plain_header';			
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','jobadd.js');		
			$data['content']['template']='admin/login.php';	
			$this->layout->admin_publish($data);
		}

			   
   }
   
   function logout()
   {
	 set_session('adminid',false);  
	 redirect('admin/auth/index');
   }

}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */