<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends CI_Controller {
  public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
    function createad()
   {
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$this->load->library('upload');
			$this->upload->initialize($this->set_upload_options());
			$upload=$this->upload->do_upload();			
			if($upload)
			{
				$photodata=$this->upload->data();
				$data['picture']=$photodata['file_name'];
			}
///////////////////////////////
			$sizes=explode('_',$data['sizes']);
			$data['height']=$sizes[1];
			$data['width']=$sizes[0];
			unset($data['sizes']);
			$insert=$this->df->insert_data_id('ads',$data);
			if($insert)
			{
				$slug=url_title($data['city']);
				$this->df->update_record('cities',array('slug'=>$slug),array('id'=>$insert));
				set_message('success','Advt added successfully!');
				redirect('admin/ads/createad');
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/ads/createad');		
			}
			
		}
		else
		{		
			$data['header']['css']=array('jobs/add.css');
			//$data['sidebar']=false;
			//$data['footer']['custom']='plain_footer';
			//$data['header']['custom']='plain_header';			
//			$data['sidebar']['custom']='jobs_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','ad_photos.js');		
			$data['content']['template']='admin/ad_add.php';	
			$this->layout->admin_publish($data);						
		}
   }   	
	
			
	function manageads()
	{
		//$data['header']['custom']='plain_header';
		//$data['footer']['custom']='plain_footer';				
		//$data['content']['ads']=$this->df->get_multi_row('ads',array('active'=>'1'));		
		$data['content']['template']='admin/manage_ads';
		//$data['sidebar']=false;	
			
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id from ads where active='1'");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/admin/ads/manageads/";
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
		$data['content']['ads']=$this->df->doquery("select * from ads where active='1' order by id desc limit $offset,$limit");					
		$this->layout->admin_publish($data);		
	}
	
	function deletead()
	{
		$id=uridata(4);
		$delete=$this->db->simple_query("update ads set active='0' where id='$id'");
		if($delete)
		{
			set_message('success','Ad deleted successfully!');
		}
		redirect('admin/ads/manageads');
	}
	
		private function set_upload_options()
	{   
	//  upload an image options
		$config = array();
		$config['upload_path'] = './uploader/files/thumbnail/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;
	
	
		return $config;
	}	
	
	
	function ad_add_info()
	{
		$data['header']['css']=array('register.css','tagmanager.css');
		$data['footer']['js']=array('parsley.js','chained.js','ad_photos.js');		
		$data['content']['ad']=$this->df->get_single_row('ads',array('id'=>uridata(4)));		
		$data['content']['template']='admin/ad_add_info';
		$this->layout->admin_publish($data);	
	}
	
	function update_add_info()
	{
		$data=$this->general->get_post_values();
		$data=$this->general->processData($data);
	 	$this->load->library('upload');	
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		//echo '<pre>';
		$photos=array();
		for($i=0; $i<=$cpt; $i++)
		{
	
			$_FILES['userfile']['name']= $files['userfile']['name'][$i];
			$_FILES['userfile']['type']= $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']= $files['userfile']['size'][$i];    	
			$this->upload->initialize($this->set_upload_options());
			$upload=$this->upload->do_upload();			
			if($upload)
			{
				$photodata=$this->upload->data();
				//$this->resize_image($photodata['file_name']);
				$photos[]=$photodata['file_name'];
				//$insert=array('albumid'=>$data['albumid'],'title'=>$data['title'][$i],'photo'=>$photodata['file_name']);
				//$this->df->insert_data('photos',$insert);				
			}
		}
		//print_r($photos);
		//exit;
		$photos=implode(',',$photos);
		$adData=array('add_photos'=>$photos,'description'=>$data['description'],'address'=>$data['address']);
		$update=$this->df->update_record('ads',$adData,array('id'=>$data['adid']));
		if($update)
		{
			//echo '<div class="span10 center-align center padding10">Photos uploaded successfully!</div>';
			set_message('success','Ad information uploaded successfully!');
			redirect('admin/ads/ad_add_info/'.$data['adid']);
		}
	}
	
	
   function editad()
   {
		$data=$this->general->get_post_values();
		$id=uridata(4);
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$this->load->library('upload');
			$this->upload->initialize($this->set_upload_options());
			$upload=$this->upload->do_upload();			
			if($upload)
			{
				$photodata=$this->upload->data();
				$data['picture']=$photodata['file_name'];
			}
///////////////////////////////
			$sizes=explode('_',$data['sizes']);
			$data['height']=$sizes[1];
			$data['width']=$sizes[0];
			unset($data['sizes']);
			$update=$this->df->update_record('ads',$data,array('id'=>$id));
			if($update)
			{
				set_message('success','Advt updated successfully!');
				redirect('admin/ads/manageads');
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/ads/manageads');		
			}
			
		}
		else
		{		
			$data['header']['css']=array('jobs/add.css');
			$data['content']['ad']=$this->df->get_single_row('ads',array('id'=>$id));
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','ad_photos.js');		
			$data['content']['template']='admin/ad_edit.php';	
			$this->layout->admin_publish($data);						
		}
   } 	
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */