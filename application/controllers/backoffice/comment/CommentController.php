<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class CommentController extends CI_Controller 
    {
		public static $table 				= "pp_tblcomment";
		public static $pkey 				= "commentID";
		public static $messageCommonText 	= "Comment";
		
        public function __construct() 
        {
            parent::__construct();
            
            if($this->session->userdata('userFullName') == ""|| $this->session->userdata('mailID') == "")
            {	
                redirect(BACKOFFICE.'LoginController', 'refresh');
            } 
			
			$this->load->model(BACKOFFICE.'Busrequestmodel', 'BusRequestModel');
			$this->load->model(BACKOFFICE.'Flightrequestmodel', 'FlightRequestModel');
			$this->load->model(BACKOFFICE.'Trainrequestmodel', 'TrainRequestModel');
			$this->load->model(BACKOFFICE.'Visarequestmodel', 'VisaRequestModel');
			$this->load->model(BACKOFFICE.'Forexrequestmodel', 'ForexRequestModel');
			$this->load->model(BACKOFFICE.'Hotelrequestmodel', 'HotelRequestModel');
			$this->load->model(BACKOFFICE.'Cabrequestmodel', 'CabRequestModel');
        }
        
    	public function index($backurl, $prop)
		{	
				$table 				= "pp_tblbusrequest";
				$pkey 				= "busRequestID";
				$messageCommonText 	= "Bus Request Comment";
				$commentResult = array();
				
				if($backurl == 'busrequests')
				{	
					$pkey 				= "busRequestID";
					$messageCommonText 	= "Bus Request Comment";
					
					$headerArray  = array('Bus Request ID', 'Employee Name', 'Company Name', 'From Location', 'To Location', 'From Date', 'To Date', 'Prefer Bus', 'Class', 'Invoice', 'Note');
					
					$tableColumns = array('busRequestID', 'employeeName', 'companyName', 'fromLocationCityName', 'toLocationCityName', 'fromDate', 'toDate', 'preferBus', 'busClassName', 'invoicePDF', 'note');
					
					$commentResult = $this->BusRequestModel->getBusRequests($prop);
					$requestFlag 		= "1";
				}
				else if($backurl == 'cabrequests')
				{
					$pkey 				= "cabRequestID";
					$messageCommonText 	= "Cab Request Comment";
					
					$headerArray  = array('Cab Request ID', 'Employee Details', 'Cab Type Name', 'no.Of Person', 'State Name', 'City Name', 'Pick Up location', 'Pick Up date & Time', 'Drop location', 'Drop date & Time', 'Flight/Train No.', 'Invoice', 'Note');

                    $tableColumns = array('cabRequestID', 'employeeName', 'cabTypeName', 'no.OfPerson', 'stateName', 'cityName', 'pickUpLocation', 'pickUpDateTime', 'dropLocation', 'dropDateTime', 'flightTrainNo', 'invoicePDF', 'note');

					$commentResult = $this->CabRequestModel->getCabRequests($prop);
					$requestFlag 		= "2";
				}
				else if($backurl == 'flightrequests')
				{
					$pkey 				= "flightRequestID";
					$messageCommonText 	= "Flight Request Comment";
					
					$headerArray  = array('Flight Request ID', 'Employee Details', 'From Location', 'To Location', 'From Date', 'To Date', 'Prefer Flight', 'Class', 'Invoice', 'Note');

                    $tableColumns = array('flightRequestID', 'employeeName', 'fromLocationAirportName', 'toLocationAirportName', 'fromDate', 'toDate', 'preferFlight', 'flightClassName', 'invoicePDF', 'note');

					$commentResult = $this->FlightRequestModel->getFlightRequests($prop);
					$requestFlag 		= "3";
				}
				else if($backurl == 'forexrequests')
				{
					$pkey 				= "forexRequestID";
					$messageCommonText 	= "Forex Request Comment";
					
					$headerArray  = array('Forex Request ID', 'Employee Details', 'Country Name', 'Currency', 'INR To Be Exchange (Amt)', 'Invoice', 'Note');
                    $tableColumns = array('forexRequestID', 'employeeName', 'countryName', 'currencyName', 'amount', 'invoicePDF', 'note');

					$commentResult = $this->ForexRequestModel->getForexRequests($prop);
					$requestFlag 		= "4";
				}
				else if($backurl == 'hotelrequests')
				{
					$pkey 				= "hotelRequestID";
					$messageCommonText 	= "Hotel Request Comment";
					
					$headerArray  = array('Hotel Request ID', 'Employee Details', 'State Name', 'City Name', 'Nearest Location', 'Check In', 'Check Out', 'Invoice', 'Note');

                    $tableColumns = array('hotelRequestID', 'employeeName', 'stateName', 'cityName', 'nearestLocation', 'checkIn', 'checkOut', 'invoicePDF', 'note');
					
					$commentResult = $this->HotelRequestModel->getHotelRequests($prop);
					$requestFlag 		= "5";
				}
				else if($backurl == 'trainrequests')
				{
					$pkey 				= "trainRequestID";
					$messageCommonText 	= "Train Request Comment";
					
					$headerArray  = array('Train Request ID', 'Train Request ID', 'Employee Details', 'From Location', 'To Location', 'From Date', 'To Date', 'Prefer Train', 'Class', 'Invoice', 'Note');

                    $tableColumns = array('trainRequestID', 'trainRequestID', 'employeeName', 'fromLocationRailwayStationName', 'toLocationRailwayStationName', 'fromDate', 'toDate', 'preferTrain', 'trainClassName', 'invoicePDF', 'note');

					$commentResult = $this->TrainRequestModel->getTrainRequests($prop);
					$requestFlag 		= "6";
				}
				else if($backurl == 'visarequests')
				{
					$pkey 				= "visaRequestID";
					$messageCommonText 	= "Visa Request Comment";
					
					$headerArray  = array('Visa Request ID', 'Employee Details', 'Country Name', 'Type Of Visa', 'From Date', 'To Date', 'Invoice', 'Note');
                    $tableColumns = array('visaRequestID', 'employeeName', 'countryName', 'visaTypeName', 'fromDate', 'toDate', 'invoicePDF', 'note');

					$commentResult = $this->VisaRequestModel->getVisaRequests($prop);
					$requestFlag 		= "7";
				}
			
			$commentResult[0]['requestID'] = $commentResult[0][$pkey];
			//$fields = $pkey." as requestID, ".$table.".*";
			//$commentResult			= $this->CommonModel->getData($table,array($pkey=>$prop),$fields,'','');
			$commentResult[0]['requestName']= $backurl;
			$commentResult[0]['requestFlag']= $requestFlag;
			$commentResult[0]['requestSeperatedName']= str_replace("Comment", "", $messageCommonText);
			
			
			if(!empty($commentResult))
			{
				$commentDataResult = $this->CommonModel->getData('pp_tblcomment',array('requestID' => $commentResult[0][$pkey], 'requestFlag' => $requestFlag),'','','');
				$this->load->view(BACKOFFICE.'comment/addComment',['commentResult' => $commentResult, 'headerArray' =>  $headerArray, 'tableColumns' =>  $tableColumns, 'commentDataResult' => $commentDataResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE."showData/".$backurl, 'refresh');
			}
		}
        
   	
    	public function insertComment()
        {  
            if(
                $this->input->post('txtComment')!="" &&
				$this->input->post('txtRequestID')!=""
            )
            {
				/*$table 				= "pp_tblbusrequest";
				$pkey 				= "busRequestID";
				$messageCommonText 	= "Bus Request Comment";
				
				if($backurl == 'busrequests')
				{
					$requestFlag 		= "1";
				}
				else if($backurl == 'cabrequests')
				{
					$requestFlag 		= "2";
				}
				else if($backurl == 'flightrequests')
				{
					$requestFlag 		= "3";
				}
				else if($backurl == 'forexrequests')
				{
					$requestFlag 		= "4";
				}
				else if($backurl == 'hotelrequests')
				{
					$requestFlag 		= "5";
				}
				else if($backurl == 'trainrequests')
				{
					$requestFlag 		= "6";
				}
				else if($backurl == 'visarequests')
				{
					$requestFlag 		= "7";
				}
				*/

				$prop = array( 
								'comment'			=>  $this->input->post('txtComment', true),
								'requestID'			=>  $this->input->post('txtRequestID'),
								'requestFlag'		=>  $this->input->post('txtRequestFlag'),
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                    
                  $bool = $this->CommonModel->insertRecord(self::$table, $prop);

                  if($bool == 1)
                  {
					  // Add activity log start
						$prop = array( 
								'description'		=>  self::$messageCommonText." : Added (".self::$pkey." : ".$this->db->insert_id()." - Comment Name : ".$this->input->post('txtCommentName', true).")",
								'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
					    $this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
						// Add activity log end
						
                    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' added successfully...');
					redirect(BACKOFFICE."comment/".$this->input->post('txtRequestName')."/".$this->input->post('txtRequestID'), 'refresh');
                  }
                  else
                  {
                       $this->session->set_userdata('toastrError', 'Data was not saved!');
						redirect(BACKOFFICE."comment/".$this->input->post('txtRequestName')."/".$this->input->post('txtRequestID'), 'refresh');
                  }
            }
            else
            {
				$this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE."showData/".$this->input->post('txtRequestName'), 'refresh');
            }
        }
     
		
		public function getComment($backurl, $prop)
		{	
				$table 				= "pp_tblbusrequest";
				$pkey 				= "busRequestID";
				$messageCommonText 	= "Bus Request Comment";
				
				if($backurl == 'busrequests')
				{
					$table 				= "pp_tblbusrequest";
					$pkey 				= "busRequestID";
					$messageCommonText 	= "Bus Request Comment";
				}
				else if($backurl == 'cabrequests')
				{
					$table 				= "pp_tblcabrequest";
					$pkey 				= "cabRequestID";
					$messageCommonText 	= "Cab Request Comment";
				}
				else if($backurl == 'flightrequests')
				{
					$table 				= "pp_tblflightrequest";
					$pkey 				= "flightRequestID";
					$messageCommonText 	= "Flight Request Comment";
				}
				else if($backurl == 'forexrequests')
				{
					$table 				= "pp_tblforexrequest";
					$pkey 				= "forexRequestID";
					$messageCommonText 	= "Forex Request Comment";
				}
				else if($backurl == 'hotelrequests')
				{
					$table 				= "pp_tblhotelrequest";
					$pkey 				= "hotelRequestID";
					$messageCommonText 	= "Hotel Request Comment";
				}
				else if($backurl == 'trainrequests')
				{
					$table 				= "pp_tbltrainrequest";
					$pkey 				= "trainRequestID";
					$messageCommonText 	= "Train Request Comment";
				}
				else if($backurl == 'visarequests')
				{
					$table 				= "pp_tblvisarequest";
					$pkey 				= "visaRequestID";
					$messageCommonText 	= "Visa Request Comment";
				}
				
			$fields = $pkey." as requestID, comment";
			$commentResult			= $this->CommonModel->getData($table,array($pkey=>$prop),$fields,'','');
			$commentResult[0]['requestName']= $backurl;
			
			
			if(!empty($commentResult))
			{
				$this->load->view(BACKOFFICE.'comment/addComment',['commentResult' => $commentResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE."showData/".$backurl, 'refresh');
			}
		}
        
        public function updateComment()
        { 
            if(
                $this->input->post('txtComment')!="" &&
				$this->input->post('txtRequestID')!="" &&
				$this->input->post('txtRequestName')!=""
            )
            {	
				$table 				= "pp_tblbusrequest";
				$pkey 				= "busRequestID";
				$messageCommonText 	= "Bus Request Comment";
				
				if($this->input->post('txtRequestName') == 'busrequests')
				{
					$table 				= "pp_tblbusrequest";
					$pkey 				= "busRequestID";
					$messageCommonText 	= "Bus Request Comment";
				}
				else if($this->input->post('txtRequestName') == 'cabrequests')
				{
					$table 				= "pp_tblcabrequest";
					$pkey 				= "cabRequestID";
					$messageCommonText 	= "Cab Request Comment";
				}
				else if($this->input->post('txtRequestName') == 'flightrequests')
				{
					$table 				= "pp_tblflightrequest";
					$pkey 				= "flightRequestID";
					$messageCommonText 	= "Flight Request Comment";
				}
				else if($this->input->post('txtRequestName') == 'forexrequests')
				{
					$table 				= "pp_tblforexrequest";
					$pkey 				= "forexRequestID";
					$messageCommonText 	= "Forex Request Comment";
				}
				else if($this->input->post('txtRequestName') == 'hotelrequests')
				{
					$table 				= "pp_tblhotelrequest";
					$pkey 				= "hotelRequestID";
					$messageCommonText 	= "Hotel Request Comment";
				}
				else if($this->input->post('txtRequestName') == 'trainrequests')
				{
					$table 				= "pp_tbltrainrequest";
					$pkey 				= "trainRequestID";
					$messageCommonText 	= "Train Request Comment";
				}
				else if($this->input->post('txtRequestName') == 'visarequests')
				{
					$table 				= "pp_tblvisarequest";
					$pkey 				= "visaRequestID";
					$messageCommonText 	= "Visa Request Comment";
				}
			
			
				$prop = array( 
								'comment'			=>  $this->input->post('txtComment', true),
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $commentID = filter_var($this->input->post('txtRequestID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord($table, $prop, $commentID, $pkey);

               if($bool == 1)
              {
				  // Add activity log start
					$prop = array( 
							'description'		=>  $messageCommonText." : Updated (".$pkey." : ".filter_var($this->input->post('txtCommentID'), FILTER_SANITIZE_NUMBER_INT)." - Comment Name : ".$this->input->post('txtCommentName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					$this->session->set_userdata('toastrSuccess', $messageCommonText.' updated successfully...');
					redirect(BACKOFFICE."showData/".$this->input->post('txtRequestName'), 'refresh');
              }
              else
              {
					$this->session->set_userdata('toastrError', $messageCommonText.' update error...');
					redirect(BACKOFFICE."showData/".$this->input->post('txtRequestName'), 'refresh');
              }
        }
        else
            {
                 $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				redirect(BACKOFFICE."showData/".$this->input->post('txtRequestName'), 'refresh');
            }
           
        }
        
		public function setVisibility($backurl,$commentID,$isActive)
        {
			$table 				= "pp_tblbusrequest";
			$pkey 				= "busRequestID";
			$messageCommonText 	= "Bus Request Comment";
			
			if($backurl == 'busrequests')
			{
				$table 				= "pp_tblbusrequest";
				$pkey 				= "busRequestID";
				$messageCommonText 	= "Bus Request Comment";
			}
			else if($backurl == 'cabrequests')
			{
				$table 				= "pp_tblcabrequest";
				$pkey 				= "cabRequestID";
				$messageCommonText 	= "Cab Request Comment";
			}
			else if($backurl == 'flightrequests')
			{
				$table 				= "pp_tblflightrequest";
				$pkey 				= "flightRequestID";
				$messageCommonText 	= "Flight Request Comment";
			}
			else if($backurl == 'forexrequests')
			{
				$table 				= "pp_tblforexrequest";
				$pkey 				= "forexRequestID";
				$messageCommonText 	= "Forex Request Comment";
			}
			else if($backurl == 'hotelrequests')
			{
				$table 				= "pp_tblhotelrequest";
				$pkey 				= "hotelRequestID";
				$messageCommonText 	= "Hotel Request Comment";
			}
			else if($backurl == 'trainrequests')
			{
				$table 				= "pp_tbltrainrequest";
				$pkey 				= "trainRequestID";
				$messageCommonText 	= "Train Request Comment";
			}
			else if($backurl == 'visarequests')
			{
				$table 				= "pp_tblvisarequest";
				$pkey 				= "visaRequestID";
				$messageCommonText 	= "Visa Request Comment";
			}
			
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord($table, $isActive, $commentID, $pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  $messageCommonText." : Visibility Changed (".$pkey." : ".$commentID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', $messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE."showData/".$backurl, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', $messageCommonText.' visibility update error...');
				redirect(BACKOFFICE."showData/".$backurl, 'refresh');
            }
        }
        
		public function cancelRequest($backurl,$commentID,$cancelRequestFlag)
        {
			$table 				= "pp_tblbusrequest";
			$pkey 				= "busRequestID";
			$messageCommonText 	= "Bus Request Comment";
			
			if($backurl == 'busrequests')
			{
				$table 				= "pp_tblbusrequest";
				$pkey 				= "busRequestID";
				$messageCommonText 	= "Bus Request Comment";
			}
			else if($backurl == 'cabrequests')
			{
				$table 				= "pp_tblcabrequest";
				$pkey 				= "cabRequestID";
				$messageCommonText 	= "Cab Request Comment";
			}
			else if($backurl == 'flightrequests')
			{
				$table 				= "pp_tblflightrequest";
				$pkey 				= "flightRequestID";
				$messageCommonText 	= "Flight Request Comment";
			}
			else if($backurl == 'forexrequests')
			{
				$table 				= "pp_tblforexrequest";
				$pkey 				= "forexRequestID";
				$messageCommonText 	= "Forex Request Comment";
			}
			else if($backurl == 'hotelrequests')
			{
				$table 				= "pp_tblhotelrequest";
				$pkey 				= "hotelRequestID";
				$messageCommonText 	= "Hotel Request Comment";
			}
			else if($backurl == 'trainrequests')
			{
				$table 				= "pp_tbltrainrequest";
				$pkey 				= "trainRequestID";
				$messageCommonText 	= "Train Request Comment";
			}
			else if($backurl == 'visarequests')
			{
				$table 				= "pp_tblvisarequest";
				$pkey 				= "visaRequestID";
				$messageCommonText 	= "Visa Request Comment";
			}
			
            if($cancelRequestFlag == 1)
            {
                $cancelRequestFlag = 0; 
            }
            else if($cancelRequestFlag == 0)
            {
                $cancelRequestFlag = 1;
            }

            $bool = $this->CommonModel->setRequestCancel($table, $cancelRequestFlag, $commentID, $pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  $messageCommonText." : Request Canceled (".$pkey." : ".$commentID." - Cancel Request Set As ".$cancelRequestFlag.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', $messageCommonText.' Request canceled successfully...');
				redirect(BACKOFFICE."showData/".$backurl, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', $messageCommonText.' request cancel error...');
				redirect(BACKOFFICE."showData/".$backurl, 'refresh');
            }
        }
        
		
        public function deleteComment($commentID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $commentID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$commentID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_COUNTRIES, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_COUNTRIES, 'refresh');
            }
        }  
    }
    
?>