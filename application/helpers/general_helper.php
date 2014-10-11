<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Set Session Value
 * @access	public
 * @return	null
 */	
if ( ! function_exists('set_session'))
{
	function set_session($name,$value=false)
	{
		if(is_array($name))
		{
			foreach($name as $k=>$v)
			{
				$_SESSION[$k]=$v;
			}
		}
		else
		{
			$_SESSION[$name]=$value;			
		}
		//$CI =& get_instance();
		//$CI->session->set_userdata($name,$value);
		return TRUE;	
	}
}

/**
 * Set Flash Message
 * @access	public
 * @return	null
 */	
if ( ! function_exists('set_message'))
{
	function set_message($type,$message)
	{
		$CI =& get_instance();
		$CI->session->set_flashdata('message','<div id="alert" class=" alert alert-'.$type.'"><button type="button" class="close" data-dismiss="alert">×</button>'.$message.'</div>');
		return TRUE;	
	}
}

/**
 * get Session Value
 * @access	public
 * @return	null
 */	
if ( ! function_exists('userdata'))
{
	function userdata($name)
	{
//		$CI =& get_instance();
		return $_SESSION[$name];//$CI->session->userdata($name);			
	}
}

/**
 * get Session Value
 * @access	public
 * @return	null
 */	
if ( ! function_exists('postdata'))
{
	function postdata($name)
	{
		$CI =& get_instance();
		return $CI->input->post($name);			
	}
}
/**
 * Display flash message if exists
 * @access	public
 * @return	null
 */	
if ( ! function_exists('show_message'))
{
	function show_message()
	{
		$CI =& get_instance();
		if($CI->session->flashdata('message'))
			{
				echo $CI->session->flashdata('message');
			}
	}
}

if ( ! function_exists('uridata'))
{
	function uridata($segment)
	{
		$CI =& get_instance();
		return $CI->uri->segment($segment);			
	}
}

if ( ! function_exists('dt'))
{
	function dt()
	{
		$CI =& get_instance();
		return date("Y-m-d");
	}
}


if ( ! function_exists('ip'))
{
	function ip()
	{
		$CI =& get_instance();
		return $CI->input->ip_address();
	}
}

if ( ! function_exists('dateadd'))
{
	function dateadd($date,$days)
	{
		$CI =& get_instance();
		$date = strtotime($date);
		$date = strtotime($days." day", $date);
		return date('Y-m-d', $date);
	}
}

if ( ! function_exists('date_human'))
{
	function date_human($date)
	{
		$CI =& get_instance();
		$date=explode('-',$date);
		return $date[2]."/".$date[1]."/".$date[0];
	}
}

if ( ! function_exists('date_stamp'))
{
	function date_stamp($date)
	{
		$CI =& get_instance();
		$date=explode('-',$date);
		return substr($date[2],0,2)."/".$date[1]."/".$date[0];
	}
}

if ( ! function_exists('format_date'))
{
	function format_date($date)
	{
		$CI =& get_instance();
		$date=explode('-',$date);
		return mktime(0,0,0,$date[1],$date[2],$date[0]);
	}
}

if ( ! function_exists('monthArray'))
{
	function monthArray()
	{
		return array(''=>'Month','01'=>'January','02'=>'February','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');		
	}
}

if ( ! function_exists('dateArray'))
{
	function dateArray()
	{
		return array(''=>'DD','01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30','31'=>'31');		
	}
}

if ( ! function_exists('yearArray'))
{
	function yearArray()
	{
		return array(''=>'Year','2013'=>'2013','2012'=>'2012','2011'=>'2011','2010'=>'2010','2009'=>'2009','2008'=>'2008','2007'=>'2007','2006'=>'2006','2005'=>'2005','2004'=>'2004','2003'=>'2003','2002'=>'2002','2001'=>'2001','2000'=>'2000','1999'=>'1999','1998'=>'1998','1997'=>'1997','1996'=>'1996','1995'=>'1995','1994'=>'1994','1993'=>'1993','1992'=>'1992','1991'=>'1991','1990'=>'1990','1989'=>'1989','1988'=>'1988','1987'=>'1987','1986'=>'1986','1985'=>'1985','1984'=>'1984','1983'=>'1983','1982'=>'1982','1981'=>'1981','1980'=>'1980','1979'=>'1979','1978'=>'1978','1977'=>'1977','1976'=>'1976','1975'=>'1975','1974'=>'1974','1973'=>'1973','1972'=>'1972','1971'=>'1971','1970'=>'1970','1969'=>'1969','1968'=>'1968','1967'=>'1967','1966'=>'1966','1965'=>'1965','1964'=>'1964','1963'=>'1963','1962'=>'1962','1961'=>'1961','1960'=>'1960','1959'=>'1959','1958'=>'1958','1957'=>'1957','1956'=>'1956','1955'=>'1955','1954'=>'1954','1953'=>'1953','1952'=>'1952','1951'=>'1951','1950'=>'1950','1949'=>'1949','1948'=>'1948','1947'=>'1947','1946'=>'1946','1945'=>'1945','1944'=>'1944','1943'=>'1943','1942'=>'1942','1941'=>'1941','1940'=>'1940','1939'=>'1939','1938'=>'1938','1937'=>'1937','1936'=>'1936','1935'=>'1935','1934'=>'1934','1933'=>'1933','1932'=>'1932','1931'=>'1931','1930'=>'1930','1929'=>'1929','1928'=>'1928','1927'=>'1927','1926'=>'1926','1925'=>'1925','1924'=>'1924','1923'=>'1923','1922'=>'1922','1921'=>'1921','1920'=>'1920','1919'=>'1919','1918'=>'1918','1917'=>'1917','1916'=>'1916','1915'=>'1915','1914'=>'1914','1913'=>'1913','1912'=>'1912','1911'=>'1911','1910'=>'1910','1909'=>'1909','1908'=>'1908','1907'=>'1907','1906'=>'1906','1905'=>'1905','1904'=>'1904','1903'=>'1903','1902'=>'1902','1901'=>'1901');		
	}
}

if ( ! function_exists('showavatar'))
{
	function showavatar($pic=false,$alt='',$attr=false)
	{
		$CI =& get_instance();
		if(strpos($pic,'graph.facebook'))
		{
			$imgurl=$pic.'?width=150&height=150';
		}
		else
		{
		if($pic!=false && $pic!="")
		{
		$imgurl=$CI->settings->uploaderPath().'thumbnail/'.$pic;
//		$imgurl=$pic;
		}
		else
		{
			$imgurl=$CI->settings->imgPath().'default_avatar.jpg';
		}
		}
		$atts=$CI->html->getAttr($attr);
		return '<img src="'.$imgurl.'" alt="'.$alt.'" '.$atts.' />';
		
	}
}

if ( ! function_exists('showimg'))
{
	function showimg($pic,$alt='')
	{
		$CI =& get_instance();
		$imgurl=base_url().$CI->config->item('imgurl').$pic;
		return '<img src="'.$imgurl.'" alt="'.$alt.'" />';
	}
}

if ( ! function_exists('showBigAvatar'))
{
	function showBigAvatar($pic=false,$alt='',$attr=false)
	{
		$CI =& get_instance();

		$imgurl=$CI->settings->uploaderPath().'/'.$pic;
		$atts=$CI->html->getAttr($attr);
		return '<img src="'.$imgurl.'" alt="'.$alt.'" '.$atts.' />';
		
	}
}

if ( ! function_exists('showBookmark'))
{
	function showBookmark($type,$id)
	{
		$CI =& get_instance();
/*		if(!userdata('uid'))
		{
			return anchor('start/signin','<i class="icon-star-empty"></i>&nbsp; Bookmark this',array("class"=>"btn bookmark-this"));
		}
		else
		{
			if($CI->df->get_count('bookmarks',array('uid'=>userdata('uid'),'itemtype'=>$type,'itemid'=>$id))==0)
			{
				$successClass='';
			}
			else
			{
				$successClass=' btn-success ';
			}
			return '<a href="javascript:void(0)" class="btn bookmark-this'.$successClass.'" rel="'.$type.':'.$id.'">'.'<i class="icon-star-empty"></i>&nbsp; Bookmark this'.'</a>';
		}*/
			return '<a href="#" rel="sidebar" title="bookmark this page" class="btn bookmark-this">'.'<i class="icon-star-empty"></i>&nbsp; Bookmark this'.'</a>';		
	}
}

if ( ! function_exists('showReport'))
{
	function showReport($type,$id)
	{
		if(userdata('uid'))
		{
		$CI =& get_instance();
		return '<a href="#report-item" role="button" data-toggle="modal" class="btn report-this" rel="'.$type.':'.$id.'">'.'<i class="icon-flag-alt"></i>&nbsp; Report'.'</a>';
		}
		
	}
}


if ( ! function_exists('newsPicture'))
{
	function newsPicture($id)
	{
		$CI =& get_instance();
		$pic=$CI->df->get_single_row('news_photos',array('newsid'=>$id));
//		$pic=$CI->df->doquery("select * from news_photos where id='$id' order by id desc");
		//return '<a href="#report-item" role="button" data-toggle="modal" class="btn report-this" rel="'.$type.':'.$id.'">'.'<i class="icon-flag-alt"></i>&nbsp; Report'.'</a>';
		return base_url().'uploads/thumb/'.$pic['photo'];		
	}
}
//

if ( ! function_exists('getLogo'))
{
	function getLogo($restrize = false)
	{
		$CI =& get_instance();
		$cityid=userdata('cityid');
		$pic=$CI->df->get_field_value('cities',array('id'=>$cityid),'picture');
		if(strlen($pic)==0)
		{
			return $CI->html->themeImg('logo.png');
		}
		else
		{
			
		}
//		$pic=$CI->df->doquery("select * from news_photos where id='$id' order by id desc");
		//return '<a href="#report-item" role="button" data-toggle="modal" class="btn report-this" rel="'.$type.':'.$id.'">'.'<i class="icon-flag-alt"></i>&nbsp; Report'.'</a>';
		if($restrize){
			$image = "<img src='".base_url()."image-restrize.php?src=".$pic."' width='261' height='34' />";
			return $image;
		}
		
		return showAvatar($pic, 'logo', array('width'=>'261', 'height'=>'34'));	
	}
}

if ( ! function_exists('showAd'))
{
	function showAd($type,$width,$height)
	{
		$CI =& get_instance();
		$cityid=userdata('cityid');		
		
		$ad=$CI->df->get_multi_row('ads',array('adtype'=>$type,'width'=>$width,'height'=>$height,'active'=>'1'),FALSE,1,array('id'=>'random'));
		
		if(count($ad)>0)
		{
			$ad=$ad[0];
			if($ad['adtype']=='text')
			{
				$attrs=array(
					'style'=>'width:'.$ad['width'].'px;height:'.$ad['height'].'px',
					'class'=>'adunit'
				);
				if($ad['linktype']=='1')
				{
					$attrs['target']='_blank';
				}
				
				$output=anchor('ads/show/'.$ad['id'],$ad['title'],$attrs);
			}
			else
			{
				$attrs=array(
					'style'=>'width:'.$ad['width'].'px;height:'.$ad['height'].'px',
					'class'=>'adunit'
				);
				if($ad['linktype']=='1')
				{
					$attrs['target']='_blank';
				}
				$output=anchor('ads/show/'.$ad['id'],showAvatar($ad['picture'],$ad['title'],array('style'=>'width:'.$ad['width'].'px;height:'.$ad['height'].'px')),$attrs);
			}
			$adid=$ad['id'];
			$CI->db->simple_query("update ads set impressions=impressions+1 where id='$adid'");
			return $output;
		}

	}
}


if ( ! function_exists('showAds'))
{
	function showAds($type,$width,$height,$count,$class='')
	{
		$CI =& get_instance();
		$cityid=userdata('cityid');		
		
		//$ad=$CI->df->get_multi_row('ads',array('adtype'=>$type,'width'=>$width,'height'=>$height,'active'=>'1'),FALSE,1,array('id'=>'random'));
		$ads=$CI->df->doquery("select distinct(id),title,adtype,linktype,adlink,width,height,picture,active from ads where adtype='$type' and width='$width' and height='$height' and active='1' ORDER BY RAND() limit $count");
		$loopcnt=0;
		$output='';
		if(count($ads)>0)
		{
				foreach($ads as $ad)
				{	
					if($loopcnt==0)	
					{
						$first=' first';
					}
					else
					{
						$first='';
					}
					$attrs=array(
						'style'=>'width:'.$ad['width'].'px;height:'.$ad['height'].'px',
						'class'=>'adunit '.$class.$first
					);
					if($ad['linktype']=='1')
					{
						$attrs['target']='_blank';
					}
					$output.=anchor('ads/show/'.$ad['id'],showAvatar($ad['picture'],$ad['title'],array('width'=>$ad['width'],'height'=>$ad['height'])),$attrs);
					$adid=$ad['id'];
					$CI->db->simple_query("update ads set impressions=impressions+1 where id='$adid'");
					$loopcnt++;
				}
				return $output;
		}

	}
}

if ( ! function_exists('showAdsInArray'))
{
	function showAdsInArray($type,$width,$height,$count,$class='')
	{
		$CI =& get_instance();
		$cityid=userdata('cityid');		
		
		//$ad=$CI->df->get_multi_row('ads',array('adtype'=>$type,'width'=>$width,'height'=>$height,'active'=>'1'),FALSE,1,array('id'=>'random'));
		$ads=$CI->df->doquery("select distinct(id),title,adtype,linktype,adlink,width,height,picture,active from ads where adtype='$type' and width='$width' and height='$height' and active='1' ORDER BY RAND() limit $count");
		$loopcnt=0;
		$output=array();
		if(count($ads)>0)
		{
				foreach($ads as $ad)
				{	
					if($loopcnt==0)	
					{
						$first=' first';
					}
					else
					{
						$first='';
					}
					$attrs=array(
						'style'=>'width:'.$ad['width'].'px;height:'.$ad['height'].'px',
						'class'=>'adunit '.$class.$first
					);
					if($ad['linktype']=='1')
					{
						$attrs['target']='_blank';
					}
					$output[]=anchor('ads/show/'.$ad['id'],showAvatar($ad['picture'],$ad['title'],array('style'=>'width:'.$ad['width'].'px;height:'.$ad['height'].'px')),$attrs);
					$adid=$ad['id'];
					$CI->db->simple_query("update ads set impressions=impressions+1 where id='$adid'");
					$loopcnt++;
				}
				return $output;
		}

	}
}

/* End of file General_helper.php */
