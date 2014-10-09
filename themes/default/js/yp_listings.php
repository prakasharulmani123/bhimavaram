<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Yellowpages extends CI_Controller {
	  
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	$this->auth->checkLogin();
   }
   
	public function index()
	{	
		$data=$this->general->processData($data);
		$this->load->library('auth');
		$data['header']['css']=array('yp/categories.css');
		$data['sidebar']=false;
		$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','edit_profile.js','picture_upload.js');		
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='yp_categories.php';		
		$data['content']['categories']=$this->df->get_multi_row('yp_categories',array('parentid'=>0),false,false,array('name'=>'asc'));		
		$this->layout->publish($data);				
	}
	
	function listings()
	{
		$catid=uridata(3);
		$category=$this->df->get_single_row('yp_categories',array('id'=>$catid));
		
		//pagination
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=1;


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
			$totallistings=$this->df->doquery("select id from yp_listings where category in($catidlist)");			
			$data['content']['categories']=$this->df->doquery("select * from yp_categories where id in($catidlist)");
		}
		else
		{
			$totallistings=$this->df->doquery("select id from yp_listings where category='$catid'");
			
			$data['content']['categories']=array();
		}

		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/yellowpages/listings/".$catid."/";
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['num_links'] = 12;
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
		$data['content']['listings']=$this->df->doquery("select * from yp_listings where category in($catidlist) order by review_score desc limit $offset,$limit");//$this->df->get_limited_rows('posts',$where,$limit,$offset);	
		}
		else
		{
		$data['content']['listings']=$this->df->doquery("select * from yp_listings where category='$catid' order by review_score desc limit $offset,$limit");			
		}
		$data['header']['css']=array('yp/listings.css');
		$data['header']['js']=array('jquery.raty.min.js','listings.js');
		//$data['sidebar']=false;
		$data['content']['template']='yp_listings.php';		
				
		$this->layout->publish($data);						
	}
	
	function add()
	{
		$catid=uridata(3);
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
			$prevdata=json_decode($data['prevdata'],true);
			unset($data['prevdata']);
			$prevdata=array_merge($data,$prevdata);
			//$data=$this->general->processData($data);
			//echo '<pre>';
			//print_r($data);
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
		//$data=$this->general->processData($data);
		$this->load->library('auth');
		$data['header']['css']=array('yp/add.css');
		$data['sidebar']['custom']='yp_add_sidebar';
		$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','ypadd.js');		
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='yp_show.php';	
		//$data['content']['subcategories']=$this->df->doquery("select * from yp_categories where parentid > 0 order by name asc");
		//$data['content']['categories']=$this->df->get_multi_row('yp_categories',array('parentid'=>0),false,false,array('name'=>'asc'));		
		$this->layout->publish($data);						
	}
	
}//controller ends

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
