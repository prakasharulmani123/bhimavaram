<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends CI_Controller {
  public function __construct()
   {
	parent::__construct();
   }
   function show()
   {
		$adid=uridata(3);
		$ad=$this->df->get_single_row('ads',array('id'=>$adid));
		$this->db->simple_query("update ads set clicks=clicks+1 where id='$adid'");		
		
		if(strlen($ad['description'])>3 && strlen($ad['add_photos'])>3)
		{
			$data['header']['css']=array('ad-show.css');
			$data['content']['template']='ad_show_page';	
			$data['content']['ad']=$ad;
			$data['sidebar']=false;
			$this->layout->publish($data);	
		}
		else
		{
			redirect($ad['adlink']);
		}
   }
   
	function go()
   {
	   $adid=uridata(3);
		$ad=$this->df->get_single_row('ads',array('id'=>$adid));
		redirect($ad['adlink']);
   }
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */