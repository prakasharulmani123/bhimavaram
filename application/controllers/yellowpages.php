<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yellowpages extends CI_Controller {
	  
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
   }
   
	public function index()
	{	
		$data=$this->general->processData($data);
		$this->load->library('auth');
		$data['header']['css']=array('yp/categories.css');
		//$data['sidebar']=false;
		$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','edit_profile.js','picture_upload.js');		
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='yp_categories.php';		
		$data['content']['categories']=$this->df->get_multi_row('yp_categories',array('parentid'=>0),false,false,array('name'=>'asc'));		
		$this->layout->publish($data);				
	}
	
	function listings()
	{
		$catid=uridata(3);
		$cityid=userdata('cityid');
		$category=$this->df->get_single_row('yp_categories',array('id'=>$catid));
		
		//pagination
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;


		if($category['parentid']=='0')
		{
			$catlist=$this->df->doquery("select id from yp_categories where parentid='$catid'");
			$catidlist='';
			foreach($catlist as $cid)
			{
				$catidlist.=$cid['id'].',';
			}
			$catidlist=rtrim($catidlist,',');
			//$query=
			$totallistings=$this->df->doquery("select id from yp_listings where category in($catidlist) and cityid='$cityid'");			
			$data['content']['categories']=$this->df->doquery("select * from yp_categories where id in($catidlist)");
		}
		else
		{
			$totallistings=$this->df->doquery("select id from yp_listings where category='$catid' and cityid='$cityid'");
			
			$data['content']['categories']=array();
		}

		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/yellowpages/listings/".$catid."/";
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
		$data['content']['listings']=$this->df->doquery("select * from yp_listings where category in($catidlist) and approved='1' and cityid='$cityid' order by review_score desc limit $offset,$limit");//$this->df->get_limited_rows('posts',$where,$limit,$offset);	
		}
		else
		{
		$data['content']['listings']=$this->df->doquery("select * from yp_listings where category='$catid' and approved='1' and cityid='$cityid' order by review_score desc limit $offset,$limit");			
		}
		$data['header']['css']=array('yp/listings.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js');
		//$data['sidebar']=false;
		$data['content']['template']='yp_listings.php';		
		$data['content']['category']=$category;
		$this->layout->publish($data);						
	}
	
	function add()
	{
		$this->auth->checkLogin();
		$catid=uridata(3);
		$data=$this->general->processData($data);
		$this->load->library('auth');
		$data['header']['css']=array('yp/add.css');
		$data['sidebar']['custom']='classy_add_sidebar';
		$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','ypadd.js');		
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='yp_add.php';	
		$data['content']['subcategories']=$this->df->doquery("select * from yp_categories where parentid > 0 order by name asc");
		$data['content']['categories']=$this->df->get_multi_row('yp_categories',array('parentid'=>0),false,false,array('name'=>'asc'));		
		$this->layout->publish($data);						
	}
	
	function contactinfo()
	{
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);			
			unset($data['closed']);			
//			print_r($data);
//			exit;
			$data['payment_options']=implode(",",$data['payment_options']);
			$data['content']['prevdata']=htmlspecialchars(json_encode($data),ENT_QUOTES);
			$catid=uridata(3);
			$data=$this->general->processData($data);
			$data['description']=htmlspecialchars($data['description']);
			$this->load->library('auth');
			$data['header']['css']=array('yp/add.css','wysiwyg.css');
			$data['sidebar']['custom']='yp_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins/jquery.fileupload.js','edit_profile.js','picture_upload.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='yp_contact.php';		
			$this->layout->publish($data);				
		}
		else
		{
			$data=$this->general->processData($data);
			$this->load->library('auth');
			$data['header']['css']=array('yp/add.css');
			$data['sidebar']['custom']='yp_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','ypadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='yp_add.php';	
			$data['content']['subcategories']=$this->df->doquery("select * from yp_categories where parentid > 0 order by name asc");
			$data['content']['categories']=$this->df->get_multi_row('yp_categories',array('parentid'=>0),false,false,array('name'=>'asc'));		
			$this->layout->publish($data);	
		}
	}	

	function complete()
	{
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);			
			unset($data['closed']);			
			$prevdata=json_decode(htmlspecialchars_decode($data['prevdata'],ENT_QUOTES),true);
			unset($data['prevdata']);
			$prevdata=array_merge($data,$prevdata);
			//$data=$this->general->processData($data);
			//echo '<pre>';
			////print_r($prevdata);
			//exit;
			//generate working hours
			$working_hours=array();
			$working_hours['monday']=($prevdata['monday_from']=='Closed')?'Closed':$prevdata['monday_from'].'-'.$prevdata['monday_to'];
			$working_hours['tuesday']=($prevdata['tuesday_from']=='Closed')?'Closed':$prevdata['tuesday_from'].'-'.$prevdata['tuesday_to'];
			$working_hours['wednesday']=($prevdata['wednesday_from']=='Closed')?'Closed':$prevdata['wednesday_from'].'-'.$prevdata['wednesday_to'];
			$working_hours['thursday']=($prevdata['thursday_from']=='Closed')?'Closed':$prevdata['thursday_from'].'-'.$prevdata['thursday_to'];
			$working_hours['friday']=($prevdata['friday_from']=='Closed')?'Closed':$prevdata['friday_from'].'-'.$prevdata['friday_to'];
			$working_hours['saturday']=($prevdata['saturday_from']=='Closed')?'Closed':$prevdata['saturday_from'].'-'.$prevdata['saturday_to'];
			$working_hours['sunday']=($prevdata['sunday_from']=='Closed')?'Closed':$prevdata['sunday_from'].'-'.$prevdata['sunday_to'];
			//payment options			
			$listing=array(
				'cityid'=>userdata('cityid'),
				'category'=>$prevdata['category'],
				'title'=>$prevdata['title'],
				'picture'=>$prevdata['picture'],
				'working_hours'=>json_encode($working_hours),
				'payment_options'=>$prevdata['payment_options'],
				'facebook'=>$prevdata['facebook'],
				'twitter'=>$prevdata['twitter'],
				'googleplus'=>$prevdata['googleplus'],
				'address'=>$prevdata['address'].", ".$prevdata['address2'],
				'pincode'=>$prevdata['pincode'],
				'areaname'=>$prevdata['area'],
				'phone'=>$prevdata['phone'],
				'mobile'=>$prevdata['mobile'],
				'fax'=>$prevdata['fax'],
				'emailaddress'=>$prevdata['email'],
				'website'=>$prevdata['website'],
				'description'=>$prevdata['description'],
			);//Listing Ends
				
			//print_r($listing);
			//exit;
			$list=$this->df->insert_data_id('yp_listings',$listing);
			//				'slug'=>$this->_createSlug($prevdata['title']),
			if($list)
			{
				$slug=$this->_createSlug($list.'-'.$prevdata['title']);
				$this->df->update_record('yp_listings',array('slug'=>$slug),array('id'=>$list));	
				set_message('success','Business listing created successfully!');
				redirect('yellowpages/'.$slug);
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('yellowpages/index');				
			}

		}
		else
		{
			$data=$this->general->processData($data);			
			unset($data['closed']);			
			//print_r($data);
			$data['content']['prevdata']=json_encode($data);
			$catid=uridata(3);
			$data=$this->general->processData($data);
			$this->load->library('auth');
			$data['header']['css']=array('yp/add.css','wysiwyg.css');
			$data['sidebar']['custom']='yp_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins/jquery.fileupload.js','edit_profile.js','picture_upload.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='yp_contact.php';		
			$this->layout->publish($data);				
		}
		
					
	}	
			
	function _createSlug($title)
		{
			return strtolower(url_title($title));
		}

	function show()
	{
		$slug=uridata(2);
		$data['content']['single_page']=true;
		$this->load->library('auth');
		$data['content']['listing']=$this->df->get_single_row('yp_listings',array('slug'=>$slug));
		$this->db->simple_query("update yp_listings set visits=visits+1 where slug='$slug'");
		$data['header']['css']=array('yp/show.css');
		$data['sidebar']['custom']='yp_add_sidebar';
		//$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','ypadd.js');		
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='yp_show.php';	
		$this->layout->publish($data);						
	}
	
	function message()
	{
		$this->auth->checkLogin();
		$uid=userdata('uid');
		$data=$this->general->get_post_values();
		$data=$this->general->processData($data);
		$listing=$this->df->get_single_row('yp_listings',array('id'=>$data['listingid']));
		$user=$this->df->get_single_row('users',array('uid'=>$uid));
		$email=$listing['email'];
		$content="You've received a message from ".$user['name']." for your listing : ".anchor('yellowpages/'.$listing['slug'],$listing['title']).'<br><br>';
		$content.='<div style="font-weight:bold;text-decoration:underline" >Message</div><br>';
		$content.='<div style="font-style:italic">'.$data['message'].'</div>';
		$this->load->library('emails');
		$send=$this->emails->send_mail($email,'['.$this->settings->siteName()."] You've got a message",$content,false,$user['email']);
		if($send)
		{
			$this->df->insert_data('yp_messages',array('listingid'=>$listing['id'],'uid'=>$uid,'message'=>$data['message'],'ip'=>ip()));
			set_message('success',"Your message has been sent successfully!");
		}
		else
		{
			set_message('error','Oops! Something went wrong!');
		}
		redirect('yellowpages/'.$data['slug']);							
	}


	function search()
	{
		$postdata=$this->general->processData($this->general->get_post_values());

		$q=$postdata['q']?$postdata['q']:urldecode(uridata('3'));
		$data['content']['q']=$q;
		if(strlen($q)==0)
		{
			redirect('yellowpages/index');
		}
		//$category=$this->df->get_single_row('yp_categories',array('id'=>$catid));		
		//pagination
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id from yp_listings where (title like '%$q%' or address like '%$q%' or areaname like '%$q%' or description like '%$q%') and cityid='$cityid' and approved='1'");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/yellowpages/search/".urlencode($q)."/";
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
		$data['content']['listings']=$this->df->doquery("select * from yp_listings where (title like '%$q%' or address like '%$q%' or areaname like '%$q%' or description like '%$q%') and cityid='$cityid' and approved='1' order by visits desc limit $offset,$limit");					
		$data['header']['css']=array('yp/listings.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js');		
		//$data['sidebar']=false;
		$data['content']['template']='yp_search.php';		
		//$data['content']['category']=$category;
		$this->layout->publish($data);		
	}

	function updateSlug()
	{
		$listings=$this->df->doquery("select id,title,slug from yp_listings");
		$this->load->helper('url');
		foreach($listings as $l)
		{
			$slug=url_title($l['id'].'-'.$l['title']);	
			$this->df->update_record('yp_listings',array('slug'=>$slug),array('id'=>$l['id']));
			echo $id.':'.$slug.'<br>';
		}
		
	}
		
}//controller ends

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
