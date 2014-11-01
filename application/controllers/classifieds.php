<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Classifieds extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   
   function index()
   {
		$data=$this->general->processData($data);
		//$this->load->library('auth');
		$data['header']['css']=array('yp/categories.css');
		//$data['sidebar']=false;
//		$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','edit_profile.js','picture_upload.js');		
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='classy_categories.php';		
		$data['content']['categories']=$this->df->get_multi_row('classy_categories',array('parentid'=>0),false,false,array('name'=>'asc'));		
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
			unset($data['parentcategory']);
			unset($data['_wysihtml5_mode']);
			$data['date_posted']=date("Y-m-d");
			$data['expiry_date']=dateadd(date("M d, Y"),'+30');
			$data['description']=htmlspecialchars($data['description']);
			$insert=$this->df->insert_data_id('classy_listings',$data);
			if($insert)
			{
				$slug=url_title($insert.'-'.$data['title']);
				$this->df->update_record('classy_listings',array('slug'=>$slug),array('id'=>$insert));
				set_message('success','Your ad has been posted successfully!');
				redirect('classifieds/'.$slug);
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('classifieds/index');		
			}
			
		}
		else
		{		
			$data['header']['css']=array('yp/add.css');
			$data['sidebar']['custom']='classy_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','classyadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='classy_add.php';	
			$data['content']['subcategories']=$this->df->doquery("select * from classy_categories where parentid > 0 order by name asc");
			$data['content']['categories']=$this->df->get_multi_row('classy_categories',array('parentid'=>0),false,false,array('name'=>'asc'));		
			$this->layout->publish($data, 'full_layout_inner');						
		}
	}   
	
	function show()
	{
		$slug=uridata(2);
		$data['content']['ad']=$this->df->get_single_row('classy_listings',array('slug'=>$slug));
		$this->db->simple_query("update classy_listings set visits=visits+1 where slug='$slug'");
		$data['header']['css']=array('classy/show.css');
		$data['content']['single_page']=true;
//		$data['sidebar']['custom']='yp_add_sidebar';
		//$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','ypadd.js');		
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='classy_show.php';	
		$this->layout->publish($data, 'full_layout_inner');
	}
	
	function checkcontactuser(){
		$this->auth->checkLogin();
		$slug=uridata(3);
		redirect('classifieds/'.$slug);
	}
	
	function message()
	{
		$uid=userdata('uid');
		$data=$this->general->get_post_values();
		$data=$this->general->processData($data);
		$listing=$this->df->get_single_row('classy_listings',array('id'=>$data['listingid']));
		$user=$this->df->get_single_row('users',array('uid'=>$uid));
		$email=$listing['email'];
		$content="You've received a message from ".$user['name']." for your ad : ".anchor('classifieds/'.$listing['slug'],$listing['title']).'<br><br>';
		$content.='<div style="font-weight:bold;text-decoration:underline" >Message</div><br>';	
		$content.='<div style="font-style:italic">'.$data['message'].'</div><br>';
		$content.='<div style="font-weight:bold;text-decoration:underline" >Name</div>';	
		$content.='<div style="font-style:italic">'.$data['name'].'</div><br>';
		$content.='<div style="font-weight:bold;text-decoration:underline" >Email</div>';	
		$content.='<div style="font-style:italic">'.$data['email'].'</div><br>';
		if(strlen($data['phone'])>1)		
		{
		$content.='<div style="font-weight:bold;text-decoration:underline" >Phone</div>';	
		$content.='<div style="font-style:italic">'.$data['phone'].'</div><br>';	
		}
		$this->load->library('emails');
		$send=$this->emails->send_mail($email,'['.$this->settings->siteName()."] New Response for ".$listing['title'],$content,false,$user['email']);
		if($send)
		{
			$this->df->insert_data('classy_responses',array('adid'=>$listing['id'],'uid'=>$uid,'message'=>$data['message'],'email'=>$data['email'],'phone'=>$data['phone'],'ipaddress'=>ip()));
			
			//Thank you mail for User who post the reply for this Ad.
			$classified_content = $this->load->view('email/classified_success', '', TRUE);
			$this->emails->send_mail($data['email'], 'Thank you for submit a reply for '.$listing['title'], $classified_content);
			
			set_message('success',"Your message has been sent successfully!");
		}
		else
		{
			set_message('error','Oops! Something went wrong!');
		}
		redirect('classifieds/'.$listing['slug']);							
	}


	function ads()
	{
		$catid=uridata(3);
		$cityid=userdata('cityid');
		$category=$this->df->get_single_row('classy_categories',array('id'=>$catid));
		
		//pagination
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;


		if($category['parentid']=='0')
		{
			$catlist=$this->df->doquery("select id from classy_categories where parentid='$catid'");
			$catidlist='';
			foreach($catlist as $cid)
			{
				$catidlist.=$cid['id'].',';
			}
			$catidlist=rtrim($catidlist,',');
			//$query=
			$totallistings=$this->df->doquery("select id from classy_listings where category in($catidlist) and cityid='$cityid'");			
			$data['content']['categories']=$this->df->doquery("select * from classy_categories where id in($catidlist)");
		}
		else
		{
			$totallistings=$this->df->doquery("select id from classy_listings where category='$catid' and cityid='$cityid'");
			
			$data['content']['categories']=array();
		}

		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/classifieds/ads/".$catid."/";
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
		if($category['parentid']=='0')
		{
		$data['content']['listings']=$this->df->doquery("select * from classy_listings where category in($catidlist) and approved='1' and cityid='$cityid' order by id desc limit $offset,$limit");//$this->df->get_limited_rows('posts',$where,$limit,$offset);	
		}
		else
		{
		$data['content']['listings']=$this->df->doquery("select * from classy_listings where category='$catid' and approved='1' and cityid='$cityid' order by id desc limit $offset,$limit");			
		}
		$data['header']['css']=array('classy/listings.css');
		//$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js');
		//$data['sidebar']=false;
		$data['content']['template']='classy_ads.php';		
		$data['content']['category']=$category;
		$this->layout->publish($data);						
	}

	function search()
	{
		$postdata=$this->general->processData($this->general->get_post_values());

		$q=$postdata['q']?$postdata['q']:urldecode(uridata('3'));
		$data['content']['q']=$q;
		if(strlen($q)==0)
		{
			redirect('classifieds/index');
		}
		//$category=$this->df->get_single_row('yp_categories',array('id'=>$catid));		
		//pagination
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id from classy_listings where (title like '%$q%' or description like '%$q%') and cityid='$cityid' and approved='1'");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/classifieds/search/".urlencode($q)."/";
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
		$data['content']['listings']=$this->df->doquery("select * from classy_listings where (title like '%$q%' or description like '%$q%') and cityid='$cityid' and approved='1' order by id desc limit $offset,$limit");					
		$data['header']['css']=array('classy/listings.css');
//		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js');		
		//$data['sidebar']=false;
		$data['content']['template']='classy_search.php';		
		//$data['content']['category']=$category;
		$this->layout->publish($data);		
	}
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */