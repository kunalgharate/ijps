<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
defined('BASEPATH') or exit('No direct script access allowed');


class DummyController extends CI_Controller
{
    
    public function __construct(){
        parent::__construct();
    }
    
    public function dd(){
        
            $this->load->library('emaillib');
            $mail = $this->emaillib->load();
            $mail->setFrom('editor@ijpsjournal.com', 'IJPS');
            
            
            // $email_addresses = explode(',', $email_list);
            
            // foreach ($email_addresses as $email) {
            //     $email = trim($email); // Remove any whitespace from the email address
            //     $mail->addAddress($email);
            // }


            $mail->addAddress('sunily46@gmail.com');
            $mail->Subject = 'New Email Subject';
            $message = "this testing email-multiple attachment";
            $mail->Body =  $message;
           
    $mail->SMTPDebug = 2;
    echo "---->>>".$_SERVER['DOCUMENT_ROOT'];
   echo 'Mailer Error: ' . $mail->ErrorInfo;
            if (!$mail->send()) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } 
        
        
    }
}
