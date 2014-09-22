<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishes extends CI_Controller {
  public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
			
	function manage()
	{
		//$data['header']['custom']='plain_header';
		//$data['footer']['custom']='plain_footer';				
		
		
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id from wishes");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/admin/wishes/manage/";
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
		$data['content']['listings']=$this->df->doquery("select * from wishes order by id desc limit $offset,$limit");					
		$data['content']['template']='admin/manage_wishes';
		//$data['sidebar']=false;		
		$this->layout->admin_publish($data);		
	}
	
	function deletewish()
	{
		$id=uridata(4);
		$delete=$this->db->simple_query("delete from wishes where id='$id'");
		if($delete)
		{
			set_message('success','Wish deleted successfully!');
		}
		redirect('admin/wishes/manage');
	}
	
	function updatewish()
	{
		$values=postdata('values');
		$values=explode(':',$values);
		
		$delete=$this->db->simple_query("update wishes set approved='".$values[1]."' where id='".$values[0]."'");
		if($delete)
		{
			echo 'Wish updated successfully!';
		}
		else
		{
			echo 'Oops! Something went wrong!';
		}
		
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
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */