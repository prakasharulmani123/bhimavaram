<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   
   function index()
   {
	   	$slug=uridata(3)?uridata(3):'everything';
		$cityid=userdata('cityid');
		//pagination
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=8;
		if($slug!='everything')
		{
			$category=$this->df->get_single_row('news_categories',array('slug'=>$slug));
			$catid=$category['id'];	
			$catfilter=" where category='$catid' and ";
		}
		else
		{
			$catfilter=" where ";
		}		
		$totallistings=$this->df->doquery("select id from news_listings".$catfilter."cityid='$cityid' and approved='1'");

		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/news/index/".$slug."/";
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
		$query="select * from news_listings".$catfilter."cityid='$cityid' and approved='1' order by id desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);					
		//$this->load->library('auth');
		$data['header']['css']=array('news/list.css');
		//$data['sidebar']=false;
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='news_browse.php';		
		$data['content']['categories']=$this->df->get_multi_row('news_categories',false,false,false,array('id'=>'asc'));	
		$this->layout->publish($data); 
   }
   
   
   function searchresults()
   {
		$cityid=userdata('cityid');
		$q=uridata('3');
		//pagination
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;		
		$totallistings=$this->df->doquery("select id from news_listings where (title like '%$q%' or content like '%$q%') and cityid='$cityid' and approved='1'");

		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/news/searchresults/".$q."/";
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
		$query="select * from news_listings where (title like '%$q%' or content like '%$q%') and cityid='$cityid' and approved='1' order by id desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);					
		//$this->load->library('auth');
		$data['header']['css']=array('news/list.css');
		//$data['sidebar']=false;
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='news_browse.php';		
		$data['content']['categories']=$this->df->get_multi_row('news_categories',false,false,false,array('id'=>'asc'));	
		$this->layout->publish($data); 
   }
      

	
	function show()
	{
		$slug=uridata(2);
		$cityid=userdata('cityid');
		$data['content']['single_page']=true;
		$data['content']['news']=$this->df->get_single_row('news_listings',array('slug'=>$slug));
		$this->db->simple_query("update news_listings set visits=visits+1 where slug='$slug'");
		$data['header']['css']=array('news/show.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js','news_show.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='news_show.php';
		$category=$data['content']['news']['category'];		
		$id=$data['content']['news']['id'];
		$data['content']['pictures']=$this->df->get_multi_row('news_photos',array('newsid'=>$id));
		$data['content']['related']=$this->df->doquery("select * from news_listings where cityid='$cityid' and approved='1' and category='$category' and id!='$id' order by id desc limit 5");
		$this->layout->publish($data);
	}	
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */