<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Polls extends CI_Controller {
  public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	//$this->auth->checkLogin();
   }
   function index()
   {
		$offset=uridata(3) ? uridata(3) : 0;
		$limit=5;
		$cityid=userdata('cityid');
		$totallistings=$this->df->doquery("select id from poll_questions");
		//fecthing result from db
		$total=count($totallistings);
		$this->load->library('pagination');					
		$config['base_url'] = base_url()."index.php/polls/index/";
		$config['total_rows'] = $total;
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['num_links'] = 8;
		$config['full_tag_open'] = '<div class="clearbig">&nbsp;</div><div class="pagination"><ul>';
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
		$query="select * from poll_questions order by id desc limit $offset,$limit";
		$data['content']['listings']=$this->df->doquery($query);					
		$data['header']['css']=array('polls/listings.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js');		
		$data['content']['template']='polls_listings.php';		
		$this->layout->publish($data);	
   }

	
	function show()
	{
		$slug=uridata(2);
		$data['content']['poll']=$this->df->get_single_row('poll_questions',array('slug'=>$slug));
		$this->db->simple_query("update poll_questions set visits=visits+1 where slug='$slug'");
		$data['content']['single_page']=true;
		$data['header']['css']=array('polls/listings.css');
		$data['footer']['js']=array('jquery.raty.min.js','yp_listings.js','wysihtml5-0.3.0.min.js','bootstrap-wysihtml5.js','news_show.js');
		$data['content']['user']=$this->df->get_single_row('users',array('uid'=>userdata('uid')));
		$data['content']['template']='polls_show.php';
		$this->layout->publish($data);
	}	
	
	function vote()
	{
		$this->auth->checkLogin();
		$data=$this->general->get_post_values();
		$data['uid']=userdata('uid');
		if($this->df->get_count('poll_votes',array('uid'=>$data['uid'],'pollid'=>$data['questionid']))==0)
		{
			$insert=$this->df->insert_data('poll_votes',array('uid'=>$data['uid'],'pollid'=>$data['questionid'],'answerid'=>$data['answer']));
			if($insert)
			{
				$answerid=$data['answer'];
				$questionid=$data['questionid'];
				$this->db->simple_query("update poll_answers set votes=votes+1 where id='$answerid'");
				$this->db->simple_query("update poll_questions set total_votes=total_votes+1 where id='$questionid'");
				set_message('success','Thank you! Your vote added successfully!');
				redirect('polls/'.$data['slug']);									
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
				redirect('polls/'.$data['slug']);					
			}
			
		}
		else
		{
			set_message('success','Thank you! You\'re already voted!');
			redirect('polls/'.$data['slug']);		
		}
	}
	
}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */