<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Movies extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   
   function index()
   {
	   $cityid=userdata('cityid');
		$offset=uridata(5) ? uridata(5) : 0;
		$limit=8;	   
	   if(uridata('3')!='0'){set_session('category',uridata('3'));}
	   if(uridata('4')!='0'){set_session('language',uridata('4'));}
	   	$data['content']['category']=userdata('category')?userdata('category'):'0';
	   	$data['content']['language']=userdata('language')?userdata('language'):'0';
		$data=$this->general->processData($data);
		//$this->load->library('auth');
		if($data['content']['category']!='0')
		{
			$typefilter=" and category='".$data['content']['category']."' ";
		}
		if($data['content']['language']!='0')
		{
			$indfilter=" and language='".$data['content']['language']."' ";
		}	
		$last_date=date("Y-m-d");		
//////Pagination
		$totalquery="select id from movies_listings where theatres > 0 ".$typefilter.$indfilter;
		$totallistings=$this->df->doquery($totalquery);
//		print_r($totallistings);
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/movies/index/".$data['content']['category']."/".$data['content']['language'].'/';
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 6;
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
		$query="select * from movies_listings where theatres > '0' ".$typefilter.$indfilter." order by theatres desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);		
		$data['header']['css']=array('movies/list.css');
//		$data['sidebar']['custom']='jobs_list_sidebar';
//		$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','edit_profile.js','picture_upload.js');		
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='movies_browse.php';		
		$data['content']['categories']=$this->df->get_multi_row('movies_categories',false,false,false,array('name'=>'asc'));		
		$data['content']['languages']=$this->df->get_multi_row('movies_languages',false,false,false,array('name'=>'asc'));		
		$this->layout->publish($data); 
   }
   
   function searchresults()
   {
	   $cityid=userdata('cityid');
	   $q=uridata(3);
		$offset=uridata(5) ? uridata(5) : 0;
		$limit=8;
		$last_date=date("Y-m-d");		
//////Pagination
		$totalquery="select id from movies_listings where (name like '%$q%' or cast like '%$q%' or description like '%$q%' ) and theatres > 0 ";
		$totallistings=$this->df->doquery($totalquery);
//		print_r($totallistings);
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/movies/index/".$data['content']['category']."/".$data['content']['language'].'/';
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 6;
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
		$query="select * from movies_listings where (name like '%$q%' or cast like '%$q%' or description like '%$q%' ) and theatres > 0 order by theatres desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);		
		$data['header']['css']=array('movies/list.css');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='movies_browse.php';		
		$data['content']['categories']=$this->df->get_multi_row('movies_categories',false,false,false,array('name'=>'asc'));		
		$data['content']['languages']=$this->df->get_multi_row('movies_languages',false,false,false,array('name'=>'asc'));		
		$this->layout->publish($data); 
   }   
		
	function resetfilter()
	{
		$name=uridata('3');
		$_SESSION[$name]=false;
	   	$data['content']['category']=userdata('category')?userdata('category'):'0';
	   	$data['content']['language']=userdata('language')?userdata('language'):'0';
		redirect('movies/index/'.$data['content']['category'].'/'.$data['content']['language']);
	}
	
	function show()
	{
		$slug=uridata(2);
		$cityid=userdata('cityid');
		$data['content']['movie']=$this->df->get_single_row('movies_listings',array('slug'=>$slug));
		$data['content']['single_page']=true;
		$this->db->simple_query("update movies_listings set visits=visits+1 where slug='$slug'");
		$data['header']['css']=array('movies/show.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js','news_show.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='movies_show.php';
		//$category=$data['content']['news']['category'];
		//$id=$data['content']['news']['id'];
		//$data['content']['related']=$this->df->doquery("select * from movies_listings where slug='$slug'");
		$this->layout->publish($data);
	}
	
	function theatres()
	{		
		$cityid=userdata('cityid');
		//pagination
		$offset=uridata(3) ? uridata(3) : 0;
		$limit=10;
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/movies/theatres/";
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
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
		$data['content']['listings']=$this->df->doquery("select * from movies_theatres where cityid='$cityid' order by review_score desc limit $offset,$limit");			
		$data['header']['css']=array('yp/listings.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js');
		//$data['sidebar']=false;
		$data['content']['template']='theatre_listings.php';		
		$data['content']['category']=$category;
		$this->layout->publish($data);						
	}			
	
	function theatre()
	{
		$slug=uridata(3);
		$cityid=userdata('cityid');
		$data['content']['theatre']=$this->df->get_single_row('movies_theatres',array('slug'=>$slug));
		$this->db->simple_query("update movies_theatres set visits=visits+1 where slug='$slug'");
		$data['header']['css']=array('movies/show.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js','news_show.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='theatres_show.php';
		//$category=$data['content']['news']['category'];
		//$id=$data['content']['news']['id'];
		//$data['content']['related']=$this->df->doquery("select * from movies_listings where slug='$slug'");
		$this->layout->publish($data);
	}	

	function checkuserlogin(){
		$this->auth->checkLogin();
		$slug=uridata(3);
		$item_type=uridata(4);
		$item_type == 'theatre' ? $url = 'movies/'.$item_type.'/'.$slug : $url = 'movies/'.$slug;
		redirect($url);
	}
		
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */