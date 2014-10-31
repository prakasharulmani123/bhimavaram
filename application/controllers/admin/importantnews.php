<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ImportantNews extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	$this->auth->checkAdminLogin();
   }
   
	function add()
	{
		//$this->auth->checkLogin();
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			
			$data['uid']=userdata('adminid');			
			//$data['cityid']=userdata('cityid');
			$data['content']=htmlspecialchars($data['content']);
			$data['ipaddress']=ip();
			unset($data['_wysihtml5_mode']);
			//echo '<pre>';
			//print_r($data);
			//exit;
			
	 	$this->load->library('upload');	
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		//echo '<pre>';
		$userfile=$data['userfile'];
		unset($data['userfile']);
		$insert=$this->df->insert_data_id('important_news',$data);
		//print_r($insert);
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
				$this->resize_image($photodata['file_name']);
				$insertdata=array('newsid'=>$insert,'photo'=>$photodata['file_name']);
				$this->df->insert_data('important_news_photos',$insertdata);				
			}
		}
		
		
		if($insert)
		{
			if($data['slug'] == ''){
				$slug=url_title($insert.'-'.$data['title']);
				$this->df->update_record('important_news',array('slug'=>$slug),array('id'=>$insert));
			}
			set_message('success','News submitted successfully! It will be available online once its approved.');
			redirect('admin/importantnews/managenews');
			//redirect('news/'.$slug);
		}
		else
		{
			set_message('error','Oops! Something went wrong!');
			redirect('news/index');		
		}
			
		}
		else
		{		
			$data['header']['css']=array('news/add.css');
			//$data['sidebar']['custom']='news_add_sidebar';
			//$data['footer']['custom']='plain_footer';
			//$data['header']['custom']='plain_header';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins/jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','news_photos.js','newsadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='admin/important_news_add.php';	
			$this->layout->admin_publish($data);						
		}
	}  
	
	function upload_photos()
	{
		$data=$this->general->get_post_values();
		$data=$this->general->processData($data);
	 	$this->load->library('upload');	
		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);
		//echo '<pre>';
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
				$this->resize_image($photodata['file_name']);
				$insert=array('albumid'=>$data['albumid'],'title'=>$data['title'][$i],'photo'=>$photodata['file_name']);
				$this->df->insert_data('photos',$insert);				
			}
			
		}
		echo '<div class="span10 center-align center padding10">Photos uploaded successfully!</div>';
	}

	
	private function set_upload_options()
	{   
	//  upload an image options
		$config = array();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']      = '0';
		$config['overwrite']     = FALSE;
	
	
		return $config;
	}	

	public function resize_image($image)
	{
	$img_cfg_thumb['image_library'] = 'gd2';
	$img_cfg_thumb['source_image'] = "./uploads/" . $image;
	$img_cfg_thumb['new_image'] = "./uploads/thumb/" . $image;
	$img_cfg_thumb['maintain_ratio'] = TRUE;
	//$img_cfg_thumb['new_image'] = $new_name;
	$img_cfg_thumb['width'] = 520;
	$img_cfg_thumb['height'] = 271;
	$this->load->library('image_lib');
	$this->image_lib->initialize($img_cfg_thumb);
	return $this->image_lib->resize();
	}

	function managenews()
	{
		//$data['header']['custom']='plain_header';
		//$data['footer']['custom']='plain_footer';				
		//$data['content']['news']=$this->df->get_multi_row('news_listings');		
		$data['content']['template']='admin/manage_important_news';
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id from important_news");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/admin/importantnews/managenews/";
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
		$data['content']['news']=$this->df->doquery("select * from important_news order by id desc limit $offset,$limit");	
				
		//$data['sidebar']=false;		
		$this->layout->admin_publish($data);		
	}


	function editnews()
	{
		$id=uridata(4);
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$data['content']=htmlspecialchars($data['content']);
			unset($data['_wysihtml5_mode']);
			
			if(substr($data['slug'],0,4) != 'http'){
				$data['slug'] = url_title($id.'-'.$data['title']);
			}

			$insert=$this->df->update_record('important_news',$data,array('id'=>$id));
			set_message('success','Important News updated successfully!');
			//redirect('news/'.$slug);
			redirect('admin/importantnews/managenews');
		}
		else
		{		
			$data['header']['css']=array('news/add.css');
			//$data['sidebar']['custom']='news_add_sidebar';
			//$data['footer']['custom']='plain_footer';
			//$data['header']['custom']='plain_header';
			$data['content']['news']=$this->df->get_single_row('important_news',array('id'=>$id));
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins/jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','news_photos.js','newsadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='admin/important_news_edit.php';	
			$this->layout->admin_publish($data);						
		}
	} 
	

	function deletenews()
	{
		$id=uridata(4);
		$this->df->delete_record('important_news',array('id'=>$id));
		$this->df->delete_record('important_news_photos',array('newsid'=>$id));
		set_message('success','Important News delted successfully!');
		redirect('admin/importantnews/managenews');
	}
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */