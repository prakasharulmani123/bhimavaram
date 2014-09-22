<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   function index()
   {
		$this->load->helper('video');
		$this->load->library('YoutubeVideoDetails');
		$offset=uridata(3) ? uridata(3) : 0;
		$limit=9;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id,cities from videos where find_in_set($cityid,cities) or find_in_set('0',cities) ");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/videos/index/";
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 8;
		$config['full_tag_open'] = '<div class="clearbig">&nbsp;</div><div class="pagination"><ul>';
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
		$query="select * from videos where find_in_set($cityid,cities) or find_in_set('0',cities) order by id desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);					
		//echo '<pre>';
		//print_r($data['content']['listings']);
		$data['header']['css']=array('photos/listings.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js');		
		//$data['sidebar']=false;
		$data['content']['template']='photos/videos_gallery.php';		
		//$data['content']['category']=$category;
		$this->layout->publish($data);	
   }
      
	function show()
	{
		$this->load->helper('video');
		$this->load->library('YoutubeVideoDetails');
		$slug=uridata(2);
		$cityid=userdata('cityid');
		$data['content']['video']=$this->df->get_single_row('videos',array('slug'=>$slug));
		$data['content']['single_page']=true;
		$id=$data['content']['video']['id'];
		$query="select * from videos where find_in_set($cityid,cities) or find_in_set('0',cities) order by id desc limit 4";
		$data['content']['related']=$this->df->doquery($query);
		//$albumid=$data['content']['photo']['albumid'];
		$this->db->simple_query("update videos set visits=visits+1 where slug='$slug'");
		$data['header']['css']=array('photos/show.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js','news_show.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		//create next nav
		$nextposts=$this->df->doquery("select * from videos where (find_in_set($cityid,cities) or find_in_set('0',cities)) and id > '$id' ");
		if(count($nextposts)>0)
		{
		$data['content']['next']=$this->df->doquery("select * from videos where (find_in_set($cityid,cities) or find_in_set('0',cities)) and id > '$id'  limit 1");
		}
		else
		{
			$data['content']['next']=0;
		}
		//create prev nav
		$prevposts=$this->df->doquery("select * from videos where (find_in_set($cityid,cities) or find_in_set('0',cities)) and id < '$id'");
		if(count($prevposts)>0)
		{
		$data['content']['prev']=$this->df->doquery("select * from videos where (find_in_set($cityid,cities) or find_in_set('0',cities)) and id < '$id'  limit 1");
		//print_r($data['content']['prev']);
		}
		else
		{
			$data['content']['prev']=0;
		}			
		$data['content']['template']='video_show.php';
		
		$data['content']['related']=$this->df->doquery("select * from videos where find_in_set($cityid,cities) or find_in_set('0',cities) order by rand() limit 4");
		$this->layout->publish($data);
	}	   

}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */