<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	$this->auth->checkAdminLogin();
   }
   function index()
   {
	   set_session('adminid',1);
	   echo "Loggedin as Admin.";
   }
  
	function manageevents()
	{
		//$data['header']['custom']='plain_header';
		//$data['footer']['custom']='plain_footer';				
		$data['content']['events']=$this->df->get_multi_row('events_listings');		
		$data['content']['template']='admin/manage_events';
		//$data['sidebar']=false;		
		$this->layout->admin_publish($data);			
	}
	
	function editevent()
	{
		$id=uridata(4);
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$data['content']=htmlspecialchars($data['content']);
			unset($data['_wysihtml5_mode']);
			unset($data['content']);
			$insert=$this->df->update_record('events_listings',$data,array('id'=>$id));
			set_message('success','Event updated successfully!');
			redirect('admin/events/manageevents');
		}
		else
		{		
			$data['header']['css']=array('news/add.css');
			//$data['sidebar']['custom']='news_add_sidebar';
			//$data['footer']['custom']='plain_footer';
			//$data['header']['custom']='plain_header';
			$data['content']['event']=$this->df->get_single_row('events_listings',array('id'=>$id));
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','parsley.extend.min.js','bootstrap-datepicker.js','timepicker.js','eventadd.js');
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='admin/event_edit';	
//			$data['content']['categories']=$this->df->get_multi_row('event_categories');		
			$this->layout->admin_publish($data);						
		}		
	}
	
		function deleteevents()
	{
		$id=uridata(4);
		$this->df->delete_record('events_listings',array('id'=>$id));
		set_message('success','Event delted successfully!');
		redirect('admin/events/manageevents');
	}

}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */