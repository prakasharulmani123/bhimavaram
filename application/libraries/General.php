<?php
class General
{
    function __construct() {
       $this->CI =& get_instance();
	   $CI =& get_instance();
	   $this->_checkCityCookie();
    }
	
	/****************************************************
	*	Fetches all POSTed values and returns as array 	*	
	****************************************************/
	
	function get_post_values() {			
			$post = array();
			foreach ( $_POST as $key => $value )
				{
					if($key!="submit")
						{
							$post[$key] = $this->CI->input->post($key);
						}
				}
			return $post;
		}


	function array_key_exists_multi($n, $arr) {
		  foreach ($arr as $key=>$val) {
			if ($n===$key) {
			  return $key;
			}
			if (is_array($val)) {
			  if(multi_array_key_exists($n, $val)) {
				return $key . ":" . $this->array_key_exists_multi($n, $val);
			  }
			}
		  }
	  return false;
	}		
	/********************************************************************************
	*	Validates Form fields automatically	and returns result as Boolean		 	*	
	********************************************************************************/
	
	function validateForm($data) {	
			$CI =& get_instance();
			$CI->load->library('form_validation');
			$CI->form_validation->set_error_delimiters('<div class="validation-error">', '</div>');					
			foreach($data as $name=>$value)
			{
				$eleName=$name;
				$name=explode('-',$name);
//				echo $eleName."<br>";
				if(count($name)>1)
				{
					//set Element Name
					$eleLabel=$name[0];
					$eleLabel=ucwords(str_replace('_',' ',$eleLabel));
					unset($name[0]);
					//set Element Parameters
					$rules=array();
					foreach($name as $rule)
					{
						$rules[]=$this->parseValidationRule($rule);						
					}
					$rules=implode('|',$rules);
					$CI->form_validation->set_rules($eleName, $eleLabel,$rules);					
				}//if it has validation rules
				else
				{
					$eleLabel=ucwords(str_replace('_',' ',$eleName));
					$CI->form_validation->set_rules($eleName, $eleLabel,'');
				}
				
			}//foreach ends
			return $CI->form_validation->run();
		}//validateForm Ends
		
	/****************************************************
	*	Parses Given string Rule and returns as CI Rule	*	
	****************************************************/					
	function parseValidationRule($rule)
	{
		//check for parameters
		if(strpos($rule,':')===false)
		{
			return $rule;
		}
		else
		{
			$rule=explode(':',$rule);
			if(strpos($rule[1],'_'))
			{
				$rule[1]=str_replace("_",".",$rule[1]);
			}
			return $rule[0].'['.$rule[1].']';
		}
	}

	/****************************************************
	*	Creates a random string at the given length 	*	
	****************************************************/			
	function processData($data)
	{
		$result=array();
		foreach($data as $name=>$value)
		{			
			$name=explode('-',$name);
			$eleName=$name[0];
			$result[$eleName]=$value;
		}
		return $result;
	}
		
	/****************************************************
	*	Creates a random string at the given length 	*	
	****************************************************/		
	function randomKey($length){
			$chr="qwertyuioplkjhgfdsazxcvbnmlkdhfueyrtwusjfhyr4786975809687vbnmlkdhfueyrtwusjvbnmlkdhfueyrtwusjfhyr4786975809687fvbnmlkdhfueyrtwusjfhyr4786975809687hyr47869758096875847341215632849069sazxcvbnmlkdhfueyrtwusjfhyr4786975809687vbnmlkdhfueyrtwusjvbnmlkdhfueyrtwusjfhyr4786975809687fvbnmlkdhfueyrtwusjfhyr4786975809687hyr478697580968758473412156328490699";
			$key="";
			$strlength=strlen($chr);
			for($i=0;$i<=$length;$i++)
				{
					$rand=rand(0,$strlength-1);
					$key.=substr($chr,$rand,1);
				}
			return $key;
		}		

	function getReviews($itemtype,$itemid,$url)
	{
		$CI =& get_instance();
		
		//
		$alltable=array('yellowpages'=>'yp_listings','movies'=>'movies_listings','theatres'=>'movies_theatres','deals'=>'offers_listings', 'news' => 'news_listings');
		$table=$alltable[$itemtype];
		$reviews=$CI->df->get_multi_row('reviews',array('itemtype'=>$itemtype,'itemid'=>$itemid,'active'=>'1'));
		$listing=$CI->df->get_single_row($table,array('id'=>$itemid));
		$output="";
		if(count($reviews)>0)
		{
			$output.='<h3 class="review-title">'.$listing['total_reviews'].' User Reviews ('.round($listing['review_score'],2).' / 5.00)</h3>';
			$output.='<ul class="reviews-list span13">';
		foreach($reviews as $review)
		{
			$user=$CI->df->get_single_row('users',array('uid'=>$review['uid']));
			$output.='<li class="review clearfix curve4" id="#review-'.$review['id'].'">';
			$output.='<div><span class="highlight">'.$user['name'].'</span> reviewed on '.date("d M, Y",format_date($review['date_added'])).'</div>';
			$output.='<div class="rating-container" title="'.$review['score'].'">&nbsp;</div>';	
			if($review['status']=='1')		
			{				
			$output.='<div class="review-message span11">'.htmlspecialchars_decode($review['review']).'</div>';					
			$output.='<div class="review-options pull-right">is this review helpful? '.anchor('actions/review_vote/'.$review['id'].'/1/'.str_replace('/','--',$url),'<i class="icon-ok"></i>&nbsp; Yes ('.$review['vote_yes'].')',array('class'=>'btn btn-mini btn-success'));
			$output.=anchor('actions/review_vote/'.$review['id'].'/0/'.str_replace('/','--',$url),'<i class="icon-remove"></i>&nbsp; No ('.$review['vote_no'].')',array('class'=>'btn btn-mini btn-danger')).'</div>';
			}
			else
			{
				$output.='<div class="center-align center padding20 moderation-box">Review awaiting moderation</div>';				
			}
			$output.='</li>';	
		}
			$output.='</ul>';
		}
		else
		{
			$output.='<div class="center-align center padding20 no-data clearfix">Be the first one to review. '.anchor('#review-item','Click here to post review!',array('class'=>'','role'=>"button",'data-toggle'=>"modal")).'</div>';
		}
		return $output;
	}
	
	function getComments($itemtype,$itemid,$url)
	{
		$CI =& get_instance();
		//
		$alltable=array('news'=>'news_listings','photos'=>'photos','videos'=>'videos','polls'=>'poll_questions');
		$table=$alltable[$itemtype];
		//
		
		$comments=$CI->df->get_multi_row('comments',array('itemtype'=>$itemtype,'itemid'=>$itemid,'active'=>'1'));
		$listing=$CI->df->get_single_row($table,array('id'=>$itemid));
		$output="";
		if(count($comments)>0)
		{
			$output.='<h3 class="review-title" style="margin-left:15px">'.$listing['total_comments'].' Comments </h3>';
			$output.='<ul class="reviews-list span12">';
		foreach($comments as $comment)
		{
			$user=$CI->df->get_single_row('users',array('uid'=>$comment['uid']));
			$output.='<li class="review clearfix curve4" id="#review-'.$comment['id'].'">';
			$output.='<div><span class="highlight">'.$user['name'].'</span> commented on '.date("d M, Y",format_date($comment['date_added'])).'</div>';
			if($comment['status']=='1')		
			{				
			$output.='<div class="review-message span11">'.htmlspecialchars_decode($comment['comment']).'</div>';					
			$output.='<div class="review-options pull-right">like this comment? '.anchor('actions/comment_vote/'.$comment['id'].'/1/'.str_replace('/','--',$url),'<i class="icon-ok"></i>&nbsp; Yes ('.$comment['vote_yes'].')',array('class'=>'btn btn-mini btn-success'));
			$output.=anchor('actions/comment_vote/'.$comment['id'].'/0/'.str_replace('/','--',$url),'<i class="icon-remove"></i>&nbsp; No ('.$comment['vote_no'].')',array('class'=>'btn btn-mini btn-danger')).'</div>';
			}
			else
			{
				$output.='<div class="center-align center padding20 moderation-box">Comment awaiting moderation</div>';				
			}
			$output.='</li>';	
		}
			$output.='</ul>';
		}
		else
		{
			if (userdata('uid')) {
				$output.='<div class="center-align center padding20 no-data clearfix">Be the first one to comment. '.anchor('#comment-item','Click here to post comment!',array('class'=>'','role'=>"button",'data-toggle'=>"modal")).'</div>';			
			}
			else{
				$output.='<div class="center-align center padding20 no-data clearfix">Be the first one to comment. '.anchor('news/checkuserlogin/'.$listing['slug'],'Click here to post comment!',array('class'=>'','role'=>"button",'data-toggle'=>"modal")).'</div>';			
			}
		}
		return $output;
	}	
	
	function _checkCityCookie()
	{
		$CI =& get_instance();
		$CI->load->model('df');
		if(!isset($_SESSION['cityid']))
		{
			//get cities list
			$allcities=$CI->df->get_multi_row('cities');
			$cities=array();
			foreach($allcities as $city)
			{
				if($city['domain']!='0')
				{
					$cities[$city['domain']]=array('id'=>$city['id'],'name'=>$city['city']);
				}
			}
			//print_r($cities);
			//$cities=array('9am.in'=>array('id'=>'2','name'=>'Hydera'));
			$currentDomain=	trim($_SERVER['HTTP_HOST']);
			//echo $currentDomain;
			if(is_array($cities[$currentDomain]))	
			{
				//echo $currentDomain;
				set_session('cityid',$cities[$currentDomain]['id']);
				set_session('city',$cities[$currentDomain]['name']);
				$cookie = array(
					'name'   => 'city',
					'value'  => userdata('cityid'),
					'expire' => '865000',
					);	
				$CI->input->set_cookie($cookie);
				return true;
			}
			else
			{				
				$CI->load->helper('cookie');
				$citycookie=$CI->input->cookie('city');

				if($citycookie)
				{
					$CI->load->model('df');
					$CI =& get_instance();
					$city=$CI->df->get_single_row('cities',array('id'=>$citycookie));
					set_session('cityid',$citycookie);
					set_session('city',$city['city']);
				}
			}
		}//city not set
		else
		{
			$CI->load->helper('cookie');
			$citycookie=$CI->input->cookie('city');
			if(!$citycookie)
				{
					if(userdata('cityid'))
					{
					$cookie = array(
					'name'   => 'city',
					'value'  => userdata('cityid'),
					'expire' => '865000',
					);	
					$CI->input->set_cookie($cookie);
					}
				}
				if($citycookie!=userdata('cityid'))
				{
					if(userdata('cityid'))
					{
					$cookie = array(
					'name'   => 'city',
					'value'  => userdata('cityid'),
					'expire' => '865000',
					);	
					$CI->input->set_cookie($cookie);
					}
				}
			if($citycookie!=userdata('cityid'))
			{
				if(userdata('cityid'))
				{
				$cookie = array(
				'name'   => 'city',
				'value'  => userdata('cityid'),
				'expire' => '865000',
				);	
				$CI->input->set_cookie($cookie);
				}
			}
		}//city set ends
	}
	
}//General Library Ends
?>