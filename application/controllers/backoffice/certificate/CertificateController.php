<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CertificateController extends CI_Controller 
{
    public static $table = "authors_pdf";
    public static $mtable = "ijps_tblmanuscript";
	public static $pkey = "manuscriptID";

    public function __construct() 
    {
        
        parent::__construct();

        if ($this->session->userdata('userFullName') == "" || $this->session->userdata('mailID') == "") {
            redirect(BACKOFFICE.'login', 'refresh');
        }

        $this->load->model(BACKOFFICE.'Dashboardmodel', 'DashboardModel');
        $this->load->model(BACKOFFICE.'Articlemodel', 'Articlemodel');
        $this->load->model(BACKOFFICE.'CommonModel', 'CommonModel');  // Ensure this is loaded for the insertRecord method
        $this->load->model(BACKOFFICE.'Manuscriptmodel', 'ManuscriptModel');
        // echo 'jjjjjjjjjjjjjjjjj'; die;
    }

    public function index($inserted_id = null) 
    {
        // echo 'kkkkkkkkkk'; die;
        // Fetch article details
        $articleResult = $this->Articlemodel->getArticleAuthor(urldecode(str_replace("-", " ", $inserted_id)));

        // $articalResult_data	= $this->ArticleModel->getArticleByTitle(urldecode(str_replace("-", " ", $prop)));
// print_r($articleResult);
// die;
        $data = [
            'inserted_id' => $inserted_id,
            'articleResult' => $articleResult
        ];
        // print_r($articleResult); die;

        $this->load->view(BACKOFFICE . 'certificate/addCertificate', $data);
    }

    public function savePdf()
    {
    if (!empty($_FILES['file']['name'])) {
        $uploadPath = UPLOAD_MANUSCRIPT;
        // $uploadPath='https://nit-school.sumagodemo.com/assetsbackoffice/uploads/manuscript/';

        // if (!is_dir($uploadPath)) {
        //     if (!mkdir($uploadPath, 0777, true)) {
        //         echo json_encode(['status' => 'error', 'msg' => 'Failed to create upload directory.']);
        //         return;
        //     }
        // }

        $filename = $_FILES['file']['name'];
        $filePath = $uploadPath . $filename;
        $txtArticleID = $_POST['articalid']; // Retrieve the Article ID from the POST data
        if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
            $data = array( 
                'txtArticleID'=> $txtArticleID,
                'file_name' => $filename,
                'file_path' => $filePath,
                'uploaded_at' => date('Y-m-d H:i:s')
            );
            $bool = $this->CommonModel->insertRecord(self::$table, $data);  

            // echo $txtArticleID; die;
            $resultManuscriptsAuthor  = $this->CommonModel->getDataLimit('ijps_tblmanuscriptinfo', array('isActive'=>'1', 'articleID'=>$txtArticleID), '', '', '', '', '', 'manuscriptInfoID','ASC');
            $resultArticleData  =$this->Articlemodel->getArticleUniqueId($txtArticleID);
            // echo $resultArticleData['0']['document'];
            // print_r($resultArticleData); 
            // die;
            
				        $emailLisstData  = $this->CommonModel->getDataLimit('ijps_tblmanuscript', array('isActive'=>'1', 'uniqueCode'=>$txtArticleID), '', '', '', '', '', '','');
                       
                        $getEmail = $this->ManuscriptModel->getEmail($txtArticleID);
                        //  print_r($getEmail);
                        //  die;
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
                        // $file_url = $this->input->post('articlePdf');                  
                        $file_url = $filePath;
				     
        				$file_name = basename($file_url);
        				$ext = substr(strrchr($file_name, '.'), 1);
        		    	$file1 = $file_name; 

                       
        			    copy(UPLOAD_ARTICLE.$file_name,UPLOAD_ARTICLE.$file1);
        			
        				
        				// if($_FILES['file2']['name']=="")
        				// {
        				// 	$file2 = "";
        				// }
        				// else
        				// {
        				// 	$ext = substr(strrchr($_FILES['file2']['name'], '.'), 1);
        				// 	$file2 = "mailAttachment2-".date('YmdHis').".".$ext;
        				// }
        				
    					
    					// if($_FILES["file2"]["name"] != "")
    					// {
    					// 	/******************************** File 2 Upload *********************************/
    					// 	$target_file    = UPLOAD_ARTICLE.$file2;
                        //     move_uploaded_file($_FILES['file2']['tmp_name'], $target_file);
    					// 	/**********  File 2 Upload *********************************/
    					// }
                        // $file_info =pathinfo($this->input->post('articlePdf'));
                        $file_info =pathinfo($filePath);
                        // print_r($this->input->post('title_of_paper'));
                        // die;
    				    // 	$article_url = base_url('/assetsbackoffice/uploads/manuscript/'). $file_info['filename'];
    					$article_url = base_url('article/'). $this->input->post('title_of_paper');
    					
                        // $article_url='https://nit-school.sumagodemo.com/assetsbackoffice/uploads/manuscript/'. $file_info['filename'];

                        // $manuscript_id=$this->input->post('manuscriptid');
                        
                        
                        $monthwiseID = $_POST['monthid'];
                        
				        $subject = "Article Published Successfully - IJPS journal (Paper_id : IJPS/".$txtArticleID.")";
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
                                                                                ".strtoupper($resultArticleData['0']['titleOfPaper'])."
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
                                                                    <span style='color: rgb(7, 55, 99);'>has been successfully published in&nbsp;</span><b style='color: rgb(7, 55, 99);'>Vol ".substr($txtArticleID, 2, 2)."; Issue ".$monthwiseID."; ".date('Y', strtotime(date("Y")))."</b>
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
                                    
                            //   echo $message;
                            //   die;      
                      //sendMail($subject, $message,$emailString, '1',$file1, $file2);

                      $manuscript_id = $_POST['manuscript_document_id'];
                        // print_r($manuscript_id); die;

                        $prop = array(
                        'statusID'				=> '4',
                        );
                        // print_r($prop); die;
                        $manuscriptID = filter_var($manuscript_id, FILTER_SANITIZE_NUMBER_INT);
                        $bool = $this->CommonModel->updateRecord(self::$mtable, $prop, $manuscriptID, self::$pkey);


                      $this->load->library('emaillib');
                    $mail = $this->emaillib->load();
                    // echo $emailString;
                    // die;
                       if($emailString!=''){
                           $email_addresses = explode(',', $emailString);
                        //    print_r($email_addresses);
                        //    die;
                             $mail->addAddress('editor@ijpsjournal.com');
                            foreach ($email_addresses as $email) {
                                $email = trim($email); 
                                $mail->addAddress($email);
                                // maheshmhaske500@gmail.com
                                // $email = trim('rpatil0913@gmail.com'); 
                                // $mail->addAddress('rpatil0913@gmail.com');
                            }
                            // echo $file1; die;
                                  
                            // $firstAttachment = $_SERVER['DOCUMENT_ROOT']."/".UPLOAD_ARTICLE_PDF.$file1;         
                        //    $firstAttachment =  _DIR_ . '/'.UPLOAD_ARTICLE_PDF.$file1;
                        //   $firstAttachment =  base_url('/assetsbackoffice/uploads/manuscript/').$file1;
                        
                        //  $firstAttachment =  $_SERVER['DOCUMENT_ROOT']."/".UPLOAD_MANUSCRIPT.$file1;
                        //   $secondAttachment =  $_SERVER['DOCUMENT_ROOT']."/".UPLOAD_ARTICLE.$resultArticleData['0']['document'];
                        
                          $firstAttachment =  $_SERVER['DOCUMENT_ROOT'] .'/assetsbackoffice/uploads/manuscript/'.$file1;
                        //   echo $firstAttachment;
                        //   die;
                          $secondAttachment =  $_SERVER['DOCUMENT_ROOT'] .'/assetsbackoffice/uploads/article/'.$resultArticleData['0']['document'];
                          
                        //    $firstAttachment ='https://nit-school.sumagodemo.com/assetsbackoffice/uploads/manuscript/'.$file1;
                           
                            // $secondAttachment = $_SERVER['DOCUMENT_ROOT']."/".UPLOAD_ARTICLE_PDF.$file2;         
                             $files = array(
                            	$firstAttachment,		$secondAttachment
                            );
                            
                           

                            if (!empty($files)) {
                                foreach ($files as $file) {
                                    
                                    if (file_exists($file)) {
                                        
                                        echo $mail->addAttachment($file);
                                        echo "Attached: " . $file . "\n"; // For direct output
                                    } else {
                                        echo "File not found: " . $file . "\n"; // For direct output
                                    }
                                }
                            }
                            // print_r($mail);
                            // die;
                            // print_r($mail);
                            // die;
                            $mail->Subject = $subject;
                            $mail->Body =  $message;
                            // print_r($mail);
                            // die;
                            // $mail->send();
                            // echo $mail;
                            // die;
                            $mail->SMTPDebug = 2; // Set the debug level (2 for general debugging, 3 for verbose)
                            $mail->Debugoutput = 'html';
                            if (!$mail->send()) {
                                echo json_encode(['status' => 'error', 'msg' => 'Failed to insert file details into the database.']);
                            } else {
                                echo json_encode(['status' => 'success', 'msg' => 'PDF saved successfully!']);
                            }

                       }
            
        } else {
            echo json_encode(['status' => 'error', 'msg' => 'Failed to upload PDF file.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'No file uploaded.']);
    }
}

}
