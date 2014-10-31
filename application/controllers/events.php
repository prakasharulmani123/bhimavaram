<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   
	function index()
	{
	   	$id=uridata(3)?uridata(3):'0';
		$cityid=userdata('cityid');
		$type=uridata('4');
		$slug=uridata('3');
		//pagination
		$offset=uridata(5) ? uridata(5) : 0;
		$limit=8;
		if($slug!='0')
		{
			$category=$this->df->get_single_row('events_categories',array('id'=>$id));
			$catid=$category['id'];	
			$catfilter=" where category='$catid' and ";
			$data['content']['category']=$category;
		}
		else
		{
			$catfilter=" where ";
			$data['content']['category']=array('name'=>'Everything');
		}		
		
		//Date Filter
		switch ($type) {
			case "today":				
				$date=date("Y-m-d");
				$daywhere=" start_date='$date' and ";
				break;
			case "tomorrow":
				$date=date("Y-m-d",strtotime("tomorrow"));
				$daywhere=" start_date='$date' and ";
				break;
			case "week":
				if(date("w")>1){$start="last ";}else{$start="";}
				$dates=date("'Y-m-d'",strtotime($start.'monday')).','.date("'Y-m-d'",strtotime($start.'tuesday')).','.date("'Y-m-d'",strtotime($start.'wednesday')).','.date("'Y-m-d'",strtotime($start.'thursday')).','.date("'Y-m-d'",strtotime($start.'friday'));
				$daywhere=" start_date in($dates) and ";
				break;
			case "weekend":
				$dates=date("'Y-m-d'",strtotime("saturday")).','.date("'Y-m-d'",strtotime("sunday"));
				$daywhere=" start_date in($dates) and ";
				break;
			case "month":
				$totaldays=cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));			
				for($i=1;$i<=$totaldays;$i++)
				{
					$dates.="'".date("Y-m-".$i)."',";
				}
				$dates=rtrim($dates,',');
				$daywhere=" start_date in($dates) and ";
				break;	
			default:
				$daywhere=" ";		
		}
		
		$totallistings=$this->df->doquery("select id from events_listings".$catfilter.$daywhere."cityid='$cityid' and approved='1'");

		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/events/index/".$id."/".$type.'/';
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
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
		$query="select * from events_listings".$catfilter.$daywhere."cityid='$cityid' and approved='1' order by start_date desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);
		//print_r($data['content']['listings']);					
		//$this->load->library('auth');
		$data['header']['css']=array('events/list.css');
		//$data['sidebar']=false;
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='events_browse.php';		
		$data['content']['categories']=$this->df->get_multi_row('events_categories',false,false,false,array('id'=>'asc'));	
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
			$data['description']=htmlspecialchars($data['description']);
			$data['ipaddress']=ip();
			unset($data['_wysihtml5_mode']);
			$insert=$this->df->insert_data_id('events_listings',$data);
			if($insert)
			{
				$slug=url_title($insert.'-'.$data['name']);
				$this->df->update_record('events_listings',array('slug'=>$slug),array('id'=>$insert));
				set_message('success','Event submitted successfully! It will be available online once its approved.');
				redirect('events/'.$slug);
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('events/index');		
			}
			
		}
		else
		{		
			$data['header']['css']=array('events/add.css');
			$data['sidebar']['custom']='events_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','parsley.extend.min.js','bootstrap-datepicker.js','timepicker.js','eventadd.js');
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['template']='event_add.php';	
			$data['content']['categories']=$this->df->get_multi_row('news_categories');		
			$this->layout->publish($data);						
		}
	}  	
	
	
	function show()
	{
		$slug=uridata(2);
		$cityid=userdata('cityid');
		$data['content']['event']=$this->df->get_single_row('events_listings',array('slug'=>$slug));
		$this->db->simple_query("update events_listings set visits=visits+1 where slug='$slug'");
		$data['content']['single_page']=true;
		$data['header']['css']=array('events/show.css', 'jobs/show.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js','news_show.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='events_show.php';
		$category=$data['content']['news']['category'];
		$id=$data['content']['news']['id'];
		$data['content']['related']=$this->df->doquery("select * from events_listings where cityid='$cityid' and approved='1' and category='$category' and id!='$id' order by id desc limit 5");
		$this->layout->publish($data);
	}		
		
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */