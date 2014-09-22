<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polls extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	$this->auth->checkAdminLogin();
   }
   function index()
   {
	   set_session('adminid',1);
   }
   function addpoll()
   {
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$data['added_by']=userdata('adminid');
			$insert=$this->df->insert_data_id('poll_questions',array('question'=>$data['question'],'added_by'=>$data['added_by']));
			if($insert)
			{
				$slug=url_title($insert.'-'.$data['question']);
				$this->df->update_record('poll_questions',array('slug'=>$slug),array('id'=>$insert));
				foreach($data['answer'] as $answer)
				{
					if($answer!='')
					{
					$this->df->insert_data_id('poll_answers',array('questionid'=>$insert,'answer'=>$answer));
					}
				}
				
				set_message('success','Poll created successfully!');
				redirect('admin/polls/addpoll');
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/polls/addpoll');	
			}
			
		}
		else
		{		
			$data['header']['css']=array('jobs/add.css');
			//$data['sidebar']=false;
			//$data['header']['custom']='plain_header';
			//$data['footer']['custom']='plain_footer';
//			$data['sidebar']['custom']='jobs_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','bootstrap-datepicker.js','addpoll.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['types']=$this->df->get_multi_row('jobs_type',false,false,false,array('id'=>'asc'));
			$data['content']['template']='admin/addpoll.php';	
			//$data['content']['categories']=$this->df->get_multi_row('jobs_categories',false,false,false,array('name'=>'asc'));		
//			$data['content']['qualifications']=$this->df->get_multi_row('jobs_qualifications',false,false,false,array('name'=>'asc'));		
			$this->layout->admin_publish($data);						
		}
   }
   
   function addmovie()
   {
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);	
			$data['added_by']=userdata('adminid');
			unset($data['_wysihtml5_mode']);
			//$data['date_posted']=date("Y-m-d");
//			$data['expiry_date']=dateadd(date("M d, Y"),'+30');
			$data['description']=htmlspecialchars($data['description']);						
	/*		echo '<pre>';
			print_r($data);
			exit;*/
			$insert=$this->df->insert_data_id('movies_listings',$data);
			if($insert)
			{
				$slug=url_title($insert.'-'.$data['name']);
				$this->df->update_record('movies_listings',array('slug'=>$slug),array('id'=>$insert));
				set_message('success','Movie added successfully!');
				redirect('admin/movies/movie/'.$slug);
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/movies/addmovie');		
			}
			
		}
		else
		{		
			$data['header']['css']=array('jobs/add.css');
			//$data['sidebar']=false;
//			$data['sidebar']['custom']='jobs_add_sidebar';
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','bootstrap-datepicker.js','jobadd.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['types']=$this->df->get_multi_row('jobs_type',false,false,false,array('id'=>'asc'));
			$data['content']['template']='admin/movie_add.php';	
			$data['content']['categories']=$this->df->get_multi_row('jobs_categories',false,false,false,array('name'=>'asc'));		
//			$data['content']['qualifications']=$this->df->get_multi_row('jobs_qualifications',false,false,false,array('name'=>'asc'));		
			$this->layout->admin_publish($data);						
		}
   }   
   
	function choose_theatre()	
	{
		//$data['header']['custom']='plain_header';
		//$data['header']['css']=array('register.css');
		$data['footer']['js']=array('parsley.js','chained.js','choose_theatre.js');		
		$data['footer']['custom']='plain_footer';		
		$data['content']['template']='admin/choose_theatre';
		$data['content']['theatres']=$this->df->get_multi_row('movies_theatres');
		//$data['sidebar']=false;		
		$this->layout->admin_publish($data);
	}
	
	
	function theatre_add_movie()	
	{
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			$theatre=$this->df->get_single_row('movies_theatres',array('id'=>uridata('4')));
			$movie=array(
			'cityid'=>$theatre['cityid'],
			'theatreid'=>$theatre['id'],
			'movieid'=>$data['movieid'],
			'timings'=>$data['tagsList']
			);
			
			$insert=$this->df->insert_data('movie_shows',$movie);					
			if($insert)
			{
				$movieid=$data['movieid'];
				$this->db->simple_query("update movies_listings set theatres=theatres+1 where id='$movieid'");
				redirect('admin/movies/manage_shows/'.uridata('4'));
			}
		}
		else
		{
		//$data['header']['custom']='plain_header';
		$data['header']['css']=array('register.css','tagmanager.css');
		$data['footer']['js']=array('parsley.js','chained.js','tagmanager.js','theatre_add_movie.js');		
		//$data['footer']['custom']='plain_footer';		
		$data['content']['template']='admin/theatre_add_movie';
		$data['content']['movies']=$this->df->get_multi_row('movies_listings',false,false,false,array('id'=>'desc'));
		$data['sidebar']=false;		
		$this->layout->admin_publish($data);
		}
	}
	
		
	function manage_shows()
	{
		$data=$this->general->get_post_values();
		$data=$this->general->processData($data);
		$theatreid=uridata('4')?uridata('4'):postdata('theatreid');
		if(!$theatreid)
		{
			redirect('admin/movies/choose_theatre');
		}
		//$data['header']['custom']='plain_header';
		$data['header']['css']=array('register.css','tagmanager.css');
		$data['footer']['js']=array('parsley.js','chained.js','choose_theatre.js');		
		//$data['footer']['custom']='plain_footer';		
		
		$data['content']['theatre']=$this->df->get_single_row('movies_theatres',array('id'=>$theatreid));		
		$data['content']['movies']=$this->df->doquery("select * from movie_shows where theatreid='$theatreid' and timings!='0'");//$this->df->get_multi_row('movie_shows',array('theatreid'=>$data['theatreid']));\		
		$data['content']['template']='admin/manage_shows';
		//$data['sidebar']=false;		
		$this->layout->admin_publish($data);		
	}

	function theatre_movie_delete_timing()
	{
		$theatreid=uridata('4');
		$movieid=uridata('5');
		$timing=urldecode(uridata('6'));
		$alltimings=$this->df->get_field_value('movie_shows',array('theatreid'=>$theatreid,'movieid'=>$movieid),'timings');
		if(strpos($alltimings,',')>0)
		{
			$alltimings=explode(',',$alltimings);
			
			if(($key = array_search($timing, $alltimings)) !== false) {
   				 unset($alltimings[$key]);
				}
			$alltimings=implode(',',$alltimings);
			$this->df->update_record('movie_shows',array('timings'=>$alltimings),array('theatreid'=>$theatreid,'movieid'=>$movieid));
		}
		else
		{
			$this->df->update_record('movie_shows',array('timings'=>'0'),array('theatreid'=>$theatreid,'movieid'=>$movieid));
			$this->db->simple_query("update movies_listings set theatres=theatres-1 where id='$movieid'");			
		}
		redirect('admin/movies/manage_shows/'.$theatreid);
		
	}
	
	function theatre_delete_movie()
	{
		$theatreid=uridata('4');
		$movieid=uridata('5');
		$this->df->delete_record('movie_shows',array('theatreid'=>$theatreid,'movieid'=>$movieid));
		$this->db->simple_query("update movies_listings set theatres=theatres-1 where id='$movieid'");
		redirect('admin/movies/manage_shows/'.$theatreid);				
	}

	function manage()
	{
		$data['content']['template']='admin/manage_polls';
		$data['footer']['js']=array('classy_admin.js');
		$offset=uridata(4) ? uridata(4) : 0;
		$limit=10;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id from poll_questions");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/admin/polls/manage/";
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
		$data['content']['polls']=$this->df->doquery("select * from poll_questions order by id desc limit $offset,$limit");
		$this->layout->admin_publish($data);		
	}
	
	function delete()
	{
		$id=uridata(4);
		$delete=$this->db->simple_query("delete from poll_questions where id='$id'");
		if($delete)
		{
			set_message('success','Poll deleted successfully!');
		}
		redirect('admin/polls/manage');
	}	
   function editpoll()
   {
	   	$id=uridata(4);
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			//update question
			$update=$this->df->update_record('poll_questions',array('question'=>$data['question']),array('id'=>$id));
			if($update)
			{
				unset($data['question']);
				foreach($data as $k=>$v)
				{
					$aid=str_replace('answer_','',$k);
					$this->df->update_record('poll_answers',array('answer'=>$v),array('id'=>$aid));
				}
				set_message('success','Poll updated successfully!');
				redirect('admin/polls/manage');
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('admin/polls/manage');	
			}
			
		}
		else
		{		
			$data['header']['css']=array('jobs/add.css');
			$data['content']['poll']=$this->df->get_single_row('poll_questions',array('id'=>$id));
			$data['content']['answers']=$this->df->get_multi_row('poll_answers',array('questionid'=>$id));
			$data['footer']['js']=array('parsley.js','plugins/jquery.ui.widget.js','plugins/jquery.iframe-transport.js','plugins//jquery.fileupload.js','chained.js','edit_profile.js','picture_upload.js','bootstrap-datepicker.js','addpoll.js','editpoll.js');		
			$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
			$data['content']['types']=$this->df->get_multi_row('jobs_type',false,false,false,array('id'=>'asc'));
			$data['content']['template']='admin/editpoll.php';	
			$this->layout->admin_publish($data);						
		}
   }	
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */