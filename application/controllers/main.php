<?php 

class Main extends CI_Controller
{
	function  _construct()
	{
	
	   parent::_construct();
	 
	   
	}
	
	
		function test()
{
	$this->load->library('eden');
	
	$auth=eden('facebook')->auth('338729102917094', 'ed0203b22d8cdef39aa9c32fc432a61c', 'http://tastypins.com/index.php/main/success');
	//http://admissions.collegehood.com/index.php
	if($this->session->userdata('code')==false)
	{
		redirect($auth->getLoginUrl(array('email')));
	}
	
	if(isset($_GET['code'])) {
    //save it to session
    $access = $auth->getAccess($_GET['code']);
    $_SESSION['fb_token'] = $access['access_token'];
}
	
	
}

function success()
	{
	$this->load->library('session');
	$this->load->library('eden');
	
	$new=$_GET['code'];
//	echo $new;
	
   if(isset($_GET['code'])) {
  //  echo 'shobana';
		$auth=eden('facebook')->auth('338729102917094', 'ed0203b22d8cdef39aa9c32fc432a61c', 'http://tastypins.com/index.php/main/success');
    $access = $auth->getAccess($_GET['code']);
	
   $data['fb_token'] = $access['access_token'];
   $this->session->set_userdata('fb_token',$access['access_token']);
   //echo $this->session->userdata($data);
}
    
		$graph = eden('facebook')->graph($this->session->userdata('fb_token'));
	    $user=$graph->getUser();
		
	
		 $uid=userdata('uid');
		 if($this->df->get_count('facebook',array('uid'=>$uid))==0)
			{ 
		
			if($this->df->get_count('facebook',array('email'=>$user['email']))==0)
			{
				//echo "35";
			    $token=$this->session->userdata('fb_token');   
			    $data=array('fbid'=>$user['id'],
							'first_name'=>$user['first_name'],			 
							'last_name'=>$user['last_name'],
							'email'=>$user['email'],
							'gender'=>$user['gender'],
							'username'=>$user['name'],
							'picture'=>'http://graph.facebook.com/'.$user['id'].'/picture',
						
							'fb_token'=>$token);
				
			  	$insert=$this->df->insert_data('tastypins_facebook',$data);	
			
			
				$data1=array('name'=>$user['name'],
							   'fb_id'=>$user['id'],
							   'email'=>$user['email'],
									   );	
				   $insert=$this->df->insert_data('tastypins_users',$data1);
				   
			//	   echo $user['id'];
				   $uid1=$this->df->get_field_value('tastypins_users',array('fb_id'=>$user['id']),'userid');
				   $dataid=array('uid'=>$uid1);
				   $this->df->update_record('tastypins_facebook',$dataid,array('fbid'=>$user['id']));
				
				
						$newdata=array('loggedin'=>TRUE,
						   'uid'=>$uid1,
						   'email'=>$user['email'],
						   'fb_id'=>$user['id'],
	                         'name'=>$user['name']);
				
			$this->session->set_userdata($newdata); 
		
			}
			else
			{
				   $user=$this->df->get_single_row('tastypins_users',array('fb_id'=>$user['id']));				
						$newdata=array('loggedin'=>TRUE,
						   'uid'=>$user['userid'],
						   'email'=>$user['email']);
						   
				
					$this->session->set_userdata($newdata); 
				
			}
				 
			 //$this->load->view('trial');
			 

		
             }
	else
		{
			
		
			if($this->df->get_count('tastypins_facebook',array('fbid'=>$user['id']))>0)
			{
			
				//echo "just";
				$fbuser=$this->df->get_single_row('tastypins_facebook',array('fbid'=>$user['id']));
				
				$newdata=array('loggedin'=>TRUE,
						   'uid'=>$fbuser['uid'],
						    'email'=>$fbuser['email']);
			 $this->session->set_userdata($newdata);
				
				
			}//
			
			else
			{
				
				//echo "justjust";
				//check if user registered with this email
				if($this->df->get_count('tastypins_users',array('email'=>$user['email']))>0)
				{
					//echo "exists";
					$u=$this->df->get_single_row('tastypins_users',array('email'=>$user['email']));
	
	
	
	
	$data=array('fbid'=>$user['id'],
							'first_name'=>$user['first_name'],			 
							'last_name'=>$user['last_name'],
							'email'=>$user['email'],
							'gender'=>$user['gender'],
							'username'=>$user['name'],
							'picture'=>'http://graph.facebook.com/'.$user['id'].'/picture',
						
							'fb_token'=>$token);
				
			  	$insert=$this->df->insert_data('tastypins_facebook',$data);	
				
	
								
								
			
								$this->df->update_record('users',array('fb_id'=>$user['id']),array('id'=>$u['userid']));
						
				$us=$this->df->get_single_row('tastypins_users',array('email'=>$user['email']));
						
						$newdata=array('loggedin'=>TRUE,
						   'uid'=>$us['userid'],
						    'email'=>$us['email']);
			 $this->session->set_userdata($newdata); 
						
						
				}
				
			}
			
			
			
			
						
		
							
		}
redirect('main');

//echo  $this->session->userdata('email');
//$this->load->view('trial');


		}



	/*$graph = eden('facebook')->graph($this->session->userdata['fb_token']);
	 $graph->$this->eden->getUser();
	echo $graph['first_name'];
	
	$this->load->view('trial');
	*/

	function index()
	{

$query=$this->db->query('SELECT * FROM tastypins_pins');
$new=$query->result_array();
$count=count($new);
$page=$this->uri->segment(3);
$limit=12;
$page= $page ? $page : 0;
	

$query=$this->db->query('SELECT * FROM tastypins_pins  LIMIT '.$page.','.$limit);
$data['new']=$query->result_array();




//pagination
$this->load->library('pagination');	
		$config['total_rows'] =$count;
	    $config['base_url'] = base_url()."index.php/main/index/";
	    $config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<div  style="margin-left:100px;font-size:20px;color:green">';
		$config['full_tag_close'] = '</div>';
		$config['num_tag_open'] = '<span style="margin:15px;">';
		$config['num_tag_close'] = '</span>';
		$config['cur_tag_open'] = '<span class="page active style="margin:5px;">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$data['navigation']=$this->pagination->create_links();

		$vdata['category']=$this->df->get_multi_row('tastypins_category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		$data['category']=$this->df->get_multi_row('tastypins_category');
		$data['sidebar'] = $this->load->view('sidebar','',TRUE);
		$data['footer'] = $this->load->view('footer','',TRUE);
		$this->load->view('home',$data);
		
	}
	
	
	
function category(){
	
	
	
$category=$this->uri->segment(3);
$var=$this->df->get_multi_row('tastypins_pins',array('category_id'=>$category));
$name=$this->df->get_field_value('tastypins_category',array('ID'=>$category),'name');
$count=count($var);
$page=$this->uri->segment(4);
$limit=9;
$page= $page ? $page : 0;
$query=$this->db->query('SELECT * FROM `tastypins_pins` WHERE category_id='.$category.' LIMIT '.$page.','.$limit);
$data['result']=$query->result_array();

//pagination starts here
	    $this->load->library('pagination');	
		$config['total_rows'] =$count;
	    $config['base_url'] = base_url()."index.php/main/category/".$category."/";
	    $config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<div  style="margin-left:100px;font-size:20px;color:green">';
		$config['full_tag_close'] = '</div>';
		$config['num_tag_open'] = '<span style="margin:15px;">';
		$config['num_tag_close'] = '</span>';
		$config['cur_tag_open'] = '<span class="page active style="margin:5px;">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$data['navigation']=$this->pagination->create_links();

		$data['heading']=$name;
		

$vdata['category']=$this->df->get_multi_row('tastypins_category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		$data['category']=$this->df->get_multi_row('tastypins_category');
		$data['sidebar'] = $this->load->view('sidebar','',TRUE);
		$data['footer'] = $this->load->view('footer','',TRUE);
		$this->load->view('category',$data);
		

	
	}	
	
	
	
		
function tags(){
	
	
	
	$tags=$this->uri->segment(3);
$name=$this->df->get_field_value('tastypins_tags',array('tag_id'=>$tags),'tag_name');
$query_count=$this->db->query('Select * from tastypins_pins where tag like "%'.$tags.'"  OR tag like "'.$tags.'%" OR tag like "%'.$tags.'%"');
	 $coun=$query_count->result_array();
	  $count=count($coun);
	$page=$this->uri->segment(4);
$limit=6;
$page= $page ? $page : 0;
$query=$this->db->query('Select * from tastypins_pins where tag like "%'.$tags.'"  OR tag like "'.$tags.'%" OR tag like "%'.$tags.'%"LIMIT '.$page.','.$limit);
	  $data['result']=$query->result_array(); 

		$data['heading']=$name;
		
		 //pagination starts here
	    $this->load->library('pagination');	
		$config['total_rows'] =$count;
	    $config['base_url'] = base_url()."index.php/main/tags/".$tags."/";
	    $config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<div  style="margin-left:100px;font-size:20px;color:green">';
		$config['full_tag_close'] = '</div>';
		$config['num_tag_open'] = '<span style="margin:15px;">';
		$config['num_tag_close'] = '</span>';
		$config['cur_tag_open'] = '<span class="page active style="margin:5px;">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$data['navigation']=$this->pagination->create_links();
	  
	  


$vdata['category']=$this->df->get_multi_row('tastypins_category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		$data['category']=$this->df->get_multi_row('tastypins_category');
		$data['sidebar'] = $this->load->view('sidebar','',TRUE);
		$data['footer'] = $this->load->view('footer','',TRUE);
		$this->load->view('tags',$data);
		

	
	}	
	
	function author(){
	
	
	
	$pinner_name=$this->uri->segment(3);
$name=$this->df->get_field_value('tastypins_pins',array('pinner_name'=>$pinner_name),'pinner_name');


$query_count=$this->db->query('Select * from tastypins_pins where pinner_name like "%'.$pinner_name.'"');
 $coun=$query_count->result_array();
	  $count=count($coun);
	$page=$this->uri->segment(4);
$limit=1;
$page= $page ? $page : 0;


$query=$this->db->query('Select * from tastypins_pins where pinner_name like "%'.$pinner_name.'" LIMIT '.$page.','.$limit);
	  $data['result']=$query->result_array(); 
	  
	  
	  
	  
	  
	  //pagination starts here
	    $this->load->library('pagination');	
		$config['total_rows'] =$count;
	    $config['base_url'] = base_url()."index.php/main/author/".$pinner_name."/";
	    $config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<div  style="margin-left:100px;font-size:20px;color:green">';
		$config['full_tag_close'] = '</div>';
		$config['num_tag_open'] = '<span style="margin:15px;">';
		$config['num_tag_close'] = '</span>';
		$config['cur_tag_open'] = '<span class="page active style="margin:5px;">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$data['navigation']=$this->pagination->create_links();
	  
	  

		$data['heading']=$name;
		

$vdata['category']=$this->df->get_multi_row('tastypins_category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		$data['category']=$this->df->get_multi_row('tastypins_category');
		$data['sidebar'] = $this->load->view('sidebar','',TRUE);
		$data['footer'] = $this->load->view('footer','',TRUE);
		$this->load->view('tags',$data);
		

	
	}	
	
	
	function search()
	{
		
	  $name=$this->input->post('search');
	
	
	 $query_count=$this->db->query('Select * from tastypins_pins where description like "%'.$name.'" OR description like "'.$name.'%" OR description like "%'.$name.'%"');
	  $coun=$query_count->result_array();
	  $count=count($coun);
	$page=$this->uri->segment(3);
$limit=9;
$page= $page ? $page : 0;
	  $query=$this->db->query('Select * from tastypins_pins where description like "%'.$name.'" OR description like "'.$name.'%" OR description like "%'.$name.'%"  LIMIT '.$page.','.$limit);
	  $data['result']=$query->result_array();
	  
	  
	  //pagination starts here
	    $this->load->library('pagination');	
		$config['total_rows'] =$count;
	    $config['base_url'] = base_url()."index.php/main/search/";
	    $config['per_page'] = $limit;
		$config['uri_segment'] = 3;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<div  style="margin-left:100px;font-size:20px;color:green">';
		$config['full_tag_close'] = '</div>';
		$config['num_tag_open'] = '<span style="margin:15px;">';
		$config['num_tag_close'] = '</span>';
		$config['cur_tag_open'] = '<span class="page active style="margin:5px;">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$data['navigation']=$this->pagination->create_links();
	$data['heading']=$name;
	$vdata['category']=$this->df->get_multi_row('tastypins_category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		$data['category']=$this->df->get_multi_row('tastypins_category');
		$data['sidebar'] = $this->load->view('sidebar','',TRUE);
		$data['footer'] = $this->load->view('footer','',TRUE);
		$this->load->view('search',$data);
		
		
		
	}
function single_image(){
	
	
	$id=$this->uri->segment(3);
	$data['result']=$this->df->get_single_row('tastypins_pins',array('ID'=>$id));
	
	$vdata['category']=$this->df->get_multi_row('tastypins_category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		
		$data['advertise'] = $this->load->view('advertise','',TRUE);
		$data['footer'] = $this->load->view('footer','',TRUE);
		$this->load->view('single_image',$data);
		
		
		
  $views=$this->df->get_field_value('tastypins_pins',array('ID'=>$id),'views');
  $views=$views+1;
  $data_views=array('views'=>$views);
  $this->df->update_record('tastypins_pins',$data_views,array('ID'=>$id));
	
	}	
	
	
	
	
	
	
	function contact(){
		
		$vdata['category']=$this->df->get_multi_row('tastypins_category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		
		$data['footer'] = $this->load->view('footer','',TRUE);
		
		$this->load->view('contact',$data);
		
		
		
		
		}
		
		
		
function sign_in()

{
	
	$vdata['category']=$this->df->get_multi_row('tastypins_category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		
		$data['footer'] = $this->load->view('footer','',TRUE);
	
			$this->load->view('sign_in',$data);

	
	
	
	
	
	}
	
	
function register()
{	
	
	 $currenturi=$this->uri->segment(3);
 $controller=$this->uri->segment(4);
	
	$name=$this->input->post('name');
	$email=$this->input->post('email');
	$password=$this->input->post('password');
	
	$count=$this->df->get_count('tastypins_users',array('name'=>$name,'email'=>$email));
	if($count==0)
	{
	
		
	$data=array('email'=>$email,'name'=>$name,'password'=>$password);
	$this->df->insert_data('tastypins_users',$data);
	    $data=array('message'=>'<div class="alert alert-info alert-message fade in message" data-alert="alert" style="margin:0px;">
     You have successfully  Registered</div>');	
	$this->session->set_flashdata($data);
	
     redirect('main');

	
	}
	
	else
	{
	
	
	    $data=array('error'=>'<div class="alert alert-error alert-message fade in message" data-alert="alert" style="width:200px; margin-left:550px;">
   You have already subscribed</div>');	
	$this->session->set_flashdata($data);
	 
	redirect($controller.'/'.$currenturi);
	
	}
	

	

}
		
	
	
	
	
	function log_in()
{	
	
	 $currenturi=$this->uri->segment(3);
 $controller=$this->uri->segment(4);
	
	$email=$this->input->post('email');
	$password=$this->input->post('password');
	$var=$this->df->get_field_value('tastypins_users',array('email'=>$email,'password'=>$password),'userid');
	$count=$this->df->get_count('tastypins_users',array('email'=>$email,'password'=>$password,));
	if($count > 0 )
	{
	
		
	
	   $data=array('message'=>'<div class="alert alert-info alert-message fade in message" data-alert="alert"  style="margin:0px;">
     You have successfully logged in </div>');	
	$this->session->set_flashdata($data);
	
	$newdata=array('uid'=>$var,
				   'email'=>$email,'loggedin'=>true);
	$this->session->set_userdata($newdata);
     redirect('main');
	 
	//echo $this->session->userdata('email').'<br>';
	 
	 //echo $this->session->userdata('loggedin').'<br>';
	 
	 //echo $this->session->userdata('uid').'<br>';
	 
	
	 
   // $this->load->view('trial');
	
	}
	
	else
	{
	
	
	    $data=array('item'=>'<div class="alert alert-error alert-message fade in message" data-alert="alert" style="width:200px; margin-left:550px;">
   error </div>');	
	$this->session->set_flashdata($data);
	 
	redirect($controller.'/'.$currenturi);
	
	}
	

	

}
		
	
function log_out()
{
	
	
	 
	
	$newdata=array('email','loggedin','uid');
	$this->session->sess_destroy($newdata);
	
	
	
	
	
	   $data=array('message'=>'<div class="alert alert-info alert-message fade in message" data-alert="alert" style="margin:0px;">
       Signed out successfully..</div>');	
	   $this->session->set_flashdata($data);
	
	echo $this->session->userdata('email');
	 
	echo $this->session->userdata('loggedin');
	 
//$this->load->view('trial');
	
	redirect('main');
	
	
	}
	
	
	function share_form()
	
	{	
			
	
		 $url=$this->input->post('url');
		 
		  $data=array('original_link'=>$url);
		  
		  
		  $this->df->insert_data('tastypins_pins',$data);
		  
		   redirect('main');
		
		}
	
	
	
	function about(){
		
		
		$vdata['category']=$this->df->get_multi_row('category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		
		$data['footer'] = $this->load->view('footer','',TRUE);
		$this->load->view('about',$data);
		}
		
		
	/*function share(){
		$data['head']=$this->load->view('head','',true);		
		$this->load->view('share',$data);
				
		
		}*/
		
		
	
	
/*	function share_form()
	{
		
		 $name=$this->input->post('url');
	
	
	 $query_count=$this->db->query('Select * from pins where original_link like "%'.$name.'" OR original_link like "'.$name.'%" OR original_link like "%'.$name.'%"');
	  $coun=$query_count->result_array();
	  $count=count($coun);
	$page=$this->uri->segment(3);
$limit=1;
$page= $page ? $page : 0;
	  $query=$this->db->query('Select * from pins where original_link like "%'.$name.'" OR original_link like "'.$name.'%" OR original_link like "%'.$name.'%"  LIMIT '.$page.','.$limit);
	  $data['result']=$query->result_array();
	  
	  
	  //pagination starts here
	    $this->load->library('pagination');	
		$config['total_rows'] =$count;
	    $config['base_url'] = base_url()."index.php/main/share_form/";
	    $config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['full_tag_open'] = '<div  style="margin-left:100px;font-size:20px;color:green">';
		$config['full_tag_close'] = '</div>';
		$config['num_tag_open'] = '<span style="margin:15px;">';
		$config['num_tag_close'] = '</span>';
		$config['cur_tag_open'] = '<span class="page active style="margin:5px;">';
		$config['cur_tag_close'] = '</span>';
		
		$this->pagination->initialize($config);
		$data['navigation']=$this->pagination->create_links();
	
	$vdata['category']=$this->df->get_multi_row('category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		$data['category']=$this->df->get_multi_row('category');
		$data['sidebar'] = $this->load->view('sidebar','',TRUE);
		$data['footer'] = $this->load->view('footer','',TRUE);
		$this->load->view('share_all',$data);
		
		
		
		
	}
	
	
	
	function share_single(){
	
	
	$id=$this->uri->segment(3);
	$data['result']=$this->df->get_single_row('pins',array('ID'=>$id));
	
	$vdata['category']=$this->df->get_multi_row('category');
		$data['header'] = $this->load->view('header',$vdata,TRUE);
		
		$data['advertise'] = $this->load->view('advertise','',TRUE);
		$data['footer'] = $this->load->view('footer','',TRUE);
		$this->load->view('share_single',$data);
		
		
		
  $views=$this->df->get_field_value('pins',array('ID'=>$id),'views');
  $views=$views+1;
  $data_views=array('views'=>$views);
  $this->df->update_record('pins',$data_views,array('ID'=>$id));
	
	}	
	*/
	
	
		
	
} ?>