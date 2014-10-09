<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   function index()
   {
		$offset=uridata(3) ? uridata(3) : 0;
		$limit=10;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id,cities from photo_albums where find_in_set($cityid,cities) or find_in_set('0',cities) ");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/photos/index/";
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
		$query="select * from photo_albums where find_in_set($cityid,cities) or find_in_set('0',cities) order by id desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);					
		//echo '<pre>';
		//print_r($data['content']['listings']);
		$data['header']['css']=array('photos/listings.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js');		
		//$data['sidebar']=false;
		$data['content']['template']='photos/photos_gallery.php';		
		//$data['content']['category']=$category;
		$this->layout->publish($data);	
   }
   
   function gallery()
   {
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=9;
		$slug=uridata('3');
		$album=$this->df->get_single_row('photo_albums',array('slug'=>$slug));
		$albumid=$album['id'];
		$totallistings=$this->df->doquery("select * from photos where albumid='$albumid' ");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/photos/gallery/".uridata('3').'/';
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
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
		$query="select * from photos where albumid='$albumid' order by id desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);			
		$data['content']['album']=$album;
		//echo '<pre>';
		//print_r($data['content']['listings']);
		$data['header']['css']=array('photos/listings.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js');		
		//$data['sidebar']=false;
		$data['content']['template']='photos/gallery.php';		
		//$data['content']['category']=$category;
		$this->layout->publish($data);	
   }   
   
	function show()
	{
		$id=uridata(3);
		$data['content']['photo']=$this->df->get_single_row('photos',array('id'=>$id));	
		$data['content']['single_page']=true;
		$data['content']['album']=$this->df->get_single_row('photo_albums',array('id'=>$data['content']['photo']['albumid']));
		$data['content']['photos']=$this->df->get_single_row('photos',array('albumid'=>$data['content']['photo']['albumid']));	
		$albumid=$data['content']['photo']['albumid'];
		$this->db->simple_query("update photos set visits=visits+1 where id='$id'");
		$data['header']['css']=array('photos/show.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js','news_show.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		//create next nav
		$nextposts=$this->df->doquery("select id from photos where id > '$id' and albumid='$albumid'");
		if(count($nextposts)>0)
		{
		$data['content']['next']=$this->df->doquery("select id from photos where id > '$id' and albumid='$albumid' limit 1");
		}
		else
		{
			$data['content']['next']=0;
		}
		//create prev nav
		$prevposts=$this->df->doquery("select id from photos where id < '$id' and albumid='$albumid'");
		if(count($prevposts)>0)
		{
		$data['content']['prev']=$this->df->doquery("select * from photos where id < '$id' and albumid='$albumid' limit 1");
		//print_r($data['content']['prev']);
		}
		else
		{
			$data['content']['prev']=0;
		}
		$data['content']['template']='photo_show.php';
		
		$data['content']['related']=$this->df->doquery("select * from photos where albumid='$albumid' order by rand() limit 4");
		$this->layout->publish($data);
	}	   

}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */