<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebook extends CI_Controller {
	
	public function index()
	{
		
	}
	
	function connect()
	{
		$this->load->library('eden');
		$fbsettings=$this->settings->getFacebookData();		
		$auth=eden('facebook')->auth($fbsettings['key'], $fbsettings['secret'], $fbsettings['callback_url']);
		if(userdata('code')==false)
		{
			redirect($auth->getLoginUrl($fbsettings['scope']));
		}

	}
	
	function success()
	{
		$this->load->library('eden');
		$fbsettings=$this->settings->getFacebookData();
		 if(isset($_GET['code'])) 
		 {
			$auth=eden('facebook')->auth($fbsettings['key'], $fbsettings['secret'], $fbsettings['callback_url']);			
			$access = $auth->getAccess($_GET['code']);			
			//print_r($access);
		   	$data['fbtoken'] = $access['access_token'];
		   	set_session('fbtoken',$access['access_token']);
		}
			//Get Facebook User Details
			$graph = eden('facebook')->graph(userdata('fbtoken'));
		    $user=$graph->getUser();
			//echo '<pre>';
			//print_r($user);
			//exit;
			////////////////////////////////////////
		if($this->df->get_count('users',array('email'=>$user['email']))==0)
			{
				//echo "35";
			    $token=userdata('fbtoken');   
			    $data=array('fbid'=>$user['id'],
							'name'=>$user['name'],
							'first_name'=>$user['first_name'],			 
							'last_name'=>$user['last_name'],
							'email'=>$user['email'],
							'gender'=>$user['gender'],
							'username'=>$user['username'],
							'picture'=>'http://graph.facebook.com/'.$user['id'].'/picture',						
							'fbtoken'=>$token);

				$profile=array(
							'name'=>$user['name'],
							'email'=>$user['email'],
							'gender'=>$user['gender'],
							'birthday'=>$user['birthday'],
							'bio'=>$user['bio'],
							'birthday'=>$user['birthday'],
							'picture'=>'http://graph.facebook.com/'.$user['id'].'/picture',	
							'registration_source'=>'facebook',
							'ipaddress'=>ip(),														
						);				
				$this->load->library('auth');
			  	$fbinsert=$this->df->insert_data('facebook',$data);
				$profileadd=$this->auth->addUser($profile,true);
				//$profiladd=$this->df->insert_data_id('users',$profile);
				if($profiladd)
				{								
					$this->auth->setLogin($profiladd);
					set_message('success','Welcome back '.userdata('name').'!');
					$this->auth->checkRedirectSource();
					redirect('start/index');	
				}
				else
				{
					set_message('error',"Oops Something went wrong. Try again!");
					redirect('start/signin');	
				}
				
			}
			else
			{
				   	$u=$this->df->get_single_row('users',array('email'=>$user['email']));				
					$this->load->library('auth');			
					$this->auth->setLogin($u['uid']);
					set_message('success','Welcome back '.userdata('name').'!');
					$this->auth->checkRedirectSource();
					redirect('start/index');	
				
			}
			////////////////////////////////////////
			

	}

	
}//controller ends

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */