<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin/upload/excel'] = 'ImportExcel/index';
$route['login'] = 'Login/index';
$route['logout'] = 'logout/index';
$route['dashboard'] = 'Dashboard/index';
$route['users'] = 'Users/index';
$route['users/create'] = 'Users/create';
$route['users/edit'] = 'Users/edit';
$route['users/activate/(:num)'] = 'Users/activate/$1';
$route['users/deactivate/(:num)'] = 'Users/deactivate/$1';
$route['groups'] = 'Groups/index';
$route['groups/create'] = 'Groups/create';
$route['groups/edit'] = 'Groups/edit';
$route['booth'] = 'Booth';
$route['candidate/(:num)'] = 'Candidate/index/$1';
$route['section'] = 'Section';
$route['voter'] = 'Voter';
$route['voterlist'] = 'VoterList';
$route['voterwaiting'] = 'VoterWaiting';
$route['check-in/(:num)'] = 'VoterList/checkIn/$1';
$route['process/(:num)'] = 'VoterWaiting/process/$1';
$route['choosing-booth/(:num)/(:num)'] = 'VoterWaiting/directing/$1/$2';
$route['booth-list'] = 'Booth/lists';
$route['booth/login'] = 'Booth/login';
$route['admin/sections'] = 'Sections/index/$1';
$route['history'] = 'History/index/$1';
$route['voting-detail/(:num)'] = 'VotingDetail/index/$1';
$route['booth-login/(:num)'] = 'Booth/login/$1';
$route['section-vote/(:num)'] = 'Vote/candidate_list/$1';
$route['vote/(:num)/(:num)'] = 'Vote/vote/$1/$2';
$route['vote/(:num)'] = 'Vote/vote/$1';
$route['vote-waiting'] = 'Vote/waiting';
$route['vote/check'] = 'Vote/check';
$route['booth-monitoring'] = 'Booth/monitoring';
$route['booth-counter/(:num)'] = 'Booth/counter/$1';
$route['event'] = 'Event';
$route['voting-result/(:num)'] = 'VotingResult/index/$1';
$route['voting-result/data/(:num)'] = 'VotingResult/data/$1';
$route['voter-percentage'] = 'VoterPercentage/index';
$route['voter-percentage/data'] = 'VoterPercentage/data';