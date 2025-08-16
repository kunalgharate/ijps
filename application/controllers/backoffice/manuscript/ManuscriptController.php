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
			// Input validation and sanitization
			$manuscriptInfoID = filter_var($prop, FILTER_VALIDATE_INT);
			if (!$manuscriptInfoID || $manuscriptInfoID <= 0) {
				log_message('error', 'Invalid manuscript info ID attempted: ' . $prop);
				$this->session->set_userdata('toastrError', 'Invalid manuscript ID provided');
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS_AUTHORS_INFO, 'refresh');
				return;
			}
			
			// Secure database query with validated input
			$manuscriptInfoResult = $this->CommonModel->getDataLimit(
				'ijps_tblmanuscriptinfo', 
				array('isActive' => '1', 'manuscriptInfoID' => $manuscriptInfoID), 
				'', '', '', '', '', 'manuscriptInfoID', 'ASC'
			); 
			
			if(!empty($manuscriptInfoResult))
			{
				// Sanitize output data before passing to view
				foreach($manuscriptInfoResult as &$result) {
					$result['articleID'] = htmlspecialchars($result['articleID'], ENT_QUOTES, 'UTF-8');
					$result['authorEmail'] = htmlspecialchars($result['authorEmail'], ENT_QUOTES, 'UTF-8');
					$result['titleOfPaper'] = htmlspecialchars($result['titleOfPaper'], ENT_QUOTES, 'UTF-8');
				}
				
				$this->load->view(BACKOFFICE.'manuscript/changeManuscriptArticleID', ['manuscriptInfoResult' => $manuscriptInfoResult]);
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
			// Input validation and sanitization
			$manuscriptID = filter_var($prop, FILTER_VALIDATE_INT);
			if (!$manuscriptID || $manuscriptID <= 0) {
				log_message('error', 'Invalid manuscript ID attempted: ' . $prop);
				$this->session->set_userdata('toastrError', 'Invalid manuscript ID provided');
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
				return;
			}
			
			// Secure database queries
			$manuscriptResult = $this->ManuscriptModel->getManuscript($manuscriptID);
			$statusResult = $this->CommonModel->getData('ijps_tblstatus', array('isActive' => '1'), '', '', '');
			
			if(!empty($manuscriptResult))
			{
				// Sanitize output data
				foreach($manuscriptResult as &$result) {
					$result['titleOfPaper'] = htmlspecialchars($result['titleOfPaper'], ENT_QUOTES, 'UTF-8');
					$result['authorName'] = htmlspecialchars($result['authorName'], ENT_QUOTES, 'UTF-8');
					$result['email'] = htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8');
					$result['message'] = htmlspecialchars($result['message'], ENT_QUOTES, 'UTF-8');
				}
				
				foreach($statusResult as &$status) {
					$status['statusName'] = htmlspecialchars($status['statusName'], ENT_QUOTES, 'UTF-8');
				}
				
				$this->load->view(BACKOFFICE.'manuscript/changeManuscriptStatus', [
					'manuscriptResult' => $manuscriptResult, 
					'statusResult' => $statusResult
				]);
			}
			else
			{
				$this->session->set_userdata('toastrError', NO_DATA_FOUND_MESSAGE);
				redirect(BACKOFFICE.SHOW_DATA_MANUSCRIPTS, 'refresh');
			}
		}
		
		 public function getReviewPoint(){
			// Input validation and sanitization
			$uniqueCode = $this->input->post('uniqueCode', true);
			
			if (empty($uniqueCode) || !preg_match('/^[a-zA-Z0-9]+$/', $uniqueCode)) {
				log_message('error', 'Invalid unique code attempted: ' . $uniqueCode);
				echo json_encode(['error' => 'Invalid unique code provided']);
				return;
			}

			$getReviewPoint = get_record_by_id('tbl_reviewpoint', $uniqueCode);
			$table = '';
			
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
				
				$jsnDecode = json_decode($getReviewPoint->reviewPoint, true);
				
				// Validate JSON decode
				if (json_last_error() !== JSON_ERROR_NONE) {
					log_message('error', 'Invalid JSON in review points for code: ' . $uniqueCode);
					echo json_encode(['error' => 'Invalid review data']);
					return;
				}
				
				$sr = 1; 
				foreach ($jsnDecode as $key => $value) { 
					// Sanitize all output data
					$reviewPoint = htmlspecialchars($value['reviewPoint'], ENT_QUOTES, 'UTF-8');
					$txtCol1Value = htmlspecialchars($value['txtCol1Value'], ENT_QUOTES, 'UTF-8');
					
					// Validate numeric input for points
					$pointsValue = filter_var($txtCol1Value, FILTER_VALIDATE_FLOAT);
					if ($pointsValue === false || $pointsValue < 0 || $pointsValue > 10) {
						$txtCol1Value = '0';
					}
					
					$table .= '<tr>
						<td>' . $sr++ . '</td>
						<td><input class="form-control" type="hidden" name="reviewPoint[]" value="' . $reviewPoint . '">' . $reviewPoint . '</td>
						<td><input type="number" class="form-control" name="txtCol1Value[]" value="' . $txtCol1Value . '" min="0" max="10" step="0.1"></td>
					</tr>';
				}

				$table .= ' </tbody>
				</table>';
				echo $table;
			} else {
				echo '<div class="alert alert-info">No review points found for this manuscript.</div>';
			}
		}
		
		public function updateManuscriptInfoArticleID()
        {
			// CSRF Protection
			if (!$this->security->csrf_verify()) {
				log_message('error', 'CSRF token mismatch in updateManuscriptInfoArticleID');
				echo json_encode(array('status'=>'error','msg'=>'Security token mismatch. Please refresh and try again.'));
				return;
			}
			
			// Input validation and sanitization
			$manuscriptInfoID = filter_var($this->input->post('txtManuscriptInfoID'), FILTER_VALIDATE_INT);
			$articleID = $this->input->post('txtArticleID', true);
			
			if (!$manuscriptInfoID || $manuscriptInfoID <= 0) {
				log_message('error', 'Invalid manuscript info ID in update: ' . $this->input->post('txtManuscriptInfoID'));
				echo json_encode(array('status'=>'error','msg'=>'Invalid manuscript ID provided'));
				return;
			}
			
			if (empty($articleID) || !preg_match('/^[a-zA-Z0-9\/]+$/', $articleID)) {
				log_message('error', 'Invalid article ID format: ' . $articleID);
				echo json_encode(array('status'=>'error','msg'=>'Invalid article ID format'));
				return;
			}
			
            if($manuscriptInfoID && !empty($articleID))
            {
				// Sanitize article ID
				$cleanArticleID = str_replace("IJPS/", '', $articleID);
				$cleanArticleID = preg_replace('/[^a-zA-Z0-9]/', '', $cleanArticleID);
				
				$prop = array( 
					'articleID' => $cleanArticleID,
					'updatedByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
					'updatedDate' => date('Y-m-d H:i:s')
				);

                $bool = $this->CommonModel->updateRecord('ijps_tblmanuscriptinfo', $prop, $manuscriptInfoID, 'manuscriptInfoID');
               
                if($bool == 1)
				{
					// Handle co-author updates with secure file upload
					if(is_array($this->input->post('txtAuthor1Name')))
					{
						$authorNames = $this->input->post('txtAuthor1Name', true);
						$authorEmails = $this->input->post('txtAuthor1Email', true);
						$authorAffiliations = $this->input->post('txtAuthor1Affiliation', true);
						$existingPhotos = $this->input->post('hiddentxtAuthor1Photo', true);
						$manuscriptInfoIDs = $this->input->post('hidtxtManuscriptInfoID', true);
						
						// Validate arrays have same length
						if (count($authorNames) !== count($authorEmails) || 
							count($authorNames) !== count($authorAffiliations)) {
							echo json_encode(array('status'=>'error','msg'=>'Author data mismatch'));
							return;
						}
						
						for($i = 0; $i < count($authorNames); $i++)
						{
							// Validate and sanitize author data
							$authorName = trim($authorNames[$i]);
							$authorEmail = trim($authorEmails[$i]);
							$authorAffiliation = trim($authorAffiliations[$i]);
							
							if (empty($authorName) || empty($authorEmail)) {
								continue; // Skip empty entries
							}
							
							// Validate email format
							if (!filter_var($authorEmail, FILTER_VALIDATE_EMAIL)) {
								log_message('error', 'Invalid email format: ' . $authorEmail);
								continue;
							}
							
							$authorPhotoName = $existingPhotos[$i] ?? '';
							
							// Handle file upload securely
							if (isset($_FILES['txtAuthor1Photo']['name'][$i]) && 
								!empty($_FILES['txtAuthor1Photo']['name'][$i])) {
								
								try {
									$authorPhotoName = $this->secureFileUpload($_FILES['txtAuthor1Photo'], $i);
								} catch (Exception $e) {
									log_message('error', 'File upload error: ' . $e->getMessage());
									echo json_encode(array('status'=>'error','msg'=>'File upload error: ' . $e->getMessage()));
									return;
								}
							}
							
							$prop2 = array( 
								'name' => htmlspecialchars($authorName, ENT_QUOTES, 'UTF-8'),
								'email' => $authorEmail,
								'affiliation' => htmlspecialchars($authorAffiliation, ENT_QUOTES, 'UTF-8'),
								'coAuthorPhoto' => $authorPhotoName,
								'updatedByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
								'updatedDate' => date('Y-m-d H:i:s')
							);
							
							$coAuthorID = filter_var($manuscriptInfoIDs[$i], FILTER_VALIDATE_INT);
							if ($coAuthorID && $coAuthorID > 0) {
								$this->db->where('manuscriptCoAuthorID', $coAuthorID);
								$this->db->update('ijps_tblmanuscriptcoauthor', $prop2);
							}
						}
					}
                
					// Add activity log
					$logProp = array( 
						'description' => self::$messageCommonText." : Updated (".self::$pkey." : ".$manuscriptInfoID." - Article ID : ".$cleanArticleID.")",
						'createdByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
						'createdDate' => date('Y-m-d H:i:s')
					);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $logProp);
					
					echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' updated successfully...'));
              }
              else
              {
                  	echo json_encode(array('status'=>'error','msg'=>self::$messageCommonText.' update error...'));
              }
        }
        else
        {
			echo json_encode(array('status'=>'error','msg'=>'Please fill all required fields...'));
        }
    }
	
	/**
	 * Secure file upload handler
	 */
	private function secureFileUpload($files, $index) {
		$allowedMimes = [
			'image/jpeg' => 'jpg',
			'image/jpg' => 'jpg', 
			'image/png' => 'png',
			'image/gif' => 'gif'
		];
		
		$maxFileSize = 2 * 1024 * 1024; // 2MB
		
		// Check if file was uploaded
		if (!isset($files['tmp_name'][$index]) || empty($files['tmp_name'][$index])) {
			throw new Exception('No file uploaded');
		}
		
		// Validate file size
		if ($files['size'][$index] > $maxFileSize) {
			throw new Exception('File size exceeds 2MB limit');
		}
		
		// Validate MIME type
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mimeType = finfo_file($finfo, $files['tmp_name'][$index]);
		finfo_close($finfo);
		
		if (!array_key_exists($mimeType, $allowedMimes)) {
			throw new Exception('Invalid file type. Only JPG, PNG, and GIF files are allowed');
		}
		
		// Generate secure filename
		$extension = $allowedMimes[$mimeType];
		$filename = 'AuthorPhoto-' . bin2hex(random_bytes(8)) . '-' . date('YmdHis') . '.' . $extension;
		
		// Ensure upload directory exists and is secure
		$uploadPath = UPLOAD_AUTHORS;
		if (!is_dir($uploadPath)) {
			mkdir($uploadPath, 0755, true);
		}
		
		// Create .htaccess to prevent script execution
		$htaccessPath = $uploadPath . '.htaccess';
		if (!file_exists($htaccessPath)) {
			file_put_contents($htaccessPath, "Options -ExecCGI\nAddHandler cgi-script .php .pl .py .jsp .asp .sh .cgi\n");
		}
		
		$targetFile = $uploadPath . $filename;
		
		// Move uploaded file
		if (!move_uploaded_file($files['tmp_name'][$index], $targetFile)) {
			throw new Exception('Failed to save uploaded file');
		}
		
		// Set proper file permissions
		chmod($targetFile, 0644);
		
		
		/**
		 * Send acceptance email with security measures
		 */
		private function sendAcceptanceEmail($articleID, $manuscriptDetails, $reviewPoints, $message, $payLink) {
			try {
				$authorEmail = $this->input->post('txtEmail', true);
				
				if (empty($authorEmail) || !filter_var($authorEmail, FILTER_VALIDATE_EMAIL)) {
					log_message('error', 'Invalid email for acceptance notification: ' . $authorEmail);
					return;
				}
				
				$subject = "ACCEPTANCE LETTER - IJPS journal (Paper_id : IJPS/" . htmlspecialchars($articleID, ENT_QUOTES, 'UTF-8') . ")";
				
				// Build review points table securely
				$reviewTable = $this->buildReviewPointsTable($reviewPoints);
				
				// Sanitize manuscript details
				$titleOfPaper = htmlspecialchars($manuscriptDetails->titleOfPaper, ENT_QUOTES, 'UTF-8');
				$sanitizedMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
				$sanitizedArticleID = htmlspecialchars($articleID, ENT_QUOTES, 'UTF-8');
				
				// Get publication date info
				$pDate = $this->input->post('txtPDate', true);
				$volume = substr($articleID, 2, 2);
				$issue = date('m', strtotime($pDate ?: 'now'));
				$year = date('Y', strtotime($pDate ?: 'now'));
				
				$emailMessage = $this->buildAcceptanceEmailTemplate(
					$titleOfPaper, 
					$sanitizedArticleID, 
					$volume, 
					$issue, 
					$year, 
					$reviewTable, 
					$sanitizedMessage, 
					$payLink
				);
				
				// Send email using secure method
				$this->sendSecureEmail($subject, $emailMessage, $authorEmail, 'acceptance');
				
			} catch (Exception $e) {
				log_message('error', 'Error sending acceptance email: ' . $e->getMessage());
			}
		}
		
		/**
		 * Send publication email with security measures
		 */
		private function sendPublicationEmail($articleID, $manuscriptDetails, $message, $emailString, $file1, $file2, $articleUrl) {
			try {
				if (empty($emailString)) {
					log_message('error', 'No email addresses for publication notification');
					return;
				}
				
				$subject = "Article Published Successfully - IJPS journal (Paper_id : IJPS/" . htmlspecialchars($articleID, ENT_QUOTES, 'UTF-8') . ")";
				
				// Sanitize data
				$titleOfPaper = htmlspecialchars($manuscriptDetails->titleOfPaper, ENT_QUOTES, 'UTF-8');
				$sanitizedMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
				$sanitizedArticleID = htmlspecialchars($articleID, ENT_QUOTES, 'UTF-8');
				$sanitizedArticleUrl = filter_var($articleUrl, FILTER_VALIDATE_URL) ? $articleUrl : '';
				
				// Get publication info
				$pDate = $this->input->post('txtPDate', true);
				$volume = substr($articleID, 2, 2);
				$issue = date('m', strtotime($pDate ?: 'now'));
				$year = date('Y', strtotime($pDate ?: 'now'));
				
				$emailMessage = $this->buildPublicationEmailTemplate(
					$titleOfPaper, 
					$sanitizedArticleID, 
					$volume, 
					$issue, 
					$year, 
					$sanitizedMessage, 
					$sanitizedArticleUrl
				);
				
				// Send email with attachments
				$this->sendSecureEmailWithAttachments($subject, $emailMessage, $emailString, 'publication', [$file1, $file2]);
				
			} catch (Exception $e) {
				log_message('error', 'Error sending publication email: ' . $e->getMessage());
			}
		}
		
		/**
		 * Send rejection email with security measures
		 */
		private function sendRejectionEmail($articleID, $manuscriptDetails, $message, $authorEmail) {
			try {
				$subject = "Rejection of Manuscript - IJPS journal (Paper_id : IJPS/" . htmlspecialchars($articleID, ENT_QUOTES, 'UTF-8') . ")";
				
				// Sanitize data
				$titleOfPaper = htmlspecialchars($manuscriptDetails->titleOfPaper, ENT_QUOTES, 'UTF-8');
				$sanitizedMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
				$sanitizedArticleID = htmlspecialchars($articleID, ENT_QUOTES, 'UTF-8');
				
				// Get publication info
				$pDate = $this->input->post('txtPDate', true);
				$volume = substr($articleID, 2, 2);
				$issue = date('m', strtotime($pDate ?: 'now'));
				$year = date('Y', strtotime($pDate ?: 'now'));
				
				$emailMessage = $this->buildRejectionEmailTemplate(
					$titleOfPaper, 
					$sanitizedArticleID, 
					$volume, 
					$issue, 
					$year, 
					$sanitizedMessage
				);
				
				// Send email
				$this->sendSecureEmail($subject, $emailMessage, $authorEmail, 'rejection');
				
			} catch (Exception $e) {
				log_message('error', 'Error sending rejection email: ' . $e->getMessage());
			}
		}
		
		/**
		 * Build review points table securely
		 */
		private function buildReviewPointsTable($reviewPoints) {
			$table = '<table border="1" cellspacing="0" cellpadding="0" style="border-collapse: collapse; border: none;">
						<tbody>
							<tr style="min-height: 16.1pt;">
								<td width="66" style="width: 49.25pt; border: 1pt solid rgb(191, 191, 191); padding: 0in 5.4pt; min-height: 16.1pt;">
									<p align="center" style="margin: 0in; text-align: center; line-height: normal; font-family: Calibri, sans-serif;">
										<b><span style="font-family: New serif; color: black;">Sr. No.</span></b>
									</p>
								</td>
								<td width="174" style="width: 130.5pt; border-top: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: none; padding: 0in 5.4pt; min-height: 16.1pt;">
									<p style="margin: 0in; line-height: normal; font-family: Calibri, sans-serif;">
										<b><span style="font-family: New serif; color: black;">Critical review on</span></b>
									</p>
								</td>
								<td width="126" style="width: 94.5pt; border-top: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: none; padding: 0in 5.4pt; min-height: 16.1pt;">
									<p align="center" style="margin: 0in; text-align: center; line-height: normal; font-family: Calibri, sans-serif;">
										<b><span style="font-family: New serif; color: black;">Points out of 10</span></b>
									</p>
								</td>
							</tr>';
			
			$serial = 1;
			foreach ($reviewPoints as $point) {
				$reviewPoint = htmlspecialchars($point['reviewPoint'], ENT_QUOTES, 'UTF-8');
				$value = htmlspecialchars($point['txtCol1Value'], ENT_QUOTES, 'UTF-8');
				
				$table .= '<tr style="min-height: 14.5pt;">
							<td width="66" style="width: 49.25pt; border-right: 1pt solid rgb(191, 191, 191); border-bottom: 1pt solid rgb(191, 191, 191); border-left: 1pt solid rgb(191, 191, 191); border-top: none; background: rgb(242, 242, 242); padding: 0in 5.4pt; min-height: 14.5pt;">
								<p align="center" style="margin: 0in; text-align: center; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;">
									<b><span style="font-family: New serif; color: black;">' . $serial++ . '</span></b>
								</p>
							</td>
							<td width="174" style="width: 130.5pt; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); background: rgb(242, 242, 242); padding: 0in 5.4pt; min-height: 14.5pt;">
								<p style="margin: 0in; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;">
									<span style="font-family: New serif; color: black;">' . $reviewPoint . '</span>
								</p>
							</td>
							<td width="126" style="width: 94.5pt; border-top: none; border-left: none; border-bottom: 1pt solid rgb(191, 191, 191); border-right: 1pt solid rgb(191, 191, 191); background: rgb(242, 242, 242); padding: 0in 5.4pt; min-height: 14.5pt;">
								<p align="center" style="margin: 0in; text-align: center; line-height: normal; font-size: 11pt;">
									<font color="#000000" face="Times New Roman, serif">' . $value . '</font>
								</p>
							</td>
						</tr>';
			}
			
			$table .= '</tbody></table>';
			return $table;
		}
		
		/**
		 * Send secure email
		 */
		private function sendSecureEmail($subject, $message, $recipients, $type) {
			try {
				$this->load->library('emaillib');
				$mail = $this->emaillib->load();
				
				// Always add editor email
				$mail->addAddress('editor@ijpsjournal.com');
				
				// Add recipient(s)
				if (strpos($recipients, ',') !== false) {
					$email_addresses = explode(',', $recipients);
					foreach ($email_addresses as $email) {
						$email = trim($email);
						if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$mail->addAddress($email);
						}
					}
				} else {
					if (filter_var($recipients, FILTER_VALIDATE_EMAIL)) {
						$mail->addAddress($recipients);
					}
				}
				
				$mail->Subject = $subject;
				$mail->Body = $message;
				
				$result = $mail->send();
				
				// Log email sending
				log_message('info', 'Email sent - Type: ' . $type . ', Recipients: ' . $recipients . ', Result: ' . ($result ? 'Success' : 'Failed'));
				
				return $result;
				
			} catch (Exception $e) {
				log_message('error', 'Email sending failed: ' . $e->getMessage());
				return false;
			}
		}
		
		/**
		 * Send secure email with attachments
		 */
		private function sendSecureEmailWithAttachments($subject, $message, $recipients, $type, $attachments = []) {
			try {
				$this->load->library('emaillib');
				$mail = $this->emaillib->load();
				
				// Always add editor email
				$mail->addAddress('editor@ijpsjournal.com');
				
				// Add recipient(s)
				if (strpos($recipients, ',') !== false) {
					$email_addresses = explode(',', $recipients);
					foreach ($email_addresses as $email) {
						$email = trim($email);
						if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
							$mail->addAddress($email);
						}
					}
				} else {
					if (filter_var($recipients, FILTER_VALIDATE_EMAIL)) {
						$mail->addAddress($recipients);
					}
				}
				
				// Add attachments securely
				foreach ($attachments as $attachment) {
					if (!empty($attachment) && file_exists(UPLOAD_ARTICLE . $attachment)) {
						$filePath = UPLOAD_ARTICLE . $attachment;
						// Validate file before attaching
						if (is_readable($filePath) && filesize($filePath) < 10485760) { // 10MB limit
							$mail->addAttachment($filePath);
						}
					}
				}
				
				$mail->Subject = $subject;
				$mail->Body = $message;
				
				$result = $mail->send();
				
				// Log email sending
				log_message('info', 'Email with attachments sent - Type: ' . $type . ', Recipients: ' . $recipients . ', Attachments: ' . implode(', ', $attachments) . ', Result: ' . ($result ? 'Success' : 'Failed'));
				
				return $result;
				
				log_message('error', 'Email with attachments sending failed: ' . $e->getMessage());
				return false;
			}
		}
		
		/**
		 * Build acceptance email template
		 */
		private function buildAcceptanceEmailTemplate($title, $articleID, $volume, $issue, $year, $reviewTable, $message, $payLink) {
			return "<div>
						<div>
							<b style='font-size: 11pt;'>
								<span style='color: rgb(32, 56, 100);'><font face='times new roman, serif'>Dear Author/Researcher,</font></span>
							</b>
							<br /><br />
						</div>
						<div>
							<p style='margin: 0in 0in 12pt; line-height: 22px;'>
								<font face='times new roman, serif'>
									<span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
										We are happy to inform you that your manuscript,
									</span>
								</font>
								<b><font face='times new roman, serif' color='#073763'>'</font></b>
								<font face='times new roman, serif'>
									<font color='#073763'>
										<b><span lang='EN-US'>" . strtoupper($title) . "</span></b>
										<b><span style='line-height: 15.6933px;'>'</span></b>
									</font>
									<span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
										has been <b>Accepted</b> for publication in upcoming <b>Vol " . $volume . "; Issue " . $issue . "; " . $year . "</b> of International Journal of Pharmaceutical Sciences.
									</span>
								</font>
							</p>
							<p style='margin-bottom: 12pt;'>
								<font size='4'>
									<span style='font-family: Garamond, serif;'>Manuscript ID :</span>
									<font color='#073763'>
										<b style='font-family: Calibri, sans-serif;'><span style='font-family: Garamond, serif;'>IJPS/" . $articleID . "</span></b>
									</font>
								</font>
							</p>
							<p style='margin: 0in; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'>
								<b><span style='font-size: 12pt; font-family: New serif; color: rgb(64, 64, 64);'>Peer-Review Report:</span></b>
							</p>
							<p style='margin: 0in; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'>
								<b><span style='font-family: New serif; color: rgb(64, 64, 64);'>&nbsp;</span></b>
							</p>
							" . $reviewTable . "
							<div style='color:black; margin-top: 15px;'>
								" . $message . "
							</div>
							<p style='margin-bottom: 12pt;'></p>
							<p style='margin: 0in 0in 8pt; line-height: normal; font-size: 11pt; font-family: Calibri, sans-serif;'>
								<b>
									<span style='font-family: Arial, sans-serif; color: rgb(64, 64, 64);'>
										Reviewer Board Decision: &nbsp;
									</span>
								</b>
								<b>
									<span style='font-family: Arial, sans-serif; color: rgb(83, 129, 53);'>Manuscript Accepted</span>
								</b>
							</p>
							<ul>
								<li style='margin-left: 15px;'>
									<font face='tahoma, sans-serif'>
										<span style='color: rgb(69, 69, 69);'>Send the soft-copy of filled <b>Copyright Transfer Agreement (CTA)</b> within 03 Days.</span>
									</font>
								</li>
								<li style='margin-left: 15px;'>
									<span style='font-family: Tahoma, sans-serif; color: rgb(69, 69, 69);'>
										Deposit/Transfer, Article Processing Charges (<b>APC</b>) of Rs. 1299<b>/-</b> within 03 Days.
									</span>
								</li>
							</ul>
							<div><br /></div>
							Fill up the form: &nbsp;
							<a href='" . site_url('submit-authors-info') . "' style='color: rgb(255, 255, 255); font-size: 13px; background-color: rgb(2, 118, 242); border: 0px solid rgb(0, 0, 0); border-radius: 6px; font-weight: 700; line-height: 40px; padding: 12px 24px; text-align: center; text-decoration-line: none; vertical-align: middle;'>
								Authors info
							</a>
							<br /><br />
							<b><span style='font-family: Garamond, serif;'><font size='4' color='#783f04'>Payment Details:</font></span></b>
							<div>
								<div>
									<font color='#0b5394'><b>Click on Link: </b></font>
									<a href='" . $payLink . "' style='color: rgb(255, 255, 255); font-size: 13px; background-color: rgb(2, 118, 242); border: 0px solid rgb(0, 0, 0); border-radius: 3px; font-weight: 700; line-height: 40px; padding: 12px 24px; text-align: center; text-decoration-line: none; vertical-align: middle;'>
										PAY NOW
									</a>
									<br /><br />
								</div>
								<p style='margin: 0cm 0cm 0.0001pt; line-height: normal; font-family: Calibri, sans-serif;'>
									<span style='font-family: New serif;'>
										<font color='#274e13'>Note: After the deposition of Article Processing Fee, you are requested to intimate us (by email) and send the scan copy of copyright form and receipt immediately by replying to this mail.</font>
									</span>
								</p>
								<p style='margin: 0cm 0cm 6pt; line-height: normal;'>
									<font face='arial, sans-serif' color='#073763'>In case we do not hear from you within the stipulated time, we may postpone the publication until the next issue.</font>
								</p>
								<p style='margin: 0cm 0cm 6pt; line-height: normal;'>
									<font face='arial, sans-serif' color='#073763'>
										We value your support to our journal and Thank you for considering this journal as a venue for your work. If you have any questions, please do not hesitate to contact us.
									</font>
								</p>
							</div>
							" . $this->getEmailFooter() . "
						</div>
					</div>";
		}
		
		/**
		 * Build publication email template
		 */
		private function buildPublicationEmailTemplate($title, $articleID, $volume, $issue, $year, $message, $articleUrl) {
			$viewArticleButton = '';
			if (!empty($articleUrl)) {
				$viewArticleButton = "<div>
										<font color='#073763'>You can also view published article on journal website:</font><br /><br />
										<a href='" . $articleUrl . "' style='color: rgb(255, 255, 255); background-color: rgb(2, 118, 242); border: 0px solid rgb(0, 0, 0); border-radius: 3px; font-size: 13px; font-weight: 700; line-height: 40px; padding: 12px 24px; text-align: center; text-decoration-line: none; vertical-align: middle;'>
											View Article
										</a>
										<br /><br />
									</div>";
			}
			
			return "<div>
						<div><span style='color: rgb(7, 55, 99); font-size: 11pt;'>Dear Author/Researcher,</span><br /><br /></div>
						<div>
							<div>
								<font color='#073763'>
									We are happy to inform you that your article <b><font face='times new roman, serif'>'</font></b>
								</font>
								<b>
									<span lang='EN-US' style='line-height: 115%;'>
										<font color='#073763' face='times new roman, serif'>" . strtoupper($title) . "</font>
									</span>
								</b>
								<font color='#073763' face='times new roman, serif'><b>'</b></font>
								<span style='color: rgb(7, 55, 99);'>has been successfully published in <b>Vol " . $volume . "; Issue " . $issue . "; " . $year . "</b> of International Journal of Pharmaceutical Sciences.</span>
								<br /><br />
							</div>
							" . $viewArticleButton . "
							<div style='color:black; margin: 15px 0;'>
								" . $message . "
							</div>
							<div><font color='#073763' face='comic sans ms, sans-serif'>Please find the attachments below.</font></div>
							<br />
							<p style='margin: 0cm 0cm 6pt; line-height: normal;'>
								<span style='color: rgb(7, 55, 99); font-family: arial, sans-serif;'>We value your support for our journal and thank you for considering this journal as a venue for your work. If you have any questions, please do not hesitate to contact us.</span>
							</p>
							" . $this->getEmailFooter() . "
						</div>
					</div>";
		}
		
		/**
		 * Build rejection email template
		 */
		private function buildRejectionEmailTemplate($title, $articleID, $volume, $issue, $year, $message) {
			return "<div>
						<div>
							<b style='font-size: 11pt;'>
								<span style='color: rgb(32, 56, 100);'>
									<font face='times new roman, serif'>Dear Author/Researcher,</font>
								</span>
							</b>
							<br /><br />
						</div>
						<div>
							<p style='margin: 0in 0in 12pt; line-height: 22px;'>
								<font face='times new roman, serif'>
									<span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
										Your manuscript,
									</span>
								</font>
								<b><font face='times new roman, serif' color='#073763'>'</font></b>
								<font face='times new roman, serif'>
									<font color='#073763'>
										<b><span lang='EN-US'>" . strtoupper($title) . "</span></b>
										<b><span style='line-height: 15.6933px;'>'</span></b>
									</font>
									<span style='font-size: 11pt; line-height: 15.6933px; color: rgb(32, 56, 100);'>
										has been <b>Rejected</b> for publication in upcoming <b>Vol. " . $volume . ", Issue " . $issue . "; " . $year . "</b> of International Journal of Pharmaceutical Sciences.
									</span>
								</font>
							</p>
							<p style='margin: 0in 0in 12pt; line-height: 22px; margin-top:5px;'>
								<span style='font-family: Calibri, sans-serif; font-size: 11pt;'>
									<span style='font-size: 12pt; font-family: New serif; color: rgb(64, 64, 64);'><b>Editorial Comment: </b></span>
								</span>
							</p>
							<p style='margin: 0in 0in 12pt; line-height: 22px;'>
								<span style='color: rgb(64, 64, 64); font-family: New serif; font-size: 12pt;'>
									" . $message . "
								</span>
							</p>
							<p style='margin: 0in 0in 12pt; line-height: 22px;'>
								<span style='color: rgb(64, 64, 64); font-family: New serif; font-size: 12pt;'>Author Guidelines: </span>
								<a href='https://ijpsjournal.com/author-guidelines'>
									https://ijpsjournal.com/author-guidelines
								</a>
							</p>
							<p style='margin: 0in 0in 12pt; line-height: 22px;'>
								<span style='color: rgb(64, 64, 64); font-family: New serif; font-size: 12pt;'>Model manuscript: </span>
								<a href='https://ijpsjournal.com/model-manuscript'>
									https://ijpsjournal.com/model-manuscript
								</a>
							</p>
							" . $this->getEmailFooter() . "
						</div>
					</div>";
		}
		
		/**
		 * Get common email footer
		 */
		private function getEmailFooter() {
			return "<div>
						<p style='margin: 0cm 0cm 6pt; line-height: normal; font-family: Calibri, sans-serif;'>
							<span style='font-family: Tahoma, sans-serif; color: rgb(49, 132, 155);'>
								----------------------------------------------------------------------------------------------
							</span>
						</p>
						<p style='margin: 0cm 0cm 6pt; line-height: normal; font-family: Calibri, sans-serif;'>
							<font color='#666666'>
								<span lang='EN-SG'>If you would like to receive <b>IJPS updates</b>, you may follow us on <b>Facebook</b> 
								<a href='http://www.facebook.com/ijpsjournal'>http://www.facebook.com/ijpsjournal</a>,
								<b>Twitter</b> <a href='http://twitter.com/int_j_pharm_sci'>http://twitter.com/int_j_pharm_sci</a>
								and <b>LinkedIn</b> <a href='http://linkedin.com/company/international-journal-in-pharmaceutical-sciences/'>linkedin.com/company/international-journal-in-pharmaceutical-sciences/</a>
								</span>
							</font>
						</p>
					</div>
					<div><br /></div>
					<span>-- </span><br />
					<div>
						<div>
							<div style='color: rgb(34, 34, 34);'>
								<p style='margin:0px;'>
									<b><span lang='EN-SG' style='color: rgb(31, 73, 125);'>Regards,</span></b>
								</p>
								<p style='margin:0px;'><span style='color: rgb(31, 73, 125);'>Editor-In-Chief</span></p>
								<img src='" . site_url('assetsbackoffice/images/favicon.png') . "' style='width:70px;'>
							</div>
							<div style='color: rgb(34, 34, 34);'><span style='color: rgb(31, 73, 125);'>International Journal of Pharmaceutical Sciences (IJPS)</span></div>
							<div style='color: rgb(34, 34, 34);'>
								<p style='margin:0px;'>
									<span style='color: rgb(31, 73, 125);'>
										E-mail: <a href='mailto:editor@ijpsjournal.com' style='color: rgb(17, 85, 204);'><span style='color: rgb(5, 99, 193);'>editor@ijpsjournal.com</span></a>
									</span>
								</p>
								<p style='margin:0px;'>
									<span style='color: rgb(31, 73, 125);'>Website: </span>
									<a href='http://www.ijpsjournal.com/' style='color: rgb(17, 85, 204);'>
										<span style='color: rgb(5, 99, 193);'>www.ijpsjournal.com</span>
									</a>
								</p>
							</div>
						</div>
					</div>";
		}
        public function updateManuscript()
        {
			// CSRF Protection
			if (!$this->security->csrf_verify()) {
				log_message('error', 'CSRF token mismatch in updateManuscript');
				echo json_encode(array('status'=>'error','msg'=>'Security token mismatch. Please refresh and try again.'));
				return;
			}
			
			// Input validation and sanitization
			$statusID = filter_var($this->input->post('cmbStatusID'), FILTER_VALIDATE_INT);
			$manuscriptID = filter_var($this->input->post('txtManuscriptID'), FILTER_VALIDATE_INT);
			$articleID = $this->input->post('txtArticleID', true);
			$message = $this->input->post('txtMessage', true);
			
			// Validate required inputs
            if(!$statusID || !$manuscriptID || empty($articleID))
            {
				log_message('error', 'Invalid input in updateManuscript: statusID=' . $statusID . ', manuscriptID=' . $manuscriptID);
                echo json_encode(array('status'=>'error','msg'=>'Please fill all required fields...'));
				return;
            }
			
			// Validate status ID is within allowed range
			if ($statusID < 1 || $statusID > 10) {
				log_message('error', 'Invalid status ID in updateManuscript: ' . $statusID);
				echo json_encode(array('status'=>'error','msg'=>'Invalid status selected'));
				return;
			}
			
			// Sanitize article ID
			$articleID = preg_replace('/[^a-zA-Z0-9]/', '', $articleID);
			if (empty($articleID)) {
				log_message('error', 'Invalid article ID format in updateManuscript');
				echo json_encode(array('status'=>'error','msg'=>'Invalid article ID format'));
				return;
			}
			
			try {
				// Prepare update data
				$prop = array( 
					'statusID' => $statusID,
					'message' => htmlspecialchars($message, ENT_QUOTES, 'UTF-8'),
					'updatedByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
					'updatedDate' => date('Y-m-d H:i:s')
				);
				
				// Get manuscript details for email processing
				$conditionsO = array('uniqueCode' => $articleID);
				$getOtherDetails = $this->ManuscriptModel->getOtherDetails($conditionsO);
				
				if (!$getOtherDetails) {
					log_message('error', 'Manuscript not found for article ID: ' . $articleID);
					echo json_encode(array('status'=>'error','msg'=>'Manuscript not found'));
					return;
				}
				
				// Update manuscript record
				$bool = $this->CommonModel->updateRecord(self::$table, $prop, $manuscriptID, self::$pkey);
 
				if($bool == 1)
				{
					// Handle status-specific processing
					if($statusID == 2) // Accepted status
					{
						$this->processAcceptedManuscript($articleID, $getOtherDetails, $message);
					}
					else if($statusID == 4) // Published status
					{
						$this->processPublishedManuscript($articleID, $getOtherDetails, $message);
					}
					else if($statusID == 5) // Rejected status
					{
						$this->processRejectedManuscript($articleID, $getOtherDetails, $message);
					}
					
					// Add activity log
					$logProp = array( 
						'description' => self::$messageCommonText." : Updated (".self::$pkey." : ".$manuscriptID." - Status changed to ".$statusID.")",
						'createdByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
						'createdDate' => date('Y-m-d H:i:s')
					);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $logProp);
					
					echo json_encode(array('status'=>'success','msg'=>self::$messageCommonText.' updated successfully...'));
				}
				else
				{
					log_message('error', 'Failed to update manuscript ID: ' . $manuscriptID);
					echo json_encode(array('status'=>'error','msg'=>self::$messageCommonText.' update error...'));
				}
				
			} catch (Exception $e) {
				log_message('error', 'Exception in updateManuscript: ' . $e->getMessage());
				echo json_encode(array('status'=>'error','msg'=>'An error occurred while updating the manuscript'));
			}
        }
		
		/**
		 * Process accepted manuscript (Status ID = 2)
		 */
		private function processAcceptedManuscript($articleID, $manuscriptDetails, $message) {
			try {
				// Validate and process review points
				$reviewPoints = $this->input->post('reviewPoint');
				$txtCol1Value = $this->input->post('txtCol1Value');
				
				if (!is_array($reviewPoints) || !is_array($txtCol1Value)) {
					log_message('error', 'Invalid review points data for article: ' . $articleID);
					return;
				}
				
				$rePoint = array();
				foreach ($reviewPoints as $key => $reviewPoint) {
					// Sanitize review point data
					$sanitizedReviewPoint = htmlspecialchars(trim($reviewPoint), ENT_QUOTES, 'UTF-8');
					$sanitizedValue = filter_var($txtCol1Value[$key], FILTER_VALIDATE_FLOAT);
					
					if (empty($sanitizedReviewPoint) || $sanitizedValue === false) {
						continue; // Skip invalid entries
					}
					
					// Validate score range (0-10)
					if ($sanitizedValue < 0 || $sanitizedValue > 10) {
						$sanitizedValue = 0;
					}
					
					$rePoint[] = array(
						'reviewPoint' => $sanitizedReviewPoint,
						'txtCol1Value' => $sanitizedValue
					);
				}
				
				if (empty($rePoint)) {
					log_message('error', 'No valid review points for article: ' . $articleID);
					return;
				}
				
				$reviewData = json_encode($rePoint);
				$insertArray = array(
					'reviewPoint' => $reviewData,
					'articleId' => $articleID,
					'created_data' => date('Y-m-d H:i:s')
				);

				// Check if review point already exists
				$conditions = array('articleId' => $articleID);
				$isExits = $this->ManuscriptModel->is_record_exist($conditions);
				
				if($isExits) {
					$this->ManuscriptModel->update_record($articleID, $insertArray);
				} else {
					$this->ManuscriptModel->insertReviewPoint('tbl_reviewpoint', $insertArray);
				}
				
				// Determine payment link based on country
				$conditionsC = array('uniqueCode' => $articleID);
				$country_code = $this->ManuscriptModel->getCountry($conditionsC);
				
				$pay_link = base_url('pay-fees/international'); // Default
				if($country_code && isset($country_code[0]['countryID']) && $country_code[0]['countryID'] == '99') {
					$pay_link = base_url('pay-fees/indian');
				}
				
				// Send acceptance email
				$this->sendAcceptanceEmail($articleID, $manuscriptDetails, $rePoint, $message, $pay_link);
				
			} catch (Exception $e) {
				log_message('error', 'Error processing accepted manuscript: ' . $e->getMessage());
			}
		}
		
		/**
		 * Process published manuscript (Status ID = 4)
		 */
		private function processPublishedManuscript($articleID, $manuscriptDetails, $message) {
			try {
				// Get email addresses for notification
				$emailData = $this->ManuscriptModel->getEmail($articleID);
				$emailString = '';
				
				if(!empty($emailData)) {
					foreach ($emailData as $row) {
						if (!empty($row['emails'])) {
							$emailString .= $row['emails'] . ', ';
						}
						if (!empty($row['co_author_emails'])) {
							$emailString .= $row['co_author_emails'] . ', ';
						}
					}
				}
				
				$emailString = rtrim($emailString, ', ');
				
				// Handle file attachments securely
				$file1 = $this->handlePublicationAttachment('file1');
				$file2 = $this->handlePublicationAttachment('file2');
				
				// Get article URL
				$documentResult = $this->ManuscriptModel->getDocument(array('manuscriptID' => $this->input->post('txtManuscriptID')));
				$article_url = '';
				
				if (!empty($documentResult) && isset($documentResult[0]['document'])) {
					$file_info = pathinfo($documentResult[0]['document']);
					$article_url = isset($file_info['filename']) ? base_url('article/') . $file_info['filename'] : '';
				}
				
				// Send publication email
				$this->sendPublicationEmail($articleID, $manuscriptDetails, $message, $emailString, $file1, $file2, $article_url);
				
			} catch (Exception $e) {
				log_message('error', 'Error processing published manuscript: ' . $e->getMessage());
			}
		}
		
		/**
		 * Process rejected manuscript (Status ID = 5)
		 */
		private function processRejectedManuscript($articleID, $manuscriptDetails, $message) {
			try {
				// Get author email
				$authorEmail = $this->input->post('txtEmail', true);
				
				if (empty($authorEmail) || !filter_var($authorEmail, FILTER_VALIDATE_EMAIL)) {
					log_message('error', 'Invalid email for rejection notification: ' . $authorEmail);
					return;
				}
				
				// Send rejection email
				$this->sendRejectionEmail($articleID, $manuscriptDetails, $message, $authorEmail);
				
			} catch (Exception $e) {
				log_message('error', 'Error processing rejected manuscript: ' . $e->getMessage());
			}
		}
		
		/**
		 * Handle publication file attachments securely
		 */
		private function handlePublicationAttachment($fileKey) {
			if (!isset($_FILES[$fileKey]['name']) || empty($_FILES[$fileKey]['name'])) {
				return '';
			}
			
			try {
				// Validate file upload
				$validation = validate_file_upload($_FILES[$fileKey], ['application/pdf', 'application/msword'], 10485760); // 10MB limit
				
				if (!empty($validation)) {
					log_message('error', 'File validation failed for ' . $fileKey . ': ' . implode(', ', $validation));
					return '';
				}
				
				// Generate secure filename
				$ext = pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION);
				$filename = 'mailAttachment_' . $fileKey . '_' . bin2hex(random_bytes(8)) . '_' . date('YmdHis') . '.' . $ext;
				
				$target_file = UPLOAD_ARTICLE . $filename;
				
				if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $target_file)) {
					chmod($target_file, 0644); // Set secure permissions
					return $filename;
				}
				
			} catch (Exception $e) {
				log_message('error', 'Error handling publication attachment: ' . $e->getMessage());
			}
			
			return '';
		}
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
        			
        				
        				if(isset($_FILES['file2']['name']) && $_FILES['file2']['name']=="")
        				{
        					$file2 = "";
        				}
        				else
        				{
                            if(isset($_FILES['file2']['name']) && $_FILES['file2']['name']!=""){
        					    $ext = substr(strrchr($_FILES['file2']['name'], '.'), 1);
        					    $file2 = "mailAttachment2-".date('YmdHis').".".$ext;
                            }
        				}
        				
    					
    					if(isset($_FILES["file2"]["name"]) && $_FILES["file2"]["name"] != "")
    					{
    						/******************************** File 2 Upload *********************************/
    						$target_file    = UPLOAD_ARTICLE.$file2;
                            move_uploaded_file($_FILES['file2']['tmp_name'], $target_file);
    						/**********  File 2 Upload *********************************/
    					}
                        $file_info =pathinfo($this->input->post('articlePdf'));
    					$article_url = (isset($file_info['filename']) && !empty($file_info['filename'])) ? base_url('article/') . $file_info['filename'] : '';

    			
    					
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
			// CSRF Protection
			if (!$this->security->csrf_verify()) {
				log_message('error', 'CSRF token mismatch in fetchDocuments');
				echo json_encode(array('status'=>'error','msg'=>'Security token mismatch'));
				return;
			}
			
			// Input validation
			$manuscriptID = filter_var($this->input->post('manuscriptId'), FILTER_VALIDATE_INT);
			
			if (!$manuscriptID || $manuscriptID <= 0) {
				log_message('error', 'Invalid manuscript ID in fetchDocuments: ' . $this->input->post('manuscriptId'));
				echo json_encode(array('status'=>'error','msg'=>'Invalid manuscript ID'));
				return;
			}
			
			try {
				$con = array('manuscriptID' => $manuscriptID);
				$result = $this->ManuscriptModel->getDocument($con);
				
				if(!empty($result) && isset($result[0]['document'])) {
					$document = $result[0]['document'];
					
					// Validate document filename
					if (empty($document) || !preg_match('/^[a-zA-Z0-9._-]+$/', $document)) {
						log_message('error', 'Invalid document filename: ' . $document);
						echo json_encode(array('status'=>'error','msg'=>'Invalid document'));
						return;
					}
					
					// Check if file exists
					$filePath = UPLOAD_ARTICLE . $document;
					if (!file_exists($filePath)) {
						log_message('error', 'Document file not found: ' . $filePath);
						echo json_encode(array('status'=>'error','msg'=>'Document file not found'));
						return;
					}
					
					// Generate secure URL
					$articleUrl = base_url() . UPLOAD_ARTICLE . htmlspecialchars($document, ENT_QUOTES, 'UTF-8');
					
					echo json_encode(array(
						'status'=>'success',
						'articleUrl'=>$articleUrl,
						'document'=>htmlspecialchars($document, ENT_QUOTES, 'UTF-8')
					));
				} else {
					echo json_encode(array('status'=>'error','msg'=>'No document found'));
				}
				
			} catch (Exception $e) {
				log_message('error', 'Exception in fetchDocuments: ' . $e->getMessage());
				echo json_encode(array('status'=>'error','msg'=>'An error occurred while fetching document'));
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
			// CSRF Protection
			if (!$this->security->csrf_verify()) {
				log_message('error', 'CSRF token mismatch in deleteManu');
				echo json_encode(array('status'=>'error','msg'=>'Security token mismatch'));
				return;
			}
			
			// Input validation
			$manuscriptID = filter_var($this->input->post('manuscriptID'), FILTER_VALIDATE_INT);
			
			if (!$manuscriptID || $manuscriptID <= 0) {
				log_message('error', 'Invalid manuscript ID in deleteManu: ' . $this->input->post('manuscriptID'));
				echo json_encode(array('status'=>'error','msg'=>'Invalid manuscript ID'));
				return;
			}
			
			try {
				// Check if manuscript exists and user has permission
				$existingManuscript = $this->CommonModel->getData(
					self::$table, 
					array('manuscriptID' => $manuscriptID, 'isActive' => '1'), 
					'manuscriptID,titleOfPaper', 
					'', 
					'row_array'
				);
				
				if (empty($existingManuscript)) {
					log_message('error', 'Manuscript not found for deletion: ' . $manuscriptID);
					echo json_encode(array('status'=>'error','msg'=>'Manuscript not found'));
					return;
				}
				
				// Soft delete - set isActive to 0
				$updateData = array(
					'isActive' => '0',
					'updatedByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
					'updatedDate' => date('Y-m-d H:i:s')
				);
				
				$this->db->set($updateData);
				$this->db->where('manuscriptID', $manuscriptID);          
				
				if($this->db->update(self::$table))
				{
					// Add activity log
					$logProp = array( 
						'description' => self::$messageCommonText." : Deleted (".self::$pkey." : ".$manuscriptID." - Title: ".substr($existingManuscript['titleOfPaper'], 0, 50).")",
						'createdByUserID' => filter_var($this->session->userdata['userID'], FILTER_SANITIZE_NUMBER_INT),
						'createdDate' => date('Y-m-d H:i:s')
					);
					$this->CommonModel->insertRecord(ACTIVITY_LOG_TABLE, $logProp);
					
					// Log security event
					log_security_event('manuscript_deleted', [
						'manuscript_id' => $manuscriptID,
						'title' => $existingManuscript['titleOfPaper']
					]);
					
					echo json_encode(array('status'=>'success','msg'=>'Manuscript deleted successfully'));
				}
				else
				{
					log_message('error', 'Failed to delete manuscript: ' . $manuscriptID);
					echo json_encode(array('status'=>'error','msg'=>'Failed to delete manuscript'));
				}
				
			} catch (Exception $e) {
				log_message('error', 'Exception in deleteManu: ' . $e->getMessage());
				echo json_encode(array('status'=>'error','msg'=>'An error occurred while deleting manuscript'));
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
			// CSRF Protection
			if (!$this->security->csrf_verify()) {
				log_message('error', 'CSRF token mismatch in getCoAuthor');
				echo json_encode(array('status'=>'error','msg'=>'Security token mismatch'));
				return;
			}
			
			// Input validation
			$manuscriptID = filter_var($this->input->post('mId'), FILTER_VALIDATE_INT);
			
			if (!$manuscriptID || $manuscriptID <= 0) {
				log_message('error', 'Invalid manuscript ID in getCoAuthor: ' . $this->input->post('mId'));
				echo '<div class="alert alert-danger">Invalid manuscript ID</div>';
				return;
			}
			
			try {
				// Get co-author data with validation
				$coAuthorsData = $this->CommonModel->getDataLimit(
					'ijps_tblmanuscriptcoauthor', 
					array('isActive'=>'1', 'manuscriptInfoID'=>$manuscriptID), 
					'', '', '', '', '', 'manuscriptCoAuthorID', 'ASC'
				);
				
				if (empty($coAuthorsData)) {
					echo '<div class="alert alert-info">No co-authors found for this manuscript.</div>';
					return;
				}
				
				// Sanitize co-author data to prevent XSS
				foreach ($coAuthorsData as &$author) {
					$author['name'] = htmlspecialchars($author['name'], ENT_QUOTES, 'UTF-8');
					$author['email'] = htmlspecialchars($author['email'], ENT_QUOTES, 'UTF-8');
					$author['affiliation'] = htmlspecialchars($author['affiliation'], ENT_QUOTES, 'UTF-8');
					$author['coAuthorPhoto'] = htmlspecialchars($author['coAuthorPhoto'], ENT_QUOTES, 'UTF-8');
				}
				
				$result['coAuthorsData'] = $coAuthorsData;
				$result['manuscriptID'] = $manuscriptID;
				
				// Load view with sanitized data
				$view_content = $this->load->view('backoffice/coauthorInfo', $result, true);
				
				// Additional XSS protection for view content
				$view_content = preg_replace_callback('/(<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>)/gi', function($matches) {
					log_message('warning', 'Script tag detected in co-author view content');
					return '<!-- Script removed for security -->';
				}, $view_content);
				
				echo $view_content;
				
			} catch (Exception $e) {
				log_message('error', 'Exception in getCoAuthor: ' . $e->getMessage());
				echo '<div class="alert alert-danger">An error occurred while loading co-author information</div>';
			}
        }

        
	}
    
?>
