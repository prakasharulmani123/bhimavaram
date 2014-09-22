<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
	function index()
	{
		redirect(base_url());	
	}
	
	public function forgot()
	{
		$this->load->library('auth');
		$this->auth->checkRelogin();
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
//////////////////////////
			$email=$data['email'];
			$u=$this->df->get_single_row('users',array('email'=>$email));
			if(count($u)==0)
				{
					set_message('error',"No account was found with that email.");
					redirect('site/forgot');			
				}
			else
				{
					$key=$this->general->randomKey(24);					
					$data=array('uid'=>$u['uid'],'ikey'=>$key,'ip'=>ip());
					$insert=$this->df->insert_data_id('password_reset',$data);
					if($insert)
						{
							$msg="Hi ".$u['name'].", <br> <br>We received a request to reset the password for your ".$this->settings->SiteName()." account.<br> <br> If you want to reset your password, click on the link below (or copy and paste the URL into your browser):<br><br>".base_url()."site/change_password/".$u['uid']."/".$key;
							$msg.="<br><br>If you don't want to reset your password, please ignore this message. Your password will not be reset. If you have any questions, please contact us at: ".$this->settings->siteEmail();
							$subject="Reset your ".$this->settings->SiteName()." password";
							$this->load->library('emails');
							$mail=$this->emails->send_mail($u['email'],$subject,$msg);
							if($mail)
								{
									set_message('success',"We've sent the instructions to your email. Please check your email!");
									redirect(base_url());
								}
						}//insert ends

				}
/////////////////////////////						
		}
		else
		{
			$data['header']['custom']='plain_header';
			$data['header']['css']=array('register.css');
			$data['footer']['js']=array('parsley.js');		
			$data['footer']['custom']='plain_footer';		
			$data['content']['template']='forgot';	
			$data['sidebar']=false;		
			$this->layout->publish($data);			
		}
	}
	
		//Change Password
	function change_password()
		{
			$uid=uridata(3);
			$key=uridata(4);
			$u=$this->df->get_single_row('password_reset',array('uid'=>$uid,'ikey'=>$key));
			$data=$this->general->get_post_values();
			if($this->general->validateForm($data))
			{
			$data=$this->general->processData($data);
			if(count($u)==0)
				{
					set_message('error',"Sorry, we couldn't verify the user requested for password reset. ".anchor('site/forgot','Try to resend the instructions'));
					redirect(base_url());
				}
			else
				{
					/////////////////////////////////////////////
					if($data['password']=="" || $data['confirm_password']=="")
						{
							set_message('error',"Enter both password and verify password!");
							redirect('site/change_password/'.$uid."/".$key);						
						}
					else if($data['password']!=$data['confirm_password'])
						{
							set_message('error',"Passwords doesn't match!");
							redirect('site/change_password/'.$uid."/".$key);
						}
					else
						{
							
							$pass=$data['password'];
							$this->load->library('encrypt');
							$pass=$this->encrypt->encode($pass);
							$update=$this->df->update_record('users',array('password'=>$pass),array('uid'=>$uid));
							if($update)
								{
									$this->df->delete_record('password_reset',array('uid'=>$uid,'ikey'=>$key));
									set_message('success',"Password changed successfully!");
									redirect('start/signin');							
								}
						}					
					//////////////////////////////////////////////
				}
			}//validation success
			else
			{
					$data['header']['custom']='plain_header';
					$data['header']['css']=array('register.css');
					$data['footer']['js']=array('parsley.js');		
					$data['footer']['custom']='plain_footer';		
					$data['content']['template']='reset_password';
					$data['sidebar']=false;		
					$this->layout->publish($data);	
			}//validation failure
		}
	//Update Password
	function update_password()
		{
			$data=$this->general->get_post_values();
			if($data['new_password']=="" || $data['verify_new_password']=="")
				{
					set_message('error',"Enter both password and verify password");
					redirect('start/change_password/'.$data['uid']."/".$data['key']);						
				}
			else if($data['new_password']!=$data['verify_new_password'])
				{
					set_message('error',"passwords doesn't match");
					redirect('start/change_password/'.$data['uid']."/".$data['key']);
				}
			else
				{
					
					$pass=$data['new_password'];
					$this->load->library('encrypt');
					$pass=$this->encrypt->encode($pass);
					$update=$this->df->update_record('users',array('password'=>$pass),array('id'=>$data['uid']));
					if($update)
						{
							$this->df->delete_record('password_reset',array('uid'=>$data['uid'],'ikey'=>$data['key']));
							set_message('success',"Password changed successfully!");
							redirect('start/login');							
						}
				}
		}	
		

	function signout()
	{
		$city=userdata('city');
		$cityid=userdata('cityid');
		session_destroy();
		session_start();
		$_SESSION['uid']=false;
		set_session('city',$city);
		set_session('cityid',$cityid);
		redirect(base_url());
	}


	function about()
	{
		$data['footer']['js']=array('parsley.js');		
		$data['content']['template']='about';	
		$this->layout->publish($data);	
	}
	
	function contact()
	{
		$data['footer']['js']=array('parsley.js');		
		$data['content']['template']='contact';		
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