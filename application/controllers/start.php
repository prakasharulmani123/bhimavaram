<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Start extends CI_Controller {
	public function index()
	{
		$this->load->helper('video');
		$this->load->library('YoutubeVideoDetails');
		$cityid=userdata('cityid');
		$day_start=date("Y-m-d 00:00:00");
		$day_end=date("Y-m-d 23:59:59");		
		$data['header']['css']=array('home.css');
		$data['footer']['js']=array('jquery.easing.1.3.js','jquery.anyslider.js','jquery.elastislide.js','timeago.js','jquery.vticker.min.js','home.js');		
		if($cityid)
		{
		$data['content']['citynews']=$this->df->doquery("select * from news_listings where cityid='$cityid' and category!='9' and approved='1' order by id desc limit 10");
		//$data['content']['topnews']=$this->df->doquery("select * from news_listings where date_added between '$day_start' and '$day_end' order by visits desc limit 7");
		$data['content']['topnews']=$this->df->doquery("select * from news_listings where cityid='$cityid' and category!='9' and approved='1' order by visits desc limit 10");
		$data['content']['cinenews']=$this->df->doquery("select * from news_listings where cityid='$cityid' and category='9' and approved='1' order by id desc limit 7");
		$data['content']['events']=$this->df->doquery("select * from events_listings where cityid='$cityid' and approved='1' order by id desc limit 5");
		$data['content']['movies']=$this->df->doquery("select * from movies_listings where theatres > '0' order by id desc limit 4");		
		$data['content']['videos']=$this->df->doquery("select * from videos where find_in_set($cityid,cities) or cities='0' order by id desc limit 3");
		$data['content']['numbers']=$this->df->doquery("select * from numbers where cityid='$cityid' order by name asc");
		//Get photos
		$totalalbums=$this->df->doquery("select id,cities from photo_albums where find_in_set($cityid,cities) or find_in_set('0',cities) order by id desc");
		$albumlist=array();
		foreach($totalalbums as $album)
		{
			$albumlist[]=$album['id'];
		}
		$albumlist=implode(',',$albumlist);
		$data['content']['photos']=$this->df->doquery("select * from photos where albumid in ('$albumlist') order by id desc limit 10");
		$polls=$this->df->doquery("select * from poll_questions order by id desc limit 1");		
		$data['content']['poll']=$polls['0'];
		$pollcomment=$this->df->get_multi_row('comments',array('itemtype'=>'polls','itemid'=>$data['content']['poll']['id'],'active'=>'1'),false,1,array('id'=>'desc'));
		$data['content']['pollcomment']=$pollcomment[0];
		//print_r($data['content']['poll']);
		$last_date=date("Y-m-d");
		$data['content']['jobs']=$this->df->doquery("select * from jobs_listings where cityid='$cityid' and approved='1' and last_date > '$last_date' limit 3");
		$today=date("Y-m-d");
		$data['content']['deals']=$this->df->doquery("select * from offers_listings where cityid='$cityid' and approved='1' and starts_on <= '$today' and closes_on >= '$today' limit 4");
		$data['content']['classifieds']=$this->df->doquery("select * from classy_listings where approved='1' and cityid='$cityid' order by id desc limit 15");
		}
		$data['content']['template']='home';
		$data['sidebar']=false;
		$this->layout->publish($data);
	}
	public function register()
	{
		$this->load->library('auth');		
		$this->auth->checkRelogin();		
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			$data['birthday']=$data['birthday_year'].'-'.$data['birthday_month'].'-'.$data['birthday_date'];
			unset($data['birthday_year']);
			unset($data['birthday_month']);
			unset($data['birthday_date']);			
			$this->load->library('encrypt');
			$data['password']=$this->encrypt->encode($data['password']);
			$insertData=array(
				'name'=>$data['name'],
				'email'=>$data['email'],
				'gender'=>$data['gender'],
				'birthday'=>$data['birthday'],
				'cityid'=>$data['city'],
				'registration_source'=>'manual',
				'ipaddress'=>ip(),
				'password'=>$data['password']
			);	
		//Add new user
			$this->load->library('auth');
			$this->auth->addUser($insertData,true);	
			$this->auth->checkRedirectSource();
			redirect(base_url());
		}
		else
		{
			$data['header']['custom']='plain_header';
			$data['header']['css']=array('register.css');
			$data['footer']['js']=array('parsley.js');		
			$data['footer']['custom']='plain_footer';		
			$data['content']['template']='register';
			$data['sidebar']=false;		
			$this->layout->publish($data);
		}		
	}
	
	public function signin()
	{
		$this->load->library('auth');
		$this->auth->checkRelogin();
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			$this->_checkLogin($data);
		}
		else
		{
			$data['header']['custom']='plain_header';
			$data['header']['css']=array('register.css');
			$data['footer']['js']=array('parsley.js');		
			$data['footer']['custom']='plain_footer';		
			$data['content']['template']='signin';
			$data['sidebar']=false;			
			$this->layout->publish($data);			
		}
	}		
	
	function emailtemplate()
	{
		$this->load->view('default/email_template');
	}
	
	function _checkLogin($data)
	{
			$this->load->library('auth');
			$this->load->library('encrypt');
			$user=$this->df->get_single_row('users',array('email'=>$data['email']));
			if(count($user)>0 && $this->encrypt->decode($user['password'])==$data['password'])
			{
				//Sign in Successful
				$this->auth->setLogin($user['uid']);
				
				// Send Thank you mail for first login user. START
				$timestamp = strtotime($user['last_login']);
				if(empty($timestamp)){
					$this->load->library('email');
					$this->email->from('admin@admin.com', 'Admin');
					$this->email->to($user['email']);
					$this->email->subject('Thanking mail');
					$this->email->message('Thank you for your first login.');
					$this->email->send();
				}
				//Send Thank you mail for first login user. END
				set_message('success','Welcome back '.userdata('name').'!');
				$this->auth->checkRedirectSource();
				redirect('profile/index');	
			}
			else
			{
				if(count($user)==0)
				{
					set_message('error',"We couldn't able to find an account with this email.");
					$this->showLoginPage();
				}
				else
				{
					set_message('error',"You've entered wrong password. Try again!");					
				}
				redirect('start/signin');
			}
	}
	
	function changecity()
	{

		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			$city=$this->df->get_single_row('cities',array('id'=>$data['city']));
			set_session('city',$city['city']);
			set_session('cityid',$city['id']);
			redirect($data['currenturl']);
		}
		else
		{
			redirect(base_url());
		}
	}
	
	function postwish()
	{
		$data=$this->general->get_post_values();
		//print_r($data); exit;
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			$data['uid']=userdata('uid')?userdata('uid'):'0';
			$currenturl=$data['currenturl'];
			$data['posted_by']=userdata('name')?userdata('name'):'0';
			$data['cityid']=userdata('cityid');
			unset($data['currenturl']);
			//print_r($data);
			$insert=$this->df->insert_data('wishes',$data);
			set_message('success','Your wish submitted successfully!');
			
			$this->load->library('email');
			$this->email->from('admin@admin.com', 'Admin');
			$this->email->to($data['email']);
			$this->email->subject('Thanking mail');
			$this->email->message('Thank you for submit your wish.');
			$this->email->send();
			
			redirect($currenturl);
			
		}
		else
		{
			set_message('error','Oops! You\'ve missed some information!');
			redirect($data['currenturl']);
		}
	}
	
	function getwish()
	{
		$cityid=userdata('cityid');
		$wish=$this->df->doquery("select * from wishes where cityid='$cityid' and approved='1' order by id desc limit 10");
		//print_r($wish);
		$row=rand(0,2);
		echo $wish[$row]['message'].' from '.$wish[$row]['posted_by'];
	}
	
	
	function setsearch()
	{
		set_session('searchtype',postdata('type'));
		set_session('searchtext',postdata('text'));
		echo "1";
	}
	
	function searchresults()
	{
		$data=$this->general->get_post_values();
		$data=$this->general->processData($data);
		$list=array(
		'yellowpages'=>'yellowpages/search/'.$data['q'],
		'classifieds'=>'classifieds/search/'.$data['q'],
		'news'=>'news/searchresults/'.$data['q'],
		'deals'=>'deals/searchresults/'.$data['q'],
		'movies'=>'movies/searchresults/'.$data['q'],
		'jobs'=>'jobs/searchresults/'.$data['q'],
		);
		redirect($list[$data['searchtype']]);
	}
	
	function setcity()
	{
		//$city=uridata('3');
		$city=$this->df->get_single_row('cities',array('id'=>uridata('3')));
		set_session('city',$city['city']);
		set_session('cityid',$city['id']);
		//$url=str_replace('--','/',uridata(5)).'#review-'.$id;
		redirect(base_url());  
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */