<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actions extends CI_Controller {
   public function __construct()
   {
	parent::__construct();
	$this->load->library('auth');  
	$this->auth->checkLogin();
   }
   
   function index()
   {
		redirect(base_url());	   
   }
   
   function bookmark()
   {
	   $data=$this->general->get_post_values();
	   if($this->df->get_count('bookmarks',array('uid'=>userdata('uid'),'itemtype'=>$data['itemtype'],'itemid'=>$data['itemid']))==0)
	   {
		   $this->df->insert_data('bookmarks',array('uid'=>userdata('uid'),'itemtype'=>$data['itemtype'],'itemid'=>$data['itemid']));
	   }
	   else
	   {
			$this->df->delete_record('bookmarks',array('uid'=>userdata('uid'),'itemtype'=>$data['itemtype'],'itemid'=>$data['itemid']));
	   }
	   echo "1";
   }
   
   function report()
   {
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
		   $uid=userdata('uid');	   
		   $insert=$this->df->insert_data('content_reports',array('uid'=>$uid,'itemtype'=>$data['itemtype'],'itemid'=>$data['itemid'],'category'=>$data['category'],'message'=>$data['message'],'ipaddress'=>ip()));
		 	 set_message('success',"Thank you! Your report sent successfully!");
		}
		else
		{
			set_message('error','Oops! Something went wrong!');
		}
		redirect($data['itemurl']);
   }
   
   function review()
   {
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			$data['message']=htmlspecialchars($data['message']);
			$rvw=array('uid'=>userdata('uid'),'itemid'=>$data['itemid'],'itemtype'=>$data['itemtype'],'score'=>$data['score'],'review'=>$data['message'],'ip'=>ip());
			if($data['itemtype']=='movies' || $data['itemtype']=='theatres' || $data['itemtype']=='deals')
			{
				$rvw['status']='1';
			}
			$insert=$this->df->insert_data_id('reviews',$rvw);
			if($insert)			
			{
				$alltable=array('yellowpages'=>'yp_listings','movies'=>'movies_listings','deals'=>'offers_listings','theatres'=>'movies_theatres');
				$table=$alltable[$data['itemtype']];
				$id=$data['itemid'];
				$item=$this->df->get_single_row($table,array('id'=>$id));
				
				//calculate score
				$oldscore=$item['review_score'];
				$newscore=(($item['total_reviews']*$item['review_score'])+$data['score'])/($item['total_reviews']+1);
				$this->db->simple_query("update $table set total_reviews=total_reviews+1,review_score='$newscore' where id='$id'");
				set_message('success',"Review added successfully! It'll available once its approved!");
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
			}

		}
		else
		{
			set_message('error','You missed some fields!');
		}
		redirect($data['itemurl']);
   }
   
   
   function review_vote()
   {
	   $id=uridata(3);
	   $type=uridata(4);
	   if($this->df->get_count('review_votes',array('reviewid'=>$id,'ipaddress'=>ip()))==0)
	   {
		   $this->df->insert_data('review_votes',array('reviewid'=>$id,'ipaddress'=>ip()));
		   if($type=='1')
		   {
		   $this->db->simple_query("update reviews set vote_yes=vote_yes+1 where id='$id'");
		   }
		   else
		   {
		   $this->db->simple_query("update reviews set vote_no=vote_no+1 where id='$id'");			   
		   }
		// set_message('success',"Review added successfully! It'll available once its approved!");  
	   }
	   $url=str_replace('--','/',uridata(5)).'#review-'.$id;
	 redirect($url);  
   }

   function comment()
   {
		$data=$this->general->get_post_values();
		if($this->general->validateForm($data))
		{
			$data=$this->general->processData($data);
			$data['comment']=htmlspecialchars($data['comment']);
			$insert=$this->df->insert_data_id('comments',array('uid'=>userdata('uid'),'itemid'=>$data['itemid'],'itemtype'=>$data['itemtype'],'comment'=>$data['comment'],'ip'=>ip()));
			if($insert)			
			{
				$alltable=array('news'=>'news_listings','photos'=>'photos','videos'=>'videos','polls'=>'poll_questions');
				//
				$table=$alltable[$data['itemtype']];
				$id=$data['itemid'];
				$item=$this->df->get_single_row($table,array('id'=>$id));
				
				//calculate score
				$this->db->simple_query("update $table set total_comments=total_comments+1 where id='$id'");
				set_message('success',"Comment added successfully!");
			}
			else
			{
				set_message('error','Oops! Something went wrong!');
			}

		}
		else
		{
			set_message('error','You missed some fields!');
		}
		redirect($data['itemurl']);
   }
   
   function comment_vote()
   {
	   $id=uridata(3);
	   $type=uridata(4);
	   if($this->df->get_count('comment_votes',array('commentid'=>$id,'ipaddress'=>ip()))==0)
	   {
		   $this->df->insert_data('comment_votes',array('commentid'=>$id,'ipaddress'=>ip()));
		   if($type=='1')
		   {
		   $this->db->simple_query("update comments set vote_yes=vote_yes+1 where id='$id'");
		   }
		   else
		   {
		   $this->db->simple_query("update comments set vote_no=vote_no+1 where id='$id'");			   
		   }
		// set_message('success',"Review added successfully! It'll available once its approved!");  
	   }
	   $url=str_replace('--','/',uridata(5)).'#review-'.$id;
	 redirect($url);  
   }

}/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */