<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('cityArray'))
{
	function cityArray()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('cities');
		$cityList['']="Choose City";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['city'];
		}
		return $cityList;
//		return array(''=>'Choose Your City','guntur'=>'Guntur','bhimavaram'=>'Bhimavaram','nellore'=>'Nellore');		
	}
}

if ( ! function_exists('YpCategory'))
{
	function YpCategory()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('yp_categories',array('parentid'=>'0'));
		$cityList['']="Choose Category";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['name'];
		}
		return $cityList;
//		return array(''=>'Choose Your City','guntur'=>'Guntur','bhimavaram'=>'Bhimavaram','nellore'=>'Nellore');		
	}
}

if ( ! function_exists('YpSubCategory'))
{
	function YpSubCategory($id)
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('yp_categories',array('parentid'=>$id));
		$cityList['']="Choose Sub-Category";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['name'];
		}
		return $cityList;
//		return array(''=>'Choose Your City','guntur'=>'Guntur','bhimavaram'=>'Bhimavaram','nellore'=>'Nellore');		
	}
}


if ( ! function_exists('Classy_Category'))
{
	function Classy_Category()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('classy_categories',array('parentid'=>'0'));
		$cityList['']="Choose Category";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['name'];
		}
		return $cityList;
//		return array(''=>'Choose Your City','guntur'=>'Guntur','bhimavaram'=>'Bhimavaram','nellore'=>'Nellore');		
	}
}


if ( ! function_exists('News_Category'))
{
	function News_Category()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('news_categories',false,false,false,array('id'=>'asc'));
		$cityList['']="Choose Category";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['name'];
		}
		return $cityList;
//		return array(''=>'Choose Your City','guntur'=>'Guntur','bhimavaram'=>'Bhimavaram','nellore'=>'Nellore');		
	}
}

if ( ! function_exists('Event_Category'))
{
	function Event_Category()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('events_categories',false,false,false,array('id'=>'asc'));
		$cityList['']="Choose Category";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['name'];
		}
		return $cityList;
//		return array(''=>'Choose Your City','guntur'=>'Guntur','bhimavaram'=>'Bhimavaram','nellore'=>'Nellore');		
	}
}

if ( ! function_exists('Job_Category'))
{
	function Job_Category()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('jobs_categories',false,false,false,array('id'=>'asc'));
		$cityList['']="Choose Industry";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['name'];
		}
		return $cityList;
//		return array(''=>'Choose Your City','guntur'=>'Guntur','bhimavaram'=>'Bhimavaram','nellore'=>'Nellore');		
	}
}

if ( ! function_exists('Job_Qualifications'))
{
	function Job_Qualifications()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('jobs_qualifications',false,false,false,array('id'=>'asc'));
		$cityList['']="Choose Qualification";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['name'];
		}
		return $cityList;
//		return array(''=>'Choose Your City','guntur'=>'Guntur','bhimavaram'=>'Bhimavaram','nellore'=>'Nellore');		
	}
}

if ( ! function_exists('Business_Listings'))
{
	function Business_Listings()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('yp_listings',array('cityid'=>userdata('cityid'),'approved'=>'1'),false,false,array('title'=>'desc'));
		$cityList['']="Choose Business";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['title'];
		}
		return $cityList;
//		return array(''=>'Choose Your City','guntur'=>'Guntur','bhimavaram'=>'Bhimavaram','nellore'=>'Nellore');		
	}
}


if ( ! function_exists('Movie_Languages'))
{
	function Movie_Languages()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('movies_languages',false,false,false,array('id'=>'asc'));
		$cityList['']="Choose Language";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['name'];
		}
		return $cityList;
	}
}

if ( ! function_exists('movies_categories'))
{
	function movies_categories()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('movies_categories',false,false,false,array('id'=>'asc'));
		$cityList['']="Choose Category";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=$city['name'];
		}
		return $cityList;
	}
}

if ( ! function_exists('movie_certificate'))
{
	function movie_certificate()
	{
		$CI =& get_instance();
		$cities=$CI->df->get_multi_row('movie_certificate',false,false,false,array('id'=>'asc'));
		$cityList['']="Choose Certificate Type";
		foreach($cities as $city)
		{
			$cityList[$city['id']]=urldecode($city['name']);
		}
		return $cityList;
	}
}

if ( ! function_exists('getTheatres'))
{
	function getTheatres($id)
	{
		$CI =& get_instance();
		$cityid=userdata('cityid');
		//$theatres=$CI->df->get_multi_row('movie_shows',array(''),false,false,array('id'=>'asc'));
		$theatres=$CI->df->doquery("select * from movie_shows where movieid='$id' and timings!='0' and cityid='$cityid'");
		$theatrelist='';
		foreach($theatres as $theatre)
		{
			$th=$CI->df->get_single_row('movies_theatres',array('id'=>$theatre['theatreid']));
			$theatrelist.=anchor('movies/theatre/'.$th['slug'],$th['name']);
		}
		return $theatrelist;
	}
}

if ( ! function_exists('getTheatresList'))
{
	function getTheatresList($id)
	{
		$CI =& get_instance();
		$cityid=userdata('cityid');
		//$theatres=$CI->df->get_multi_row('movie_shows',array(''),false,false,array('id'=>'asc'));
		$theatres=$CI->df->doquery("select * from movie_shows where movieid='$id' and timings!='0' and cityid='$cityid'");
		$theatrelist='';
?>
   	<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Theatre</th>
      <th>ShowTimes</th>
    </tr>
  </thead>
  <tbody>
<?php		
		foreach($theatres as $theatre)
		{
			$th=$CI->df->get_single_row('movies_theatres',array('id'=>$theatre['theatreid']));
			$theatrelist.=anchor('movies/theatre/'.$th['slug'],$th['name']);
?>

    <tr>
      <td><?php echo anchor('movies/theatre/'.$CI->df->get_field_value('movies_theatres',array('id'=>$theatre['theatreid']),'slug'),$CI->df->get_field_value('movies_theatres',array('id'=>$theatre['theatreid']),'name'));//movie['name'];?></td>
      <td>
      <?php
	 	$timings=explode(',',$theatre['timings']);
		$timinglist='';
		foreach($timings as $timing)
		{
			$timinglist.=$timing.',';	 
		}
		echo rtrim($timinglist,',');?>
      </td>    
    </tr>
	<?php } ?>
  </tbody>
</table>
<?php			
		
		//return $theatrelist;
	}
}


if ( ! function_exists('getMoviesList'))
{
	function getMoviesList($id)
	{
		$CI =& get_instance();
		$cityid=userdata('cityid');
		//$theatres=$CI->df->get_multi_row('movie_shows',array(''),false,false,array('id'=>'asc'));
		$theatres=$CI->df->doquery("select * from movie_shows where theatreid='$id' and timings!='0' and cityid='$cityid'");
		$theatrelist='';
?>
   	<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Movie</th>
      <th>ShowTimes</th>
    </tr>
  </thead>
  <tbody>
<?php		
		foreach($theatres as $theatre)
		{
			$th=$CI->df->get_single_row('movies_listings',array('id'=>$theatre['movieid']));
			$theatrelist.=anchor('movies/'.$th['slug'],$th['name']);
?>

    <tr>
      <td><?php echo anchor('movies/'.$CI->df->get_field_value('movies_listings',array('id'=>$theatre['movieid']),'slug'),$CI->df->get_field_value('movies_listings',array('id'=>$theatre['movieid']),'name'));//movie['name'];?></td>
      <td>
      <?php
	 	$timings=explode(',',$theatre['timings']);
		$timinglist='';
		foreach($timings as $timing)
		{
			$timinglist.=$timing.',';	 
		}
		echo rtrim($timinglist,',');?>
      </td>    
    </tr>
	<?php } ?>
  </tbody>
</table>
<?php			
		
		//return $theatrelist;
	}
}



if ( ! function_exists('getMovies'))
{
	function getMovies($id)
	{
		$CI =& get_instance();
		$cityid=userdata('cityid');
		//$theatres=$CI->df->get_multi_row('movie_shows',array(''),false,false,array('id'=>'asc'));
		$theatres=$CI->df->doquery("select * from movie_shows where theatreid='$id' and timings!='0' and cityid='$cityid'");
		$theatrelist='';
		foreach($theatres as $theatre)
		{
			$th=$CI->df->get_single_row('movies_listings',array('id'=>$theatre['movieid']));
			$theatrelist.=anchor('movies/'.$th['slug'],$th['name']).',';
		}
		return rtrim($theatrelist,',');
	}
}

if ( ! function_exists('getWishes'))
{
	function getWishes()
	{
		$CI =& get_instance();
		$cityid=userdata('cityid');
		$wishes=$CI->df->doquery("select * from wishes where cityid='$cityid' and approved='1' order by id desc limit 10");
		foreach($wishes as $wish)
		{
		$output.='<li class="news-item">'.$wish['message'].'<span style="padding:0px 10px 0 10px; margin-top:0px;line-height:32px;font-size:18px;">&raquo;</span></li>';
		}
		return $output;
	}
}

if ( ! function_exists('questionArray'))
{
	function questionArray()
	{
		$CI =& get_instance();
		$questions=$CI->df->get_multi_row('questions');
		$questionList['']="Choose Security Question";
		foreach($questions as $question)
		{
			$questionList[$question['id']]=$question['question'];
		}
		return $questionList;
//		return array(''=>'Choose Your City','guntur'=>'Guntur','bhimavaram'=>'Bhimavaram','nellore'=>'Nellore');		
	}
}


/* End of file General_helper.php */
