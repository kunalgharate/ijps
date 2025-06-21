<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class RequestController extends CI_Controller 
    {
		public static $table 				= "pp_tblbusrequest";
		public static $pkey 				= "busRequestID";
		public static $messageCommonText 	= "Bus Request Request";
		
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
        
    	public function index()
    	{
            $this->load->view(BACKOFFICE.'request/addRequest');
    	}

		public function getRequest($backurl, $prop, $loadFlag)
		{	
				$table 				= "pp_tblbusrequest";
				$pkey 				= "busRequestID";
				$messageCommonText 	= "Bus Request Request";
				
				if($backurl == 'busrequests')
				{
					$table 				= "pp_tblbusrequest";
					$pkey 				= "busRequestID";
					$messageCommonText 	= "Bus Request Request";
					$requestResult = $this->BusRequestModel->getBusRequests($prop);
					$headerArray  = array('Bus Request ID', 'Employee Name', 'Company Name', 'From Location', 'To Location', 'From Date', 'To Date', 'Prefer Bus', 'Class', 'Invoice', 'Note');
					
					$tableColumns = array('busRequestID', 'employeeName', 'companyName', 'fromLocationCityName', 'toLocationCityName', 'fromDate', 'toDate', 'preferBus', 'busClassName', 'invoicePDF', 'note');
				}
				else if($backurl == 'cabrequests')
				{
					$table 				= "pp_tblcabrequest";
					$pkey 				= "cabRequestID";
					$messageCommonText 	= "Cab Request Request";
				}
				else if($backurl == 'flightrequests')
				{
					$table 				= "pp_tblflightrequest";
					$pkey 				= "flightRequestID";
					$messageCommonText 	= "Flight Request Request";
				}
				else if($backurl == 'forexrequests')
				{
					$table 				= "pp_tblforexrequest";
					$pkey 				= "forexRequestID";
					$messageCommonText 	= "Forex Request Request";
				}
				else if($backurl == 'hotelrequests')
				{
					$table 				= "pp_tblhotelrequest";
					$pkey 				= "hotelRequestID";
					$messageCommonText 	= "Hotel Request Request";
				}
				else if($backurl == 'trainrequests')
				{
					$table 				= "pp_tbltrainrequest";
					$pkey 				= "trainRequestID";
					$messageCommonText 	= "Train Request Request";
				}
				else if($backurl == 'visarequests')
				{
					$table 				= "pp_tblvisarequest";
					$pkey 				= "visaRequestID";
					$messageCommonText 	= "Visa Request Request";
				}
				
			//$fields = $pkey." as requestID, invoicePDF";
			//$requestResult			= $this->CommonModel->getData($table,array($pkey=>$prop),$fields,'','');
			$requestResult[0]['requestName']= $backurl;
			$requestResult[0]['loadFlag']= $loadFlag;
			$requestResult[0]['requestSeperatedName']= str_replace("Comment", "", $messageCommonText);
			$requestResult[0]['requestID'] = $requestResult[0][$pkey];
			
			$statusResult			= $this->CommonModel->getData('pp_tblstatus','','','','');
			
			if(!empty($requestResult))
			{
				$load = "request/addRequest";
				
				/*if($loadFlag == '1')
				{
					$load = "request/addRequest";
				}
				else
				{
					$load = "request/changeStatus";
				}*/
				
				$this->load->view(BACKOFFICE.'request/addRequest',['requestResult' => $requestResult, 'headerArray' =>  $headerArray, 'tableColumns' =>  $tableColumns, 'statusResult' => $statusResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE."showData/".$backurl, 'refresh');
			}
		}
        
        public function updateRequest()
        { 
            if(
				(
					$this->input->post('txtLoadFlag')== "1" &&
					$this->input->post('txtRequestID')!="" &&
					$_FILES['txtInvoicePDF']['name']!=""
				) ||
				(
					$this->input->post('txtLoadFlag') =="2" &&
					$this->input->post('txtRequestID')!="" &&
					$this->input->post('cmbStatusID')!=""
				)
            )
            {	
				$table 				= "pp_tblbusrequest";
				$pkey 				= "busRequestID";
				$messageCommonText 	= "Bus Request Request";
				
				if($this->input->post('txtRequestName') == 'busrequests')
				{
					$table 				= "pp_tblbusrequest";
					$pkey 				= "busRequestID";
					$messageCommonText 	= "Bus Request Request";
				}
				else if($this->input->post('txtRequestName') == 'cabrequests')
				{
					$table 				= "pp_tblcabrequest";
					$pkey 				= "cabRequestID";
					$messageCommonText 	= "Cab Request Request";
				}
				else if($this->input->post('txtRequestName') == 'flightrequests')
				{
					$table 				= "pp_tblflightrequest";
					$pkey 				= "flightRequestID";
					$messageCommonText 	= "Flight Request Request";
				}
				else if($this->input->post('txtRequestName') == 'forexrequests')
				{
					$table 				= "pp_tblforexrequest";
					$pkey 				= "forexRequestID";
					$messageCommonText 	= "Forex Request Request";
				}
				else if($this->input->post('txtRequestName') == 'hotelrequests')
				{
					$table 				= "pp_tblhotelrequest";
					$pkey 				= "hotelRequestID";
					$messageCommonText 	= "Hotel Request Request";
				}
				else if($this->input->post('txtRequestName') == 'trainrequests')
				{
					$table 				= "pp_tbltrainrequest";
					$pkey 				= "trainRequestID";
					$messageCommonText 	= "Train Request Request";
				}
				else if($this->input->post('txtRequestName') == 'visarequests')
				{
					$table 				= "pp_tblvisarequest";
					$pkey 				= "visaRequestID";
					$messageCommonText 	= "Visa Request Request";
				}
				
				
				
				if($this->input->post('txtLoadFlag') == '1')
				{
				
					if($_FILES['txtInvoicePDF']['name']=="")
					{
						$invoicePDF = "";
					}
					else
					{
						$ext = substr( strrchr($_FILES['txtInvoicePDF']['name'], '.'), 1);
						$invoicePDF = $pkey."-".$this->input->post('txtRequestID')."-invoice-".date('YmdHis').".".$ext;
					}
				
					$prop = array( 
									'invoicePDF' 			=>  $invoicePDF,
									'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
								);
				}
				else
				{
					$prop = array( 
									'statusID' 			=>  $this->input->post('cmbStatusID'),
									'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
								);
				}
				
			    $requestID = filter_var($this->input->post('txtRequestID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord($table, $prop, $requestID, $pkey);

               if($bool == 1)
              {
				if($this->input->post('txtLoadFlag') == '1')
				{
				  if($_FILES["txtInvoicePDF"]["name"] != "")
					{
						/******************************** Author Photo Upload *********************************/
						$target_file    = UPLOAD_INVOICE.$invoicePDF;

						if(move_uploaded_file($_FILES['txtInvoicePDF']['tmp_name'], $target_file))
						{
						}
						else 
						{ 
							$this->session->set_userdata('toastrError', 'Problem uploading image...');
							redirect(BACKOFFICE."showData/".$this->input->post('txtRequestName'), 'refresh');
						}

						/**********  Photo Upload *********************************/
					}
				}

				  // Add activity log start
					$prop = array( 
							'description'		=>  $messageCommonText." : Invoice Uploded (".$pkey." : ".filter_var($this->input->post('txtRequestID'), FILTER_SANITIZE_NUMBER_INT)." - Request Name : ".$this->input->post('txtRequestName', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
					$this->session->set_userdata('toastrSuccess', $messageCommonText.' invoice uploaded successfully...');
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
        
		public function setVisibility($backurl,$requestID,$isActive)
        {
			$table 				= "pp_tblbusrequest";
			$pkey 				= "busRequestID";
			$messageCommonText 	= "Bus Request Request";
			
			if($backurl == 'busrequests')
			{
				$table 				= "pp_tblbusrequest";
				$pkey 				= "busRequestID";
				$messageCommonText 	= "Bus Request Request";
			}
			else if($backurl == 'cabrequests')
			{
				$table 				= "pp_tblcabrequest";
				$pkey 				= "cabRequestID";
				$messageCommonText 	= "Cab Request Request";
			}
			else if($backurl == 'flightrequests')
			{
				$table 				= "pp_tblflightrequest";
				$pkey 				= "flightRequestID";
				$messageCommonText 	= "Flight Request Request";
			}
			else if($backurl == 'forexrequests')
			{
				$table 				= "pp_tblforexrequest";
				$pkey 				= "forexRequestID";
				$messageCommonText 	= "Forex Request Request";
			}
			else if($backurl == 'hotelrequests')
			{
				$table 				= "pp_tblhotelrequest";
				$pkey 				= "hotelRequestID";
				$messageCommonText 	= "Hotel Request Request";
			}
			else if($backurl == 'trainrequests')
			{
				$table 				= "pp_tbltrainrequest";
				$pkey 				= "trainRequestID";
				$messageCommonText 	= "Train Request Request";
			}
			else if($backurl == 'visarequests')
			{
				$table 				= "pp_tblvisarequest";
				$pkey 				= "visaRequestID";
				$messageCommonText 	= "Visa Request Request";
			}
			
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord($table, $isActive, $requestID, $pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  $messageCommonText." : Visibility Changed (".$pkey." : ".$requestID." - Visibility Set As ".$isActive.")",
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
        
		/*
		public function cancelRequest($backurl,$requestID,$cancelRequestFlag)
        {
			$table 				= "pp_tblbusrequest";
			$pkey 				= "busRequestID";
			$messageCommonText 	= "Bus Request Request";
			
			if($backurl == 'busrequests')
			{
				$table 				= "pp_tblbusrequest";
				$pkey 				= "busRequestID";
				$messageCommonText 	= "Bus Request Request";
			}
			else if($backurl == 'cabrequests')
			{
				$table 				= "pp_tblcabrequest";
				$pkey 				= "cabRequestID";
				$messageCommonText 	= "Cab Request Request";
			}
			else if($backurl == 'flightrequests')
			{
				$table 				= "pp_tblflightrequest";
				$pkey 				= "flightRequestID";
				$messageCommonText 	= "Flight Request Request";
			}
			else if($backurl == 'forexrequests')
			{
				$table 				= "pp_tblforexrequest";
				$pkey 				= "forexRequestID";
				$messageCommonText 	= "Forex Request Request";
			}
			else if($backurl == 'hotelrequests')
			{
				$table 				= "pp_tblhotelrequest";
				$pkey 				= "hotelRequestID";
				$messageCommonText 	= "Hotel Request Request";
			}
			else if($backurl == 'trainrequests')
			{
				$table 				= "pp_tbltrainrequest";
				$pkey 				= "trainRequestID";
				$messageCommonText 	= "Train Request Request";
			}
			else if($backurl == 'visarequests')
			{
				$table 				= "pp_tblvisarequest";
				$pkey 				= "visaRequestID";
				$messageCommonText 	= "Visa Request Request";
			}
			
            if($cancelRequestFlag == 1)
            {
                $cancelRequestFlag = 0; 
            }
            else if($cancelRequestFlag == 0)
            {
                $cancelRequestFlag = 1;
            }

            $bool = $this->CommonModel->setRequestCancel($table, $cancelRequestFlag, $requestID, $pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  $messageCommonText." : Request Canceled (".$pkey." : ".$requestID." - Cancel Request Set As ".$cancelRequestFlag.")",
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
        */
			
	}
    
?>