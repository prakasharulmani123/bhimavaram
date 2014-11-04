<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deals extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   
   function index()
   {
		$catid=uridata(3)?uridata(3):'0';
		$cityid=userdata('cityid');
		if($catid!='0')
		{
			$category=$this->df->get_single_row('yp_categories',array('id'=>$catid));
			$data['content']['parentcategory']=$category['parentid'];
			if($category['parentid']=='0')	
			{
				$allcats=$this->df->get_multi_row('yp_categories',array('parentid'=>$catid));
				$subcats='';
				foreach($allcats as $scat)
				{
					$subcats.=$scat['id'].',';
				}
				$subcats=rtrim($subcats,',');
				if(strlen($subcats)>0)
				{
				$catquery=" and category in($subcats) ";
				}
				else
				{
					$catquery=" ";
				}
			}
			else
			{
				$catquery=" and category='$catid' ";
			}
		}
		else
		{
			$catquery=" ";
			$data['content']['parentcategory']=0;
		}
		
		//pagination
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=8;		
		
		$data=$this->general->processData($data);
		//$this->load->library('auth');			
//////Pagination
		$today=date("Y-m-d");
		$totalquery="select id from offers_listings where cityid='$cityid' ".$catquery." and approved='1' and starts_on <= '$today' and closes_on >= '$today' ";
		$totallistings=$this->df->doquery($totalquery);
//		print_r($totallistings);
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/deals/index/".$catid."/";
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
		$query="select * from offers_listings where cityid='$cityid' ".$catquery." and approved='1' and starts_on <= '$today' and closes_on >= '$today' order by id,visits desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);		
		$data['header']['css']=array('jobs/list.css');
//		$data['sidebar']['custom']='jobs_list_sidebar';
//		$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','edit_profile.js','picture_upload.js');		
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='deals_browse.php';	
		$data['content']['category']=$catid;
		$data['content']['categories']=$this->df->get_multi_row('yp_categories',array('parentid'=>'0'),false,false,array('name'=>'asc'));			
		$this->layout->publish($data); 
   }
   
   
   function searchresults()
   {
	   	$q=uridata('3');
		$cityid=userdata('cityid');
		
		//pagination
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=8;		
		
		$data=$this->general->processData($data);
		//$this->load->library('auth');			
//////Pagination
		$today=date("Y-m-d");
		$totalquery="select id from offers_listings where cityid='$cityid' and (title like '%$q%' or description like '%$q%') and approved='1' and starts_on <= '$today' and closes_on >= '$today' ";
		$totallistings=$this->df->doquery($totalquery);
//		print_r($totallistings);
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/deals/searchresults/".$catid."/";
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
		$query="select * from offers_listings where cityid='$cityid' and (title like '%$q%' or description like '%$q%') and approved='1' and starts_on <= '$today' and closes_on >= '$today' order by visits desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);		
		$data['header']['css']=array('jobs/list.css');
//		$data['sidebar']['custom']='jobs_list_sidebar';
//		$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','edit_profile.js','picture_upload.js');		
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='deals_search.php';	
		$data['content']['category']=$catid;
		$data['content']['categories']=$this->df->get_multi_row('yp_categories',array('parentid'=>'0'),false,false,array('name'=>'asc'));			
		$this->layout->publish($data); 
   }
      
	function add()
	{
		$this->auth->checkLogin();
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$data['uid']=userdata('uid');
			$data['cityid']=userdata('cityid');
			$data['category']=$this->df->get_field_value('yp_listings',array('id'=>$data['business']),'category');
			unset($data['_wysihtml5_mode']);
			//$data['date_posted']=date("Y-m-d");
//			$data['expiry_date']=dateadd(date("M d, Y"),'+30');
			$data['description']=htmlspecialchars($data['description']);
/*			echo '<pre>';
			print_r($data);						
			exit;*/
			$insert=$this->df->insert_data_id('offers_listings',$data);
			if($insert)
			{
				$slug=url_title($insert.'-'.$data['title']);
				$this->df->update_record('offers_listings',array('slug'=>$slug),array('id'=>$insert));
				set_message('success','Your deal has been posted successfully! It will be available online once approved!');
				redirect('deals/'.$slug);
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('deals/index');		
			}
			
		}
		else
		{		
			$data['header']['css']=array('deals/add.css');
			$data['sidebar']['custom']='deals_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','bootstrap-datepicker.js','jobadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['types']=$this->df->get_multi_row('jobs_type',false,false,false,array('id'=>'asc'));
			$data['content']['template']='deals_add.php';	
			$data['content']['subcategories']=$this->df->doquery("select * from yp_categories where parentid > 0 order by name asc");
			$data['content']['categories']=$this->df->get_multi_row('yp_categories',array('parentid'=>0),false,false,array('name'=>'asc'));		
//			$data['content']['qualifications']=$this->df->get_multi_row('jobs_qualifications',false,false,false,array('name'=>'asc'));		
			$this->layout->publish($data);						
		}
	}   
	
	function show()
	{
		$slug=uridata(2);
		$this->db->simple_query("update jobs_listings set visits=visits+1 where slug='$slug'");
		$data['content']['single_page']=true;
		$data['header']['css']=array('jobs/show.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['deal']=$this->df->get_single_row('offers_listings',array('slug'=>$slug));
		$data['content']['business']=$this->df->get_single_row('yp_listings',array('id'=>$data['content']['deal']['business']));
		$data['content']['template']='deals_show.php';	
		$this->layout->publish($data);
	}
	
	function checkuserlogin(){
		$this->auth->checkLogin();
		$slug=uridata(3);
		redirect('deals/'.$slug);
	}
	
	function message()
	{
		$this->auth->checkLogin();
		//Current loggedin user
		$uid=userdata('uid');
		$user=$this->df->get_single_row('users',array('uid'=>$uid));
		
		$data=$this->general->get_post_values();
		$data=$this->general->processData($data);
		
		//Deal details
		$deal_listing=$this->df->get_single_row('offers_listings',array('id'=>$data['listingid']));
		
		//Deal added user.
		$deal_user = $this->df->get_single_row('users',array('uid'=>$deal_listing['uid']));
		$email=$deal_user['email'];	
					
		$content="You've received a message from ".$user['name']." for your Deal : ".anchor('deals/'.$deal_listing['slug'],$deal_listing['title']).'<br><br>';
		$content.='<div style="font-weight:bold;text-decoration:underline" >Message</div><br>';
		$content.='<div style="font-style:italic">'.$data['message'].'</div>';
		$this->load->library('emails');
		$send=$this->emails->send_mail($email,'['.$this->settings->siteName()."] You've got a message",$content,false,$user['email']);
		if($send){
			set_message('success',"Your message has been sent successfully!");
		} else {
			set_message('error','Oops! Something went wrong!');
		}
		redirect('deals/'.$data['slug']);							
	}

}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */