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
					$security_check = $this->df->get_single_row('users',array('email'=>$email, 'question_id' => $data['question_id'], 'answer' => $data['answer']));
					
					if(!empty($security_check)){
						$key=$this->general->randomKey(24);					
						$data=array('uid'=>$u['uid'],'ikey'=>$key,'ip'=>ip());
						$insert=$this->df->insert_data_id('password_reset',$data);
						if($insert)
							{
								$msg="Hi ".$u['name'].", <br> <br>We received a request to reset the password for your ".$this->settings->SiteName()." account.<br> <br> If you want to reset your password, click on the link below (or copy and paste the URL into your browser):<br><br>".base_url()."index.php/site/change_password/".$u['uid']."/".$key;
								$msg.="<br><br>If you don't want to reset your password, please ignore this message. Your password will not be reset. If you have any questions, please contact us at: ".$this->settings->siteEmail();
								$subject="Reset your ".$this->settings->SiteName()." password";
								$this->load->library('emails');
								$mail=$this->emails->send_mail($u['email'],$subject,$msg);
								if($mail)
									{
										set_message('success',"We've sent the instructions to your email. Please check your email!");
										redirect('start/signin');
									}
							}//insert ends
					}
					else{
						set_message('error',"Your security question & answer is wrong");
						redirect('site/forgot');			
					}

				}
/////////////////////////////						
		}
		else
		{
//			$data['header']['custom']='plain_header';
			$data['header']['css']=array('register.css');
			$data['footer']['js']=array('parsley.js');		
//			$data['footer']['custom']='plain_footer';		
			$data['content']['template']='forgot';	
			$data['sidebar']=false;		
			$this->layout->publish($data, 'full_layout_inner');			
		}
	}
	
	//Change Password
	function change_password()
		{
			$uid=uridata(3);
			$key=uridata(4);
			
			if($uid != '' && $key != ''){
				$u=$this->df->get_single_row('password_reset',array('uid'=>$uid,'ikey'=>$key));
				if(empty($u)){
					set_message('error',"Sorry, we couldn't verify the user requested for password reset. ".anchor('site/forgot','Try to resend the instructions'));
					redirect('start/signin');
				}
				else{
					$data=$this->general->get_post_values();
					if($this->general->validateForm($data))
					{
						$data=$this->general->processData($data);
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
					}//validation success
					else
					{
	//						$data['header']['custom']='plain_header';
							$data['header']['css']=array('register.css');
							$data['footer']['js']=array('parsley.js');		
	//						$data['footer']['custom']='plain_footer';		
							$data['content']['template']='reset_password';
							$data['sidebar']=false;
							$data['content']['user'] = $this->df->get_single_row('users',array('uid'=>$uid));
									
							$this->layout->publish($data, 'full_layout_inner');	
					}//validation failure
				}
			}
			else{
				set_message('error',"Not a valid link");
				redirect('start/signin');
			}
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
		$this->df->update_record('users',array('last_login'=>date("Y-m-d H:i:s")),array('uid'=>$_SESSION['uid']));
		$city=userdata('city');
		$cityid=userdata('cityid');
		session_destroy();
		session_start();
		$_SESSION['uid']=false;
		set_session('city',$city);
		set_session('cityid',$cityid);
		set_message('success', 'You are logged out successfully');
		redirect('start/signin');
//		redirect(base_url());
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