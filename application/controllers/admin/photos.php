<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller {
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
   function addalbum()
   {
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$data['added_by']=userdata('adminid');
			//$data['cityid']=userdata('cityid');
			unset($data['_wysihtml5_mode']);
			$data['cities']=implode(',',$data['cities']);
			//$data['date_posted']=date("Y-m-d");
//			$data['expiry_date']=dateadd(date("M d, Y"),'+30');
			$data['description']=htmlspecialchars($data['description']);						
			$insert=$this->df->insert_data_id('photo_albums',$data);
			if($insert)
			{
				$slug=url_title($insert.'-'.$data['name']);
				$this->df->update_record('photo_albums',array('slug'=>$slug),array('id'=>$insert));
				set_message('success','Album added successfully!');
				redirect('admin/photos/addphotos/'.$slug);
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/photos/addalbum');		
			}
			
		}
		else
		{		
			//$data['header']['custom']='plain_header';
			//$data['footer']['custom']='plain_footer';
			//$data['sidebar']=false;
//			$data['sidebar']['custom']='jobs_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','bootstrap-datepicker.js','jobadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='admin/album_Add.php';	
			$data['content']['cities']=$this->df->get_multi_row('cities',false,false,false,array('city'=>'asc'));		
//			$data['content']['qualifications']=$this->df->get_multi_row('jobs_qualifications',false,false,false,array('name'=>'asc'));		
			$this->layout->admin_publish($data);						
		}
   }
   function addvideo()
   {
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$data['added_by']=userdata('adminid');
			$data['cities']=implode(',',$data['cities']);
			$insert=$this->df->insert_data_id('videos',$data);
			if($insert)
			{
				$slug=url_title($insert.'-'.$data['title']);
				$this->df->update_record('videos',array('slug'=>$slug),array('id'=>$insert));
				set_message('success','Video added successfully!');
				redirect('admin/photos/addvideo');
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/photos/addvideo');		
			}
			
		}
		else
		{		
			//$data['header']['custom']='plain_header';
			//$data['footer']['custom']='plain_footer';
			//$data['sidebar']=false;
//			$data['sidebar']['custom']='jobs_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','bootstrap-datepicker.js','jobadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='admin/video_add.php';	
			$data['content']['cities']=$this->df->get_multi_row('cities',false,false,false,array('city'=>'asc'));		
//			$data['content']['qualifications']=$this->df->get_multi_row('jobs_qualifications',false,false,false,array('name'=>'asc'));		
			$this->layout->admin_publish($data);						
		}
   }
   
   
	function choose_album()	
	{
		//$data['header']['custom']='plain_header';
		$data['header']['css']=array('register.css');
		$data['footer']['js']=array('parsley.js','chained.js','choose_theatre.js');		
		//$data['footer']['custom']='plain_footer';		
		$data['content']['template']='admin/choose_album';
		$data['content']['theatres']=$this->df->get_multi_row('photo_albums');
		//$data['sidebar']=false;		
		$this->layout->admin_publish($data);
	}
	
	

		
	function add_photos()
	{
		$data=$this->general->get_post_values();
		$data=$this->general->processData($data);
		$albumid=uridata('4')?uridata('4'):postdata('albumid');
		if(!$albumid)
		{
			redirect('admin/photos/choose_album');
		}
		//$data['header']['custom']='plain_header';
		$data['header']['css']=array('register.css','tagmanager.css');
		$data['footer']['js']=array('parsley.js','chained.js','upload_photos.js');		
		//$data['footer']['custom']='plain_footer';				
		$data['content']['album']=$this->df->get_single_row('photo_albums',array('id'=>$albumid));		
		$data['content']['albumid']=$albumid;
		$data['content']['template']='admin/add_photos';
		//$data['sidebar']=false;		
		$this->layout->admin_publish($data);		
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
	$img_cfg_thumb['width'] = 200;
	$img_cfg_thumb['height'] = 200;
	$this->load->library('image_lib');
	$this->image_lib->initialize($img_cfg_thumb);
	return $this->image_lib->resize();
	}
	
	
	function manage()
	{
		$data['content']['albums']=$this->df->get_multi_row('photo_albums');		
		$data['content']['template']='admin/manage_Albums';
		$this->layout->admin_publish($data);			
	}	
	
	function manage_photos()
	{
		$id=uridata(4);
		$data['content']['photos']=$this->df->get_multi_row('photos',array('albumid'=>$id));		
		$data['content']['template']='admin/manage_photos';
		$this->layout->admin_publish($data);			
	}		

	function deletealbum()
	{
		$id=uridata(4);
		$delete=$this->db->simple_query("delete from photo_albums where id='$id'");
		if($delete)
		{
			set_message('success','Photo album deleted successfully!');
		}
		redirect('admin/photos/manage');
	}
	
	function deletephoto()
	{
		$id=uridata(4);
		$albumid=uridata(5);
		$delete=$this->db->simple_query("delete from photos where id='$id'");
		if($delete)
		{
			set_message('success','Photo deleted successfully!');
		}
		redirect('admin/photos/manage_photos/'.$albumid);
	}	
	
	function manage_videos()
	{
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id from videos");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/admin/photos/manage_videos/";
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
		$data['footer']['js']=array('wishes_admin.js');
		$data['content']['videos']=$this->df->doquery("select * from videos order by id desc limit $offset,$limit");					
		$data['content']['template']='admin/manage_videos';
		//$data['sidebar']=false;		
		$this->layout->admin_publish($data);		
	}
	function deletevideo()
	{
		$id=uridata(4);
		$albumid=uridata(5);
		$delete=$this->db->simple_query("delete from videos where id='$id'");
		if($delete)
		{
			set_message('success','Video deleted successfully!');
		}
		redirect('admin/photos/manage_videos/'.$albumid);
	}	

   function editalbum()
   {
	   $id=uridata(4);
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			unset($data['_wysihtml5_mode']);
			$data['description']=htmlspecialchars($data['description']);						
			$update=$this->df->update_record('photo_albums',$data,array('id'=>$id));
			if($update)
			{
				set_message('success','Album updated successfully!');
				redirect('admin/photos/manage/');
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/photos/manage');		
			}
			
		}
		else
		{		
			$data['content']['album']=$this->df->get_single_row('photo_albums',array('id'=>$id));
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','bootstrap-datepicker.js','jobadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='admin/album_edit.php';	
			$data['content']['cities']=$this->df->get_multi_row('cities',false,false,false,array('city'=>'asc'));		
			$this->layout->admin_publish($data);						
		}
   }
   
	function editvideo()
   {
	    $id=uridata(4);
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$update=$this->df->update_record('videos',$data,array('id'=>$id));
			if($update)
			{
				set_message('success','Video updated successfully!');
				redirect('admin/photos/manage_videos');
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/photos/manage_videos');		
			}
			
		}
		else
		{		
			$data['content']['video']=$this->df->get_single_row('videos',array('id'=>$id));
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','bootstrap-datepicker.js','jobadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='admin/video_edit.php';	
			$data['content']['cities']=$this->df->get_multi_row('cities',false,false,false,array('city'=>'asc'));		
			$this->layout->admin_publish($data);						
		}
   }


}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */