<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ImportantNews extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   
   
	function show()
	{
		$slug=uridata(2);
		$cityid=userdata('cityid');
		$data['content']['single_page']=true;
		$data['content']['news']=$this->df->get_single_row('important_news',array('slug'=>$slug));
		$this->db->simple_query("update important_news set visits=visits+1 where slug='$slug'");
		$data['header']['css']=array('news/show.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js','news_show.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='important_news_show.php';
		$id=$data['content']['news']['id'];
		$data['content']['pictures']=$this->df->get_multi_row('important_news_photos',array('newsid'=>$id));
		$data['content']['related']=$this->df->doquery("select * from important_news where cityid='$cityid' and approved='1' and id!='$id' order by id desc limit 5");
		$this->layout->publish($data);
	}	
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */