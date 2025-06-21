<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
	
    class ManuscriptController extends CI_Controller 
    {
		public static $table 				= "ijps_tblmanuscript";
		public static $pkey 				= "manuscriptID";
		public static $messageCommonText 	= "Manuscript";
		
        public function __construct() 
        {
            parent::__construct();
            
            if($this->session->userdata('userFullName') == ""|| $this->session->userdata('mailID') == "")
            {	
                redirect(BACKOFFICE.'LoginController', 'refresh');
            } 
			
			$this->load->model(BACKOFFICE.'Manuscriptmodel', 'ManuscriptModel');
        }
        
        
        
        public function changeManuscriptArticleID($prop)
		{	
			//$manuscriptInfoResult			= $this->CommonModel->getData('ijps_tblmanuscriptinfo','','','','');
			$manuscriptInfoResult = $this->CommonModel->getDataLimit('ijps_tblmanuscriptinfo', array('isActive'=>'1', 'manuscriptInfoID'=>$prop), '', '', '', '', '' ,'manuscriptInfoID','ASC'); 
			
			if(!empty($manuscriptInfoResult))
			{
				$this->load->view(BACKOFFICE.'manuscript/changeManuscriptArticleID',['manuscriptInfoResult' => $manuscriptInfoResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS_AUTHORS_INFO, 'refresh');
			}
		}
		
		
    	public function index()
    	{
            $this->load->view(BACKOFFICE.'manuscript/addManuscript');
    	}
		
		public function changeManuscriptStatus($prop)
		{	
			$manuscriptResult				= $this->ManuscriptModel->getManuscript($prop);
			$statusResult			= $this->CommonModel->getData('ijps_tblstatus','','','','');
			
			if(!empty($manuscriptResult))
			{
				$this->load->view(BACKOFFICE.'manuscript/changeManuscriptStatus',['manuscriptResult' => $manuscriptResult, 'statusResult' => $statusResult]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
			}
		}
		
		 public function getReviewPoint(){

            $uniqueCode = $this->input->post('uniqueCode');
            $getReviewPoint = get_record_by_id('tbl_reviewpoint',$uniqueCode );
            $table ='';
            if(!empty($getReviewPoint->reviewPoint)){
                $table .= '<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.No</th>
                                    <th scope="col">Critical review on</th>
                                    <th scope="col">Points out of 10</th>
                                </tr>
                            </thead>
                            <tbody>';  
                $jsnDecode = json_decode($getReviewPoint->reviewPoint,true);
                $sr=1; foreach ($jsnDecode as $key => $value) { 
                    $table.='<tr>
                    <td>'.$sr++.'</td>
                    <td><input class="form-control" type="hidden" name="reviewPoint[]" value="'.$value['reviewPoint'].'">'.$value['reviewPoint'].'</td>
                    <td><input type="text" class="form-control" name="txtCol1Value[]" value="'.$value['txtCol1Value'].'"></td>
                </tr>';
            }

            $table.=' </tbody>
            </table>';
            echo $table;
            }
        }
		
		public function updateManuscriptInfoArticleID()
        {
            
            if(
				$this->input->post('txtManuscriptInfoID')!="" &&
				$this->input->post('txtArticleID')!=""
            )
            {
				$prop = array( 
								'articleID'				=>  str_replace("IJPS/", '', $this->input->post('txtArticleID', true)),
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $txtManuscriptInfoID = filter_var($this->input->post('txtManuscriptInfoID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord('ijps_tblmanuscriptinfo', $prop, $txtManuscriptInfoID, 'manuscriptInfoID');
               
                if($bool == 1)
				{
				         if(is_array($this->input->post('txtAuthor1Name')))
                            {
                               
                               $name=  $this->input->post('txtAuthor1Name', true);
                                $email = $this->input->post('txtAuthor1Email', true);
                                $affilation = $this->input->post('txtAuthor1Affiliation', true);
                                $photo = $this->input->post('hiddentxtAuthor1Photo', true);
                                 $txtManuscriptInfoID = $this->input->post('hidtxtManuscriptInfoID');
                                
                                for($i=0;$i<count($this->input->post('txtAuthor1Name'));$i++)
                                    {
                                        //  echo "<pre>";print_r($txtManuscriptInfoID);echo "</pre>";
                                        $ext = substr( strrchr($_FILES['txtAuthor1Photo']['name'][$i], '.'), 1);
                                         
                                        if(empty($_FILES['txtAuthor1Photo']['name'][$i])){
                                            
                                              $authorPhotoName = "AuthorPhoto-".date('YmdHis').".".$ext;
                                             $prop2 = array( 
                                                'name'				=> $name[$i] ,
                                                'email'				=>  $email[$i]  ,
                                                'affiliation'				=>  $affilation[$i]  ,
                                                'coAuthorPhoto'				=>  $photo[$i],
                                                'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
                                                );
                                        }else{
                                           
                                             $authorPhotoName = "AuthorPhoto-".date('YmdHis').".".$ext;
                                            $target_file    = UPLOAD_AUTHORS.$authorPhotoName;
                                            if(move_uploaded_file($_FILES['txtAuthor1Photo']['tmp_name'][$i], $target_file))
                                            {
                                                 $prop2 = array( 
                                                'name'				=> $name[$i] ,
                                                'email'				=>  $email[$i]  ,
                                                'affiliation'				=>  $affilation[$i]  ,
                                                'coAuthorPhoto'				=>  $authorPhotoName,
                                                'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
                                                );
                                            }
                                        }
                                     $this->db->where('manuscriptCoAuthorID ',  $txtManuscriptInfoID[$i]);
                                    $this->db->update('ijps_tblmanuscriptcoauthor', $prop2);
                                         
                                    }
                            }
                
                // Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtManuscriptID'), FILTER_SANITIZE_NUMBER_INT)." - Manuscript Title : ".$this->input->post('txtTitle', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
						echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' updated successfully...'));
                  
              }
              else
              {
                  	echo json_encode(array('status'=>'error','msg'=>self::$messageCommonText.' update error...'));
				
              }
        }
        else
            {
                	echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
                
            }
           
        }
        public function updateManuscript()
        {
            if(
				$this->input->post('cmbStatusID')!="" &&
				$this->input->post('txtManuscriptID')!=""
            )
            {
				$prop = array( 
								'statusID'				=>  $this->input->post('cmbStatusID', true),
								'message'				=>  $this->input->post('txtMessage', true),
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);
                $conditionsO = array('uniqueCode '=>$this->input->post('txtArticleID'));
                $getOtherDetails = $this->ManuscriptModel->getOtherDetails($conditionsO);
			    $manuscriptID = filter_var($this->input->post('txtManuscriptID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $manuscriptID, self::$pkey);
 
				if($bool == 1)
				{
				    
				    if($this->input->post('cmbStatusID', true) == 2)
				    {
                        $reviewPoints = $this->input->post('reviewPoint');
                        $txtCol1Value = $this->input->post('txtCol1Value');
                        $rePoint = array();
                        
                        foreach ($reviewPoints as $key => $reviewPoint) {                           
                            $rePoint[] = array(
                                'reviewPoint' => $reviewPoint,
                                'txtCol1Value' => $txtCol1Value[$key]
                            );
                        }
                        $reviewData = json_encode($rePoint);

                        $insertArray = array('reviewPoint'=>$reviewData,'articleId'=>$this->input->post('txtArticleID'),'created_data'=>date('Y-m-d H:i:s'));

                        $conditions = array('articleId'=>$this->input->post('txtArticleID'));
                        $conditionsC = array('uniqueCode'=>$this->input->post('txtArticleID'));
                        
                        

                        $country_code = $this->ManuscriptModel->getCountry($conditionsC);
                      
                        if($country_code[0]['countryID']=='99'){
                            $pay_link = base_url('pay-fees/indian');
                           
                        }else{
                             $pay_link =base_url().'pay-fees/international';
                        }
                        
                     
                        $isExits = $this->ManuscriptModel->is_record_exist($conditions);
                        if($isExits){
                            $this->ManuscriptModel->update_record($this->input->post('txtArticleID'),$insertArray);
                        }else{
                            $this->ManuscriptModel->insertReviewPoint('tbl_reviewpoint',$insertArray);
                            
                        }
                        
				        $subject = "ACCEPTANCE LETTER - IJPS journal (Paper_id : IJPS/".$this->input->post('txtArticleID').")";
				        $message = "<div id='m_-811177307910776471ydp41863206yiv7747682938'>
                                        <div>
                                            <b style='font-size: 11pt;'>
                                                <span style='color: rgb(32, 56, 100);'><font face='times new roman, serif' style='background-color: inherit;'>Dear&nbsp;Author/Researcher,</font></span>
                                            </b>
                                            <br />
                                            <br />
                                        </div>
                                        <div>
                                            <div>
                                                <div dir='ltr'>
                                                    <div>
                                                        <div dir='ltr'>
                                                            <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                                <font face='times new roman, serif'>
                                                                    <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                        We are happy to inform you that your manuscript,
                                                                        <a
                                                                            name='m_-811177307910776471_m_-3969377242492246480_m_-8223847472106530372_m_-9211533579389544600_m_-1970464064096226173_m_-8825111219271386020_m_8832422992720899625_m_-6198995648823214532_m_-2119759295910414398_m_-9120389020893591049_m_5301770532860377666_m_2492289481098601842_m_-8398744203341755579_m_-183165483310698853_m_-5183886941758032307_m_38605100104123258_m_-6207720197657357054_m_-540971926111574648_m_-5349309404870035727_m_-557469278173148291_m_-9121850764511288930_m_493740067844802'
                                                                            style='color: rgb(34, 34, 34);'
                                                                            rel='noreferrer noopener'
                                                                        >
                                                                            <span id='m_-811177307910776471ydp41863206yiv7747682938m_-3969377242492246480m_-8223847472106530372mt-tracked-link_3_1693485378209' style='color: red;'></span>
                                                                        </a>
                                                                        &nbsp;
                                                                    </span>
                                                                </font>
                                                                &nbsp;<b><font face='times new roman, serif' color='#073763'>'</font></b>
                                                                <font face='times new roman, serif'>
                                                                    <font color='#073763'>
                                                                        <b><span lang='EN-US'>".strtoupper($getOtherDetails->titleOfPaper)."</span></b>
                                                                        <b><span style='line-height: 15.6933px;'>'</span><span style='line-height: 15.6933px;'>&nbsp;</span></b>
                                                                    </font>
                                                                    <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                        has been&nbsp;<b>Accepted</b>&nbsp;for publication in upcoming&nbsp;<b>Vol ".substr($this->input->post('txtArticleID'), 2, 2)."; Issue ".date('m', strtotime($this->input->post('txtPDate')))."; ".date('Y', strtotime($this->input->post('txtPDate')))."</b>&nbsp;of International Journal of Pharmaceutical Sciences
                                                                        
                                                                    </span>
                                                                </font>
                                                                <span style='font-family: Arial, sans-serif; font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>.</span>
                                                            </p>
                                                            <p style='margin-bottom: 12pt;'>
                                                                <font size='4'>
                                                                    <span style='font-family: Garamond, serif;'>Manuscript ID :</span>
                                                                    <font color='#073763'>
                                                                        <b style='font-family: Calibri, sans-serif;'><span style='font-family: Garamond, serif;'>&nbsp;</span></b>
                                                                        <b style='font-family: Calibri, sans-serif;'><span style='font-family: Garamond, serif;'>IJPS/".$this->input->post('txtArticleID')."</span></b>
                                                                    </font>
                                                                </font>
                                                                <b style='font-size: large; font-family: Calibri, sans-serif;'>
                                                                    <span style='font-family: Garamond, serif;'><font color='#073763' style='background-color: inherit;'></font></span>
                                                                </b>
                                                            </p>
                                                            <p style='margin: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; font-size: 11pt; font-family: Calibri, sans-serif;'>
                                                                <b><span style='font-size: 12pt; font-family: New serif; color: rgb(64, 64, 64);'>Peer-Review Report:</span></b><b><span style='font-family: New serif; color: rgb(64, 64, 64);'></span></b>
                                                            </p>
                                                            <p style='margin: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; font-size: 11pt; font-family: Calibri, sans-serif;'>
                                                                <b><span style='font-family: New serif; color: rgb(64, 64, 64);'>&nbsp;</span></b>
                                                            </p>
                                                            <table border='1' cellspacing='0' cellpadding='0' style='border-collapse: collapse; border: none;'>
                                                                <tbody>
                                                                    <tr style='min-height: 16.1pt;'>
                                                                        <td width='66' style='width: 49.25pt; border: 1pt solid rgb(191, 191, 191); padding: 0in 5.4pt; min-height: 16.1pt;'>
                                                                            <p align='center' style='margin: 0in; text-align: center; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <b><span style='font-family: New serif; color: black;'>Sr. No.</span></b><b></b>
                                                                            </p>
                                                                        </td>
                                                                        <td
                                                                            width='174'
                                                                            style='
                                                                                width: 130.5pt;
                                                                                border-top: 1pt solid rgb(191, 191, 191);
                                                                                border-right: 1pt solid rgb(191, 191, 191);
                                                                                border-bottom: 1pt solid rgb(191, 191, 191);
                                                                                border-left: none;
                                                                                padding: 0in 5.4pt;
                                                                                min-height: 16.1pt;
                                                                            '
                                                                        >
                                                                            <p style='margin: 0in; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <b><span style='font-family: New serif; color: black;'>Critical review on</span></b><b></b>
                                                                            </p>
                                                                        </td>
                                                                        <td
                                                                            width='126'
                                                                            style='
                                                                                width: 94.5pt;
                                                                                border-top: 1pt solid rgb(191, 191, 191);
                                                                                border-right: 1pt solid rgb(191, 191, 191);
                                                                                border-bottom: 1pt solid rgb(191, 191, 191);
                                                                                border-left: none;
                                                                                padding: 0in 5.4pt;
                                                                                min-height: 16.1pt;
                                                                            '
                                                                        >
                                                                            <p align='center' style='margin: 0in; text-align: center; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <b><span style='font-family: New serif; color: black;'>Points out of 10</span></b><span style='font-size: 11pt;'><b></b></span>
                                                                            </p>
                                                                        </td>
                                                                    </tr>";
                                                                    $serial=1;
                                                                    foreach ($rePoint as $key => $value) { 

                                                                       
                                                                        $message .=  "<tr style='min-height: 14.5pt;'>
                                                                        <td
                                                                            width='66'
                                                                            style='
                                                                                width: 49.25pt;
                                                                                border-right: 1pt solid rgb(191, 191, 191);
                                                                                border-bottom: 1pt solid rgb(191, 191, 191);
                                                                                border-left: 1pt solid rgb(191, 191, 191);
                                                                                border-top: none;
                                                                                background: rgb(242, 242, 242);
                                                                                padding: 0in 5.4pt;
                                                                                min-height: 14.5pt;
                                                                            '
                                                                        >
                                                                            <p align='center' style='margin: 0in; text-align: center; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'>
                                                                                <b><span style='font-family: New serif; color: black;'>".$serial++."</span></b><b></b>
                                                                            </p>
                                                                        </td>
                                                                        <td
                                                                            width='174'
                                                                            style='
                                                                                width: 130.5pt;
                                                                                border-top: none;
                                                                                border-left: none;
                                                                                border-bottom: 1pt solid rgb(191, 191, 191);
                                                                                border-right: 1pt solid rgb(191, 191, 191);
                                                                                background: rgb(242, 242, 242);
                                                                                padding: 0in 5.4pt;
                                                                                min-height: 14.5pt;
                                                                            '
                                                                        >
                                                                            <p style='margin: 0in; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'><span style='font-family: New serif; color: black;'>".$value['reviewPoint']."</span></p>
                                                                        </td>
                                                                        <td
                                                                            width='126'
                                                                            style='
                                                                                width: 94.5pt;
                                                                                border-top: none;
                                                                                border-left: none;
                                                                                border-bottom: 1pt solid rgb(191, 191, 191);
                                                                                border-right: 1pt solid rgb(191, 191, 191);
                                                                                background: rgb(242, 242, 242);
                                                                                padding: 0in 5.4pt;
                                                                                min-height: 14.5pt;
                                                                            '
                                                                        >
                                                                            <p align='center' style='margin: 0in; text-align: center; line-height: normal; font-size: 11pt;'><font color='#000000' face='Times New Roman, serif'>".$value['txtCol1Value']."</font></p>
                                                                        </td>
                                                                    </tr>";
                                                                    }
                                                                    
                                                                   
                                                                    $message .= "</tbody>
                                                            </table>
                                                            <div style='color:black;'>
                                                                        ".$this->input->post('txtMessage', true)."
                                                            </div>
                                                            
                                                            <p style='margin-bottom: 12pt;'></p>
                                                            <p style='margin: 0in 0in 8pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; font-size: 11pt; font-family: Calibri, sans-serif;'>
                                                                <b>
                                                                    <span style='font-family: Arial, sans-serif; color: rgb(64, 64, 64); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>
                                                                        Reviewer Board Decision: &nbsp;
                                                                    </span>
                                                                </b>
                                                                <b>
                                                                    <span style='font-family: Arial, sans-serif; color: rgb(83, 129, 53); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>Manuscript Accepted</span>
                                                                </b>
                                                                <span style='font-family: Arial, sans-serif;'></span>
                                                            </p>
                                                            <p style='margin-bottom: 12pt;'></p>
                                                            <ul>
                                                                <li style='margin-left: 15px;'>
                                                                    <font face='tahoma, sans-serif'>
                                                                        <span style='color: rgb(69, 69, 69);'>Send the soft-copy of filled&nbsp;</span><b style='color: rgb(69, 69, 69);'>Copyright Transfer&nbsp;Agreement (CTA)&nbsp;</b>
                                                                        <span style='color: rgb(69, 69, 69);'>within 03 Days.</span>
                                                                    </font>
                                                                </li>
                                                                <li style='margin-left: 15px;'>
                                                                    <span style='font-family: Tahoma, sans-serif; color: rgb(69, 69, 69); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>
                                                                        Deposit/Transfer,&nbsp;Article Processing Charges (<b>APC</b>) of Rs. 1299<b>/-</b>
                                                                    </span>
                                                                    <b style='font-family: Calibri, sans-serif;'>
                                                                        <span style='font-family: Tahoma, sans-serif; color: rgb(0, 176, 240); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>&nbsp;</span>
                                                                    </b>
                                                                    <span style='font-family: Tahoma, sans-serif; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>within</span>
                                                                    <span style='font-family: Tahoma, sans-serif; color: rgb(69, 69, 69); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>&nbsp;03 Days.</span>
                                                                </li>
                                                            </ul>
                                                            <div>
                                                                <font color='#454545' face='Tahoma, sans-serif'><br /></font>
                                                            </div>
                                                            Fill up the form :&nbsp;
                                                            <a
                                                                href='".site_url('submit-authors-info')."'
                                                                style='
                                                                    color: rgb(255, 255, 255);
                                                                    font-size: 13px;
                                                                    background-color: rgb(2, 118, 242);
                                                                    border: 0px solid rgb(0, 0, 0);
                                                                    border-radius: 6px;
                                                                    font-weight: 700;
                                                                    line-height: 40px;
                                                                    padding: 12px 24px;
                                                                    text-align: center;
                                                                    text-decoration-line: none;
                                                                    vertical-align: middle;
                                                                '
                                                                rel='noreferrer noopener'
                                                                target='_blank'
                                                                data-saferedirecturl='https://www.google.com/url?q=".site_url('submit-authors-info')."&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2vU9etIAzveduyfxZYYbzG'
                                                            >
                                                                <span id='m_-811177307910776471ydp41863206yiv7747682938m_-3969377242492246480m_-8223847472106530372mt-tracked-link_3_1694759410352' style='color: red;'></span>Authors info
                                                            </a>
                                                            &nbsp;<br />
                                                            <b>
                                                                <span style='font-family: Garamond, serif;'>
                                                                    <font size='4' color='#783f04' style='background-color: inherit;'>
                                                                        <div>
                                                                            <b>
                                                                                <font size='4' color='#783f04'><br /></font>
                                                                            </b>
                                                                        </div>
                                                                        Payment Details:
                                                                    </font>
                                                                </span>
                                                            </b>
                                                            <div>
                                                                <font color='#783f04' face='Garamond, serif' size='4'>
                                                                    <b><br /></b>
                                                                </font>
                                                                <div>
                                                                    <font color='#0b5394'>
                                                                        <b>Click on Link:<span style='font-size: 11pt;'>&nbsp;</span></b>
                                                                    </font>
                                                                    &nbsp;
                                                                    <a
                                                                        href='".$pay_link."'
                                                                        style='
                                                                            color: rgb(255, 255, 255);
                                                                            font-size: 13px;
                                                                            background-color: rgb(2, 118, 242);
                                                                            border: 0px solid rgb(0, 0, 0);
                                                                            border-radius: 3px;
                                                                            font-weight: 700;
                                                                            line-height: 40px;
                                                                            padding: 12px 24px;
                                                                            text-align: center;
                                                                            text-decoration-line: none;
                                                                            vertical-align: middle;
                                                                        '
                                                                        rel='noreferrer noopener'
                                                                        target='_blank'
                                                                        data-saferedirecturl='https://www.google.com/url?q=".$pay_link."&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw3opttcENfVwqbwI9gLK4dV'
                                                                    >
                                                                        <span id='m_-811177307910776471ydp41863206yiv7747682938m_-3969377242492246480m_-8223847472106530372mt-tracked-link_1683274494583' style='color: red;'></span>PAY NOW
                                                                    </a>
                                                                    &nbsp;<br />
                                                                    <br />
                                                                </div>
                                                                <div>
                                                                    <!--<b><font color='#0b5394'>Bank deposit:</font><font color='#38761d'>&nbsp;</font></b>
                                                                    <div><b>Bank&nbsp;</b>: Kotak Mahindra Bank</div>
                                                                    <div><b>Account No</b>.: 1213832440</div>
                                                                    <div><b>IFSC code&nbsp;</b>: KKBK0000694</div>-->
                                                                    <div>
                                                                        <!--<b>Account holder name</b>: IJPS Journal<br />-->
                                                                        <p style='margin: 0cm 0cm 6pt 13.5pt; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'>&nbsp;</p>
                                                                        <p style='margin: 0cm 0cm 0.0001pt; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                            <span style='font-family: New serif; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>
                                                                                <font color='#274e13' style='background-color: inherit;'>Note: After the deposition of Article Processing Fee, you are requested to intimate us (by email) and send the scan copy of&nbsp;</font>
                                                                            </span>
                                                                            <span style='color: rgb(39, 78, 19); font-family: New serif;'>copyright form and&nbsp;</span>
                                                                            <span style='color: rgb(39, 78, 19); font-family: New serif;'>receipt immediately by replying to this mail.</span>
                                                                        </p>
                                                                        <p style='margin: 0cm 0cm 0.0001pt; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'><br /></p>
                                                                        <p style='margin: 0cm 0cm 0.0001pt; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'><br /></p>
                                                                        <p style='margin: 0cm 0cm 6pt; line-height: normal;'>
                                                                            <font face='arial, sans-serif' color='#073763'>In case we do not hear from you within the stipulated time, we may postpone the publication until the next issue.</font>
                                                                        </p>
                                                                        <p style='margin: 0cm 0cm 6pt; line-height: normal;'>
                                                                            <font face='arial, sans-serif' color='#073763'>
                                                                                We value your support to our journal and Thank you for considering this journal as a venue for your work. If you have any questions, please do not hesitate to contact us.
                                                                            </font>
                                                                        </p>
                                                                        <div>
                                                                            <p style='margin: 0cm 0cm 6pt; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <span style='font-family: Tahoma, sans-serif; color: rgb(49, 132, 155);'>
                                                                                    ------------------------------<wbr />------------------------------<wbr />------------------------------<wbr />------------------------
                                                                                </span>
                                                                            </p>
                                                                            <p style='margin: 0cm 0cm 6pt; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <font color='#666666'>
                                                                                    <span lang='EN-SG'>If you would like to receive&nbsp;<b>IJPS updates</b>, you may follow us on&nbsp;<b>Facebook</b>&nbsp;</span>
                                                                                    <a
                                                                                        href='https://www.facebook.com/ijpsjournal'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=https://www.facebook.com/ijpsjournal&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw0P9y2uY6lFKNSTIuAD6bZM'
                                                                                    >
                                                                                        <span lang='EN-SG'></span>
                                                                                    </a>
                                                                                    <a
                                                                                        href='http://www.facebook.com/ijpsjournal'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://www.facebook.com/ijpsjournal&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2IctN0SzM8Huv5guEENFwR'
                                                                                    >
                                                                                        http://www.<wbr />facebook.com/ijpsjournal
                                                                                    </a>
                                                                                    <span lang='EN-SG'>,&nbsp;<b>Twitter&nbsp;</b></span>
                                                                                    <a
                                                                                        href='https://twitter.com/int_j_pharm_sci'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=https://twitter.com/int_j_pharm_sci&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2DFdTWxJJLvhHdGg9xQaIW'
                                                                                    >
                                                                                        <span lang='EN-SG'></span>
                                                                                    </a>
                                                                                    <a
                                                                                        href='http://twitter.com/int_j_pharm_sci'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://twitter.com/int_j_pharm_sci&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2BFX6y8rI2QHALezinWjKj'
                                                                                    >
                                                                                        htt<wbr />p://twitter.com/int_j_pharm_sci
                                                                                    </a>
                                                                                    <b><span lang='EN-SG'>&nbsp;</span></b>
                                                                                    <span lang='EN-SG'>
                                                                                        and&nbsp;<b>Linke<wbr />d in&nbsp;</b>
                                                                                    </span>
                                                                                    <a
                                                                                        href='http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw3q3JCR5FyvtM9KKylhQ9jC'
                                                                                    >
                                                                                        <span lang='EN-SG'></span>
                                                                                    </a>
                                                                                    <a
                                                                                        href='http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw3q3JCR5FyvtM9KKylhQ9jC'
                                                                                    >
                                                                                        linkedin.com/company/international-journal-in-pharmaceutical-sciences/
                                                                                    </a>
                                                                                </font>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div><br /></div>
                                                            <span>-- </span><br />
                                                            <div dir='ltr'>
                                                                <div dir='ltr'>
                                                                    <div style='color: rgb(34, 34, 34);'>
                                                                        <p style='margin:0px;'>
                                                                            <b><span lang='EN-SG' style='color: rgb(31, 73, 125);'>Regards,</span></b>
                                                                        </p>
                                                                        <p  style='margin:0px;'><span style='color: rgb(31, 73, 125);'>Editor-In-Chief</span></p>
                                                                        <img src='".site_url('assetsbackoffice/images/favicon.png')."' style='width:70px;'>
                                                                    </div>
                                                                    <div style='color: rgb(34, 34, 34);'><span style='color: rgb(31, 73, 125);'>International Journal of Pharmaceutical Sciences (IJPS)</span></div>
                                                                    <div style='color: rgb(34, 34, 34);'>
                                                                        <p  style='margin:0px;'>
                                                                            <span style='color: rgb(31, 73, 125);'>
                                                                                E-mail:&nbsp;
                                                                                <a href='mailto:editor@ijpsjournal.com' style='color: rgb(17, 85, 204);' rel='noreferrer noopener' target='_blank'><span style='color: rgb(5, 99, 193);'>editor@ijpsjournal.com</span></a>
                                                                            </span>
                                                                        </p>
                                                                        <p  style='margin:0px;'>
                                                                            <span style='color: rgb(31, 73, 125);'>Website:&nbsp;&nbsp;</span>
                                                                            <a
                                                                                href='http://www.ijpsjournal.com/'
                                                                                style='color: rgb(17, 85, 204);'
                                                                                rel='noreferrer noopener'
                                                                                target='_blank'
                                                                                data-saferedirecturl='https://www.google.com/url?q=http://www.ijpsjournal.com/&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw1CHQkkeVsJQ9ZBdvlfwfLN'
                                                                            >
                                                                                <span style='color: rgb(5, 99, 193);'>www.ijpsjournal.com</span>
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br />
                                                        </div>
                                                    </div>
                                                    <br />
                                                </div>
                                            </div>
                                        </div>
                                    </div>";

                                    // echo $message;die;
                        //sendMail($subject, $message, $this->input->post('txtEmail'), '2','', ''); 
                         $aatchment = $_SERVER['DOCUMENT_ROOT']."/".UPLOAD_COPYRIGHT;  
                        $this->load->library('emaillib');
                      $mail = $this->emaillib->load();
                       $mail->addAddress('editor@ijpsjournal.com');
                        $mail->addAddress($this->input->post('txtEmail'));
                     $mail->addAttachment($aatchment);
                       $mail->Subject = $subject;
                      $mail->Body =$message;
                       $mail->send();
                        //  echo json_encode(array('status'=>'success','msg'=>'Status updated successfully..'));                                           
				    }
				    else if($this->input->post('cmbStatusID', true) == 4)
				    {				      
                      
				        $resultManuscriptsAuthor  = $this->CommonModel->getDataLimit('ijps_tblmanuscriptinfo', array('isActive'=>'1', 'articleID'=>$this->input->post('txtArticleID')), '', '', '', '', '', 'manuscriptInfoID','ASC');
				        $emailLisstData  = $this->CommonModel->getDataLimit('ijps_tblmanuscript', array('isActive'=>'1', 'uniqueCode'=>$this->input->post('txtArticleID')), '', '', '', '', '', '','');
                       
                        $getEmail = $this->ManuscriptModel->getEmail($this->input->post('txtArticleID'));
                         
                         $emailString = ''; 
                        if(!empty($getEmail)){
                            foreach ($getEmail as $row) {
                           
                                if (!empty($row['emails'])) {
                                    $emailString .= $row['emails'] . ', ';
                                }
                                
                               
                                if (!empty($row['co_author_emails'])) {
                                    $emailString .= $row['co_author_emails'] . ', ';
                                }
                            }
                        }

                        $emailString = rtrim($emailString, ', ');
        				$file_name = basename($file_url);
        				$ext = substr(strrchr($file_name, '.'), 1);
        		    	$file1 = "mailAttachment1-".date('YmdHis').".".$ext; 
        			    copy(UPLOAD_ARTICLE.$file_name,UPLOAD_ARTICLE.$file1);
        			
        				
        				if($_FILES['file2']['name']=="")
        				{
        					$file2 = "";
        				}
        				else
        				{
        					$ext = substr(strrchr($_FILES['file2']['name'], '.'), 1);
        					$file2 = "mailAttachment2-".date('YmdHis').".".$ext;
        				}
        				
    					
    					if($_FILES["file2"]["name"] != "")
    					{
    						/******************************** File 2 Upload *********************************/
    						$target_file    = UPLOAD_ARTICLE.$file2;
                            move_uploaded_file($_FILES['file2']['tmp_name'], $target_file);
    						/**********  File 2 Upload *********************************/
    					}
                        $file_info =pathinfo($this->input->post('articlePdf'));
    					$article_url = base_url('article/'). $file_info['filename'];
    			
    					
				        $subject = "Article Published Successfully - IJPS journal (Paper_id : IJPS/".$this->input->post('txtArticleID').")";
				        $message = "<div id='m_-3607494969263911555ydp1c713f0eyiv0552343105'>
                                        <div><span style='color: rgb(7, 55, 99); font-size: 11pt;'>Dear&nbsp;Author/Researcher,</span><br /><br /></div>
                                        <div>
                                            <div>
                                                <div dir='ltr'>
                                                    <div>
                                                        <div dir='ltr'>
                                                            <div>
                                                                <div>
                                                                    <font color='#073763'>
                                                                        We are happy to inform you&nbsp;that your article&nbsp;<b><font face='times new roman, serif'>'</font></b>
                                                                    </font>
                                                                    <b>
                                                                        <span lang='EN-US' style='line-height: 115%;'>
                                                                            <font color='#073763' face='times new roman, serif' style='background-color: inherit;'>
                                                                                ".strtoupper($getOtherDetails->titleOfPaper)."
                                                                            </font>
                                                                        </span>
                                                                    </b><font color='#073763' face='times new roman, serif'><b>'</b></font>
                                                                    <font face='times new roman, serif' color='#073763'>
                                                                    <b>
                                                                    
                                                                    </b>
                                                                    </font><font color='#222222'>&nbsp;</font>
                                                                    </a>
                                                                    </b>
                                                                    </font>
                                                                    <span style='color: rgb(7, 55, 99);'>has been successfully published in&nbsp;</span><b style='color: rgb(7, 55, 99);'>Vol ".substr($this->input->post('txtArticleID'), 2, 2)."; Issue ".date('m', strtotime($this->input->post('txtPDate')))."; ".date('Y', strtotime($this->input->post('txtPDate')))."</b>
                                                                    <span style='color: rgb(7, 55, 99);'>&nbsp;of&nbsp;International Journal of Pharmaceutical Sciences.</span><br />
                                                                    </div>
                                                                    
                                                                    <div><br /></div>
                                                                    <div><font color='#073763'>You can also&nbsp;view published article on journal website,&nbsp;</font></div>
                                                                    <div><br /></div>
                                                                    <div>
                                                                    <font color='#073763'>
                                                                    <a
                                                                    href='".$article_url."'
                                                                    style='
                                                                    color: rgb(255, 255, 255);
                                                                    background-color: rgb(2, 118, 242);
                                                                    border: 0px solid rgb(0, 0, 0);
                                                                    border-radius: 3px;
                                                                    font-size: 13px;
                                                                    font-weight: 700;
                                                                    line-height: 40px;
                                                                    padding: 12px 24px;
                                                                    text-align: center;
                                                                    text-decoration-line: none;
                                                                    vertical-align: middle;
                                                                    '
                                                                    rel='noreferrer noopener'
                                                                    target='_blank'
                                                                    data-saferedirecturl='".$article_url."&amp;source=gmail&amp;ust=1694942281318000&amp;usg=AOvVaw2BXxYuZXE_flJ1d4drIwnf'
                                                                    >
                                                                    <span id='m_-3607494969263911555ydp1c713f0eyiv0552343105m_-8557045952869076606m_-2257514280001564672mt-tracked-link_3_1694774119325' style='color: red;'></span>View Article
                                                                    </a>
                                                                    &nbsp;<br />
                                                                    </font>
                                                                    </div>
                                                                    
                                                                    <div>
                                                                    <font color='#073763'><br /></font>
                                                                    </div>
                                                                    <div><font color='#073763' face='comic sans ms, sans-serif'>Please find the attachments below.</font></div>
                                                                    <div><br /></div>
                                                                    </div>
                                                                    <div>
                                                                    <p style='margin: 0cm 0cm 6pt; line-height: normal;'>
                                                                    <span style='color: rgb(7, 55, 99); font-family: arial, sans-serif;'>We value your support</span><font color='#073763'><span style='font-family: arial, sans-serif;'>&nbsp;</span>for our</font>
                                                                    <span style='color: rgb(7, 55, 99); font-family: arial, sans-serif;'>
                                                                    &nbsp;journal and thank you for considering this journal as a venue for your work. If you have any questions, please do not hesitate to contact us.
                                                                    </span>
                                                                    <br />
                                                                    </p>
                                                                    <div>
                                                                    <p style='margin: 0cm 0cm 6pt; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                    <span style='font-family: Tahoma, sans-serif; color: rgb(49, 132, 155);'>
                                                                    ------------------------------<wbr />------------------------------<wbr />------------------------------<wbr />------------------------------<wbr />------------------------------
                                                                    <wbr />------------------------------<wbr />---------------
                                                                    </span>
                                                                    </p>
                                                                    </div>
                                                                    </div>
                                                                    <p style='margin-bottom: 12pt;'>
                                                                    <span lang='EN-SG' style='color: rgb(102, 102, 102); font-family: Calibri, sans-serif;'>If you would like to receive&nbsp;<b>IJPS updates</b>, you may follow us on&nbsp;<b>Facebook</b>&nbsp;</span>
                                                                    <a
                                                                    href='https://www.facebook.com/ijpsjournal'
                                                                    style='font-family: Calibri, sans-serif;'
                                                                    rel='noreferrer noopener'
                                                                    target='_blank'
                                                                    data-saferedirecturl='https://www.google.com/url?q=https://www.facebook.com/ijpsjournal&amp;source=gmail&amp;ust=1694942281318000&amp;usg=AOvVaw0KAiyebaFmMrdzLObYWAl8'
                                                                    >
                                                                    <span lang='EN-SG'>http://www.<wbr />facebook.com/ijpsjournal</span>
                                                                    </a>
                                                                    <span lang='EN-SG' style='color: rgb(102, 102, 102); font-family: Calibri, sans-serif;'>,&nbsp;<b>Twitter&nbsp;</b></span>
                                                                    <a
                                                                    href='https://twitter.com/int_j_pharm_sci'
                                                                    style='font-family: Calibri, sans-serif;'
                                                                    rel='noreferrer noopener'
                                                                    target='_blank'
                                                                    data-saferedirecturl='https://www.google.com/url?q=https://twitter.com/int_j_pharm_sci&amp;source=gmail&amp;ust=1694942281318000&amp;usg=AOvVaw0tOpm-TV8AY1LYbRYwurqu'
                                                                    >
                                                                    <span lang='EN-SG'>htt<wbr />p://twitter.com/int_j_pharm_sci</span>
                                                                    </a>
                                                                    <b style='color: rgb(102, 102, 102); font-family: Calibri, sans-serif;'><span lang='EN-SG'>&nbsp;</span></b>
                                                                    <span lang='EN-SG' style='color: rgb(102, 102, 102); font-family: Calibri, sans-serif;'>
                                                                    and&nbsp;<b>Linke<wbr />d in&nbsp;</b>
                                                                    </span>
                                                                    <a
                                                                    href='http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/'
                                                                    style='font-family: Calibri, sans-serif;'
                                                                    rel='noreferrer noopener'
                                                                    target='_blank'
                                                                    data-saferedirecturl='https://www.google.com/url?q=http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/&amp;source=gmail&amp;ust=1694942281318000&amp;usg=AOvVaw0f4YADzwPFg3GcPJWb5RKy'
                                                                    >
                                                                    <span lang='EN-SG'>linkedin.com/company/international-journal-in-pharmaceutical-sciences/</span>
                                                                    </a>
                                                                    </p>
                                                                    <img alt='' style='width: 0px; max-width: 0px;' />
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <font color='#888888'> </font>
                                                                    <span>-- </span><br />
                                                                    <div dir='ltr'>
                                                                    <div dir='ltr'>
                                                                    <div style='color: rgb(34, 34, 34);'>
                                                                    <p style='margin:0px;'>
                                                                    <b><span lang='EN-SG' style='color: rgb(31, 73, 125);'>Regards,</span></b>
                                                                    </p>
                                                                    <p  style='margin:0px;'><span style='color: rgb(31, 73, 125);'>Editor-In-Chief</span></p>
                                                                    <img src='".site_url('assetsbackoffice/images/favicon.png')."' style='width:70px;'>
                                                                    </div>
                                                                    <div style='color: rgb(34, 34, 34);'><span style='color: rgb(31, 73, 125);'>International Journal of Pharmaceutical Sciences (IJPS)</span></div>
                                                                    <div style='color: rgb(34, 34, 34);'>
                                                                    <p  style='margin:0px;'>
                                                                    <span style='color: rgb(31, 73, 125);'>
                                                                    E-mail:&nbsp;
                                                                    <a href='mailto:editor@ijpsjournal.com' style='color: rgb(17, 85, 204);' rel='noreferrer noopener' target='_blank'><span style='color: rgb(5, 99, 193);'>editor@ijpsjournal.com</span></a>
                                                                    </span>
                                                                    </p>
                                                                    <p  style='margin:0px;'>
                                                                    <span style='color: rgb(31, 73, 125);'>Website:&nbsp;&nbsp;</span>
                                                                    <a
                                                                    href='http://www.ijpsjournal.com/'
                                                                    style='color: rgb(17, 85, 204);'
                                                                    rel='noreferrer noopener'
                                                                    target='_blank'
                                                                    data-saferedirecturl='https://www.google.com/url?q=http://www.ijpsjournal.com/&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw1CHQkkeVsJQ9ZBdvlfwfLN'
                                                                    >
                                                                    <span style='color: rgb(5, 99, 193);'>www.ijpsjournal.com</span>
                                                                    </a>
                                                                    </p>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <br />
                                                                    </div>
                                                                    </div>
                                                                    </div>  ";
                                    
                                    
                      //sendMail($subject, $message,$emailString, '1',$file1, $file2);
                       
                      $this->load->library('emaillib');
                    $mail = $this->emaillib->load();
                       if($emailString!=''){
                           $email_addresses = explode(',', $emailString);
                             $mail->addAddress('editor@ijpsjournal.com');
                            foreach ($email_addresses as $email) {
                                $email = trim($email); 
                                $mail->addAddress($email);
                            }
                            $firstAttachment = $_SERVER['DOCUMENT_ROOT']."/".UPLOAD_ARTICLE.$file1;         
                            $secondAttachment = $_SERVER['DOCUMENT_ROOT']."/".UPLOAD_ARTICLE.$file2;         
                             $files = array(
                            	$firstAttachment,                            	$secondAttachment		
                            );
                            if(!empty( $files)){
                                foreach ($files as $file) {
                                	$mail->addAttachment($file);
                                }
                            }
                            $mail->Subject = $subject;
                            $mail->Body =  $message;
                            $mail->send();
                       }
                       
				    }
				    else if($this->input->post('cmbStatusID', true) == 5)
				    {
				        $subject = "Rejection of Manuscript - IJPS journal (Paper_id : IJPS/".$this->input->post('txtArticleID').")";
				        $message = "<div id='m_6403885194706110442ydpce89535fyiv2982826698'>
                                        <div>
                                            <b style='font-size: 11pt;'>
                                                <span style='color: rgb(32, 56, 100);'>
                                                    <font face='times new roman, serif' style='background-color: inherit;'>Dear&nbsp;Author/Researcher,</font>
                                                </span>
                                            </b>
                                            <br /><br />
                                        </div>
                                        <div>
                                            <div>
                                                <div dir='ltr'>
                                                    <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                        <font face='times new roman, serif'>
                                                            <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                Your manuscript,
                                                                <a
                                                                    name='m_6403885194706110442_m_-2473429162651231089_m_8720172151793714188_m_-9211533579389544600_m_-1970464064096226173_m_-8825111219271386020_m_8832422992720899625_m_-6198995648823214532_m_-2119759295910414398_m_-9120389020893591049_m_5301770532860377666_m_2492289481098601842_m_-8398744203341755579_m_-183165483310698853_m_-5183886941758032307_m_38605100104123258_m_-6207720197657357054_m_-540971926111574648_m_-5349309404870035727_m_-557469278173148291_m_-9121850764511288930_m_493740067844802'
                                                                    style='color: rgb(34, 34, 34);'
                                                                    rel='noreferrer noopener'
                                                                >
                                                                    <span id='m_6403885194706110442ydpce89535fyiv2982826698m_-2473429162651231089mt-tracked-link_3_1693485378209' style='color: red;'></span>
                                                                </a>
                                                                &nbsp;
                                                            </span>
                                                        </font>
                                                        <b><font face='times new roman, serif' color='#073763'>'</font></b>
                                                        <font face='times new roman, serif'>
                                                            <font color='#073763'>
                                                                <b><span lang='EN-US'>".strtoupper($getOtherDetails->titleOfPaper)."</span></b>
                                                                <b><span style='line-height: 15.6933px;'>'</span><span style='line-height: 15.6933px;'>&nbsp;</span></b>
                                                            </font>
                                                            <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                has been <b>Rejected&nbsp;</b>for publication in upcoming&nbsp;<b>Vol. ".substr($this->input->post('txtArticleID'), 2, 2).", Issue ".date('m', strtotime($this->input->post('txtPDate')))."; ".date('Y', strtotime($this->input->post('txtPDate')))."</b>&nbsp;of International Journal of Pharmaceutical Sciences
                                                            </span>
                                                        </font>
                                                        <span style='font-family: Arial, sans-serif; font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>.</span>
                                                        <font face='times new roman, serif'>
                                                            <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                <!--<br><br>".$this->input->post('txtMessage', true)."-->
                                                            </span>
                                                        </font>
                                                    </p>
                                                    <p style='margin: 0in 0in 12pt; line-height: 22px; margin-top:5px;'>
                                                        <span style='font-family: Calibri, sans-serif; font-size: 11pt;'>
                                                            <span style='font-size: 12pt; font-family: New serif; color: rgb(64, 64, 64);'><b>Editorial Comment:&nbsp;</b></span>
                                                        </span>
                                                    </p>
                                                    <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                        <span style='color: rgb(64, 64, 64); font-family: New serif; font-size: 12pt;'>
                                                        <!--The manuscript is not written properly according to author guidelines. hence proved for lacking of novelty.-->
                                                        ".$this->input->post('txtMessage', true)."
                                                        </span>
                                                    </p>
                                                    <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                        <span style='color: rgb(64, 64, 64); font-family: New serif; font-size: 12pt;'>Author Guidelines:&nbsp;</span>
                                                        <a
                                                            href='https://ijpsjournal.com/author-guidelines'
                                                            rel='noreferrer noopener'
                                                            target='_blank'
                                                            data-saferedirecturl='https://www.google.com/url?q=https://ijpsjournal.com/author-guidelines&amp;source=gmail&amp;ust=1694939164706000&amp;usg=AOvVaw0L_avy1HIQtDC_G1hR-PuL'
                                                        >
                                                            https://<wbr />ijpsjournal.com/author-<wbr />guidelines
                                                        </a>
                                                    </p>
                                                    <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                        <span style='color: rgb(64, 64, 64); font-family: New serif; font-size: 12pt;'>Model manuscript:</span>&nbsp;
                                                        <a
                                                            href='https://ijpsjournal.com/model-manuscript'
                                                            rel='noreferrer noopener'
                                                            target='_blank'
                                                            data-saferedirecturl='https://www.google.com/url?q=https://ijpsjournal.com/model-manuscript&amp;source=gmail&amp;ust=1694939164706000&amp;usg=AOvVaw1AK-KKazJTxMq3fjOOE964'
                                                        >
                                                            https://<wbr />ijpsjournal.com/model-<wbr />manuscript
                                                        </a>
                                                    </p>
                                                    <div>--<br /></div>
                                                    <div dir='ltr'>
                                                        <div dir='ltr'>
                                                            <div style='color: rgb(34, 34, 34);'>
                                                                <p style='margin:0px;'>
                                                                    <b><span lang='EN-SG' style='color: rgb(31, 73, 125);'>Regards,</span></b>
                                                                </p>
                                                                <p style='margin:0px;'><span style='color: rgb(31, 73, 125);'>Editor-In-Chief</span></p>
                                                                <img src='".site_url('assetsbackoffice/images/favicon.png')."' style='width:70px;'>
                                                            </div>
                                                            <div style='color: rgb(34, 34, 34);'><span style='color: rgb(31, 73, 125);'>International Journal of Pharmaceutical Sciences (IJPS)</span></div>
                                                            <div style='color: rgb(34, 34, 34);'>
                                                                <p style='margin:0px;'>
                                                                    <span style='color: rgb(31, 73, 125);'>
                                                                        E-mail:&nbsp;<a href='mailto:editor@ijpsjournal.com' style='color: rgb(17, 85, 204);' rel='noreferrer noopener' target='_blank'><span style='color: rgb(5, 99, 193);'>editor@ijpsjournal.com</span></a>
                                                                    </span>
                                                                </p>
                                                                <p style='margin:0px;'>
                                                                    <span style='color: rgb(31, 73, 125);'>Website:&nbsp;&nbsp;</span>
                                                                    <a
                                                                        href='http://www.ijpsjournal.com/'
                                                                        style='color: rgb(17, 85, 204);'
                                                                        rel='noreferrer noopener'
                                                                        target='_blank'
                                                                        data-saferedirecturl='https://www.google.com/url?q=http://www.ijpsjournal.com/&amp;source=gmail&amp;ust=1694939164706000&amp;usg=AOvVaw1gF3fvmOj8wWCcGoUcpvUL'
                                                                    >
                                                                        <span style='color: rgb(5, 99, 193);'>www.ijpsjournal.com</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <img
                                                        alt=''
                                                        src='https://ci5.googleusercontent.com/proxy/UKQicLJ5UpohMDFAgMxwD2l9DHBTnXIyu30mX4IPtGJTkACZKIWQaIy1Nn5V_FAqk2O6b-FmoMihtm3LkcOZSSYu8MFQ6otoklMLybmEhGztZWgFj5fwVX0_D-jrNjp8-Q5VPMnM3bCo=s0-d-e1-ft#https://mailtrack.io/trace/mail/af74e405fcde8e46f08931726f76cda440520039.png?u=9618149'
                                                        style='width: 0px; max-width: 1px;'
                                                        class='CToWUd'
                                                        data-bit='iit'
                                                    />
                                                </div>
                                                <font color='#888888'> </font>
                                            </div>
                                        </div>
                                    </div>";

                        //sendMail($subject, $message, $this->input->post('txtEmail'), '0', '', '');
                        
                         $this->load->library('emaillib');
                       $mail = $this->emaillib->load();
                       $mail->addAddress('editor@ijpsjournal.com');
                       $mail->addAddress($this->input->post('txtEmail'));
                        $mail->Subject = $subject;
                       $mail->Body =$message;
                       $mail->send();

				    }
				    
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtManuscriptID'), FILTER_SANITIZE_NUMBER_INT)." - Manuscript Title : ".$this->input->post('txtTitle', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
                //    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
				// 	redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
                    echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' updated successfully...'));
              }
              else
              {
					// $this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					// redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
                    echo json_encode(array('status'=>'error','msg'=>self::$messageCommonText.' updated error...'));
              }
        }
        else
            {

                // $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				// redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
                echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
            }
           
        }
        
		public function updateManuscript_bk()
        {
            if(
				$this->input->post('cmbStatusID')!="" &&
				$this->input->post('txtManuscriptID')!=""
            )
            {
				$prop = array( 
								'statusID'				=>  $this->input->post('cmbStatusID', true),
								'message'				=>  $this->input->post('txtMessage', true),
								'updatedByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
							);

			    $manuscriptID = filter_var($this->input->post('txtManuscriptID'), FILTER_SANITIZE_NUMBER_INT);
                $bool = $this->CommonModel->updateRecord(self::$table, $prop, $manuscriptID, self::$pkey);
 
				if($bool == 1)
				{
				    
				    if($this->input->post('cmbStatusID', true) == 2)
				    {
                        $reviewPoints = $this->input->post('reviewPoint');
                        $txtCol1Value = $this->input->post('txtCol1Value');
                        $rePoint = array();
                        
                        foreach ($reviewPoints as $key => $reviewPoint) {                           
                            $rePoint[] = array(
                                'reviewPoint' => $reviewPoint,
                                'txtCol1Value' => $txtCol1Value[$key]
                            );
                        }
                        $reviewData = json_encode($rePoint);

                        $insertArray = array('reviewPoint'=>$reviewData,'articleId'=>$this->input->post('txtArticleID'),'created_data'=>date('Y-m-d H:is'));

                        $conditions = array('articleId'=>$this->input->post('txtArticleID'));

                        $isExits = $this->ManuscriptModel->is_record_exist($conditions);
                        if($isExits){
                            $this->ManuscriptModel->update_record($this->input->post('txtArticleID'),$insertArray);
                        }else{
                            $this->ManuscriptModel->insertReviewPoint('tbl_reviewpoint',$insertArray);
                            
                        }
                        
				        $subject = "ACCEPTANCE LETTER - IJPS journal (Paper_id : IJPS/".$this->input->post('txtArticleID').")";
				        $message = "<div id='m_-811177307910776471ydp41863206yiv7747682938'>
                                        <div>
                                            <b style='font-size: 11pt;'>
                                                <span style='color: rgb(32, 56, 100);'><font face='times new roman, serif' style='background-color: inherit;'>Dear&nbsp;Author/Researcher,</font></span>
                                            </b>
                                            <br />
                                            <br />
                                        </div>
                                        <div>
                                            <div>
                                                <div dir='ltr'>
                                                    <div>
                                                        <div dir='ltr'>
                                                            <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                                <font face='times new roman, serif'>
                                                                    <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                        We are happy to inform you that your manuscript,
                                                                        <a
                                                                            name='m_-811177307910776471_m_-3969377242492246480_m_-8223847472106530372_m_-9211533579389544600_m_-1970464064096226173_m_-8825111219271386020_m_8832422992720899625_m_-6198995648823214532_m_-2119759295910414398_m_-9120389020893591049_m_5301770532860377666_m_2492289481098601842_m_-8398744203341755579_m_-183165483310698853_m_-5183886941758032307_m_38605100104123258_m_-6207720197657357054_m_-540971926111574648_m_-5349309404870035727_m_-557469278173148291_m_-9121850764511288930_m_493740067844802'
                                                                            style='color: rgb(34, 34, 34);'
                                                                            rel='noreferrer noopener'
                                                                        >
                                                                            <span id='m_-811177307910776471ydp41863206yiv7747682938m_-3969377242492246480m_-8223847472106530372mt-tracked-link_3_1693485378209' style='color: red;'></span>
                                                                        </a>
                                                                        &nbsp;
                                                                    </span>
                                                                </font>
                                                                &nbsp;<b><font face='times new roman, serif' color='#073763'>'</font></b>
                                                                <font face='times new roman, serif'>
                                                                    <font color='#073763'>
                                                                        <b><span lang='EN-US'>".strtoupper($this->input->post('txtTitleOfPaper'))."</span></b>
                                                                        <b><span style='line-height: 15.6933px;'>'</span><span style='line-height: 15.6933px;'>&nbsp;</span></b>
                                                                    </font>
                                                                    <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                        has been&nbsp;<b>Accepted</b>&nbsp;for publication in upcoming&nbsp;<b>Vol ".substr($this->input->post('txtArticleID'), 2, 2)."; Issue ".date('m', strtotime($this->input->post('txtPDate')))."; ".date('Y', strtotime($this->input->post('txtPDate')))."</b>&nbsp;of International Journal of Pharmaceutical Sciences
                                                                        
                                                                    </span>
                                                                </font>
                                                                <span style='font-family: Arial, sans-serif; font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>.</span>
                                                            </p>
                                                            <p style='margin-bottom: 12pt;'>
                                                                <font size='4'>
                                                                    <span style='font-family: Garamond, serif;'>Manuscript ID :</span>
                                                                    <font color='#073763'>
                                                                        <b style='font-family: Calibri, sans-serif;'><span style='font-family: Garamond, serif;'>&nbsp;</span></b>
                                                                        <b style='font-family: Calibri, sans-serif;'><span style='font-family: Garamond, serif;'>IJPS/".$this->input->post('txtArticleID')."</span></b>
                                                                    </font>
                                                                </font>
                                                                <b style='font-size: large; font-family: Calibri, sans-serif;'>
                                                                    <span style='font-family: Garamond, serif;'><font color='#073763' style='background-color: inherit;'></font></span>
                                                                </b>
                                                            </p>
                                                            <p style='margin: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; font-size: 11pt; font-family: Calibri, sans-serif;'>
                                                                <b><span style='font-size: 12pt; font-family: New serif; color: rgb(64, 64, 64);'>Peer-Review Report:</span></b><b><span style='font-family: New serif; color: rgb(64, 64, 64);'></span></b>
                                                            </p>
                                                            <p style='margin: 0in; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; font-size: 11pt; font-family: Calibri, sans-serif;'>
                                                                <b><span style='font-family: New serif; color: rgb(64, 64, 64);'>&nbsp;</span></b>
                                                            </p>
                                                            <table border='1' cellspacing='0' cellpadding='0' style='border-collapse: collapse; border: none;'>
                                                                <tbody>
                                                                    <tr style='min-height: 16.1pt;'>
                                                                        <td width='66' style='width: 49.25pt; border: 1pt solid rgb(191, 191, 191); padding: 0in 5.4pt; min-height: 16.1pt;'>
                                                                            <p align='center' style='margin: 0in; text-align: center; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <b><span style='font-family: New serif; color: black;'>Sr. No.</span></b><b></b>
                                                                            </p>
                                                                        </td>
                                                                        <td
                                                                            width='174'
                                                                            style='
                                                                                width: 130.5pt;
                                                                                border-top: 1pt solid rgb(191, 191, 191);
                                                                                border-right: 1pt solid rgb(191, 191, 191);
                                                                                border-bottom: 1pt solid rgb(191, 191, 191);
                                                                                border-left: none;
                                                                                padding: 0in 5.4pt;
                                                                                min-height: 16.1pt;
                                                                            '
                                                                        >
                                                                            <p style='margin: 0in; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <b><span style='font-family: New serif; color: black;'>Critical review on</span></b><b></b>
                                                                            </p>
                                                                        </td>
                                                                        <td
                                                                            width='126'
                                                                            style='
                                                                                width: 94.5pt;
                                                                                border-top: 1pt solid rgb(191, 191, 191);
                                                                                border-right: 1pt solid rgb(191, 191, 191);
                                                                                border-bottom: 1pt solid rgb(191, 191, 191);
                                                                                border-left: none;
                                                                                padding: 0in 5.4pt;
                                                                                min-height: 16.1pt;
                                                                            '
                                                                        >
                                                                            <p align='center' style='margin: 0in; text-align: center; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <b><span style='font-family: New serif; color: black;'>Points out of 10</span></b><span style='font-size: 11pt;'><b></b></span>
                                                                            </p>
                                                                        </td>
                                                                    </tr>";
                                                                    foreach ($rePoint as $key => $value) { 

                                                                       
                                                                        $message .=  "<tr style='min-height: 14.5pt;'>
                                                                        <td
                                                                            width='66'
                                                                            style='
                                                                                width: 49.25pt;
                                                                                border-right: 1pt solid rgb(191, 191, 191);
                                                                                border-bottom: 1pt solid rgb(191, 191, 191);
                                                                                border-left: 1pt solid rgb(191, 191, 191);
                                                                                border-top: none;
                                                                                background: rgb(242, 242, 242);
                                                                                padding: 0in 5.4pt;
                                                                                min-height: 14.5pt;
                                                                            '
                                                                        >
                                                                            <p align='center' style='margin: 0in; text-align: center; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'>
                                                                                <b><span style='font-family: New serif; color: black;'>1</span></b><b></b>
                                                                            </p>
                                                                        </td>
                                                                        <td
                                                                            width='174'
                                                                            style='
                                                                                width: 130.5pt;
                                                                                border-top: none;
                                                                                border-left: none;
                                                                                border-bottom: 1pt solid rgb(191, 191, 191);
                                                                                border-right: 1pt solid rgb(191, 191, 191);
                                                                                background: rgb(242, 242, 242);
                                                                                padding: 0in 5.4pt;
                                                                                min-height: 14.5pt;
                                                                            '
                                                                        >
                                                                            <p style='margin: 0in; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'><span style='font-family: New serif; color: black;'>".$value['reviewPoint']."</span></p>
                                                                        </td>
                                                                        <td
                                                                            width='126'
                                                                            style='
                                                                                width: 94.5pt;
                                                                                border-top: none;
                                                                                border-left: none;
                                                                                border-bottom: 1pt solid rgb(191, 191, 191);
                                                                                border-right: 1pt solid rgb(191, 191, 191);
                                                                                background: rgb(242, 242, 242);
                                                                                padding: 0in 5.4pt;
                                                                                min-height: 14.5pt;
                                                                            '
                                                                        >
                                                                            <p align='center' style='margin: 0in; text-align: center; line-height: normal; font-size: 11pt;'><font color='#000000' face='Times New Roman, serif'>".$value['txtCol1Value']."</font></p>
                                                                        </td>
                                                                    </tr>";
                                                                    }
                                                                    
                                                                   
                                                                    $message .= "</tbody>
                                                            </table>
                                                            <div style='color:black;'>
                                                                        ".$this->input->post('txtMessage', true)."
                                                            </div>
                                                            
                                                            <p style='margin-bottom: 12pt;'></p>
                                                            <p style='margin: 0in 0in 8pt; line-height: normal; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; font-size: 11pt; font-family: Calibri, sans-serif;'>
                                                                <b>
                                                                    <span style='font-family: Arial, sans-serif; color: rgb(64, 64, 64); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>
                                                                        Reviewer Board Decision: &nbsp;
                                                                    </span>
                                                                </b>
                                                                <b>
                                                                    <span style='font-family: Arial, sans-serif; color: rgb(83, 129, 53); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>Manuscript Accepted</span>
                                                                </b>
                                                                <span style='font-family: Arial, sans-serif;'></span>
                                                            </p>
                                                            <p style='margin-bottom: 12pt;'></p>
                                                            <ul>
                                                                <li style='margin-left: 15px;'>
                                                                    <font face='tahoma, sans-serif'>
                                                                        <span style='color: rgb(69, 69, 69);'>Send the soft-copy of filled&nbsp;</span><b style='color: rgb(69, 69, 69);'>Copyright Transfer&nbsp;Agreement (CTA)&nbsp;</b>
                                                                        <span style='color: rgb(69, 69, 69);'>within 03 Days.</span>
                                                                    </font>
                                                                </li>
                                                                <li style='margin-left: 15px;'>
                                                                    <span style='font-family: Tahoma, sans-serif; color: rgb(69, 69, 69); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>
                                                                        Deposit/Transfer,&nbsp;Article Processing Charges (<b>APC</b>) of Rs. 1299<b>/-</b>
                                                                    </span>
                                                                    <b style='font-family: Calibri, sans-serif;'>
                                                                        <span style='font-family: Tahoma, sans-serif; color: rgb(0, 176, 240); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>&nbsp;</span>
                                                                    </b>
                                                                    <span style='font-family: Tahoma, sans-serif; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>within</span>
                                                                    <span style='font-family: Tahoma, sans-serif; color: rgb(69, 69, 69); background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>&nbsp;03 Days.</span>
                                                                </li>
                                                            </ul>
                                                            <div>
                                                                <font color='#454545' face='Tahoma, sans-serif'><br /></font>
                                                            </div>
                                                            Fill up the form :&nbsp;
                                                            <a
                                                                href='".site_url('submit-authors-info')."'
                                                                style='
                                                                    color: rgb(255, 255, 255);
                                                                    font-size: 13px;
                                                                    background-color: rgb(2, 118, 242);
                                                                    border: 0px solid rgb(0, 0, 0);
                                                                    border-radius: 6px;
                                                                    font-weight: 700;
                                                                    line-height: 40px;
                                                                    padding: 12px 24px;
                                                                    text-align: center;
                                                                    text-decoration-line: none;
                                                                    vertical-align: middle;
                                                                '
                                                                rel='noreferrer noopener'
                                                                target='_blank'
                                                                data-saferedirecturl='https://www.google.com/url?q=".site_url('submit-authors-info')."&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2vU9etIAzveduyfxZYYbzG'
                                                            >
                                                                <span id='m_-811177307910776471ydp41863206yiv7747682938m_-3969377242492246480m_-8223847472106530372mt-tracked-link_3_1694759410352' style='color: red;'></span>Authors info
                                                            </a>
                                                            &nbsp;<br />
                                                            <b>
                                                                <span style='font-family: Garamond, serif;'>
                                                                    <font size='4' color='#783f04' style='background-color: inherit;'>
                                                                        <div>
                                                                            <b>
                                                                                <font size='4' color='#783f04'><br /></font>
                                                                            </b>
                                                                        </div>
                                                                        Payment Details:
                                                                    </font>
                                                                </span>
                                                            </b>
                                                            <div>
                                                                <font color='#783f04' face='Garamond, serif' size='4'>
                                                                    <b><br /></b>
                                                                </font>
                                                                <div>
                                                                    <font color='#0b5394'>
                                                                        <b>Click on Link:<span style='font-size: 11pt;'>&nbsp;</span></b>
                                                                    </font>
                                                                    &nbsp;
                                                                    <a
                                                                        href='https://pages.razorpay.com/IJPSArticleProcessing'
                                                                        style='
                                                                            color: rgb(255, 255, 255);
                                                                            font-size: 13px;
                                                                            background-color: rgb(2, 118, 242);
                                                                            border: 0px solid rgb(0, 0, 0);
                                                                            border-radius: 3px;
                                                                            font-weight: 700;
                                                                            line-height: 40px;
                                                                            padding: 12px 24px;
                                                                            text-align: center;
                                                                            text-decoration-line: none;
                                                                            vertical-align: middle;
                                                                        '
                                                                        rel='noreferrer noopener'
                                                                        target='_blank'
                                                                        data-saferedirecturl='https://www.google.com/url?q=https://pages.razorpay.com/IJPSArticleProcessing&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw3opttcENfVwqbwI9gLK4dV'
                                                                    >
                                                                        <span id='m_-811177307910776471ydp41863206yiv7747682938m_-3969377242492246480m_-8223847472106530372mt-tracked-link_1683274494583' style='color: red;'></span>PAY NOW
                                                                    </a>
                                                                    &nbsp;<br />
                                                                    <br />
                                                                </div>
                                                                <div>
                                                                    <!--<b><font color='#0b5394'>Bank deposit:</font><font color='#38761d'>&nbsp;</font></b>
                                                                    <div><b>Bank&nbsp;</b>: Kotak Mahindra Bank</div>
                                                                    <div><b>Account No</b>.: 1213832440</div>
                                                                    <div><b>IFSC code&nbsp;</b>: KKBK0000694</div>-->
                                                                    <div>
                                                                        <!--<b>Account holder name</b>: IJPS Journal<br />-->
                                                                        <p style='margin: 0cm 0cm 6pt 13.5pt; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'>&nbsp;</p>
                                                                        <p style='margin: 0cm 0cm 0.0001pt; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                            <span style='font-family: New serif; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial;'>
                                                                                <font color='#274e13' style='background-color: inherit;'>Note: After the deposition of Article Processing Fee, you are requested to intimate us (by email) and send the scan copy of&nbsp;</font>
                                                                            </span>
                                                                            <span style='color: rgb(39, 78, 19); font-family: New serif;'>copyright form and&nbsp;</span>
                                                                            <span style='color: rgb(39, 78, 19); font-family: New serif;'>receipt immediately by replying to this mail.</span>
                                                                        </p>
                                                                        <p style='margin: 0cm 0cm 0.0001pt; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'><br /></p>
                                                                        <p style='margin: 0cm 0cm 0.0001pt; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'><br /></p>
                                                                        <p style='margin: 0cm 0cm 6pt; line-height: normal;'>
                                                                            <font face='arial, sans-serif' color='#073763'>In case we do not hear from you within the stipulated time, we may postpone the publication until the next issue.</font>
                                                                        </p>
                                                                        <p style='margin: 0cm 0cm 6pt; line-height: normal;'>
                                                                            <font face='arial, sans-serif' color='#073763'>
                                                                                We value your support to our journal and Thank you for considering this journal as a venue for your work. If you have any questions, please do not hesitate to contact us.
                                                                            </font>
                                                                        </p>
                                                                        <div>
                                                                            <p style='margin: 0cm 0cm 6pt; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <span style='font-family: Tahoma, sans-serif; color: rgb(49, 132, 155);'>
                                                                                    ------------------------------<wbr />------------------------------<wbr />------------------------------<wbr />------------------------
                                                                                </span>
                                                                            </p>
                                                                            <p style='margin: 0cm 0cm 6pt; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                                <font color='#666666'>
                                                                                    <span lang='EN-SG'>If you would like to receive&nbsp;<b>IJPS updates</b>, you may follow us on&nbsp;<b>Facebook</b>&nbsp;</span>
                                                                                    <a
                                                                                        href='https://www.facebook.com/ijpsjournal'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=https://www.facebook.com/ijpsjournal&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw0P9y2uY6lFKNSTIuAD6bZM'
                                                                                    >
                                                                                        <span lang='EN-SG'></span>
                                                                                    </a>
                                                                                    <a
                                                                                        href='http://www.facebook.com/ijpsjournal'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://www.facebook.com/ijpsjournal&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2IctN0SzM8Huv5guEENFwR'
                                                                                    >
                                                                                        http://www.<wbr />facebook.com/ijpsjournal
                                                                                    </a>
                                                                                    <span lang='EN-SG'>,&nbsp;<b>Twitter&nbsp;</b></span>
                                                                                    <a
                                                                                        href='https://twitter.com/int_j_pharm_sci'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=https://twitter.com/int_j_pharm_sci&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2DFdTWxJJLvhHdGg9xQaIW'
                                                                                    >
                                                                                        <span lang='EN-SG'></span>
                                                                                    </a>
                                                                                    <a
                                                                                        href='http://twitter.com/int_j_pharm_sci'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://twitter.com/int_j_pharm_sci&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw2BFX6y8rI2QHALezinWjKj'
                                                                                    >
                                                                                        htt<wbr />p://twitter.com/int_j_pharm_sci
                                                                                    </a>
                                                                                    <b><span lang='EN-SG'>&nbsp;</span></b>
                                                                                    <span lang='EN-SG'>
                                                                                        and&nbsp;<b>Linke<wbr />d in&nbsp;</b>
                                                                                    </span>
                                                                                    <a
                                                                                        href='http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw3q3JCR5FyvtM9KKylhQ9jC'
                                                                                    >
                                                                                        <span lang='EN-SG'></span>
                                                                                    </a>
                                                                                    <a
                                                                                        href='http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/'
                                                                                        rel='noreferrer noopener'
                                                                                        target='_blank'
                                                                                        data-saferedirecturl='https://www.google.com/url?q=http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw3q3JCR5FyvtM9KKylhQ9jC'
                                                                                    >
                                                                                        linkedin.com/company/international-journal-in-pharmaceutical-sciences/
                                                                                    </a>
                                                                                </font>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div><br /></div>
                                                            <span>-- </span><br />
                                                            <div dir='ltr'>
                                                                <div dir='ltr'>
                                                                    <div style='color: rgb(34, 34, 34);'>
                                                                        <p style='margin:0px;'>
                                                                            <b><span lang='EN-SG' style='color: rgb(31, 73, 125);'>Regards,</span></b>
                                                                        </p>
                                                                        <p  style='margin:0px;'><span style='color: rgb(31, 73, 125);'>Editor-In-Chief</span></p>
                                                                        <img src='".site_url('assetsbackoffice/images/favicon.png')."' style='width:70px;'>
                                                                    </div>
                                                                    <div style='color: rgb(34, 34, 34);'><span style='color: rgb(31, 73, 125);'>International Journal of Pharmaceutical Sciences (IJPS)</span></div>
                                                                    <div style='color: rgb(34, 34, 34);'>
                                                                        <p  style='margin:0px;'>
                                                                            <span style='color: rgb(31, 73, 125);'>
                                                                                E-mail:&nbsp;
                                                                                <a href='mailto:editor@ijpsjournal.com' style='color: rgb(17, 85, 204);' rel='noreferrer noopener' target='_blank'><span style='color: rgb(5, 99, 193);'>editor@ijpsjournal.com</span></a>
                                                                            </span>
                                                                        </p>
                                                                        <p  style='margin:0px;'>
                                                                            <span style='color: rgb(31, 73, 125);'>Website:&nbsp;&nbsp;</span>
                                                                            <a
                                                                                href='http://www.ijpsjournal.com/'
                                                                                style='color: rgb(17, 85, 204);'
                                                                                rel='noreferrer noopener'
                                                                                target='_blank'
                                                                                data-saferedirecturl='https://www.google.com/url?q=http://www.ijpsjournal.com/&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw1CHQkkeVsJQ9ZBdvlfwfLN'
                                                                            >
                                                                                <span style='color: rgb(5, 99, 193);'>www.ijpsjournal.com</span>
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br />
                                                        </div>
                                                    </div>
                                                    <br />
                                                </div>
                                            </div>
                                        </div>
                                    </div>";

                                    // echo $message;die;
                        //sendMail($subject, $message, $this->input->post('txtEmail'), '2','', ''); 
                        $this->load->library('emaillib');
                        $mail = $this->emaillib->load();
                        $mail->addAddress('editor@ijpsjournal.com');
                        $mail->addAddress($this->input->post('txtEmail'));
                        $mail->Subject = $subject;
                        $mail->Body =$message;
                        $mail->send();
                        //  echo json_encode(array('status'=>'success','msg'=>'Status updated successfully..'));                                           
				    }
				    else if($this->input->post('cmbStatusID', true) == 4)
				    {				        
				        $emailList= "";				        
				        // $resultManuscripts  = $this->CommonModel->getDataLimit('ijps_tblmanuscriptinfo', array('isActive'=>'1', 'manuscriptID'=> $this->input->post('txtManuscriptID')), '', '', '', '', '', 'manuscriptInfoID','ASC');
				        $resultManuscriptsAuthor  = $this->CommonModel->getDataLimit_bk('ijps_tblmanuscriptinfo', array('isActive'=>'1', 'articleID'=>'23011118'), '', '', '', '', '', 'manuscriptInfoID','ASC');
				       
				        
				        if(count($resultManuscriptsAuthor)>0)
				        {
				            $data = $this->CommonModel->getDataLimit('ijps_tblmanuscriptcoauthor', array('isActive'=>'1', 'manuscriptInfoID'=>$resultManuscriptsAuthor['0']['manuscriptInfoID']), '', '', '', '', '' ,'manuscriptCoAuthorID','ASC'); 
				        }
				        else
				        {
				            $data = array();
				        }
				        if(is_array($data)){
                            for($k=0;$k<count($data);$k++)
                            {
                                if($data[$k]['email'] != "")
                                {
                                    if($emailList != "")
                                    {
                                        $emailList .= ",".$data[$k]['email'];
                                    }
                                    else
                                    {
                                        $emailList .= $data[$k]['email'];
                                    }
                                }
                            }
                        }
				        
    					
    					if($emailList != "")
				        {
				            if(count($resultManuscriptsAuthor)>0)
    				        {
    				            $emailList .= ",".$resultManuscriptsAuthor['0']['authorEmail'];
    				        }
				        }
				        else
				        {
				            if(count($resultManuscriptsAuthor)>0)
    				        {
    				            $emailList .= $resultManuscriptsAuthor['0']['authorEmail'];
    				        }
				        }
				        
				        if($_FILES['file1']['name']=="")
        				{
        					$file1 = "";
        				}
        				else
        				{
        					$ext = substr(strrchr($_FILES['file1']['name'], '.'), 1);
        					$file1 = "mailAttachment1-".date('YmdHis').".".$ext;
        				}
        				
        				if($_FILES['file2']['name']=="")
        				{
        					$file2 = "";
        				}
        				else
        				{
        					$ext = substr(strrchr($_FILES['file2']['name'], '.'), 1);
        					$file2 = "mailAttachment2-".date('YmdHis').".".$ext;
        				}
        				
        				if($_FILES["file1"]["name"] != "")
    					{
    						/******************************** File 1 Upload *********************************/
    						$target_file    = UPLOAD_ARTICLE.$file1;
    						move_uploaded_file($_FILES['file1']['tmp_name'], $target_file);
    						/**********  File1 Upload *********************************/
    					}
    					
    					if($_FILES["file2"]["name"] != "")
    					{
    						/******************************** File 2 Upload *********************************/
    						$target_file    = UPLOAD_ARTICLE.$file2;
                            move_uploaded_file($_FILES['file2']['tmp_name'], $target_file);
    						/**********  File 2 Upload *********************************/
    					}
    				
    				echo $file1;
    				echo $file2;
    					die;
				        $subject = "Article Published Successfully - IJPS journal (Paper_id : IJPS/".$this->input->post('txtArticleID').")";
				        $message = "<div id='m_-3607494969263911555ydp1c713f0eyiv0552343105'>
                                        <div><span style='color: rgb(7, 55, 99); font-size: 11pt;'>Dear&nbsp;Author/Researcher,</span><br /><br /></div>
                                        <div>
                                            <div>
                                                <div dir='ltr'>
                                                    <div>
                                                        <div dir='ltr'>
                                                            <div>
                                                                <div>
                                                                    <font color='#073763'>
                                                                        We are happy to inform you&nbsp;that your article&nbsp;<b><font face='times new roman, serif'>'</font></b>
                                                                    </font>
                                                                    <b>
                                                                        <span lang='EN-US' style='line-height: 115%;'>
                                                                            <font color='#073763' face='times new roman, serif' style='background-color: inherit;'>
                                                                                ".strtoupper($this->input->post('txtTitleOfPaper'))."
                                                                            </font>
                                                                        </span>
                                                                    </b>
                                                                    <font color='#073763' face='times new roman, serif'><b>'</b></font>
                                                                    <font face='times new roman, serif' color='#073763'>
                                                                        <b>
                                                                            <a
                                                                                name='m_-3607494969263911555_m_-8557045952869076606_m_-2257514280001564672_m_5888134170492751039_m_-7784859677378891417_m_3137714239362053671_m_5926209324528191344_m_-1892125031921963028_m_3102156258986690331_m_3639047417297020307_m_-3477411432260503822_m_-6904441226978385909_m_719650204365500747_m_-8100822672409122918_m_4204925680570380102_m_-150220901481547380_m_-107622683795979243_m_3395236452777031732_m_4034680314401270549_m_-5987919106145030545_m_942418933602505435_m_4559046309672149272_m_6391668144564951044_m_-3616032781070206668_m_699791849357692412_m_-2431082819207992080_m_5895529337538888912_m_2193062260660450482_m_2500065197505590012_m_-5528524060243725567_m_6866380959629914521_m_-6018361261117468728_m_1802890913272025978_m_5325781708963704022_m_-5706482765058606937_m_7080496060193858156_m_-7983727994470957897_m_-734813852135506785_m_-3972672332138013339_m_-3506628290072701102_m_2682049984134440292_m_-1673840461485769403_m_-4003680501875904542_m_8924889861739982355_m_-6112462050927018694_m_5205134459835426955_m_-4235833541233240303_m_-4973565978011469877_m_-4265499499978816848_m_-467110752263681589_m_-7957764918862868330_m_640915007462143845_m_6651974063146854755_m_6807803706881611707_m_-476674044549325113_m_6143995729300247420_m_5657893748002038618_m_2082022739944469834_m_2422324232726147786_m_5916583908660301417_m_-3292575693417682695_m_5597613784674440464_m_7880523692870093792_m_-6640801121892695129_m_6993236180911001478_m_-5492371042877380675_m_-6383543308303830820__Hlk135699622'
                                                                                style='color: rgb(34, 34, 34);'
                                                                                rel='noreferrer noopener'
                                                                            >
                                                                                <font color='#222222'>&nbsp;</font>
                                                                            </a>
                                                                        </b>
                                                                    </font>
                                                                    <span style='color: rgb(7, 55, 99);'>has been successfully published in&nbsp;</span><b style='color: rgb(7, 55, 99);'>Vol ".substr($this->input->post('txtArticleID'), 2, 2)."; Issue ".date('m', strtotime($this->input->post('txtPDate')))."; ".date('Y', strtotime($this->input->post('txtPDate')))."</b>
                                                                    <span style='color: rgb(7, 55, 99);'>&nbsp;of&nbsp;International Journal of Pharmaceutical Sciences.</span><br />
                                                                </div>
                                    
                                                                <div><br /></div>
                                                                <div><font color='#073763'>You can also&nbsp;view published article on journal website,&nbsp;</font></div>
                                                                <div><br /></div>
                                                                <div>
                                                                    <font color='#073763'>
                                                                        <a
                                                                            href='".$this->input->post('articleUrl', true)."'
                                                                            style='
                                                                                color: rgb(255, 255, 255);
                                                                                background-color: rgb(2, 118, 242);
                                                                                border: 0px solid rgb(0, 0, 0);
                                                                                border-radius: 3px;
                                                                                font-size: 13px;
                                                                                font-weight: 700;
                                                                                line-height: 40px;
                                                                                padding: 12px 24px;
                                                                                text-align: center;
                                                                                text-decoration-line: none;
                                                                                vertical-align: middle;
                                                                            '
                                                                            rel='noreferrer noopener'
                                                                            target='_blank'
                                                                            data-saferedirecturl='".$this->input->post('articleUrl', true)."&amp;source=gmail&amp;ust=1694942281318000&amp;usg=AOvVaw2BXxYuZXE_flJ1d4drIwnf'
                                                                        >
                                                                            <span id='m_-3607494969263911555ydp1c713f0eyiv0552343105m_-8557045952869076606m_-2257514280001564672mt-tracked-link_3_1694774119325' style='color: red;'></span>View Article
                                                                        </a>
                                                                        &nbsp;<br />
                                                                    </font>
                                                                </div>
                                                                <div><font color='#073763'><br>".$this->input->post('txtMessage', true)."<br></font></div>
                                                                <div>
                                                                    <font color='#073763'><br /></font>
                                                                </div>
                                                                <div><font color='#073763' face='comic sans ms, sans-serif'>Please find the attachments below.</font></div>
                                                                <div><br /></div>
                                                            </div>
                                                            <div>
                                                                <p style='margin: 0cm 0cm 6pt; line-height: normal;'>
                                                                    <span style='color: rgb(7, 55, 99); font-family: arial, sans-serif;'>We value your support</span><font color='#073763'><span style='font-family: arial, sans-serif;'>&nbsp;</span>for our</font>
                                                                    <span style='color: rgb(7, 55, 99); font-family: arial, sans-serif;'>
                                                                        &nbsp;journal and thank you for considering this journal as a venue for your work. If you have any questions, please do not hesitate to contact us.
                                                                    </span>
                                                                    <br />
                                                                </p>
                                                                <div>
                                                                    <p style='margin: 0cm 0cm 6pt; line-height: normal; font-family: Calibri, sans-serif;'>
                                                                        <span style='font-family: Tahoma, sans-serif; color: rgb(49, 132, 155);'>
                                                                            ------------------------------<wbr />------------------------------<wbr />------------------------------<wbr />------------------------------<wbr />------------------------------
                                                                            <wbr />------------------------------<wbr />---------------
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <p style='margin-bottom: 12pt;'>
                                                                <span lang='EN-SG' style='color: rgb(102, 102, 102); font-family: Calibri, sans-serif;'>If you would like to receive&nbsp;<b>IJPS updates</b>, you may follow us on&nbsp;<b>Facebook</b>&nbsp;</span>
                                                                <a
                                                                    href='https://www.facebook.com/ijpsjournal'
                                                                    style='font-family: Calibri, sans-serif;'
                                                                    rel='noreferrer noopener'
                                                                    target='_blank'
                                                                    data-saferedirecturl='https://www.google.com/url?q=https://www.facebook.com/ijpsjournal&amp;source=gmail&amp;ust=1694942281318000&amp;usg=AOvVaw0KAiyebaFmMrdzLObYWAl8'
                                                                >
                                                                    <span lang='EN-SG'>http://www.<wbr />facebook.com/ijpsjournal</span>
                                                                </a>
                                                                <span lang='EN-SG' style='color: rgb(102, 102, 102); font-family: Calibri, sans-serif;'>,&nbsp;<b>Twitter&nbsp;</b></span>
                                                                <a
                                                                    href='https://twitter.com/int_j_pharm_sci'
                                                                    style='font-family: Calibri, sans-serif;'
                                                                    rel='noreferrer noopener'
                                                                    target='_blank'
                                                                    data-saferedirecturl='https://www.google.com/url?q=https://twitter.com/int_j_pharm_sci&amp;source=gmail&amp;ust=1694942281318000&amp;usg=AOvVaw0tOpm-TV8AY1LYbRYwurqu'
                                                                >
                                                                    <span lang='EN-SG'>htt<wbr />p://twitter.com/int_j_pharm_sci</span>
                                                                </a>
                                                                <b style='color: rgb(102, 102, 102); font-family: Calibri, sans-serif;'><span lang='EN-SG'>&nbsp;</span></b>
                                                                <span lang='EN-SG' style='color: rgb(102, 102, 102); font-family: Calibri, sans-serif;'>
                                                                    and&nbsp;<b>Linke<wbr />d in&nbsp;</b>
                                                                </span>
                                                                <a
                                                                    href='http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/'
                                                                    style='font-family: Calibri, sans-serif;'
                                                                    rel='noreferrer noopener'
                                                                    target='_blank'
                                                                    data-saferedirecturl='https://www.google.com/url?q=http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/&amp;source=gmail&amp;ust=1694942281318000&amp;usg=AOvVaw0f4YADzwPFg3GcPJWb5RKy'
                                                                >
                                                                    <span lang='EN-SG'>linkedin.com/company/international-journal-in-pharmaceutical-sciences/</span>
                                                                </a>
                                                            </p>
                                                            <img alt='' style='width: 0px; max-width: 0px;' />
                                                        </div>
                                                    </div>
                                                </div>
                                                <font color='#888888'> </font>
                                                <span>-- </span><br />
                                                            <div dir='ltr'>
                                                                <div dir='ltr'>
                                                                    <div style='color: rgb(34, 34, 34);'>
                                                                        <p style='margin:0px;'>
                                                                            <b><span lang='EN-SG' style='color: rgb(31, 73, 125);'>Regards,</span></b>
                                                                        </p>
                                                                        <p  style='margin:0px;'><span style='color: rgb(31, 73, 125);'>Editor-In-Chief</span></p>
                                                                        <img src='".site_url('assetsbackoffice/images/favicon.png')."' style='width:70px;'>
                                                                    </div>
                                                                    <div style='color: rgb(34, 34, 34);'><span style='color: rgb(31, 73, 125);'>International Journal of Pharmaceutical Sciences (IJPS)</span></div>
                                                                    <div style='color: rgb(34, 34, 34);'>
                                                                        <p  style='margin:0px;'>
                                                                            <span style='color: rgb(31, 73, 125);'>
                                                                                E-mail:&nbsp;
                                                                                <a href='mailto:editor@ijpsjournal.com' style='color: rgb(17, 85, 204);' rel='noreferrer noopener' target='_blank'><span style='color: rgb(5, 99, 193);'>editor@ijpsjournal.com</span></a>
                                                                            </span>
                                                                        </p>
                                                                        <p  style='margin:0px;'>
                                                                            <span style='color: rgb(31, 73, 125);'>Website:&nbsp;&nbsp;</span>
                                                                            <a
                                                                                href='http://www.ijpsjournal.com/'
                                                                                style='color: rgb(17, 85, 204);'
                                                                                rel='noreferrer noopener'
                                                                                target='_blank'
                                                                                data-saferedirecturl='https://www.google.com/url?q=http://www.ijpsjournal.com/&amp;source=gmail&amp;ust=1694942281416000&amp;usg=AOvVaw1CHQkkeVsJQ9ZBdvlfwfLN'
                                                                            >
                                                                                <span style='color: rgb(5, 99, 193);'>www.ijpsjournal.com</span>
                                                                            </a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br />
                                            </div>
                                        </div>
                                    </div>";
                                    echo $message;die;
                       // sendMail($subject, $message, $emailList, '1',$file1, $file2);
                        
                        $this->load->library('emaillib');
                     $mail = $this->emaillib->load();
                       if($emailList!=''){
                           $email_addresses = explode(',', $emailList);
                             $mail->addAddress('editor@ijpsjournal.com');
                            foreach ($email_addresses as $email) {
                                $email = trim($email); 
                                $mail->addAddress($email);
                            }
                            $firstAttachment = $_SERVER['DOCUMENT_ROOT']."/".UPLOAD_ARTICLE.$file1;         
                            $secondAttachment = $_SERVER['DOCUMENT_ROOT']."/".UPLOAD_ARTICLE.$file2;         
                             $files = array(
                            	$firstAttachment, $secondAttachment		
                            );
                            if(!empty( $files)){
                                foreach ($files as $file) {
                                	$mail->addAttachment($file);
                                }
                            }
                            $mail->Subject = $subject;
                            $mail->Body =  $message;
                            $mail->send();
                       }
				    }
				    else if($this->input->post('cmbStatusID', true) == 5)
				    {
				        $subject = "Rejection of Manuscript - IJPS journal (Paper_id : IJPS/".$this->input->post('txtArticleID').")";
				        $message = "<div id='m_6403885194706110442ydpce89535fyiv2982826698'>
                                        <div>
                                            <b style='font-size: 11pt;'>
                                                <span style='color: rgb(32, 56, 100);'>
                                                    <font face='times new roman, serif' style='background-color: inherit;'>Dear&nbsp;Author/Researcher,</font>
                                                </span>
                                            </b>
                                            <br /><br />
                                        </div>
                                        <div>
                                            <div>
                                                <div dir='ltr'>
                                                    <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                        <font face='times new roman, serif'>
                                                            <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                Your manuscript,
                                                                <a
                                                                    name='m_6403885194706110442_m_-2473429162651231089_m_8720172151793714188_m_-9211533579389544600_m_-1970464064096226173_m_-8825111219271386020_m_8832422992720899625_m_-6198995648823214532_m_-2119759295910414398_m_-9120389020893591049_m_5301770532860377666_m_2492289481098601842_m_-8398744203341755579_m_-183165483310698853_m_-5183886941758032307_m_38605100104123258_m_-6207720197657357054_m_-540971926111574648_m_-5349309404870035727_m_-557469278173148291_m_-9121850764511288930_m_493740067844802'
                                                                    style='color: rgb(34, 34, 34);'
                                                                    rel='noreferrer noopener'
                                                                >
                                                                    <span id='m_6403885194706110442ydpce89535fyiv2982826698m_-2473429162651231089mt-tracked-link_3_1693485378209' style='color: red;'></span>
                                                                </a>
                                                                &nbsp;
                                                            </span>
                                                        </font>
                                                        <b><font face='times new roman, serif' color='#073763'>'</font></b>
                                                        <font face='times new roman, serif'>
                                                            <font color='#073763'>
                                                                <b><span lang='EN-US'>".strtoupper($this->input->post('txtTitleOfPaper'))."</span></b>
                                                                <b><span style='line-height: 15.6933px;'>'</span><span style='line-height: 15.6933px;'>&nbsp;</span></b>
                                                            </font>
                                                            <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                has been <b>Rejected&nbsp;</b>for publication in upcoming&nbsp;<b>Vol. ".substr($this->input->post('txtArticleID'), 2, 2).", Issue ".date('m', strtotime($this->input->post('txtPDate')))."; ".date('Y', strtotime($this->input->post('txtPDate')))."</b>&nbsp;of International Journal of Pharmaceutical Sciences
                                                            </span>
                                                        </font>
                                                        <span style='font-family: Arial, sans-serif; font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>.</span>
                                                        <font face='times new roman, serif'>
                                                            <span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
                                                                <!--<br><br>".$this->input->post('txtMessage', true)."-->
                                                            </span>
                                                        </font>
                                                    </p>
                                                    <p style='margin: 0in 0in 12pt; line-height: 22px; margin-top:5px;'>
                                                        <span style='font-family: Calibri, sans-serif; font-size: 11pt;'>
                                                            <span style='font-size: 12pt; font-family: New serif; color: rgb(64, 64, 64);'><b>Editorial Comment:&nbsp;</b></span>
                                                        </span>
                                                    </p>
                                                    <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                        <span style='color: rgb(64, 64, 64); font-family: New serif; font-size: 12pt;'>
                                                        <!--The manuscript is not written properly according to author guidelines. hence proved for lacking of novelty.-->
                                                        ".$this->input->post('txtMessage', true)."
                                                        </span>
                                                    </p>
                                                    <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                        <span style='color: rgb(64, 64, 64); font-family: New serif; font-size: 12pt;'>Author Guidelines:&nbsp;</span>
                                                        <a
                                                            href='https://ijpsjournal.com/author-guidelines'
                                                            rel='noreferrer noopener'
                                                            target='_blank'
                                                            data-saferedirecturl='https://www.google.com/url?q=https://ijpsjournal.com/author-guidelines&amp;source=gmail&amp;ust=1694939164706000&amp;usg=AOvVaw0L_avy1HIQtDC_G1hR-PuL'
                                                        >
                                                            https://<wbr />ijpsjournal.com/author-<wbr />guidelines
                                                        </a>
                                                    </p>
                                                    <p style='margin: 0in 0in 12pt; line-height: 22px;'>
                                                        <span style='color: rgb(64, 64, 64); font-family: New serif; font-size: 12pt;'>Model manuscript:</span>&nbsp;
                                                        <a
                                                            href='https://ijpsjournal.com/model-manuscript'
                                                            rel='noreferrer noopener'
                                                            target='_blank'
                                                            data-saferedirecturl='https://www.google.com/url?q=https://ijpsjournal.com/model-manuscript&amp;source=gmail&amp;ust=1694939164706000&amp;usg=AOvVaw1AK-KKazJTxMq3fjOOE964'
                                                        >
                                                            https://<wbr />ijpsjournal.com/model-<wbr />manuscript
                                                        </a>
                                                    </p>
                                                    <div>--<br /></div>
                                                    <div dir='ltr'>
                                                        <div dir='ltr'>
                                                            <div style='color: rgb(34, 34, 34);'>
                                                                <p style='margin:0px;'>
                                                                    <b><span lang='EN-SG' style='color: rgb(31, 73, 125);'>Regards,</span></b>
                                                                </p>
                                                                <p style='margin:0px;'><span style='color: rgb(31, 73, 125);'>Editor-In-Chief</span></p>
                                                                <img src='".site_url('assetsbackoffice/images/favicon.png')."' style='width:70px;'>
                                                            </div>
                                                            <div style='color: rgb(34, 34, 34);'><span style='color: rgb(31, 73, 125);'>International Journal of Pharmaceutical Sciences (IJPS)</span></div>
                                                            <div style='color: rgb(34, 34, 34);'>
                                                                <p style='margin:0px;'>
                                                                    <span style='color: rgb(31, 73, 125);'>
                                                                        E-mail:&nbsp;<a href='mailto:editor@ijpsjournal.com' style='color: rgb(17, 85, 204);' rel='noreferrer noopener' target='_blank'><span style='color: rgb(5, 99, 193);'>editor@ijpsjournal.com</span></a>
                                                                    </span>
                                                                </p>
                                                                <p style='margin:0px;'>
                                                                    <span style='color: rgb(31, 73, 125);'>Website:&nbsp;&nbsp;</span>
                                                                    <a
                                                                        href='http://www.ijpsjournal.com/'
                                                                        style='color: rgb(17, 85, 204);'
                                                                        rel='noreferrer noopener'
                                                                        target='_blank'
                                                                        data-saferedirecturl='https://www.google.com/url?q=http://www.ijpsjournal.com/&amp;source=gmail&amp;ust=1694939164706000&amp;usg=AOvVaw1gF3fvmOj8wWCcGoUcpvUL'
                                                                    >
                                                                        <span style='color: rgb(5, 99, 193);'>www.ijpsjournal.com</span>
                                                                    </a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <img
                                                        alt=''
                                                        src='https://ci5.googleusercontent.com/proxy/UKQicLJ5UpohMDFAgMxwD2l9DHBTnXIyu30mX4IPtGJTkACZKIWQaIy1Nn5V_FAqk2O6b-FmoMihtm3LkcOZSSYu8MFQ6otoklMLybmEhGztZWgFj5fwVX0_D-jrNjp8-Q5VPMnM3bCo=s0-d-e1-ft#https://mailtrack.io/trace/mail/af74e405fcde8e46f08931726f76cda440520039.png?u=9618149'
                                                        style='width: 0px; max-width: 1px;'
                                                        class='CToWUd'
                                                        data-bit='iit'
                                                    />
                                                </div>
                                                <font color='#888888'> </font>
                                            </div>
                                        </div>
                                    </div>";

                        //sendMail($subject, $message, $this->input->post('txtEmail'), '0', '', '');
                        
                          $this->load->library('emaillib');
                        $mail = $this->emaillib->load();
                        $mail->addAddress('editor@ijpsjournal.com');
                        $mail->addAddress($this->input->post('txtEmail'));
                        $mail->Subject = $subject;
                        $mail->Body =$message;
                        $mail->send();

				    }
				    
					// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Updated (".self::$pkey." : ".filter_var($this->input->post('txtManuscriptID'), FILTER_SANITIZE_NUMBER_INT)." - Manuscript Title : ".$this->input->post('txtTitle', true).")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
                //    $this->session->set_userdata('toastrSuccess', self::$messageCommonText.' updated successfully...');
				// 	redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
                    echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' updated successfully...'));
              }
              else
              {
					// $this->session->set_userdata('toastrError', self::$messageCommonText.' update error...');
					// redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
                    echo json_encode(array('status'=>'error','msg'=>self::$messageCommonText.' updated error...'));
              }
        }
        else
            {

                // $this->session->set_userdata('toastrWarning', 'Please fill all fields...');
				// redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
                echo json_encode(array('status'=>'error','msg'=>'Please fill all fields...'));
            }
           
        }

        public function fetchDocuments(){
            $con = array('manuscriptID' => $this->input->post('manuscriptId'));
            $result  =$this->ManuscriptModel->getDocument($con);
            if(!empty($result)){
                echo json_encode(array('status'=>'success','articleUrl'=>base_url().UPLOAD_ARTICLE.$result[0]['document'],'document'=>$result[0]['document']));
            }

        }
        
		public function setVisibilityManuscript($manuscriptID, $isActive)
        {
            if($isActive == 1)
            {
                $isActive = 0; 
            }
            else if($isActive == 0)
            {
                $isActive = 1;
            }

            $bool = $this->CommonModel->setVisibilityOfRecord(self::$table, $isActive, $manuscriptID, self::$pkey);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Visibility Changed (".self::$pkey." : ".$manuscriptID." - Visibility Set As ".$isActive.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' visibility updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' visibility update error...');
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
            }
        }
        
        public function deleteManuscript($manuscriptID)
        {
            $bool    = $this->CommonModel->deleteRecord(self::$table, $manuscriptID, self::$pkey);
            
            if($bool == 1)
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$manuscriptID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' deleted successfully...');
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
            }
            else
            {
                $this->session->set_userdata('toastrError', self::$messageCommonText.' delete error...');
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
            }
        }  
    	 public function deleteManu(){
        

            $manuscriptID = $this->input->post('manuscriptID');             
            $this->db->set('isActive', '0');
            $this->db->where('manuscriptID', $manuscriptID);          
            
            if($this->db->update(self::$table))
            {
				// Add activity log start
				$prop = array( 
						'description'		=>  self::$messageCommonText." : Deleted (".self::$pkey." : ".$manuscriptID.")",
						'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
					);
				$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
				// Add activity log end
				
				echo json_encode(array('status'=>'success','msg'=>'Deleted Successfully.'));
            }
            else
            {
                echo json_encode(array('status'=>'error','msg'=>'Error.'));
            }
        }
		public function setApprovalManuscript($manuscriptID, $approvedFlag)
        {
            if($approvedFlag == 1)
            {
                $approvedFlag = 0; 
            }
            else if($approvedFlag == 0)
            {
                $approvedFlag = 1;
            }

            $bool = $this->ManuscriptModel->setApprovalManuscript($approvedFlag, $manuscriptID);
            
            if ($bool == 1)
            {
				// Add activity log start
					$prop = array( 
							'description'		=>  self::$messageCommonText." : Approved Changed (".self::$pkey." : ".$manuscriptID." - Visibility Set As ".$approvedFlag.")",
							'createdByUserID'   =>  filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT)
						);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $prop);
					// Add activity log end
					
				$this->session->set_userdata('toastrSuccess', self::$messageCommonText.' approved updated successfully...');
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
            }
            else
            {
				
				$this->session->set_userdata('toastrError', self::$messageCommonText.' approved update error...');
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
            }
        }
        
         public function getCoAuthor(){
        

            $manuscriptID = $this->input->post('mId');             
                     
            $result['coAuthorsData'] = $this->CommonModel->getDataLimit('ijps_tblmanuscriptcoauthor', array('isActive'=>'1', 'manuscriptInfoID'=>$manuscriptID), '', '', '', '', '' ,'manuscriptCoAuthorID','ASC');
            $view_content = $this->load->view('backoffice/coauthorInfo', $result, true);
    
            // Echo the view content as the response
            echo $view_content;
        }

        
	}
    
?>
