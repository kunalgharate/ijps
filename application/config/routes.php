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
$route['default_controller'] = 'HomeController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['backoffice/setting']								= 'backoffice/setting/SettingController';

$route['backoffice/country']								= 'backoffice/Country/CountryController';
$route['backoffice/country/(:num)']							= 'backoffice/Country/CountryController/getCountry/$1';
$route['backoffice/country/setVisibility/(:num)/(:num)']	= 'backoffice/Country/CountryController/setVisibilityCountry/$1/$2';
$route['backoffice/country/deleteData/(:num)']				= 'backoffice/Country/CountryController/deleteCountry/$1';

$route['backoffice/state']									= 'backoffice/state/StateController';
$route['backoffice/state/(:num)']							= 'backoffice/state/StateController/getState/$1';
$route['backoffice/state/setVisibility/(:num)/(:num)']		= 'backoffice/state/StateController/setVisibilityState/$1/$2';
$route['backoffice/state/deleteData/(:num)']				= 'backoffice/state/StateController/deleteState/$1';

$route['backoffice/city']									= 'backoffice/city/CityController';
$route['backoffice/city/(:num)']							= 'backoffice/city/CityController/getCity/$1';
$route['backoffice/city/setVisibility/(:num)/(:num)']		= 'backoffice/city/CityController/setVisibilityCity/$1/$2';
$route['backoffice/city/deleteData/(:num)']					= 'backoffice/city/CityController/deleteCity/$1';

$route['backoffice/currency']								= 'backoffice/currency/CurrencyController';
$route['backoffice/currency/(:num)']						= 'backoffice/currency/CurrencyController/getCurrency/$1';
$route['backoffice/currency/setVisibility/(:num)/(:num)']	= 'backoffice/currency/CurrencyController/setVisibilityCurrency/$1/$2';
$route['backoffice/currency/deleteData/(:num)']				= 'backoffice/currency/CurrencyController/deleteCurrency/$1';

$route['backoffice/cabtype']								= 'backoffice/cabType/CabTypeController';
$route['backoffice/cabtype/(:num)']							= 'backoffice/cabType/CabTypeController/getCabType/$1';
$route['backoffice/cabtype/setVisibility/(:num)/(:num)']	= 'backoffice/cabType/CabTypeController/setVisibilityCabType/$1/$2';
$route['backoffice/cabtype/deleteData/(:num)']				= 'backoffice/cabType/CabTypeController/deleteCabType/$1';

$route['backoffice/visatype']								= 'backoffice/visaType/VisaTypeController';
$route['backoffice/visatype/(:num)']						= 'backoffice/visaType/VisaTypeController/getVisaType/$1';
$route['backoffice/visatype/setVisibility/(:num)/(:num)']	= 'backoffice/visaType/VisaTypeController/setVisibilityVisaType/$1/$2';
$route['backoffice/visatype/deleteData/(:num)']				= 'backoffice/visaType/VisaTypeController/deleteVisaType/$1';

$route['backoffice/trainclass']								= 'backoffice/trainClass/TrainClassController';
$route['backoffice/trainclass/(:num)']						= 'backoffice/trainClass/TrainClassController/getTrainClass/$1';
$route['backoffice/trainclass/setVisibility/(:num)/(:num)']	= 'backoffice/trainClass/TrainClassController/setVisibilityTrainClass/$1/$2';
$route['backoffice/trainclass/deleteData/(:num)']			= 'backoffice/trainClass/TrainClassController/deleteTrainClass/$1';

$route['backoffice/busclass']								= 'backoffice/busClass/BusClassController';
$route['backoffice/busclass/(:num)']						= 'backoffice/busClass/BusClassController/getBusClass/$1';
$route['backoffice/busclass/setVisibility/(:num)/(:num)']	= 'backoffice/busClass/BusClassController/setVisibilityBusClass/$1/$2';
$route['backoffice/busclass/deleteData/(:num)']				= 'backoffice/busClass/BusClassController/deleteBusClass/$1';

$route['backoffice/flightclass']							= 'backoffice/flightClass/FlightClassController';
$route['backoffice/flightclass/(:num)']						= 'backoffice/flightClass/FlightClassController/getFlightClass/$1';
$route['backoffice/flightclass/setVisibility/(:num)/(:num)']= 'backoffice/flightClass/FlightClassController/setVisibilityFlightClass/$1/$2';
$route['backoffice/flightclass/deleteData/(:num)']			= 'backoffice/flightClass/FlightClassController/deleteFlightClass/$1';

$route['backoffice/flight']									= 'backoffice/flight/FlightController';
$route['backoffice/flight/(:num)']							= 'backoffice/flight/FlightController/getFlight/$1';
$route['backoffice/flight/setVisibility/(:num)/(:num)']		= 'backoffice/flight/FlightController/setVisibilityFlight/$1/$2';
$route['backoffice/flight/deleteData/(:num)']				= 'backoffice/flight/FlightController/deleteFlight/$1';


$route['backoffice/train']									= 'backoffice/train/TrainController';	
$route['backoffice/train/(:num)']							= 'backoffice/train/TrainController/getTrain/$1';
$route['backoffice/train/setVisibility/(:num)/(:num)']		= 'backoffice/train/TrainController/setVisibilityTrain/$1/$2';
$route['backoffice/train/deleteData/(:num)']				= 'backoffice/train/TrainController/deleteTrain/$1';

$route['backoffice/airport']								= 'backoffice/airport/AirportController';
$route['backoffice/airport/(:num)']							= 'backoffice/airport/AirportController/getAirport/$1';
$route['backoffice/airport/setVisibility/(:num)/(:num)']	= 'backoffice/airport/AirportController/setVisibilityAirport/$1/$2';
$route['backoffice/airport/deleteData/(:num)']				= 'backoffice/airport/AirportController/deleteAirport/$1';

$route['backoffice/railwaystation']									= 'backoffice/railWayStation/RailWayStationController';
$route['backoffice/railwaystation/(:num)']							= 'backoffice/railWayStation/RailWayStationController/getRailWayStation/$1';
$route['backoffice/railwaystation/setVisibility/(:num)/(:num)']		= 'backoffice/railWayStation/RailWayStationController/setVisibilityRailWayStation/$1/$2';
$route['backoffice/railwaystation/deleteData/(:num)']				= 'backoffice/railWayStation/RailWayStationController/deleteRailWayStation/$1';

$route['backoffice/comment/(:any)/(:num)']								 ='backoffice/comment/CommentController/index/$1/$2';
//$route['backoffice/comment/(:any)/(:num)']					= 'backoffice/comment/CommentController/getComment/$1/$2';
//$route['backoffice/comment/setVisibility/(:any)/(:num)/(:num)']	= 'backoffice/comment/CommentController/setVisibility/$1/$2/$3';
//$route['backoffice/comment/cancelRequest/(:any)/(:num)/(:num)']	= 'backoffice/comment/CommentController/cancelRequest/$1/$2/$3';
//$route['backoffice/company/deleteData/(:num)']				= 'backoffice/comment/CommentController/delete/$1';

$route['backoffice/request']								 ='backoffice/request/RequestController';
$route['backoffice/request/(:any)/(:num)/(:num)']					= 'backoffice/request/RequestController/getRequest/$1/$2/$3';
//$route['backoffice/request/updateStatusRequest/(:any)/(:num)/(:num)']					= 'backoffice/request/RequestController/updateStatusRequest/$1/$2/$3';
$route['backoffice/request/setVisibility/(:any)/(:num)/(:num)']	= 'backoffice/request/RequestController/setVisibility/$1/$2/$3';
$route['backoffice/request/cancelRequest/(:any)/(:num)/(:num)']	= 'backoffice/request/RequestController/cancelRequest/$1/$2/$3';
$route['backoffice/request/deleteData/(:num)']				= 'backoffice/request/RequestController/delete/$1';

$route['backoffice/company']								= 'backoffice/company/CompanyController';
$route['backoffice/company/(:num)']							= 'backoffice/company/CompanyController/getCompany/$1';
$route['backoffice/company/setVisibility/(:num)/(:num)']	= 'backoffice/company/CompanyController/setVisibilityCompany/$1/$2';
$route['backoffice/company/deleteData/(:num)']				= 'backoffice/company/CompanyController/deleteCompany/$1';

$route['backoffice/employee']								= 'backoffice/employee/EmployeeController';
$route['backoffice/employee/(:num)']						= 'backoffice/employee/EmployeeController/getEmployee/$1';
$route['backoffice/employee/setVisibility/(:num)/(:num)']	= 'backoffice/employee/EmployeeController/setVisibilityEmployee/$1/$2';
$route['backoffice/employee/deleteData/(:num)']				= 'backoffice/employee/EmployeeController/deleteEmployee/$1';

$route['backoffice/department']								= 'backoffice/Department/DepartmentController';
$route['backoffice/department/(:num)']						= 'backoffice/Department/DepartmentController/getDepartment/$1';
$route['backoffice/department/setVisibility/(:num)/(:num)']	= 'backoffice/Department/DepartmentController/setVisibilityDepartment/$1/$2';
$route['backoffice/department/deleteData/(:num)']			= 'backoffice/Department/DepartmentController/deleteDepartment/$1';

$route['backoffice/customReport/seeCustomReport']				= 'backoffice/customReport/CustomReportController';

//Admin

$route['backoffice/newsletter']								= 'backoffice/newsLetter/NewsLetterController';
$route['backoffice/newsletter/(:num)']						= 'backoffice/newsLetter/NewsLetterController/getNewsLetter/$1';
$route['backoffice/newsletter/setVisibility/(:num)/(:num)']	= 'backoffice/newsLetter/NewsLetterController/setVisibilityNewsLetter/$1/$2';
$route['backoffice/newsletter/deleteData/(:num)']			= 'backoffice/newsLetter/NewsLetterController/deleteNewsLetter/$1';

$route['backoffice/apikey']								= 'backoffice/apikey/ApiKeyController';
$route['backoffice/apikey/addApiKey']                   = 'backoffice/apikey/ApiKeyController/addApiKey';
$route['backoffice/apikey/(:num)']						= 'backoffice/apikey/ApiKeyController/getNewsLetter/$1';
$route['backoffice/apikey/setVisibility/(:num)/(:num)']	= 'backoffice/apikey/ApiKeyController/setVisibilityNewsLetter/$1/$2';
$route['backoffice/apikey/deleteData/(:num)']			= 'backoffice/apikey/ApiKeyController/deleteNewsLetter/$1';

$route['backoffice/blog']									= 'backoffice/blog/BlogController';
$route['backoffice/blog/(:num)']							= 'backoffice/blog/BlogController/getBlog/$1';
$route['backoffice/blog/setVisibility/(:num)/(:num)']		= 'backoffice/blog/BlogController/setVisibilityBlog/$1/$2';
$route['backoffice/blog/deleteData/(:num)']					= 'backoffice/blog/BlogController/deleteBlog/$1';

$route['backoffice/blog-category']									= 'backoffice/blogCategory/BlogCategoryController';
$route['backoffice/blog-category/(:num)']							= 'backoffice/blogCategory/BlogCategoryController/getBlogCategory/$1';
$route['backoffice/blog-category/setVisibility/(:num)/(:num)']		= 'backoffice/blogCategory/BlogCategoryController/setVisibilityBlogCategory/$1/$2';
$route['backoffice/blog-category/deleteData/(:num)']				= 'backoffice/blogCategory/BlogCategoryController/deleteBlogCategory/$1';

$route['backoffice/manuscript']									= 'backoffice/manuscript/ManuscriptController';
$route['backoffice/manuscript/(:num)']							= 'backoffice/manuscript/ManuscriptController/changeManuscriptStatus/$1';
$route['backoffice/manuscript/setVisibility/(:num)/(:num)']		= 'backoffice/manuscript/ManuscriptController/setVisibilityManuscript/$1/$2';
$route['backoffice/manuscript/setApproval/(:num)/(:num)']		= 'backoffice/manuscript/ManuscriptController/setApprovalManuscript/$1/$2';
$route['backoffice/manuscript/deleteData/(:num)']				= 'backoffice/manuscript/ManuscriptController/deleteManuscript/$1';
$route['backoffice/manuscriptinfo/deleteData/(:num)']				= 'backoffice/manuscriptInfo/ManuscriptInfoController/deleteManuscript/$1';


$route['backoffice/manuscript/changeManuscriptArticleID/(:num)']									= 'backoffice/manuscript/ManuscriptController/changeManuscriptArticleID/$1';



$route['backoffice/author']									= 'backoffice/author/AuthorController';
$route['backoffice/author/(:num)']							= 'backoffice/author/AuthorController/getAuthor/$1';
$route['backoffice/author/setVisibility/(:num)/(:num)']		= 'backoffice/author/AuthorController/setVisibilityAuthor/$1/$2';
$route['backoffice/author/deleteData/(:num)']					= 'backoffice/author/AuthorController/deleteAuthor/$1';


$route['backoffice']                      						= 'backoffice/LoginController/index';
$route['backoffice/dashboard']									= 'backoffice/dashboard/DashboardController/index';
$route['backoffice/login']										= 'backoffice/LoginController/index';
$route['backoffice/login/authenticateUser']						= 'backoffice/LoginController/authenticateUser';
$route['backoffice/showData/(:any)']							= 'backoffice/dataTable/DataTableController/index/$1';

$route['backoffice/happyStory']									= 'backoffice/happyStories/HappyStoriesController';
$route['backoffice/happyStory/(:num)']							= 'backoffice/happyStories/HappyStoriesController/getHappyStory/$1';
$route['backoffice/happyStory/setVisibility/(:num)/(:num)']		= 'backoffice/happyStories/HappyStoriesController/setVisibilityHappyStory/$1/$2';
$route['backoffice/happyStory/deleteData/(:num)']				= 'backoffice/happyStories/HappyStoriesController/deleteHappyStory/$1';

$route['backoffice/profile']								= 'backoffice/profile/ProfileController';
$route['backoffice/profile/(:num)']							= 'backoffice/profile/ProfileController/getProfile/$1';
$route['backoffice/profile/setVisibility/(:num)/(:num)']	= 'backoffice/profile/ProfileController/setVisibilityProfile/$1/$2';
$route['backoffice/profile/deleteData/(:num)']				= 'backoffice/profile/ProfileController/deleteProfile/$1';
$route['backoffice/profile/searchProfiles']				= 'backoffice/profile/ProfileController/searchProfiles';
$route['backoffice/profile/verify/(:num)']				= 'backoffice/profile/ProfileController/verify/$1';

$route['backoffice/volume']								= 'backoffice/volume/VolumeController';
$route['backoffice/volume/(:num)']						= 'backoffice/volume/VolumeController/getVolume/$1';
$route['backoffice/volume/setVisibility/(:num)/(:num)']	= 'backoffice/volume/VolumeController/setVisibilityVolume/$1/$2';
$route['backoffice/volume/deleteData/(:num)']			= 'backoffice/volume/VolumeController/deleteVolume/$1';

$route['backoffice/issue']								= 'backoffice/issue/IssueController';
$route['backoffice/issue/(:num)']						= 'backoffice/issue/IssueController/getIssue/$1';
$route['backoffice/issue/setVisibility/(:num)/(:num)']	= 'backoffice/issue/IssueController/setVisibilityIssue/$1/$2';
$route['backoffice/issue/deleteData/(:num)']			= 'backoffice/issue/IssueController/deleteIssue/$1';

$route['backoffice/certificate/addCertificate/(:num)'] = 'CertificateController/index/$1';
$route['backoffice/certificate/addCertificate'] = 'CertificateController/index';

$route['backoffice/article/(:num)']							= 'backoffice/article/ArticleController/index/$1';
$route['backoffice/updatearticle/(:num)']						= 'backoffice/article/ArticleController/getArticle/$1';
$route['backoffice/article/setVisibility/(:num)/(:num)']= 'backoffice/article/ArticleController/setVisibilityArticle/$1/$2';
$route['backoffice/article/deleteData/(:num)']			= 'backoffice/article/ArticleController/deleteArticle/$1';

$route['backoffice/articleDirect']							= 'backoffice/article/ArticleController/articleDirect';

$route['submit-subscribe']											= 'HomeController/submitsubscribe';


//FRONTEND
$route['toolsForAuthor']											= 'HomeController/toolsForAuthor';
$route['home']											= 'HomeController/index';
$route['about-us']										= 'HomeController/aboutus';
$route['contact-us']									= 'HomeController/contactus';
$route['publication-area']								= 'HomeController/publicationarea';
$route['reviewer-guidelines']							= 'HomeController/reviewerguidelines';
$route['plagiarism-policy']								= 'HomeController/plagiarismpolicy';
$route['open-access-policy']							= 'HomeController/openaccesspolicy';
$route['editorial-policy']								= 'HomeController/editorialpolicy';

$route['author-guidelines']								= 'HomeController/authorguidelines';
$route['copyright-form']								= 'HomeController/copyrightform';
$route['model-manuscript']								= 'HomeController/modelmanuscript';
$route['check-paper-status']							= 'HomeController/checkpaperstatus';
$route['peer-review-process']							= 'HomeController/peerreviewprocess';

$route['current-issue']									= 'HomeController/currentissue/';
$route['archive']										= 'HomeController/archive';

$route['editorial-board']								= 'HomeController/editorialboard';

$route['pay-fees']										= 'HomeController/payfees';

$route['newsletters']									= 'HomeController/newsletters';
$route['blogs']											= 'HomeController/blogs';
$route['blogs-categorywise/(:num)']						= 'HomeController/blogscategorywise/$1';

/*$route['blog-details/(:num)']							= 'HomeController/blogdetails/$1';*/
$route['blog/(:any)']							= 'HomeController/blogdetails/$1';
$route['privacy-policy']								= 'HomeController/privacy';

$route['terms-and-conditions']							= 'HomeController/termsofservice';
$route['cancellation-and-refund-policy']				= 'HomeController/cancellation';
/*$route['article/(:num)']										= 'HomeController/article/$1';*/
$route['article/(:any)']										= 'HomeController/article/$1';
$route['issues-details/(:num)/(:num)/(:num)']					= 'HomeController/issuesdetails/$1/$2/$3';
$route['issues-details/(:num)/(:num)/(:num)/(:num)']					= 'HomeController/issuesdetails/$1/$2/$3/$4';
$route['submit-manuscript']								= 'HomeController/submitmanuscript';
$route['submit-manuscript-save']						= 'HomeController/insertManuscript';
$route['register-save']						            = 'HomeController/insertAuthor';
$route['login']											= 'HomeController/authorlogin';
$route['login/authenticateUser']						= 'HomeController/authenticateUser';
$route['login/signOut']									= 'HomeController/signOut';
$route['register']										= 'HomeController/register';
$route['rz']										= 'Register';
$route['rze']										= 'Razorpay';
$route['searchdata']										= 'HomeController/searchdata';

$route['submit-authors-info']							= 'HomeController/submitauthorsinfo';
$route['submit-authors-info-save']						= 'HomeController/insertsubmitauthorsinfo';
$route['submit-contact-form-save']						= 'HomeController/insertsubmitcontactform';
$route['getstatus']							            = 'HomeController/getStatus';

$route['faq']											= 'HomeController/faq';
$route['termsandconditions']							= 'HomeController/termsandconditions';
$route['privacypolicy']									= 'HomeController/privacypolicy';
$route['horoscope']										= 'HomeController/horoscope';
$route['successstories']								= 'HomeController/successstories';
$route['successstory/(:any)']							= 'HomeController/successstorydetails/$1';
//$route['successstorydetails']							= 'HomeController/successstorydetails';
$route['listing']										= 'HomeController/listing';
$route['listing/(:num)']								= 'HomeController/listing/$i';
$route['bride']											= 'HomeController/bridelisting';
$route['groom']											= 'HomeController/groomlisting';
$route['divorced-widowed-bride']						= 'HomeController/divorcedwidowedbridelisting';
$route['divorced-widow-groom']					= 'HomeController/divorcedwidowgroomlisting';
$route['bride/(:num)']							= 'HomeController/bridelisting/$i';
$route['groom/(:num)']							= 'HomeController/groomlisting/$i';
$route['divorced-widowed-bride/(:num)']			= 'HomeController/divorcedwidowedbridelisting/$i';
$route['divorced-widow-groom/(:num)']			= 'HomeController/divorcedwidowgroomlisting/$i';

$route['registration']									= 'HomeController/registration';
$route['profileregistration']							= 'HomeController/profileregistration';
$route['changepassword']								= 'HomeController/changepassword';
$route['forgetpassword']								= 'HomeController/forgetpassword';
$route['forgot_pass']								= 'HomeController/forgot_pass';
$route['fullprofile/(:num)']							= 'HomeController/fullprofile/$1';
$route['notification']									= 'HomeController/notification';
$route['updateprofile']									= 'HomeController/updateprofile';
$route['updateprofilesubmit']							= 'HomeController/updateprofilesubmit';

$route['home1']											= 'HomeController/index2';

$route['dashboard']											= 'HomeController/dashboard';

$route['manuscript-list']											= 'HomeController/manuscriptlist';






//$route['login']											= 'LoginController/index';
//$route['login/authenticateUser']						= 'LoginController/authenticateUser';
//$route['login/signOut']									= 'LoginController/signOut';


//$route['mySizes']										= 'mySizes/MySizesController/index';

$route['mySizesShow']									= 'mySizes/MySizesController/index/0';
$route['mySizesEdit']									= 'mySizes/MySizesController/index/1';

$route['emergencyContacts']								= 'dashboard/DashboardController/emergencyContacts';
$route['todaysBirthday']								= 'dashboard/DashboardController/todaysBirthday';
$route['upcomingBirthday']								= 'dashboard/DashboardController/upcomingBirthday';
$route['todaysWorkAnniversaries']						= 'dashboard/DashboardController/todaysWorkAnniversaries';
$route['upcomingWorkAnniversaries']						= 'dashboard/DashboardController/upcomingWorkAnniversaries';
$route['employeeOfTheMonthYear']						= 'dashboard/DashboardController/employeeOfTheMonthYear';
$route['newEmployeeAnnouncement']						= 'dashboard/DashboardController/newEmployeeAnnouncement';
$route['importantLinks']								= 'dashboard/DashboardController/importantLinks';

$route['safetyInstructions']							= 'dashboard/DashboardController/loadPosts/1';
$route['events']										= 'dashboard/DashboardController/loadPosts/2';
$route['news']											= 'dashboard/DashboardController/loadPosts/3';
$route['alerts']										= 'dashboard/DashboardController/loadPosts/4';
$route['trainings']										= 'dashboard/DashboardController/loadPosts/5';
$route['HRcommunicationsAndUpdates']					= 'dashboard/DashboardController/loadPosts/6';
$route['CSR']											= 'dashboard/DashboardController/loadPosts/7';

$route['trainings/sendFeedback']						= 'dashboard/DashboardController/sendFeedback';

$route['safetyInstructions/(:any)']						= 'dashboard/DashboardController/loadPostDetails/$1';
$route['events/(:any)']									= 'dashboard/DashboardController/loadPostDetails/$1';
$route['news/(:any)']									= 'dashboard/DashboardController/loadPostDetails/$1';
$route['alerts/(:any)']									= 'dashboard/DashboardController/loadPostDetails/$1';
$route['trainings/(:any)']								= 'dashboard/DashboardController/loadPostDetails/$1';
$route['HRcommunicationsAndUpdates/(:any)']				= 'dashboard/DashboardController/loadPostDetails/$1';
$route['CSR/(:any)']									= 'dashboard/DashboardController/loadPostDetails/$1';


$route['circulars']										= 'dashboard/DashboardController/loadPosts/8';
$route['policies']										= 'dashboard/DashboardController/loadPosts/9';
$route['handbook']										= 'dashboard/DashboardController/loadPosts/10';

$route['loadCompanyVideos']								= 'dashboard/DashboardController/loadCompanyVideos';
$route['loadCoOperativeSocietyAccBal']					= 'dashboard/DashboardController/loadCoOperativeSocietyAccBal';
$route['jobs']											= 'dashboard/DashboardController/jobs';
$route['job/uploadResume']								= 'dashboard/DashboardController/uploadResume';
$route['job/(:any)']									= 'dashboard/DashboardController/jobDetails/$1';

$route['holidayCalender']								= 'dashboard/DashboardController/holidayCalender';

$route['employeesContactList']							= 'dashboard/DashboardController/employeesContactList';
$route['searchEmployees']								= 'dashboard/DashboardController/searchEmployees';
$route['filterEmployees']								= 'dashboard/DashboardController/filterEmployees';



$route['contactUS']										= 'dashboard/DashboardController/contactUS';
$route['contactUSSubmit']								= 'dashboard/DashboardController/contactUSSubmit';

$route['aboutUS']										= 'dashboard/DashboardController/aboutUS';

$route['historyOfCompany']								= 'dashboard/DashboardController/historyOfCompany';
$route['departmentalInformation']						= 'dashboard/DashboardController/departmentalInformation';
$route['companyPresentationTemplates']						= 'dashboard/DashboardController/companyPresentationTemplates';

$route['organizationChart']								= 'dashboard/DashboardController/organizationChart';
$route['photoGallery']								= 'dashboard/DashboardController/photoVideoGalleryCategory';
$route['photoGallery/(:any)']								= 'dashboard/DashboardController/photoVideoGallery/$1';

/*$route['videoGallery']								= 'dashboard/DashboardController/videoGalleryCategory';
$route['videoGallery/(:any)']								= 'dashboard/DashboardController/videoGallery/$1';*/

//admin


$route['backoffice/emergencyContact']								= 'backoffice/emergencyContact/EmergencyContactController';
$route['backoffice/emergencyContact/(:num)']						= 'backoffice/emergencyContact/EmergencyContactController/getEmergencyContact/$1';
$route['backoffice/emergencyContact/setVisibility/(:num)/(:num)']	= 'backoffice/emergencyContact/EmergencyContactController/setVisibilityEmergencyContact/$1/$2';
$route['backoffice/emergencyContact/deleteData/(:num)']				= 'backoffice/emergencyContact/EmergencyContactController/deleteEmergencyContact/$1';

$route['backoffice/emergencyContactCategory']								= 'backoffice/emergencyContactCategory/EmergencyContactCategoryController';
$route['backoffice/emergencyContactCategory/(:num)']						= 'backoffice/emergencyContactCategory/EmergencyContactCategoryController/getEmergencyContactCategory/$1';
$route['backoffice/emergencyContactCategory/setVisibility/(:num)/(:num)']	= 'backoffice/emergencyContactCategory/EmergencyContactCategoryController/setVisibilityEmergencyContactCategory/$1/$2';
$route['backoffice/emergencyContactCategory/deleteData/(:num)']				= 'backoffice/emergencyContactCategory/EmergencyContactCategoryController/deleteEmergencyContactCategory/$1';

$route['backoffice/referralList'] = 'backoffice/ReferralController/';
$route['backoffice/importantLink']								= 'backoffice/importantLink/ImportantLinkController';
$route['backoffice/importantLink/(:num)']						= 'backoffice/importantLink/ImportantLinkController/getImportantLink/$1';
$route['backoffice/importantLink/setVisibility/(:num)/(:num)']	= 'backoffice/importantLink/ImportantLinkController/setVisibilityImportantLink/$1/$2';
$route['backoffice/importantLink/deleteData/(:num)']				= 'backoffice/importantLink/ImportantLinkController/deleteImportantLink/$1';

$route['backoffice/companyVideo']								= 'backoffice/companyVideo/CompanyVideoController';
$route['backoffice/companyVideo/(:num)']						= 'backoffice/companyVideo/CompanyVideoController/getCompanyVideo/$1';
$route['backoffice/companyVideo/setVisibility/(:num)/(:num)']	= 'backoffice/companyVideo/CompanyVideoController/setVisibilityCompanyVideo/$1/$2';
$route['backoffice/companyVideo/deleteData/(:num)']				= 'backoffice/companyVideo/CompanyVideoController/deleteCompanyVideo/$1';

$route['backoffice/designation']								= 'backoffice/designation/DesignationController';
$route['backoffice/designation/(:num)']							= 'backoffice/designation/DesignationController/getDesignation/$1';
$route['backoffice/designation/setVisibility/(:num)/(:num)']	= 'backoffice/designation/DesignationController/setVisibilityDesignation/$1/$2';
$route['backoffice/designation/deleteData/(:num)']				= 'backoffice/designation/DesignationController/deleteDesignation/$1';

$route['backoffice/department']								= 'backoffice/department/DepartmentController';
$route['backoffice/department/(:num)']						= 'backoffice/department/DepartmentController/getDepartment/$1';
$route['backoffice/department/setVisibility/(:num)/(:num)']	= 'backoffice/department/DepartmentController/setVisibilityDepartment/$1/$2';
$route['backoffice/department/deleteData/(:num)']				= 'backoffice/department/DepartmentController/deleteDepartment/$1';

$route['backoffice/employeeType']								= 'backoffice/employeeType/EmployeeTypeController';
$route['backoffice/employeeType/(:num)']						= 'backoffice/employeeType/EmployeeTypeController/getEmployeeType/$1';
$route['backoffice/employeeType/setVisibility/(:num)/(:num)']	= 'backoffice/employeeType/EmployeeTypeController/setVisibilityEmployeeType/$1/$2';
$route['backoffice/employeeType/deleteData/(:num)']				= 'backoffice/employeeType/EmployeeTypeController/deleteEmployeeType/$1';

$route['backoffice/post']									= 'backoffice/post/PostController';
$route['backoffice/post/(:num)']							= 'backoffice/post/PostController/getPost/$1';
$route['backoffice/post/setVisibility/(:num)/(:num)']		= 'backoffice/post/PostController/setVisibilityPost/$1/$2';
$route['backoffice/post/deleteData/(:num)']				= 'backoffice/post/PostController/deletePost/$1';

$route['backoffice/holiday']								= 'backoffice/holiday/HolidayController';
$route['backoffice/holiday/(:num)']							= 'backoffice/holiday/HolidayController/getHoliday/$1';
$route['backoffice/holiday/setVisibility/(:num)/(:num)']	= 'backoffice/holiday/HolidayController/setVisibilityHoliday/$1/$2';
$route['backoffice/holiday/deleteData/(:num)']				= 'backoffice/holiday/HolidayController/deleteHoliday/$1';

$route['backoffice/employee']								= 'backoffice/employee/EmployeeController';
$route['backoffice/employee/(:num)']						= 'backoffice/employee/EmployeeController/getEmployee/$1';
$route['backoffice/employee/setVisibility/(:num)/(:num)']	= 'backoffice/employee/EmployeeController/setVisibilityEmployee/$1/$2';
$route['backoffice/employee/employeeOfTheMonth/(:num)']		= 'backoffice/employee/EmployeeController/employeeOfTheMonth/$1';
$route['backoffice/employee/employeeOfTheYear/(:num)']		= 'backoffice/employee/EmployeeController/employeeOfTheYear/$1';
$route['backoffice/employee/deleteData/(:num)']				= 'backoffice/employee/EmployeeController/deleteEmployee/$1';
$route['backoffice/employee/searchEmployees']				= 'backoffice/employee/EmployeeController/searchEmployees';
$route['backoffice/employee/endService/(:num)']				= 'backoffice/employee/EmployeeController/endService/$1';

$route['backoffice/employee/searchMeasurements']				= 'backoffice/employee/EmployeeController/searchMeasurements';

$route['backoffice/guest']									= 'backoffice/guest/GuestController';
$route['backoffice/guest/(:num)']							= 'backoffice/guest/GuestController/getGuest/$1';
$route['backoffice/guest/setVisibility/(:num)/(:num)']		= 'backoffice/guest/GuestController/setVisibilityGuest/$1/$2';
$route['backoffice/guest/deleteData/(:num)']				= 'backoffice/guest/GuestController/deleteGuest/$1';

$route['backoffice/jobPost']								= 'backoffice/jobPost/JobPostController';
$route['backoffice/jobPost/(:num)']							= 'backoffice/jobPost/JobPostController/getJobPost/$1';
$route['backoffice/jobPost/setVisibility/(:num)/(:num)']	= 'backoffice/jobPost/JobPostController/setVisibilityJobPost/$1/$2';
$route['backoffice/jobPost/deleteData/(:num)']				= 'backoffice/jobPost/JobPostController/deleteJobPost/$1';
$route['backoffice/jobPost/jobApplications']				= 'backoffice/jobPost/JobPostController/jobApplications';


$route['backoffice/importBankData']							= 'backoffice/importBankData/ImportBankDataController';

$route['backoffice/mySizes']								= 'backoffice/employee/EmployeeController/mySizes';

$route['backoffice/companyPresentationTemplate']				= 'backoffice/companyPresentationTemplate/CompanyPresentationTemplateController';
$route['backoffice/companyPresentationTemplate/(:num)']			= 'backoffice/companyPresentationTemplate/CompanyPresentationTemplateController/getcompanyPresentationTemplate/$1';
$route['backoffice/companyPresentationTemplate/setVisibility/(:num)/(:num)']= 'backoffice/companyPresentationTemplate/CompanyPresentationTemplateController/setVisibilityCompanyPresentationTemplate/$1/$2';
$route['backoffice/companyPresentationTemplate/deleteData/(:num)']	= 'backoffice/companyPresentationTemplate/CompanyPresentationTemplateController/deleteCompanyPresentationTemplate/$1';

$route['backoffice/searchActivityLogs']						= 'backoffice/activityLog/ActivityLogController/searchActivityLogs';

$route['backoffice/photoVideoGallery']								= 'backoffice/photoVideoGallery/PhotoVideoGalleryController';
$route['backoffice/photoVideoGallery/(:num)']						= 'backoffice/photoVideoGallery/PhotoVideoGalleryController/getPhotoVideoGallery/$1';
$route['backoffice/photoVideoGallery/setVisibility/(:num)/(:num)']	= 'backoffice/photoVideoGallery/PhotoVideoGalleryController/setVisibilityPhotoVideoGallery/$1/$2';
$route['backoffice/photoVideoGallery/deleteData/(:num)']				= 'backoffice/photoVideoGallery/PhotoVideoGalleryController/deletePhotoVideoGallery/$1';

$route['backoffice/photoVideoGalleryCategory']			= 'backoffice/photoVideoGalleryCategory/PhotoVideoGalleryCategoryController';
$route['backoffice/photoVideoGalleryCategory/(:num)']	= 'backoffice/photoVideoGalleryCategory/PhotoVideoGalleryCategoryController/getPhotoVideoGalleryCategory/$1';
$route['backoffice/photoVideoGalleryCategory/setVisibility/(:num)/(:num)']	= 'backoffice/photoVideoGalleryCategory/PhotoVideoGalleryCategoryController/setVisibilityPhotoVideoGalleryCategory/$1/$2';
$route['backoffice/photoVideoGalleryCategory/deleteData/(:num)']				= 'backoffice/photoVideoGalleryCategory/PhotoVideoGalleryCategoryController/deletePhotoVideoGalleryCategory/$1';

$route['backoffice/photoVideoGalleryCategory/setPin/(:num)/(:num)']	= 'backoffice/photoVideoGalleryCategory/PhotoVideoGalleryCategoryController/setPinPhotoVideoGalleryCategory/$1/$2';


$route['contactform']											= 'Contactform/';
$route['deleteContactForm/(:num)']											= 'Contactform/deleteContactus/$i';
$route['upload']											= 'backoffice/Upload';
// $route['uploadImages']											= 'backoffice/Upload';
$route['check-plagarism']											= 'HomeController/checkPlagarismForm';
$route['backoffice/paymentHistory']											= 'backoffice/PaymentHistory/index';
$route['reference-book']											= 'HomeController/referenceBooks';
$route['reference-books']											= 'HomeController/referenceBook';
$route['backoffice/add-reference']											= 'backoffice/Reference/add';
$route['backoffice/saveReferenceData']											= 'backoffice/Reference/saveReferenceData';
$route['view-book/(:num)']											= 'HomeController/viewBooks/$1';
$route['backoffice/request_plagarism']											= 'Upload/request';
$route['pay-fees/indian']											= 'HomeController/pay_indian';
$route['pay-fees/international']											= 'HomeController/pay_international_view';
$route['verifyOtp']						= 'LoginController/verifyOtp';

$route['cloudservices/token'] = 'backoffice/article/cloudservices/get_token';

$route['backoffice/authorsInfoList']	= 'backoffice/Receviedmanuscript/authorsInfoList';
$route['backoffice/manageArticle']									= 'backoffice/Receviedmanuscript/manageArticleView';

$route['referral-program']									= 'HomeController/referralprogram/';
$route['ReferralController/submitReferral'] = 'backoffice/ReferralController/submitReferral';





