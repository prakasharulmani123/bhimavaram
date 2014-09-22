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
			//$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','edit_profile.js','picture_upload.js');		
			//$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
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