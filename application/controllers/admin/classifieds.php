<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classifieds extends CI_Controller {
  public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
			
	function manage()
	{
		$data['content']['template']='admin/manage_classifieds';
		$data['footer']['js']=array('classy_admin.js');
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id from classy_listings where active='1'");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/admin/classifieds/manage/";
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
		$data['content']['ads']=$this->df->doquery("select * from classy_listings where active='1' order by id desc limit $offset,$limit");
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
	
		function updatead()
	{
		$values=postdata('values');
		$values=explode(':',$values);
		
		$delete=$this->db->simple_query("update classy_listings set approved='".$values[1]."' where id='".$values[0]."'");
		if($delete)
		{
			echo 'Classified ad updated successfully!';
		}
		else
		{
			echo 'Oops! Something went wrong!';
		}
		
	}
		function delete()
	{
		$id=uridata(4);
		$delete=$this->db->simple_query("delete from classy_listings where id='$id'");
		if($delete)
		{
			set_message('success','Classified ad deleted successfully!');
		}
		redirect('admin/classifieds/manage');
	}
	
	function editit()
	{
		$id=uridata(4);
		$data=$this->general->get_post_values();
		
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$data['uid']=userdata('uid');
			$data['cityid']=userdata('cityid');
			unset($data['parentcategory']);
			unset($data['_wysihtml5_mode']);
			if($data['picture']=='')
			{
				unset($data['picture']);
			}
			$data['date_posted']=date("Y-m-d");
			$data['expiry_date']=dateadd(date("M d, Y"),'+30');
			$data['description']=htmlspecialchars($data['description']);
			$update=$this->df->update_record('classy_listings',$data,array('id'=>$id));
			if($update)
			{
				set_message('success','Classified has been updated successfully!');
				redirect('admin/classifieds/manage');
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/classifieds/manage');		
			}
			
		}
		else
		{		
			$data['header']['css']=array('yp/add.css');
			$data['content']['ad']=$this->df->get_single_row('classy_listings',array('id'=>$id));
			//$data['sidebar']['custom']='classy_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','classyadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='admin/classy_edit.php';	
			$data['content']['subcategories']=$this->df->doquery("select * from classy_categories where parentid > 0 order by name asc");
			$data['content']['categories']=$this->df->get_multi_row('classy_categories',array('parentid'=>0),false,false,array('name'=>'asc'));		
			$this->layout->admin_publish($data);						
		}
	} 
	
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */