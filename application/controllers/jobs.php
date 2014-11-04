<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobs extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   
   function index()
   {
	   $cityid=userdata('cityid');
		$offset=uridata(6) ? uridata(6) : 0;
		$limit=8;	   
	   if(uridata('3')!='0'){set_session('jobindustry',uridata('3'));}
	   if(uridata('4')!='0'){set_session('jobtype',uridata('4'));}
	   if(uridata('5')!='0'){set_session('jobqualification',uridata('5'));}
	   	$data['content']['jobtype']=userdata('jobtype')?userdata('jobtype'):'0';
	   	$data['content']['jobindustry']=userdata('jobindustry')?userdata('jobindustry'):'0';
	   	$data['content']['jobqualification']=userdata('jobqualification')?userdata('jobqualification'):'0';		
		$data=$this->general->processData($data);
		//$this->load->library('auth');
		if($data['content']['jobtype']!='0')
		{
			$typefilter=" and jobtype='".$data['content']['jobtype']."' ";
		}
		if($data['content']['jobindustry']!='0')
		{
			$indfilter=" and category='".$data['content']['jobindustry']."' ";
		}
		if($data['content']['jobqualification']!='0')
		{
			$qualifilter=" and qualification='".$data['content']['jobqualification']."' ";
		}		
		$last_date=date("Y-m-d");		
//////Pagination
		$totalquery="select id from jobs_listings where cityid='$cityid'".$typefilter.$indfilter.$qualifilter." and approved='1' and last_date > '$last_date'";
		$totallistings=$this->df->doquery($totalquery);
//		print_r($totallistings);
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/jobs/index/".$data['content']['jobindustry']."/".$data['content']['jobtype'].'/'.$data['content']['jobqualification'].'/';
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
		$query="select * from jobs_listings where cityid='$cityid'".$typefilter.$indfilter.$qualifilter." and approved='1' and last_date > '$last_date' order by visits desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);		
		$data['header']['css']=array('jobs/list.css');
//		$data['sidebar']['custom']='jobs_list_sidebar';
//		$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','edit_profile.js','picture_upload.js');		
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='jobs_browse.php';		
		$data['content']['industries']=$this->df->get_multi_row('jobs_categories',false,false,false,array('name'=>'asc'));		
		$data['content']['qualifications']=$this->df->get_multi_row('jobs_qualifications');		
		$data['content']['types']=$this->df->get_multi_row('jobs_type',false,false,false,array('id'=>'asc'));		
		$this->layout->publish($data); 
   }
   
  function searchresults()
   {
	   $q=uridata(3);
	   $cityid=userdata('cityid');
		$offset=uridata(6) ? uridata(6) : 0;
		$limit=8;	   	
		$last_date=date("Y-m-d");		
//////Pagination
		$totalquery="select id from jobs_listings where cityid='$cityid' and (title like '%$q%' or description like '%$q%' or location  like '%$q%') and approved='1' and last_date > '$last_date'";
		$totallistings=$this->df->doquery($totalquery);
//		print_r($totallistings);
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/jobs/index/".$data['content']['jobindustry']."/".$data['content']['jobtype'].'/'.$data['content']['jobqualification'].'/';
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
		$query="select * from jobs_listings where cityid='$cityid' and (title like '%$q%' or description like '%$q%' or location  like '%$q%') and approved='1' and last_date > '$last_date' order by visits desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);		
		$data['header']['css']=array('jobs/list.css');
//		$data['sidebar']['custom']='jobs_list_sidebar';
//		$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','edit_profile.js','picture_upload.js');		
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='jobs_browse.php';		
		$data['content']['industries']=$this->df->get_multi_row('jobs_categories',false,false,false,array('name'=>'asc'));		
		$data['content']['qualifications']=$this->df->get_multi_row('jobs_qualifications');		
		$data['content']['types']=$this->df->get_multi_row('jobs_type',false,false,false,array('id'=>'asc'));		
		$this->layout->publish($data); 
   }   
   
	function add()
	{
		$this->auth->checkLogin();
		$data=$this->general->get_post_values();
		if($_POST)
		{
			if($data['business-required']=='')
			{
				unset($data['business-required']);
			}
			else
			{
				unset($data['business_name-required']);
				unset($data['address-required']);
				unset($data['phone-required']);
			}
		}
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			//print_r($data);	
			$data['uid']=userdata('uid');
			$data['cityid']=userdata('cityid');
			unset($data['_wysihtml5_mode']);
			$data['date_posted']=date("Y-m-d");
//			$data['expiry_date']=dateadd(date("M d, Y"),'+30');
			$data['description']=htmlspecialchars($data['description']);
			$data['exp_to']=$data['exp_to_year'].' Years '.$data['exp_to_month'].' Months';
			$data['exp_from']=$data['exp_from_year'].' Years '.$data['exp_from_month'].' Months';
			unset($data['exp_from_year']);
			unset($data['exp_from_month']);
			unset($data['exp_to_year']);
			unset($data['exp_to_month']);
			$insert=$this->df->insert_data_id('jobs_listings',$data);
			if($insert)
			{
				$slug=url_title($insert.'-'.$data['title']);
				$this->df->update_record('jobs_listings',array('slug'=>$slug),array('id'=>$insert));
				set_message('success','Your job has been posted successfully!');
				redirect('jobs/'.$slug);
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('jobs/index');		
			}
			
		}
		else
		{		
			$data['header']['css']=array('jobs/add.css');
			$data['sidebar']['custom']='jobs_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','bootstrap-datepicker.js','jobadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['types']=$this->df->get_multi_row('jobs_type',false,false,false,array('id'=>'asc'));
			$data['content']['template']='jobs_add.php';	
			$data['content']['categories']=$this->df->get_multi_row('jobs_categories',false,false,false,array('name'=>'asc'));		
//			$data['content']['qualifications']=$this->df->get_multi_row('jobs_qualifications',false,false,false,array('name'=>'asc'));		
			$this->layout->publish($data, 'full_layout_inner');						
		}
	}   
	
	function show()
	{
		$slug=uridata(2);
		//$data['content']['ad']=$this->df->get_single_row('jobs_listings',array('slug'=>$slug));
		$this->db->simple_query("update jobs_listings set visits=visits+1 where slug='$slug'");
		$data['header']['css']=array('jobs/show.css');
		$data['content']['single_page']=true;
//		$data['sidebar']['custom']='yp_add_sidebar';
		//$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','ypadd.js');		
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['listing']=$this->df->get_single_row('jobs_listings',array('slug'=>$slug));
		$data['content']['business']=$this->df->get_single_row('yp_listings',array('id'=>$data['content']['listing']['business']));
		$data['content']['template']='jobs_show.php';	
		$this->layout->publish($data);
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
		
		
	function resetfilter()
	{
		$name='job'.uridata('3');
		$_SESSION[$name]=false;
	   	$data['content']['jobtype']=userdata('jobtype')?userdata('jobtype'):'0';
	   	$data['content']['jobindustry']=userdata('jobindustry')?userdata('jobindustry'):'0';
	   	$data['content']['jobqualification']=userdata('jobqualification')?userdata('jobqualification'):'0';		
		
		redirect('jobs/index/'.$data['content']['jobindustry'].'/'.$data['content']['jobtype'].'/'.	$data['content']['jobqualification']);
	}
	
	function message()
	{
		$uid=userdata('uid');
		$data=$this->general->get_post_values();
		$data=$this->general->processData($data);
		$listing=$this->df->get_single_row('jobs_listings',array('id'=>$data['listingid']));
		$business=$this->df->get_single_row('yp_listings',array('id'=>$listing['business']));
		$user=$this->df->get_single_row('users',array('uid'=>$uid));
		$email=$business['email'];
		$content="You've received a message from ".$user['name']." for your job listing : ".anchor('jobs/'.$listing['slug'],$listing['title']).'<br><br>';
		$content.='<div style="font-weight:bold;text-decoration:underline" >Message</div><br>';
		$content.='<div style="font-style:italic">'.$data['message'].'</div>';
		$this->load->library('emails');
		$send=$this->emails->send_mail($email,'['.$this->settings->siteName()."] You've got a message",$content,false,$user['email']);
		if($send)
		{
			$this->df->insert_data('jobs_messages',array('listingid'=>$listing['id'],'uid'=>$uid,'message'=>$data['message'],'ip'=>ip()));
			set_message('success',"Your message has been sent successfully!");
		}
		else
		{
			set_message('error','Oops! Something went wrong!');
		}
		redirect('jobs/'.$data['slug']);							
	}	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */