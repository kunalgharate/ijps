<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class DataTableController extends CI_Controller 
    {
        public function __construct() 
        {
            parent::__construct();
            
           if($this->session->userdata('userFullName') == "" || $this->session->userdata('mailID') == "")
            {
                redirect('login', 'refresh');
            }
			
			$this->load->model(BACKOFFICE.'Manuscriptmodel', 'ManuscriptModel');
			$this->load->model(BACKOFFICE.'Articlemodel', 'ArticleModel');
			$this->load->model(BACKOFFICE.'Authormodel', 'AuthorModel');
			
			
			$this->load->model(BACKOFFICE.'Statemodel', 'StateModel');
			$this->load->model(BACKOFFICE.'Citymodel', 'CityModel');
			
			$this->load->model(BACKOFFICE.'Busrequestmodel', 'BusRequestModel');
			$this->load->model(BACKOFFICE.'Flightrequestmodel', 'FlightRequestModel');
			$this->load->model(BACKOFFICE.'Trainrequestmodel', 'TrainRequestModel');
			$this->load->model(BACKOFFICE.'Visarequestmodel', 'VisaRequestModel');
			$this->load->model(BACKOFFICE.'Forexrequestmodel', 'ForexRequestModel');
			$this->load->model(BACKOFFICE.'Hotelrequestmodel', 'HotelRequestModel');
			$this->load->model(BACKOFFICE.'Cabrequestmodel', 'CabRequestModel');
			$this->load->model(BACKOFFICE.'Employeemodel', 'EmployeeModel');
            
			$this->load->model(BACKOFFICE.'Emergencycontactmodel', 'EmergencyContactModel');
			$this->load->model(BACKOFFICE.'Designationmodel', 'DesignationModel');
			$this->load->model(BACKOFFICE.'Postmodel', 'PostModel');
			$this->load->model(BACKOFFICE.'Profilemodel', 'ProfileModel');
			$this->load->model(BACKOFFICE.'Jobpostmodel', 'JobPostModel');
			$this->load->model(BACKOFFICE.'Activitylogmodel', 'ActivityLogModel');
			$this->load->model(BACKOFFICE.'photovideogallerymodel', 'PhotoVideoGalleryModel');
        }
        
    	public function index($show)
    	{
    	    $pageHeading = "";
    	    
     	    switch ($show) 
            {
				case 'subscribers':
                    $pageHeading  = "All Subscribers";
            	    $headerArray  = array('Subscriber ID', 'Email');
					$result       = $this->CommonModel->getData('ijps_tblsubscriber','','','','');
                    $tableColumns = array('subscriberID', 'email');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
                    
                case 'contactformdata':
                    $pageHeading  = "Contact Form Data";
            	    $headerArray  = array('Id', 'Name', 'Email ID', 'Contact Number', 'Subject', 'Message','Date');
					$result       = $this->CommonModel->getData('ijps_tblcontactformdata','','','','');
                    $tableColumns = array('contactFormDataID', 'name', 'emailID', 'contactNumber', 'subject', 'message','createdDate');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'newsletters':
                    $pageHeading  = "All Newsletters";
            	    $headerArray  = array('Newsletter ID', 'Title', 'Description', 'Link', 'Thumbnail Image');
					$result       = $this->CommonModel->getData('ijps_tblnewsletter','','','','');
                    $tableColumns = array('newsletterID', 'title', 'description', 'link', 'thumbnailImage');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
					
				case 'blogs':
                    $pageHeading  = "All Blogs";
            	    $headerArray  = array('Blog ID', 'Title', 'Description', 'Thumbnail Image', 'Banner Image');
					$result       = $this->CommonModel->getData('ijps_tblblog','','','','');
                    $tableColumns = array('blogID', 'title', 'description', 'thumbnailImage', 'bannerImage');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'manuscripts':
                    $pageHeading  = "All Manuscripts";
            	    $headerArray  = array('Serial No.', 'Article ID', 'Author Name', 'Title of paper', 'Artical Type', 'Country Name', 'Date of submission', 'Current Status'); //, 'Approved', 'Author Email', 'Author Contact Number');
            	    //$headerArray  = array('Manuscript ID', 'Manuscript ID');
					$result       = $this->ManuscriptModel->getManuscripts();
                    $tableColumns = array('manuscriptID', 'uniqueCode', 'authorName', 'titleOfPaper', 'articalTypeName', 'countryName', 'createdDate', 'statusName'); //, 'approvedFlag', 'email', 'contactNumber');
                    //$tableColumns = array('manuscriptID', 'manuscriptID', 'manuscriptID');
					
					$statusResult			= $this->CommonModel->getData('ijps_tblstatus','','','','');
					 
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading, 'statusResult' => $statusResult]);
                    break;
                
                
                    
				case 'manuscriptsauthorsinfo':
                    $pageHeading  = "All Manuscripts Authors info/Copyright form/Payment details";
            	    $headerArray  = array('Serial No.', 'Article ID', 'Copyright Form', 'Payment Receipt', 'Corresponding Author Name', 'Corresponding Author Email', 'Corresponding Author Affiliation', 'Corresponding Author Photo', 'Co Author Details');
					$result       = $this->ManuscriptModel->getManuscriptsinfo();
					
					for($k=0;$k<count($result);$k++)
					{
					    $result[$k]['coAuthorsData'] = $this->CommonModel->getDataLimit('ijps_tblmanuscriptcoauthor', array('isActive'=>'1', 'manuscriptInfoID'=>$result[$k]['manuscriptInfoID']), '', '', '', '', '' ,'manuscriptCoAuthorID','ASC'); 
					}
					
                    $tableColumns = array('manuscriptInfoID', 'articleID', 'copyrightform', 'paymentreceipt', 'authorName', 'authorEmail', 'authorAffiliation', 'authorPhoto', 'coAuthors');
					
					$statusResult			= $this->CommonModel->getData('ijps_tblstatus','','','','');
					
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading, 'statusResult' => $statusResult]);
                    break;
                    
				case 'articles':
                    $pageHeading  = "All Articles";
            	    $headerArray  = array('serial no.', 'Article ID', 'Is Featured', 'Document', 'Artical Type', 'Title', 'Published Date', 'DOI', 'Keywords', 'Citation');
					$result       = $this->ArticleModel->getArticles();
                    $tableColumns = array('articleID', 'uniqueCode', 'featuredArticleFlag', 'document', 'articalTypeName', 'titleOfPaper', 'createdDate', 'doi', 'keywords', 'citation');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'authors':
                    $pageHeading  = "All Authors";
            	    $headerArray  = array('Author ID', 'Author Photo', 'Author Name', 'Designation Name', 'Email', 'Contact Number', 'Address');
					$result       = $this->AuthorModel->getAuthors();
                    $tableColumns = array('authorID', 'authorPhoto', 'name', 'designationName', 'email', 'contactNumber', 'address');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
					
			case 'blogcategories':
                    $pageHeading  = "All Blog Categories";
            	    $headerArray  = array('Blog Category ID', 'Blog Category Name');
					$result       = $this->CommonModel->getData('ijps_tblblogcategory','','','','');
                    $tableColumns = array('blogCategoryID', 'blogCategoryName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
					
			case 'volumes':
                    $pageHeading  = "All Volumes";
            	    $headerArray  = array('Volume ID', 'Volume ID', 'Volume Name');
					$result       = $this->CommonModel->getData('ijps_tblvolume','','','','');
                    $tableColumns = array('volumeID', 'volumeID', 'volumeName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 

				case 'issues':
                    $pageHeading  = "All Issues";
            	    $headerArray  = array('Issue ID', 'Issue ID', 'Issue Name');
					$result       = $this->CommonModel->getData('ijps_tblissue','','','','');
                    $tableColumns = array('issueID', 'issueID', 'issueName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 

					
				case 'companies':
                    $pageHeading  = "All Companies";
            	    $headerArray  = array('Company ID', 'Company Name', 'GSTIN', 'PAN', 'TIN', 'Contact Number', 'Alternate Contact Number', 'Email', 'Reg.Office Address', 'Office Address', 'Contact Person Name', 'Contact Person Email', 'Contact Person Contact Number', 'Contact Person Alternate Contact Number');
					$result       = $this->CommonModel->getData('pp_tblcompany','','','','');
                    $tableColumns = array('companyID', 'companyName', 'GSTIN', 'PAN', 'TIN', 'contactNumber', 'alternateContactNumber', 'email', 'registeredOfficeAddress', 'officeAddress', 'contactPersonName', 'contactPersonEmail', 'contactPersonContactNumber', 'contactPersonAlternateContactNumber');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
					
				case 'employees':
                    $pageHeading  = "All Employees";
            	    $headerArray  = array('EmployeeID', 'Employee Name', 'Department Name', 'Budget', 'Approval Authority', 'Permanent Address', 'Residential Address', 'Contact Number', 'Alternate Contact Number', 'Email', 'Aadhar Card Image', 'PAN Card', 'Passport', 'VISA', 'Travel Insurance');
					$result       = $this->EmployeeModel->getEmployees();
                    $tableColumns = array('employeeID', 'employeeName', 'departmentName', 'budget', 'approvalAuthority', 'permanentAddress', 'residentialAddress', 'contactNumber', 'alternateContactNumber', 'email', 'aadharCardImage', 'panCardImage', 'passportImage', 'visaImage', 'travelInsuranceImage');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'departments':
                    $pageHeading  = "All Departments";
            	    $headerArray  = array('Department ID', 'Department Name');
					$result       = $this->CommonModel->getData('pp_tbldepartment','','','','');
                    $tableColumns = array('departmentID', 'departmentName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
					
				case 'countries':
                    $pageHeading  = "All Countries";
            	    $headerArray  = array('Country ID', 'Country Name');
					$result       = $this->CommonModel->getData('pp_tblcountry','','','','');
                    $tableColumns = array('countryID', 'countryName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'states':
                    $pageHeading  = "All States";
            	    $headerArray  = array('State ID', 'State Name', 'Country Name');
					$result       = $this->StateModel->getStates();
                    $tableColumns = array('stateID', 'stateName', 'countryName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'cities':
                    $pageHeading  = "All Cities";
            	    $headerArray  = array('City ID', 'City ID', 'City Name', 'State Name');
					$result       = $this->CityModel->getCities();
                    $tableColumns = array('cityID', 'cityID', 'cityName', 'stateName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'currencies':
                    $pageHeading  = "All Currencies";
            	    $headerArray  = array('Currency ID', 'Currency ID', 'Currency Name');
					$result       = $this->CommonModel->getData('pp_tblcurrency','','','','');
                    $tableColumns = array('currencyID', 'currencyID', 'currencyName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'cabtypes':
                    $pageHeading  = "All Cab Types";
            	    $headerArray  = array('Cab Type ID', 'Cab Type ID', 'Cab Type Name');
					$result       = $this->CommonModel->getData('pp_tblcabtype','','','','');
                    $tableColumns = array('cabTypeID', 'cabTypeID', 'cabTypeName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'visatypes':
                    $pageHeading  = "All Visa Types";
            	    $headerArray  = array('Visa Type ID', 'Visa Type ID', 'Visa Type Name');
					$result       = $this->CommonModel->getData('pp_tblvisatype','','','','');
                    $tableColumns = array('visaTypeID', 'visaTypeID', 'visaTypeName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'trainclasses':
                    $pageHeading  = "All Train Classes";
            	    $headerArray  = array('Train Class ID', 'Train Class ID', 'Train Class Name');
					$result       = $this->CommonModel->getData('pp_tbltrainclass','','','','');
                    $tableColumns = array('trainClassID', 'trainClassID', 'trainClassName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'busclasses':
                    $pageHeading  = "All Bus Classes";
            	    $headerArray  = array('Bus Class ID', 'Bus Class ID', 'Bus Class Name');
					$result       = $this->CommonModel->getData('pp_tblbusclass','','','','');
                    $tableColumns = array('busClassID', 'busClassID', 'busClassName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'flightclasses':
                    $pageHeading  = "All Flight Classes";
            	    $headerArray  = array('Flight Class ID', 'Flight Class ID', 'Flight Class Name');
					$result       = $this->CommonModel->getData('pp_tblflightclass','','','','');
                    $tableColumns = array('flightClassID', 'flightClassID', 'flightClassName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'flights':
                    $pageHeading  = "All Flights";
            	    $headerArray  = array('Flight ID', 'Flight ID', 'Flight Name');
					$result       = $this->CommonModel->getData('pp_tblflight','','','','');
                    $tableColumns = array('flightID', 'flightID', 'flightName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'trains':
                    $pageHeading  = "All Trains";
            	    $headerArray  = array('Train ID', 'Train ID', 'Train Name');
					$result       = $this->CommonModel->getData('pp_tbltrain','','','','');
                    $tableColumns = array('trainID', 'trainID', 'trainName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				
				
				case 'busrequests':
                    $pageHeading  = "All Bus Requests";
            	    $headerArray  = array('Bus Request ID', 'Bus Request ID', 'Employee Details', 'From Location', 'To Location', 'From Date', 'To Date', 'Prefer Bus', 'Class', 'Note', 'Invoice', 'Is Confirm ?', 'status');
					$result       = $this->BusRequestModel->getBusRequests('');
                    $tableColumns = array('busRequestID', 'busRequestID', 'employeeName', 'fromLocationCityName', 'toLocationCityName', 'fromDate', 'toDate', 'preferBus', 'busClassName', 'note', 'invoicePDF', 'confirmFlag', 'statusName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 	
					
				case 'cabrequests':
                    $pageHeading  = "All Cab Requests";
            	    $headerArray  = array('Cab Request ID', 'Cab Request ID', 'Employee Details', 'Cab Type Name', 'no.Of Person', 'State Name', 'City Name', 'Pick Up location', 'Pick Up date & Time', 'Drop location', 'Drop date & Time', 'Flight/Train No.', 'Note', 'Invoice', 'Status');
					$result       = $this->CabRequestModel->getCabRequests('');
                    $tableColumns = array('cabRequestID', 'cabRequestID', 'employeeName', 'cabTypeName', 'no.OfPerson', 'stateName', 'cityName', 'pickUpLocation', 'pickUpDateTime', 'dropLocation', 'dropDateTime', 'flightTrainNo', 'note', 'invoicePDF', 'statusName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'flightrequests':
                    $pageHeading  = "All Flight Requests";
            	    $headerArray  = array('Flight Request ID', 'Flight Request ID', 'Employee Details', 'From Location', 'To Location', 'From Date', 'To Date', 'Prefer Flight', 'Class', 'Note', 'Invoice', 'Status');
					$result       = $this->FlightRequestModel->getFlightRequests('');
                    $tableColumns = array('flightRequestID', 'flightRequestID', 'employeeName', 'fromLocationAirportName', 'toLocationAirportName', 'fromDate', 'toDate', 'preferFlight', 'flightClassName', 'note', 'invoicePDF', 'statusName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'forexrequests':
                    $pageHeading  = "All Forex Requests";
            	    $headerArray  = array('Forex Request ID', 'Forex Request ID', 'Employee Details', 'Country Name', 'Currency', 'INR To Be Exchange (Amt)', 'Note', 'Invoice', 'Status');
					$result       = $this->ForexRequestModel->getForexRequests('');
                    $tableColumns = array('forexRequestID', 'forexRequestID', 'employeeName', 'countryName', 'currencyName', 'amount', 'note', 'invoicePDF', 'statusName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'hotelrequests':
                    $pageHeading  = "All Hotel Requests";
            	    $headerArray  = array('Hotel Request ID', 'Hotel Request ID', 'Employee Details', 'State Name', 'City Name', 'Nearest Location', 'Check In', 'Check Out', 'Note', 'Invoice', 'Status');
					$result       = $this->HotelRequestModel->getHotelRequests('');
                    $tableColumns = array('hotelRequestID', 'hotelRequestID', 'employeeName', 'stateName', 'cityName', 'nearestLocation', 'checkIn', 'checkOut', 'note', 'invoicePDF', 'statusName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
                case 'trainrequests':
                    $pageHeading  = "All Train Requests";
            	    $headerArray  = array('Train Request ID', 'Train Request ID', 'Employee Details', 'From Location', 'To Location', 'From Date', 'To Date', 'Prefer Train', 'Class', 'Note', 'Invoice', 'Status');
					$result       = $this->TrainRequestModel->getTrainRequests('');
                    $tableColumns = array('trainRequestID', 'trainRequestID', 'employeeName', 'fromLocationRailwayStationName', 'toLocationRailwayStationName', 'fromDate', 'toDate', 'preferTrain', 'trainClassName', 'note', 'invoicePDF', 'statusName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'visarequests':
                    $pageHeading  = "All Visa Requests";
            	    $headerArray  = array('Visa Request ID', 'Visa Request ID', 'Employee Details', 'Country Name', 'Type Of Visa', 'From Date', 'To Date', 'Note', 'Invoice', 'Status');
					$result       = $this->VisaRequestModel->getVisaRequests('');
                    $tableColumns = array('visaRequestID', 'visaRequestID', 'employeeName', 'countryName', 'visaTypeName', 'fromDate', 'toDate', 'note', 'invoicePDF', 'statusName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'railwaystations':
                    $pageHeading  = "All Railway Stations";
            	    $headerArray  = array('Railway Station ID', 'Railway Station ID', 'Railway Station Code', 'Railway Station Name');
					$result       = $this->CommonModel->getData('pp_tblrailwaystation','','','','');
                    $tableColumns = array('railwayStationID', 'railwayStationID', 'employeeName', 'railwayStationCode', 'railwayStationName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'airports':
                    $pageHeading  = "All Airports";
            	    $headerArray  = array('Airport ID', 'Airport ID', 'Airport id', 'Airport ident', 'Airport Type', 'Airport Name');
					$result       = $this->CommonModel->getData('pp_tblairport','','','','');
                    $tableColumns = array('airportID', 'airportID', 'airportid1', 'airportident', 'airportType', 'airportName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;  

				case 'requestwithfilters': 
					
					if($this->input->post('rbtnRequestTypeFilterFlag'))
					{
						$filter = "";
						
						$requestTypeFilterFlag		=	$this->input->post('rbtnRequestTypeFilterFlag');
						$table 						= 	"";
						$dtpFromDate = "";
						$dtpToDate = "";
						$query = "";
						
						if(!empty($this->input->post('dtpFromDate')))
                        {
                            $dtpFromDate   = strtotime(date($this->input->post('dtpFromDate')));
        				    $dtpFromDate   = date("Y-m-d", $dtpFromDate);
                        }
                        
                        if(!empty($this->input->post('dtpToDate')))
                        {
                            $dtpToDate   = strtotime(date($this->input->post('dtpToDate')));
        				    $dtpToDate   = date("Y-m-d", $dtpToDate);
                        }
                        
                        

						if($requestTypeFilterFlag == '1')
						{
						    $articleID			    = $this->input->post('cmbManuscriptArticleID');
                			$articalTypeID			= $this->input->post('cmbArticalTypeID');
                			$countryID				= $this->input->post('cmbCountryID');
                			$statusID	            = $this->input->post('cmbStatusID');
							global $table;
							$table						=	"ijps_tblmanuscript";
							$requestName 				= 	"Received Manuscripts";
							
							if($articleID != "0")
							{
								$filter = $table.".manuscriptID = '".$articleID."'";
							}
							
							if($articalTypeID != "0")
							{
								if($filter != "")
								{
									$filter .= " AND ".$table.".articalTypeID = '".$articalTypeID."'";
								}
								else
								{
									$filter = $table.".articalTypeID = '".$articalTypeID."'";
								}
							}
							
							if($countryID != "0")
							{
								if($filter != "")
								{
									$filter .= " AND ".$table.".countryID = '".$countryID."'";
								}
								else
								{
									$filter = $table.".countryID = '".$countryID."'";
								}
							}
							
							if($statusID != "0")
							{
								if($filter != "")
								{
									$filter .= " AND ".$table.".statusID = '".$statusID."'";
								}
								else
								{
									$filter = $table.".statusID = '".$statusID."'";
								} 
							}
							
        					$headerArray  = array('Manuscript ID ', 'Article ID', 'Author Name','Email','Mobile No', 'Title of paper', 'Artical Type', 'Country Name', 'Date of submission', 'Current Status');
                            $tableColumns = array('manuscriptID', 'uniqueCode', 'authorName', 'email','contactNumber','titleOfPaper', 'articalTypeName', 'countryName', 'createdDate', 'statusName');
						}
						else if($requestTypeFilterFlag == '2')
						{
						    $manuscriptInfoID			    = $this->input->post('cmbManuscriptInfoID');
							
							global $table;
							$table 						=	"ijps_tblmanuscriptinfo";
							$requestName 				= 	"Manuscript Info";
							
							if($manuscriptInfoID != "0")
							{
								$filter = $table.".manuscriptInfoID = '".$manuscriptInfoID."'";
							}
							
							$headerArray  = array('Manuscript Info ID', 'Article ID', 'Copyright Form', 'Payment Receipt', 'Corresponding Author Name', 'Corresponding Author Email', 'Corresponding Author Affiliation', 'Co Author Details');
					
                            $tableColumns = array('manuscriptInfoID', 'articleID', 'copyrightform', 'paymentreceipt', 'authorName', 'authorEmail', 'authorAffiliation', 'coAuthors');
						}   
						else if($requestTypeFilterFlag == '3')
						{
							$articleID			    = $this->input->post('cmbArticleID');
                			$articalTypeID			= $this->input->post('cmbArticalTypeID');
							$table 						=	"ijps_tblarticle";
							$requestName 				= 	"Article";
							
							if($articleID != "0")
							{
    								$filter = $table.".articleID  = '".$articleID."'";
							}
							
							if($articalTypeID != "0")
							{
								if($filter != "")
								{
									$filter .= " AND ".$table.".articalTypeID = '".$articalTypeID."'";
								}
								else
								{
									$filter = $table.".articalTypeID = '".$articalTypeID."'";
								}
							}
							
							$headerArray  = array('Article ID', 'Article ID', 'Is Featured', 'Artical Type', 'Title', 'Published Date', 'Abstract', 'Reference', 'DOI', 'Keywords', 'Citation');
                            $tableColumns = array('articleID', 'articleIDUniqueCode', 'featuredArticleFlag', 'articalTypeName', 'titleOfPaper', 'createdDate', 'abstract', 'reference', 'doi', 'keywords', 'citation');
						}
						else if($requestTypeFilterFlag == '4')
						{
							$table 						=	"ijps_tblnewsletter";
							$requestName 				= 	"Newsletters";

							$headerArray  = array('Index', 'Title', 'Description', 'Link');
                            $tableColumns = array('index', 'title', 'description', 'link');
						}
						else if($requestTypeFilterFlag == '5')
						{
							$blogCategoryID					=	$this->input->post('cmbBlogCategoryID');

							global $table;
							$table 						=	"ijps_tblblog";
							$requestName 				= 	"Blog ";
							
							if($blogCategoryID != "0")
							{
								if($filter != "")
								{
									$filter .= " AND ".$table.".blogCategoryID = '".$blogCategoryID."'";
								}
								else
								{
									$filter = $table.".blogCategoryID = '".$blogCategoryID."'";
								}
							}
							
							$headerArray  = array('Index', 'Blog Category Name', 'Title', 'Description');
                            $tableColumns = array('index', 'blogCategoryName', 'title', 'description');
						}
						else if($requestTypeFilterFlag == '6')
						{
							$table 							=	"ijps_tblsubscriber";
							$requestName 					= 	"Subscribers";
							
							$headerArray  = array('index', 'Email');
                            $tableColumns = array('index', 'email');
						}
						else if($requestTypeFilterFlag == '7')
						{
						    $table 							=	"ijps_tblcontactformdata";
							$requestName 					= 	"Contact Form";
						    $headerArray  = array('Index', 'First Name', 'Email', 'Contact Number', 'Subject', 'Message');
                            $tableColumns = array('index', 'name', 'emailID', 'contactNumber', 'subject', 'message');
						
						}
						
						if($dtpFromDate != "" && $dtpToDate != "")
                        {
                            $query = $table.".createdDate BETWEEN '".$dtpFromDate."' AND '".date('Y-m-d', strtotime('+1 day', strtotime($dtpToDate)))."'";
                        }
                        
						if($filter != "")
						{
							$filter .= " AND ".$table.".isActive = '1'";
						}
						else
						{
							$filter = $table.".isActive = '1'";
						}

                        if($query != "")
						{
							$filter .= " AND ".$query;
						}
						
						$result       = $this->CommonModel->getRequestWithFilterResult($filter, $table, $requestTypeFilterFlag);
						
						if($requestTypeFilterFlag == '2')
						{
    						for($k=0;$k<count($result);$k++)
        					{
        					    $result[$k]['coAuthorsData'] = $this->CommonModel->getDataLimit('ijps_tblmanuscriptcoauthor', array('isActive'=>'1', 'manuscriptInfoID'=>$result[$k]['manuscriptInfoID']), '', '', '', '', '' ,'manuscriptCoAuthorID','ASC'); 
        					}
						}

						$pageHeading  = $requestName." Data As Per Filters";
						
						$this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
					
					}
					else
					{
						$this->session->set_userdata('toastrWarning', 'something went wrong. please try again later...');
						redirect(BACKOFFICE."customReport/seeCustomReport", 'refresh');
					}
					
                    break;
				
				
				case 'happyStories':
                    $pageHeading  = "All Happy Stories";
            	    $headerArray  = array('Happy Story ID', 'Happy Story ID', 'Heading', 'Short Description', 'Description', 'Image', 'Video Type', 'Video URL');
					$result       = $this->CommonModel->getData('tblhappystory','','','','');
                    $tableColumns = array('happyStoryID', 'happyStoryID', 'happyStoryHeading', 'happyStoryShortDescription', 'happyStoryDescription', 'thumbnailImage', 'videoTypeFlag', 'videoURL');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'profiles':
                    $pageHeading  = "All Working Profiles";
            	    $headerArray  = array('Profile. ID', 'Profile ID', 'Full Name', 'Date Of‎ Birth', 'Address', 'Contact Number', 'Email', 'Photo');
                    $result       = $this->ProfileModel->getProfiles();
                    $tableColumns = array('profileID', 'profileID', 'fullName', 'dateOf‎Birth', 'address', 'contactNumber', 'emailAddress', 'photo');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'emergencyContacts':
                    $pageHeading  = "All Emergency Contacts";
            	    $headerArray  = array('Emergency Contact ID', 'Emergency Contact ID', 'Category Name', 'Title', 'Contact Number');
                    $result       = $this->EmergencyContactModel->getEmergencyContacts();
                    $tableColumns = array('emergencyContactID', 'emergencyContactID', 'name', 'title', 'contactNumber');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'emergencyContactCategories':
                    $pageHeading  = "All Emergency Contact Categories";
            	    $headerArray  = array('Emergency Contact Category ID', 'Emergency Contact Category ID', 'Category Name');
                    $result       = $this->CommonModel->getData('tblemergencycontactcategory','','','','');
                    $tableColumns = array('emergencyContactCategoryID', 'emergencyContactCategoryID', 'name');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'importantLinks':
                    $pageHeading  = "All Important Links";
            	    $headerArray  = array('Important Link ID', 'Important Link ID', 'Link Type', 'Heading', 'URL');
                    $result       = $this->CommonModel->getData('tblimportantlink','','','','');
                    $tableColumns = array('importantLinkID', 'importantLinkID', 'linkType', 'heading', 'URL');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'companyVideos':
                    $pageHeading  = "All Company Videos";
            	    $headerArray  = array('Company Video ID', 'Company Video ID', 'Heading', 'Description', 'Video Type', 'Video URL');
                    $result       = $this->CommonModel->getData('tblcompanyvideo','','','','');
                    $tableColumns = array('companyVideoID', 'companyVideoID', 'heading', 'description', 'videoTypeFlag', 'videoURL');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'departments':
                    $pageHeading  = "All Departments";
            	    $headerArray  = array('Department ID', 'Department ID', 'Department Name', 'Department Information', 'File');
                    $result       = $this->CommonModel->getData('tbldepartment','','','','');
                    $tableColumns = array('departmentID', 'departmentID', 'departmentName', 'departmentInformation', 'file');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'employeeTypes':
                    $pageHeading  = "All Employee Types";
            	    $headerArray  = array('Employee Type ID', 'Employee Type ID', 'Employee Type');
                    $result       = $this->CommonModel->getData('tblemployeetype','','','','');
                    $tableColumns = array('employeeTypeID', 'employeeTypeID', 'employeeTypeName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'designations':
                    $pageHeading  = "All Designations";
            	    $headerArray  = array('Designation ID', 'Designation ID', 'Department Name', 'Designation Name');
                    $result       = $this->DesignationModel->getDesignations();
                    $tableColumns = array('designationID', 'designationID', 'departmentName', 'designationName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'posts':
                    $pageHeading  = "All Posts";
            	    $headerArray  = array('Post ID', 'Post ID', 'Post Type', 'Post Heading', 'Post Description', 'Visible For Flag', 'Image', 'Video Type', 'Video URL');
                    $result       = $this->PostModel->getPosts();
                    $tableColumns = array('postID', 'postID', 'name', 'postHeading', 'postDescription', 'visibleForFlag', 'thumbnailImage', 'videoTypeFlag', 'videoURL');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'holidays':
                    $pageHeading  = "All Holidays";
            	    $headerArray  = array('Holiday ID', 'Holiday ID', 'Holiday Title', 'Holiday Date');
                    $result       = $this->CommonModel->getData('tblholiday','','','','');
                    $tableColumns = array('holidayID', 'holidayID', 'holidayTitle', 'holidayDate');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;

				/*case 'employees':
                    $pageHeading  = "All Working Employees";
            	    $headerArray  = array('Emp. ID', 'Emp. ID', 'Full Name', 'Date Of Joining', 'Date Of‎ Birth', 'Address', 'Contact Number', 'Landline Number', 'Email', 'Photo', 'Department Name', 'Designation Name', 'Employee Type');
                    $result       = $this->EmployeeModel->getEmployees();
                    $tableColumns = array('employeeID', 'employeeID', 'fullName', 'dateOfJoining', 'dateOf‎Birth', 'address', 'contactNumber', 'landlineNumber', 'emailAddress', 'photo', 'departmentName', 'designationName', 'employeeTypeName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				*/
				case 'bankData':
                    $pageHeading  = "All Uploaded Bank Data";
            	    $headerArray  = array('Bank Data ID', 'Bank Data ID', 'Email ID', 'Saving Account Number', 'Saving Account Balance');
                    $result       = $this->CommonModel->getData('tblimportbankdata','','','','');
                    $tableColumns = array('importBankDataID', 'importBankDataID', 'emailID', 'savingAccountNumber', 'savingAccountBalance');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'jobPosts':
                    $pageHeading  = "All Job Posts";
            	    $headerArray  = array('Job Post ID', 'Job Post ID', 'Job Title', 'Job Description', 'Work Experience', 'Salary', 'Start Date', 'Location', 'Qualification');
                    $result       = $this->CommonModel->getData('tbljobpost','','','','');
                    $tableColumns = array('jobPostID', 'jobPostID', 'jobTitle', 'jobDescription', 'workExperience', 'salary', 'startDate', 'location', 'qualification');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'jobApplications': 
					
					$jobPostID					=	$this->input->post('cmbJobPostID');
					$employeeID					=	$this->input->post('cmbEmployeeID');
					
					$filter = "";
					
					if($jobPostID != "0")
					{
						$filter = "tbljobpost.jobPostID = '".$jobPostID."'";
					}
					
					if($employeeID != "0")
					{
						if($filter != "")
						{
							$filter .= " AND tblemployee.employeeID = '".$employeeID."'";
						}
						else
						{
							$filter .= "tblemployee.employeeID = '".$employeeID."'";
						}
					}//echo $filter;exit;
					
					$result       = $this->JobPostModel->getJobApplications($filter);

					$pageHeading  = "Job Applications";
            	    $headerArray  = array('Job Post Resume ID', 'Job Post Resume ID', 'Job Title', 'Reference Name', 'Resume Link', 'Message');
                    $tableColumns = array('jobPostResumeID', 'jobPostResumeID', 'jobTitle', 'fullName', 'resumeLink', 'message');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'searchEmployees': 
					
					$departmentID					=	$this->input->post('cmbDepartmentID');
					$designationID					=	$this->input->post('cmbDesignationID');
					$employeeTypeID					=	$this->input->post('cmbEmployeeTypeID');
					$employeeFilterFlag				=	$this->input->post('rbtnEmployeeFilterFlag');
					
					$filter = "";
					
					if($departmentID != "0")
					{
						$filter = "tbldepartment.departmentID = '".$departmentID."'";
					}
					
					if($designationID != "0")
					{
						if($filter != "")
						{
							$filter .= " AND tbldesignation.designationID = '".$designationID."'";
						}
						else
						{
							$filter .= "tbldesignation.designationID = '".$designationID."'";
						}
					}
					
					if($employeeTypeID != "0")
					{
						if($filter != "")
						{
							$filter .= " AND tblemployeetype.employeeTypeID = '".$employeeTypeID."'";
						}
						else
						{
							$filter .= "tblemployeetype.employeeTypeID = '".$employeeTypeID."'";
						}
					}
					
					if($employeeFilterFlag == "1")
					{
						if($filter != "")
						{
							$filter .= " AND tblemployee.serviceEndFlag = '0'";
						}
						else
						{
							$filter .= "tblemployee.serviceEndFlag = '0'";
						}
					}
					else if($employeeFilterFlag == "2")
					{
						if($filter != "")
						{
							$filter .= " AND tblemployee.serviceEndFlag = '1";
						}
						else
						{
							$filter .= "tblemployee.serviceEndFlag = '1'";
						}
					}
					
					//echo $filter;exit;
					
					//$result       = $this->EmployeeModel->getFilterEmployeeResult($filter);
					$result       = $this->EmployeeModel->getSearchEmployeeResult($filter);
					

					$pageHeading  = "All Employees";
            	    $headerArray  = array('Emp. ID', 'Emp. ID', 'Full Name', 'Date Of Joining', 'Date Of‎ Birth', 'Address', 'Contact Number', 'Landline Number', 'Email', 'Photo', 'Department Name', 'Designation Name', 'Employee Type');
                    $tableColumns = array('employeeID', 'employeeID', 'fullName', 'dateOfJoining', 'dateOf‎Birth', 'address', 'contactNumber', 'landlineNumber', 'emailAddress', 'photo', 'departmentName', 'designationName', 'employeeTypeName');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'searchMeasurements': 
					
					$departmentID					=	$this->input->post('cmbDepartmentID');
					$designationID					=	$this->input->post('cmbDesignationID');
					$employeeTypeID					=	$this->input->post('cmbEmployeeTypeID');
					
					$filter = "tblemployee.isActive = '1' AND tblemployee.serviceEndFlag = '0'";
					
					if($departmentID != "0")
					{
						$filter .= "AND tbldepartment.departmentID = '".$departmentID."'";
					}
					
					if($designationID != "0")
					{
						if($filter != "")
						{
							$filter .= " AND tbldesignation.designationID = '".$designationID."'";
						}
						else
						{
							$filter .= "tbldesignation.designationID = '".$designationID."'";
						}
					}
					
					if($employeeTypeID != "0")
					{
						if($filter != "")
						{
							$filter .= " AND tblemployeetype.employeeTypeID = '".$employeeTypeID."'";
						}
						else
						{
							$filter .= "tblemployeetype.employeeTypeID = '".$employeeTypeID."'";
						}
					}
					
					$result       = $this->EmployeeModel->getSearchEmployeeResult($filter);
					

					$pageHeading  = "All Measurements";
            	    $headerArray  = array('Emp. ID', 'Emp. ID', 'Full Name', 'Department Name', 'Designation Name', 'Employee Type', 'Shoe Size', 'Shirt Size', 'Tshirt Size', 'Pant Size');
                    $tableColumns = array('employeeID', 'employeeID', 'fullName', 'departmentName', 'designationName', 'employeeTypeName', 'shoesize', 'shirtsize', 'tshirtsize', 'pantsize');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'searchActivityLogs': 
					
					$websiteUser			=	$this->input->post('cmbWebsiteUser');
					$websiteActivityLabel	=	$this->input->post('cmbWebsiteActivityLabel');
					$websiteLog				=	$this->input->post('rbtnWebsiteLog');
					$backofficeUser			=	$this->input->post('cmbBackofficeUser');
					$activityLabel			=	$this->input->post('cmbActivityLabel');
					$logPeriodFlag			=	$this->input->post('rbtnLogPeriodFlag');
					$dateOfFrom				=	$this->input->post('dtpDateOfFrom');
					$dateOfTo				=	$this->input->post('dtpDateOfTo');
					$filter = "";
					
					if($websiteLog == "1")
					{
						if($backofficeUser != "0")
						{
							$filter .= "tblactivitylog.createdByUserID = '".$backofficeUser."'";
						}
						
						if($activityLabel != "0")
						{
							if($filter != "")
							{
								$filter .= " AND tblactivitylog.description LIKE '%".$activityLabel."%'";
							}
							else
							{
								$filter .= "tblactivitylog.description LIKE '%".$activityLabel."%'";
							}
						}
						
						if($filter != "")
						{
							$filter .= " AND tblactivitylog.applicationFlag = 0 ";
						}
						else
						{
							$filter .= "tblactivitylog.applicationFlag = 0 ";
						}
					}
					else
					{
						if($websiteUser != "0")
						{
							$filter .= "tblactivitylog.createdByUserID = '".$websiteUser."'";
						}
						
						if($websiteActivityLabel != "0")
						{
							if($filter != "")
							{
								$filter .= " AND tblactivitylog.description LIKE '%".$websiteActivityLabel."%'";
							}
							else
							{
								$filter .= "tblactivitylog.description LIKE '%".$websiteActivityLabel."%'";
							}
						}

						if($filter != "")
						{
							$filter .= " AND tblactivitylog.applicationFlag = 1 ";
						}
						else
						{
							$filter .= "tblactivitylog.applicationFlag = 1 ";
						}
					}

					if($logPeriodFlag == "0")
					{
						if($filter != "")
						{
							$filter .= " AND tblactivitylog.createdDate like '%".date("Y-m-d")."%'";
						}
						else
						{
							$filter .= "tblactivitylog.createdDate like '%".date("Y-m-d")."%'";
						}
					}
					else if($logPeriodFlag == "1")
					{
						if($filter != "")
						{
							////$filter .= "AND ((DATE_FORMAT(createdDate,'%y %m-%d') < DATE_FORMAT(NOW(),'%m-%d')) AND (DATE_FORMAT(createdDate,'%m-%d') > DATE_ADD(CURDATE(), INTERVAL -3 DAY)))";
							$filter .= "AND DATE(createdDate) BETWEEN DATE_SUB(CURDATE(),INTERVAL 4 DAY) AND CURDATE()";
						}
						else
						{
							//$filter .= "((DATE_FORMAT(createdDate,'%m-%d') < DATE_FORMAT(NOW(),'%m-%d')) AND (DATE_FORMAT(createdDate,'%m-%d') > DATE_ADD(CURDATE(), INTERVAL -3 DAY)))";
							
							///$filter .= "((DATE_FORMAT(createdDate,'%y-%m-%d') < DATE_FORMAT(NOW(),'%y-%m-%d')))";
							//							AND (DATE_FORMAT(createdDate,'%m-%d') > DATE_ADD(CURDATE(), INTERVAL -3 DAY)))";
							$filter .= "DATE(createdDate) BETWEEN DATE_SUB(CURDATE(),INTERVAL 4 DAY) AND CURDATE()";
						}
						
					}
					else if($logPeriodFlag == "2")
					{
						$dateOfFrom = strtotime(date($dateOfFrom));
						$dateOfFrom = date("Y-m-d", $dateOfFrom);
						
						$dateOfTo	= strtotime(date($dateOfTo));
						$dateOfTo   = date("Y-m-d", $dateOfTo);
						
						//echo $dateOfFrom;exit;
						
						if($filter != "")
						{
							///$filter .= "AND ((DATE_FORMAT(createdDate,'%m-%d') < DATE_FORMAT(NOW(),'%m-%d')) AND (DATE_FORMAT(createdDate,'%m-%d') > DATE_FORMAT(NOW(),'%m-%d')))";
							$filter .= "AND DATE(createdDate) BETWEEN '".$dateOfFrom."' AND '".$dateOfTo."'";
						}
						else
						{
							//$filter .= "((DATE_FORMAT(createdDate,'%m-%d') < DATE_FORMAT(NOW(),'%m-%d')) AND (DATE_FORMAT(createdDate,'%m-%d') > DATE_FORMAT(NOW(),'%m-%d')))";
							$filter .= "DATE(createdDate) BETWEEN '".$dateOfFrom."' AND '".$dateOfTo."'";
						}
						
					}
					
					//echo $filter;exit;
					
					$result       = $this->ActivityLogModel->getActivityLog($filter, $websiteLog);
					
					
					//print_r($result);exit;

					$pageHeading  = "Activity Log";
            	    $headerArray  = array('Activity Log ID', 'Activity Log ID', 'Description', 'Activity Date', 'User');
                    $tableColumns = array('activityLogID', 'activityLogID', 'description', 'createdDate', 'activityUser');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'contactFormData':
                    $pageHeading  = "Contact Form Submissions";
            	    $headerArray  = array('Contact Form ID', 'Contact Form ID', 'First Name', 'Last Name', 'Email', 'Contact Number', 'Subject', 'Message');
					$result       = $this->CommonModel->getData('tblcontactform','','','','');
                    $tableColumns = array('contactformID', 'contactformID', 'firstName', 'lastName', 'email', 'contactNumber', 'subject', 'message');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'trainingFeedbacks':
                    $pageHeading  = "Training Feedbacks";
            	    $headerArray  = array('Training Feedback ID','Training Feedback ID', 'Post Heading', 'Employee Name', 'Content question 1 Star Rating', 'Content question 2 Star Rating', 'Content question 3 Star Rating', 'Content question 4 Star Rating', 'Content question 5 Star Rating', 'Content question 6 Star Rating', 'faculty question 1 Star Rating', 'faculty question 2 Star Rating', 'faculty question 3 Star Rating', 'faculty question 4 Star Rating', 'Faculty Question 5 Star Rating', 'Useful Aspect');
					$result       = $this->PostModel->getTrainingFeedbacks('tbltrainingfeedback','','','','');
                    $tableColumns = array('trainingFeedbackID', 'trainingFeedbackID', 'postHeading', 'fullName', 'trainingContentFlag1', 'trainingContentFlag2', 'trainingContentFlag3', 'trainingContentFlag4', 'trainingContentFlag5', 'trainingContentFlag6', 'facultyFlag1', 'facultyFlag2', 'facultyFlag3', 'facultyFlag4', 'facultyFlag5', 'usefulAspect');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;				
					
					
				case 'companyPresentationTemplates':
                    $pageHeading  = "Company Presentation Templates";
            	    $headerArray  = array('Company Presentation Template ID', 'Company Presentation Template ID', 'Heading', 'Description', 'Upload File');
					$result       = $this->CommonModel->getData('tblcompanypresentationtemplate','','','','');
                    $tableColumns = array('companyPresentationTemplateID', 'companyPresentationTemplateID', 'heading', 'shortDescription', 'uploadFile');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
					
				case 'guests':
                    $pageHeading  = "All Guests";
            	    $headerArray  = array('Guest ID', 'Guest ID', 'Full Name', 'Designation Name', 'Date Of‎ Visit', 'Introduction', 'Photo');
                    $result       = $this->CommonModel->getData('tblguest','','','','');
                    $tableColumns = array('guestID', 'guestID', 'guestFullName', 'designationName', 'visitDate', 'introduction', 'photo');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break;
				
				case 'photoVideoGallery':
                    $pageHeading  = "All Gallery Photos/Vodeos";
            	    $headerArray  = array('Photo Video Gallery ID', 'Photo Video Gallery ID', 'Category Name', 'photo/Video Type', 'Photo/Video');
                    $result       = $this->PhotoVideoGalleryModel->getPhotoVideoGalleries();
                    $tableColumns = array('photoVideoGalleryID', 'photoVideoGalleryID', 'name', 'photoVideoTypeFlag', 'photoVideoLink');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
				
				case 'photoVideoGalleryCategory':
                    $pageHeading  = "All Photo Video Gallery Categories";
            	    $headerArray  = array('Photo Video Gallery Category ID', 'Photo Video Gallery ID', 'Category Name', 'Visible For Flag');
                    $result       = $this->CommonModel->getData('tblphotovideogallerycategory','','','','');
                    $tableColumns = array('photoVideoGalleryCategoryID', 'photoVideoGalleryCategoryID', 'name', 'visibleForFlag');
                    $this->load->view(BACKOFFICE.'dataTable/DataTable', ['result'=>$result, 'headerArray'=>$headerArray, 'tableColumns'=>$tableColumns, 'show'=>$show, 'pageHeading'=>$pageHeading]);
                    break; 
			}
    	}
     }