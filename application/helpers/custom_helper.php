<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('getNotiFicationList')) {

    function getNotiFicationList($areaId ='')
    {
    	$CI = & get_instance();
    //	echo $areaId;
    	$notification = $CI->CommonModel->getDataLimit('tblNotification', array('isActive' => 1),'title,createdDate','','',5,0,'createdDate');
  
       // echo $CI->db->last_query();
    	return $notification;
    }
}

function getNotifications($flag)
{
	
	//$this->load->model(BACKOFFICE.'loginmodel', 'login');
	$CI = & get_instance();
	$notificationResult	= $CI->CommonModel->getNotificationData($flag);
	$CI->load->model(BACKOFFICE.'Postmodel', 'PostModel');
					
	for($p=0;$p<count($notificationResult);$p++)
	{ 
		$notificationResult[$p]['url'] 			= "";
		
		if(strpos($notificationResult[$p]['description'], 'Emergency contact')!== false)
		{
			$notificationResult[$p]['url'] 			= "emergencyContacts";	
			$notificationResult[$p]['description'] = "New Emergency contact Added";
		}
		else if(strpos($notificationResult[$p]['description'], 'Company Video')!== false)
		{
			$notificationResult[$p]['url'] 			= "loadCompanyVideos";	
			$notificationResult[$p]['description'] = "New Company Video Added";
		}
		else if(strpos($notificationResult[$p]['description'], 'Company Presentation Template')!== false)
		{
			$notificationResult[$p]['url'] 			= "companyPresentationTemplates";	
			$notificationResult[$p]['description'] = "New Company Presentation Template Added";
		}
		else if(strpos($notificationResult[$p]['description'], 'Employee')!== false)
		{
			$notificationResult[$p]['url'] 			= "dashboard/#NewEmployeeAnnouncement";	
			$notificationResult[$p]['description'] = "New Employee Joined Our Company";
		}
		else if(strpos($notificationResult[$p]['description'], 'Guest')!== false)
		{
			$notificationResult[$p]['url'] 			= "dashboard/#Guest";	
			$notificationResult[$p]['description'] = "Upcomming New Guest Added";
		}
		else if(strpos($notificationResult[$p]['description'], 'Important link')!== false)
		{
			$notificationResult[$p]['url'] 			= "dashboard/#ImportantLinks";	
			$notificationResult[$p]['description'] = "New Important link Added";
		}
		else if(strpos($notificationResult[$p]['description'], 'Bank Data')!== false)
		{
			$notificationResult[$p]['url'] 			= "loadCoOperativeSocietyAccBal";
			$notificationResult[$p]['description'] = "Co-Operative Society Data Updated";
		}
		else if(strpos($notificationResult[$p]['description'], 'Job post')!== false)
		{
			$postArray 								= explode(" ", $notificationResult[$p]['description']);
			$postID 								= $postArray['6'];
			$notificationResult[$p]['url'] 			= "job/".$postID;
			
			$notificationResult[$p]['description'] = "New Job post Added";
		}
		else if(strpos($notificationResult[$p]['description'], 'Post')!== false)
		{
			$postResult	= array();
			$postArray 								= explode(" ", $notificationResult[$p]['description']);
			$postID 								= $postArray['5'];
			$postResult								= $CI->PostModel->getPost($postID);//print_r($postResult);exit;
			
			if(!empty($postResult))
			{
				//print_r($postResult);exit;
				$notificationResult[$p]['description'] 	= "New ".$postResult[0]['name']." Added";
				$k = $postResult[0]['postCategoryID'];
				
				if($k==1)
				{
					$viewAllURL		= "safetyInstructions";
				}
				else if($k==2)
				{
					$viewAllURL		= "events";
				}
				else if($k==3)
				{
					$viewAllURL		= "news";
				}
				else if($k==4)
				{
					$viewAllURL		= "alerts";
				}
				else if($k==5)
				{
					$viewAllURL		= "trainings";
				}
				else if($k==6)
				{
					$viewAllURL		= "HRcommunicationsAndUpdates";
				}
				else if($k==7)
				{
					$viewAllURL		= "CSR";
				}
				else if($k==8)
				{
					$viewAllURL		= "circulars";
				}
				else if($k==9)
				{
					$viewAllURL		= "policies";
				}
				else if($k==10)
				{
					$viewAllURL		= "handbook";
				}
				
				$notificationResult[$p]['url']	= $viewAllURL."/".$postID;
			}
			/*else
			{
				unset($notificationResult[$p]);
			}*/
		}
	}
	return $notificationResult;
}

function get_time_ago($time_ago)
{
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        } 
    }
    //Years 
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}


function sendMail($subject, $message, $to, $flag, $file1, $file2)
{ 
    $to 	= "editor@ijpsjournal.com,".$to;
    
    if($flag==0)
    {
		$headers 	= "From: IJPS: A Pharmaceutical Journal<editor@ijpsjournal.com>\r\n";
		$headers 	.= "MIME-Version: 1.0\r\n";
		$headers 	.= "Content-Type: text/html; charset=UTF-8\r\n";
        
        mail($to, $subject, $message, $headers);
    }
    else if($flag==1)
    {   //echo base_url(UPLOAD_ARTICLE).$file1."-----".base_url(UPLOAD_ARTICLE).$file2;exit;
        // Boundary for separating different parts of the email
        $boundary = md5(uniqid(time()));
        
        $headers = "From: IJPS: A Pharmaceutical Journal <editor@ijpsjournal.com>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
        
        // Email body
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/html; charset=UTF-8\r\n";
        $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $body .= "$message\r\n";
        
        // Attach the first file (replace 'path/to/your/file1.pdf' and 'file1.pdf' with actual file details)
        $attachment_path1 = base_url(UPLOAD_ARTICLE).$file1; /*'https://vivekniti.in/ijpsjournal.com/assets/public/Manuscripts/16909147901_KondetiVenkata_vol_1_issue_8_2023.pdf';*/
        $file_contents1 = file_get_contents($attachment_path1);
        $file_base64_1 = base64_encode($file_contents1);
        $attachment_name1 = $file1;
        
        $body .= "--$boundary\r\n";
        $body .= "Content-Type: application/pdf; name=\"$attachment_name1\"\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$attachment_name1\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split($file_base64_1) . "\r\n";
        
        // Attach the second file (replace 'path/to/your/file2.pdf' and 'file2.pdf' with actual file details)
        $attachment_path2 = base_url(UPLOAD_ARTICLE).$file2;
        $file_contents2 = file_get_contents($attachment_path2);
        $file_base64_2 = base64_encode($file_contents2);
        $attachment_name2 = $file2;
        
        $body .= "--$boundary\r\n";
        $body .= "Content-Type: application/pdf; name=\"$attachment_name2\"\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$attachment_name2\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split($file_base64_2) . "\r\n";
        
        $body .= "--$boundary--\r\n";
        
        // Send the email
        $mail_sent = mail($to, $subject, $body, $headers);
    }
    else 
    {
        // Boundary for separating different parts of the email
        $boundary = md5(uniqid(time()));
        
        $headers = "From: IJPS: A Pharmaceutical Journal <editor@ijpsjournal.com>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
        
        // Email body
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/html; charset=UTF-8\r\n";
        $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $body .= "$message\r\n";

        // Attach the first file (replace 'path/to/your/file1.pdf' and 'file1.pdf' with actual file details)
        $attachment_path1 = base_url()."assets/public/Front/assets/images/Copyright-Agreement.pdf"; /*'https://vivekniti.in/ijpsjournal.com/assets/public/Manuscripts/16909147901_KondetiVenkata_vol_1_issue_8_2023.pdf';*/
        $file_contents1 = file_get_contents($attachment_path1);
        $file_base64_1 = base64_encode($file_contents1);
        $attachment_name1 = "Copyright-Agreement.pdf";
        
        $body .= "--$boundary\r\n";
        $body .= "Content-Type: application/pdf; name=\"$attachment_name1\"\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$attachment_name1\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= chunk_split($file_base64_1) . "\r\n";
        
        $body .= "--$boundary--\r\n";
        
        // Send the email
        $mail_sent = mail($to, $subject, $body, $headers);
    }
        
		/*if (mail($to_email, $subject, $message, $headers))
		{
			echo "Email successfully sent to $to_email...";
		}
		else
		{
			echo "Email sending failed!";
		}*/
					
	               /* $CI = & get_instance();
	                $CI->load->library('email');

					$CI->email
						->from('deshmukhr.2021@gmail.com', 'ijpsjournal')
						->to($to)
						->reply_to('deshmukhr.2021@gmail.com')
						->cc('deshmukhr.2021@gmail.com')
						->subject($subject)
						->message($message)
						->set_mailtype('html');

					// send email
					$CI->email->send();
					//echo $CI->email->print_debugger();exit;
					*/
}



if (!function_exists('get_record_by_id')) {
    function get_record_by_id($table, $id) {
        $CI =& get_instance();
        $CI->load->database();
        $query = $CI->db->get_where($table, array('articleId' => $id));		
        return $query->row();
    }
}

if (!function_exists('get_coauthor')) {
    function get_coauthor($table, $id) {
        $CI =& get_instance();
        $CI->load->database();
        $query = $CI->db->get_where($table, array('manuscriptInfoID' => $id));		
        return $query->result_array();
    }
}

	

if (!function_exists('getAccepted')) {
    function getAccepted ($articleId) {
        $CI =& get_instance();
        $CI->load->database();
        $query = $CI->db->get_where('tbl_reviewpoint', array('articleId' => $articleId,'is_deleted'=>'0'));		
        // echo  $CI->db->last_query();
        return $query->result_array();
    }
}
