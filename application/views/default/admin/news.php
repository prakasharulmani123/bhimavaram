<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	$this->auth->checkAdminLogin();
   }
   function index()
   {
	   set_session('adminid',1);
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
		$insert=$this->df->insert_data_id('news_listings',$data);
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
				$this->df->insert_data('news_photos',$insertdata);				
			}
		}
		
		
		if($insert)
		{
			$slug=url_title($insert.'-'.$data['title']);
			$this->df->update_record('news_listings',array('slug'=>$slug),array('id'=>$insert));
			set_message('success','News submitted successfully! It will be available online once its approved.');
			redirect('news/'.$slug);
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
			$data['content']['template']='admin/news_add.php';	
			$data['content']['categories']=$this->df->get_multi_row('news_categories');		
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

	function theatre_movie_delete_timing()
	{
		$theatreid=uridata('4');
		$movieid=uridata('5');
		$timing=urldecode(uridata('6'));
		$alltimings=$this->df->get_field_value('movie_shows',array('theatreid'=>$theatreid,'movieid'=>$movieid),'timings');
		if(strpos($alltimings,',')>0)
		{
			$alltimings=explode(',',$alltimings);
			
			if(($key = array_search($timing, $alltimings)) !== false) {
   				 unset($alltimings[$key]);
				}
			$alltimings=implode(',',$alltimings);
			$this->df->update_record('movie_shows',array('timings'=>$alltimings),array('theatreid'=>$theatreid,'movieid'=>$movieid));
		}
		else
		{
			$this->df->update_record('movie_shows',array('timings'=>'0'),array('theatreid'=>$theatreid,'movieid'=>$movieid));
			$this->db->simple_query("update movies_listings set theatres=theatres-1 where id='$movieid'");			
		}
		redirect('admin/movies/manage_shows/'.$theatreid);
		
	}
	

	
	private function set_upload_options()
	{   
	//  upload an image options
		$config = array();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
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
	$img_cfg_thumb['width'] = 350;
	$img_cfg_thumb['height'] = 225;
	$this->load->library('image_lib');
	$this->image_lib->initialize($img_cfg_thumb);
	return $this->image_lib->resize();
	}

	function managenews()
	{
		//$data['header']['custom']='plain_header';
		//$data['footer']['custom']='plain_footer';				
		//$data['content']['news']=$this->df->get_multi_row('news_listings');		
		$data['content']['template']='admin/manage_news';
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id from news_listings");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/admin/news/managenews/";
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
		$data['content']['news']=$this->df->doquery("select * from news_listings order by id desc limit $offset,$limit");	
				
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
			$insert=$this->df->update_record('news_listings',$data,array('id'=>$id));
			set_message('success','News updated successfully!');
			redirect('admin/news/managenews');
		}
		else
		{		
			$data['header']['css']=array('news/add.css');
			//$data['sidebar']['custom']='news_add_sidebar';
			//$data['footer']['custom']='plain_footer';
			//$data['header']['custom']='plain_header';
			$data['content']['news']=$this->df->get_single_row('news_listings',array('id'=>$id));
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins/jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','news_photos.js','newsadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='admin/news_edit.php';	
			$data['content']['categories']=$this->df->get_multi_row('news_categories');		
			$this->layout->admin_publish($data);						
		}
	} 
	

	function deletenews()
	{
		$id=uridata(4);
		$this->df->delete_record('news_listings',array('id'=>$id));
		set_message('success','News delted successfully!');
		redirect('admin/news/managenews');
	}
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */