<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cities extends CI_Controller {
  public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   function addcity()
   {
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$data['added_by']=userdata('adminid');
			$insert=$this->df->insert_data_id('cities',$data);
			if($insert)
			{
				$slug=url_title($data['city']);
				$this->df->update_record('cities',array('slug'=>$slug),array('id'=>$insert));
				set_message('success','City added successfully!');
				redirect('admin/cities/addcity');
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/cities/addcity');		
			}
			
		}
		else
		{		
			$data['header']['css']=array('jobs/add.css');
			//$data['sidebar']=false;
			//$data['footer']['custom']='plain_footer';
			//$data['header']['custom']='plain_header';			
//			$data['sidebar']['custom']='jobs_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','jobadd.js');		
			$data['content']['template']='admin/city_add.php';	
			$this->layout->admin_publish($data);						
		}
   }   	


	function manage()
	{
		$data['content']['template']='admin/manage_cities';
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;
		$totallistings=$this->df->doquery("select id from cities");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/admin/cities/manage/";
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 8;
		$config['full_tag_open'] = '<div class="pagination"><ul>';
		$config['full_tag_close'] = '</ul></div>';			
		$config['next_link'] = 'Next &raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo; Prev';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="current-link"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';			
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';			
		$this->pagination->initialize($config);
		$data['content']['navigation']=$this->pagination->create_links();
		$data['content']['total']=$total;
		$data['content']['cities']=$this->df->doquery("select * from cities limit $offset,$limit");	
				
		//$data['sidebar']=false;		
		$this->layout->admin_publish($data);		
	}
	
   function editcity()
   {
	   $id=uridata(4);
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			if($data['picture']=='')
			{
				unset($data['picture']);
			}
			$update=$this->df->update_record('cities',$data,array('id'=>$id));
			if($update)
			{
				set_message('success','City info updated successfully!');
				redirect('admin/cities/manage');
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/cities/manage');		
			}
			
		}
		else
		{		
			$data['header']['css']=array('jobs/add.css');
			$data['content']['city']=$this->df->get_single_row('cities',array('id'=>$id));
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','jobadd.js');		
			$data['content']['template']='admin/city_edit.php';	
			$this->layout->admin_publish($data);						
		}
   }   		
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */