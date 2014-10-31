<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "start";
$route['404_override'] = '';

$route['yellowpages/index'] = "yellowpages/index";
$route['yellowpages/index/:any'] = "yellowpages/index/$1";
$route['yellowpages/listings/:any'] = "yellowpages/listings/$1";
$route['yellowpages/search'] = "yellowpages/search";
$route['yellowpages/search/:any'] = "yellowpages/search/$1";
$route['yellowpages/searchresults/:any'] = "yellowpages/searchresults/$1";
$route['yellowpages/add'] = "yellowpages/add";
$route['yellowpages/contactinfo'] = "yellowpages/contactinfo";
$route['yellowpages/complete'] = "yellowpages/complete";
$route['yellowpages/message'] = "yellowpages/message";
$route['yellowpages/:any'] = "yellowpages/show/$1";

//Classifieds
$route['classifieds/index'] = "classifieds/index";
$route['classifieds/index/:any'] = "classifieds/index/$1";
$route['classifieds/ads/:any'] = "classifieds/ads/$1";
$route['classifieds/search'] = "classifieds/search";
$route['classifieds/search/:any'] = "classifieds/search/$1";
$route['classifieds/searchresults/:any'] = "classifieds/searchresults/$1";
$route['classifieds/add'] = "classifieds/add";
$route['classifieds/message'] = "classifieds/message";
$route['classifieds/ads'] = "classifieds/ads";
$route['classifieds/ads/:any'] = "classifieds/ads/$1";
$route['classifieds/reply'] = "classifieds/reply";
$route['classifieds/:any'] = "classifieds/show/$1";

//News
$route['news/index'] = "news/index";
$route['news/index/:any'] = "news/index/$1";
$route['news/searchresults/:any'] = "news/searchresults/$1";
$route['news/add'] = "news/add";
$route['news/:any'] = "news/show/$1";

//Events
$route['events/index'] = "events/index";
$route['events/index/:any'] = "events/index/$1";
$route['events/add'] = "events/add";
$route['events/:any'] = "events/show/$1";

//Movies
$route['movies/index'] = "movies/index";
$route['movies/index/:any'] = "movies/index/$1";
$route['movies/theatres'] = "movies/theatres";
$route['movies/theatres/:any'] = "movies/theatres/$1";
$route['movies/searchresults/:any'] = "movies/searchresults/$1";
$route['movies/theatre/:any'] = "movies/theatre/$1";
$route['movies/index/:any'] = "movies/index/$1";
$route['movies/resetfilter/:any'] = "movies/resetfilter/$1";
//$route['movies/add'] = "movies/add";
$route['movies/:any'] = "movies/show/$1";

//Jobs
$route['jobs/index'] = "jobs/index";
$route['jobs/message'] = "jobs/message";
$route['jobs/index/:any'] = "jobs/index/$1";
$route['jobs/searchresults/:any'] = "jobs/searchresults/$1";
$route['jobs/resetfilter/:any'] = "jobs/resetfilter/$1";
$route['jobs/add'] = "jobs/add";
$route['jobs/:any'] = "jobs/show/$1";

$route['videos/index'] = "videos/index";
$route['videos/index/:any'] = "videos/index/$1";
//$route['videos/show/:any'] = "videos/show/$1";
$route['videos/:any'] = "videos/show/$1";

//Deals
$route['deals/index'] = "deals/index";
$route['deals/index/:any'] = "deals/index/$1";
$route['deals/searchresults/:any'] = "deals/searchresults/$1";
$route['deals/add'] = "deals/add";
//$route['movies/add'] = "movies/add";
$route['deals/:any'] = "deals/show/$1";

//Polls
$route['polls/index'] = "polls/index";
$route['polls/index/:any'] = "polls/index/$1";
$route['polls/vote'] = "polls/vote";
$route['polls/vote/:any'] = "polls/vote/$1";
//$route['movies/add'] = "movies/add";
$route['polls/:any'] = "polls/show/$1";

//Area
$route['areas/index'] = "areas/index";
//$route['movies/add'] = "movies/add";
$route['areas/:any'] = "areas/show/$1";

//Important News
$route['importantnews/:any'] = "importantnews/show/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */