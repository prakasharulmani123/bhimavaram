<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Areas extends CI_Controller {
  public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   function index()
   {
		$offset=uridata(3) ? uridata(3) : 0;
		$limit=5;
		$cityid=userdata('cityid');
		//$totallistings=$this->df->doquery("");		
		$query="select * from areas where cityid='$cityid' order by name asc";
		$data['content']['listings']=$this->df->doquery($query);					
		$data['header']['css']=array('areas/listings.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js');		
		$data['content']['template']='areas_listings.php';		
		$this->layout->publish($data);	
   }

	
	function show()
	{
		$slug=uridata(2);
		$data['sidebar']=false;
		$data['content']['area']=$this->df->get_single_row('areas',array('slug'=>$slug));
		$data['content']['single_page']=true;
		$this->db->simple_query("update areas set visits=visits+1 where slug='$slug'");
		$data['header']['css']=array('areas/show.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js','news_show.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='area_show.php';
		$this->layout->publish($data);
	}	

	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */